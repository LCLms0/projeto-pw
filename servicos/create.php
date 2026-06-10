<?php
require_once __DIR__ . '/../auth/security.php';

$erros = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../config/config.php';

    $nome = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);
    $duracao = intval($_POST['duracao']);
    $descricao = trim($_POST['descricao']);

    unset($_SESSION['sucesso_servico']);

    // --- VALIDAÇÕES ---
    if ($preco <= 0) {
        $erros[] = "O preço do serviço deve ser maior que zero!";
    }
    
    if ($duracao <= 0) {
        $erros[] = "A duração do serviço deve ser maior que zero!";
    }

    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        $erros[] = "Erro no envio da foto. Certifique-se de escolher um arquivo.";
    }
    if (empty($nome)) {
        $erros[] = "O nome do serviço é obrigatório.";
    }
    if (is_numeric($nome)) {
        $erros[] = "O nome do serviço não pode ser composto apenas por números.";
    }
    if (strlen($nome) > 100) {
        $erros[] = "O nome do serviço está muito longo (máximo de 100 caracteres).";
    }

    if (empty($erros)) {
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_info = getimagesize($file_tmp);
        
        if ($file_info !== false) {
            $mime_type = $file_info['mime'];
            
            if ($mime_type === 'image/jpeg' || $mime_type === 'image/jpg') {
                $img_original = imagecreatefromjpeg($file_tmp);
            } elseif ($mime_type === 'image/png') {
                $img_original = imagecreatefrompng($file_tmp);
            } else {
                $erros[] = "Formato de imagem inválido! Apenas JPG, JPEG ou PNG.";
            }

            if (empty($erros)) {
                $largura_orig = imagesx($img_original);
                $altura_orig = imagesy($img_original);

                $menor_lado = min($largura_orig, $altura_orig);
                $src_x = (int) round(($largura_orig - $menor_lado) / 2);
                $src_y = (int) round(($altura_orig - $menor_lado) / 2);

                $tamanho_alvo = 1080;
                $img_quadrada = imagecreatetruecolor($tamanho_alvo, $tamanho_alvo);

                if ($mime_type === 'image/png') {
                    imagealphablending($img_quadrada, false);
                    imagesavealpha($img_quadrada, true);
                }

                imagecopyresampled(
                    $img_quadrada, $img_original, 
                    0, 0, $src_x, $src_y, 
                    $tamanho_alvo, $tamanho_alvo, 
                    $menor_lado, $menor_lado
                );

                $nome_foto = uniqid() . '.jpg';
                $pasta_destino = __DIR__ . '/../public/uploads/';

                if (!is_dir($pasta_destino)) {
                    mkdir($pasta_destino, 0777, true);
                }

                imagejpeg($img_quadrada, $pasta_destino . $nome_foto, 85);

                imagedestroy($img_original);
                imagedestroy($img_quadrada);

                $stmt = $pdo->prepare("INSERT INTO servicos (nome, preco, duracao, descricao, foto) VALUES (:nome, :preco, :duracao, :descricao, :foto)");
                $stmt->execute([
                    'nome' => $nome,
                    'preco' => $preco,
                    'duracao' => $duracao,
                    'descricao' => $descricao,
                    'foto' => $nome_foto
                ]);

                $_SESSION['sucesso_servico'] = "O serviço \"$nome\" foi cadastrado com sucesso!";
                header("Location: servicos.php");
                exit();
            }
        } else {
            $erros[] = "O arquivo enviado não é uma imagem válida.";
        }
    }
}

if (!empty($erros)) {
    $erro_lista = $erros; 
    include 'servicos.php';
    exit();
}

// finalizado