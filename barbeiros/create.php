<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';

$erros = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $telefone = preg_replace('/\D/', '', $_POST['telefone']);
    $bio = trim($_POST['bio']);
    $servico_id = !empty($_POST['servico_id']) ? intval($_POST['servico_id']) : null;
    $nome_foto = 'default-barber.png'; // Foto padrão caso falte upload

    unset($_SESSION['sucesso_barbeiro']);
    // ---VALIDAÇÕES ---
    if (empty($nome)) {
        $erros[] = "O nome do barbeiro é obrigatório.";
    }
    if (is_numeric($nome)) {
        $erros[] = "O nome do barbeiro não pode ser composto apenas por números.";
    }
    if (strlen($nome) > 100) {
        $erros[] = "O nome do barbeiro está muito longo (máximo de 100 caracteres).";
    }
    // --- VALIDAÇÃO DO TELEFONE ---
    if (strlen($telefone) < 10 || strlen($telefone) > 11) {
        $erros[] = "Telefone inválido. Insira um número com DDD válido.";
    }

    // Se houver qualquer erro de preenchimento, interrompe o script e volta exibindo os erros
    if (!empty($erros)) {
        $erro_lista = $erros;
        include 'barbeiros.php';
        exit();
    }

    // --- ARQUIVO DE FOTO ---
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

    try {
            $stmt = $pdo->prepare("INSERT INTO barbeiros (nome, telefone, bio, servico_id, foto) VALUES (:nome, :telefone, :bio, :servico_id, :foto)");
            $stmt->execute([
                ':nome'       => $nome,
                ':telefone'   => $telefone,
                ':bio'        => $bio,
                ':servico_id' => $servico_id,
                ':foto'       => $nome_foto
            ]);

            $_SESSION['sucesso_barbeiro'] = "Barbeiro adicionado com sucesso!";
        } catch (PDOException $e) {
            // Se o banco rejeitar o comando, o script para aqui e mostra o motivo real
            die("Erro no banco de dados: " . $e->getMessage());
        }    

    $_SESSION['sucesso_barbeiro'] = "Barbeiro adicionado com sucesso!";
}

header("Location: barbeiros.php");
exit();

// finalizado
