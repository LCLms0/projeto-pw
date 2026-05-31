<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: ../dashboard.php") ;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../config/config.php';
    
    $user_typed = strtolower(trim($_POST['username']));
    $password_typed = trim($_POST['password']);

    if (!empty($user_typed) && !empty($password_typed)) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $stmt->execute(['usuario' => $user_typed]);

        $user_bank = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_bank) {   
            if ($password_typed === $user_bank['senha']) {
                $_SESSION["username"] = $user_bank['usuario'];
                header("Location: ../dashboard.php");  
                exit();
            } else {
                $erro = "Usuário e/ou Senha Incorretos!";
            }
        } else {
            $erro = "Usuário e/ou Senha Incorretos!";
        }
    } else {
        $erro = "Usuário e/ou Senha Incorretos!";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CTRL Barber </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../public/css/style.css">

</head>
    <body>
    <div class="container-fluid">        
        <div class="row vh-100">
            
            <div class="col-12 col-md-7 border-end border-primary fundo-esquerdo-imagem">
                <img src="../public/css/imgs/logo.png" class="w-25 mt-5" alt="logo">        
            </div>

            <div class="col-12 col-md-5 d-flex flex-column justify-content-center">
                <div>
                    <h1>Login</h1>
                    <form action="login.php" method="POST">
                        
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nome" required>
                            <label for="username">Nome:</label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                            <label for="password">Senha:</label>
                        </div>
                        
                        <button type="submit" name="enter">Acessar Painel</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>
</html>