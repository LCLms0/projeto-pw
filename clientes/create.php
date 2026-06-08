<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $servico_favorito_id = !empty($_POST['servico_favorito_id']) ? intval($_POST['servico_favorito_id']) : null;
    $nome_foto = 'default-avatar.png'; // Foto padrão para clientes

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