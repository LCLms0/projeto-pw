<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';

$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $telefone = preg_replace('/\D/', '', $_POST['telefone']); // Limpa deixando apenas números
    $bio = trim($_POST['bio']);
    $servico_id = !empty($_POST['servico_id']) ? intval($_POST['servico_id']) : null;

    unset($_SESSION['sucesso_barbeiro']);

    // --- VALIDAÇÕES ---
    if (empty($nome)) {
        $erros[] = "O nome do barbeiro é obrigatório.";
    }

    if (is_numeric($nome)) {
        $erros[] = "O nome do barbeiro não pode ser composto apenas por números.";
    }

    if (strlen($nome) > 100) {
        $erros[] = "O nome do barbeiro está muito longo (máximo de 100 caracteres).";
    }

    if (strlen($telefone) < 10 || strlen($telefone) > 11) {
        $erros[] = "Telefone inválido. Insira um número com DDD válido.";
    }

    // Se houver qualquer erro de preenchimento na edição, interrompe e volta
    if (!empty($erros)) {
        $erro_lista = $erros;
        include 'barbeiros.php';
        exit();
    }

    // --- BUSCA O BARBEIRO ATUAL ---
    $stmt = $pdo->prepare("SELECT foto FROM barbeiros WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $barbeiro_atual = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$barbeiro_atual) {
        header("Location: barbeiros.php");
        exit();
    }

    $nome_foto = $barbeiro_atual['foto']; 

    // --- PROCESSAMENTO DA FOTO NA EDIÇÃO ---
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $novo_nome_foto = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = __DIR__ . '/../public/uploads/';
            
            if (move_uploaded_file($fileTmpPath, $uploadFileDir . $novo_nome_foto)) {
                $foto_antiga = $uploadFileDir . $barbeiro_atual['foto'];
                if (file_exists($foto_antiga) && !empty($barbeiro_atual['foto']) && $barbeiro_atual['foto'] != 'default-barber.png') {
                    unlink($foto_antiga);
                }
                $nome_foto = $novo_nome_foto;
            }
        } else {
            $erro_lista = ["Formato de imagem inválido! Use JPG, JPEG, PNG ou WEBP."];
            include 'barbeiros.php';
            exit();
        }
    }
    // --- ATUALIZAÇÃO NO BANCO ---
    $stmt_update = $pdo->prepare("UPDATE barbeiros SET nome = :nome, telefone = :telefone, bio = :bio, servico_id = :servico_id, foto = :foto WHERE id = :id");
    $stmt_update->execute([
        'nome' => $nome,
        'telefone' => $telefone,
        'bio' => $bio,
        'servico_id' => $servico_id,
        'foto' => $nome_foto,
        'id' => $id
    ]);

    $_SESSION['sucesso_barbeiro'] = "Dados do barbeiro updated!";
}
header("Location: barbeiros.php");
exit();