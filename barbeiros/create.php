<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $bio = trim($_POST['bio']);
    $servico_id = !empty($_POST['servico_id']) ? intval($_POST['servico_id']) : null;
    $nome_foto = 'default-barber.png'; // Foto padrão caso falte upload

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

    $stmt = $pdo->prepare("INSERT INTO barbeiros (nome, telefone, bio, servico_id, foto) VALUES (:nome, :telefone, :bio, :servico_id, :foto)");
    $stmt->execute([
        'nome' => $nome,
        'telefone' => $telefone,
        'bio' => $bio,
        'servico_id' => $servico_id,
        'foto' => $nome_foto
    ]);

    $_SESSION['sucesso_barbeiro'] = "Barbeiro adicionado com sucesso!";
}

header("Location: barbeiros.php");
exit();