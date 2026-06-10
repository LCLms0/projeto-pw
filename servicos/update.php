<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';

$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);
    $duracao = intval($_POST['duracao']);
    $descricao = trim($_POST['descricao']);

    unset($_SESSION['sucesso_servico']);

    // --- AS MESMAS VALIDAÇÕES DO CREATE.PHP ---
    if ($preco <= 0) {
        $erros[] = "O preço do serviço deve ser maior que zero!";
    }
    
    if ($duracao <= 0) {
        $erros[] = "A duração do serviço deve ser maior que zero!";
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

    // Se houver qualquer erro de preenchimento, interrompe e volta exibindo o erro
    if (!empty($erros)) {
        $erro_lista = $erros;
        include 'servicos.php';
        exit();
    }

    // 1. Busca o serviço atual para saber qual é a foto antiga
    $stmt = $pdo->prepare("SELECT foto FROM servicos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $servico_atual = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$servico_atual) {
        header("Location: servicos.php");
        exit();
    }

    $nome_foto = $servico_atual['foto']; 

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {

            $novo_nome_foto = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = __DIR__ . '/../public/uploads/';
            $dest_path = $uploadFileDir . $novo_nome_foto;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {

                $foto_antiga_caminho = $uploadFileDir . $servico_atual['foto'];
                if (file_exists($foto_antiga_caminho) && !empty($servico_atual['foto'])) {
                    unlink($foto_antiga_caminho);
                }
                
                $nome_foto = $novo_nome_foto;
            }
        }
    }

    $stmt_update = $pdo->prepare("UPDATE servicos SET nome = :nome, preco = :preco, duracao = :duracao, descricao = :descricao, foto = :foto WHERE id = :id");
    $stmt_update->execute([
        'nome' => $nome,
        'preco' => $preco,
        'duracao' => $duracao,
        'descricao' => $descricao,
        'foto' => $nome_foto,
        'id' => $id
    ]);

    $_SESSION['sucesso_servico'] = "Serviço atualizado com sucesso!";
}

header("Location: servicos.php");
exit();

// finalizado