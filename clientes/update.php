<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $servico_favorito_id = !empty($_POST['servico_favorito_id']) ? intval($_POST['servico_favorito_id']) : null;

    $stmt = $pdo->prepare("SELECT foto FROM clientes WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $cliente_atual = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente_atual) {
        header("Location: clientes.php");
        exit();
    }

    $nome_foto = $cliente_atual['foto']; 

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $novo_nome_foto = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = __DIR__ . '/../public/uploads/';
            
            if (move_uploaded_file($fileTmpPath, $uploadFileDir . $novo_nome_foto)) {
                $foto_antiga = $uploadFileDir . $cliente_atual['foto'];
                if (file_exists($foto_antiga) && !empty($cliente_atual['foto']) && $cliente_atual['foto'] != 'default-avatar.png') {
                    unlink($foto_antiga);
                }
                $nome_foto = $novo_nome_foto;
            }
        }
    }

    $stmt_update = $pdo->prepare("UPDATE clientes SET nome = :nome, telefone = :telefone, servico_favorito_id = :servico_favorito_id, foto = :foto WHERE id = :id");
    $stmt_update->execute([
        'nome' => $nome,
        'telefone' => $telefone,
        'servico_favorito_id' => $servico_favorito_id,
        'foto' => $nome_foto,
        'id' => $id
    ]);

    $_SESSION['sucesso_cliente'] = "Dados do cliente atualizados!";
}

header("Location: clientes.php");
exit();