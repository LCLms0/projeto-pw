<?php
require_once __DIR__ . '/../auth/security.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])) {
    require_once __DIR__ . '/../config/config.php';
    
    $id = intval($_POST['id']);

    // Busca o nome do arquivo da foto no banco para excluir do servidor
    $stmt_foto = $pdo->prepare("SELECT foto FROM servicos WHERE id = :id");
    $stmt_foto->execute(['id' => $id]);
    $servico = $stmt_foto->fetch(PDO::FETCH_ASSOC);

    if ($servico) {
        $caminho_foto = __DIR__ . '/../public/uploads/' . $servico['foto'];
        
        // Remove o arquivo do disco se ele existir para não acumular lixo
        if (file_exists($caminho_foto) && !empty($servico['foto'])) {
            unlink($caminho_foto);
        }

        // Executa o comando de exclusão na tabela
        $stmt_del = $pdo->prepare("DELETE FROM servicos WHERE id = :id");
        $stmt_del->execute(['id' => $id]);

        $_SESSION['sucesso_servico'] = "Serviço removido com sucesso!";
    }
}

header("Location: servicos.php");
exit();

// finalizado