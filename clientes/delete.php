<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt_foto = $pdo->prepare("SELECT foto FROM clientes WHERE id = :id");
    $stmt_foto->execute(['id' => $id]);
    $cliente = $stmt_foto->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        $caminho_foto = __DIR__ . '/../public/uploads/' . $cliente['foto'];
        if (file_exists($caminho_foto) && !empty($cliente['foto']) && $cliente['foto'] != 'default-avatar.png') {
            unlink($caminho_foto);
        }

        $stmt_del = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt_del->execute(['id' => $id]);

        $_SESSION['sucesso_cliente'] = "Cliente removido com sucesso!";
    }
}

header("Location: clientes.php");
exit();