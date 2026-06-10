<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';

$erros = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $telefone = preg_replace('/\D/', '', $_POST['telefone']); // Limpa parênteses, traços e espaços
    $servico_favorito_id = !empty($_POST['servico_favorito_id']) ? intval($_POST['servico_favorito_id']) : null;
    $nome_foto = 'default-avatar.png'; // Foto padrão para clientes

    unset($_SESSION['sucesso_cliente']);

    // --- VALIDAÇÕES ---
    if (empty($nome)) {
        $erros[] = "O nome do cliente é obrigatório.";
    }

    if (is_numeric($nome)) {
        $erros[] = "O nome do cliente não pode ser composto apenas por números.";
    }

    if (strlen($nome) > 100) {
        $erros[] = "O nome do cliente está muito longo (máximo de 100 caracteres).";
    }

    if (strlen($telefone) < 10 || strlen($telefone) > 11) {
        $erros[] = "Telefone inválido. Insira um número com DDD válido.";
    }

    // Se houver erro, barra na hora e volta exibindo na tela
    if (!empty($erros)) {
        $erro_lista = $erros;
        include 'clientes.php';
        exit();
    }

    // --- UPLOAD DA FOTO ---
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $nome_foto = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = __DIR__ . '/../public/uploads/' . $nome_foto;
            move_uploaded_file($fileTmpPath, $dest_path);
        }
    }

    // --- ENVIANDO PARA O BANCO DE DADOS ---
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, telefone, servico_favorito_id, foto) VALUES (:nome, :telefone, :servico_favorito_id, :foto)");
    $stmt->execute([
        'nome' => $nome,
        'telefone' => $telefone,
        'servico_favorito_id' => $servico_favorito_id,
        'foto' => $nome_foto
    ]);

    $_SESSION['sucesso_cliente'] = "Cliente adicionado com sucesso!";
}

header("Location: clientes.php");
exit();