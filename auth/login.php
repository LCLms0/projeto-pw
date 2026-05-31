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
    <title>Login | Barbearia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
    
    <div class="row">
        
        <div class="col-12 col-md-7">
            <h2>Lado da Foto e Texto</h2>
        </div>

        <div  class="col-12 col-md-5">
            <div>
                <h1>Login</h1>
                <?php if (isset($erro)){ ?>
                <h1 style="color: red;"><?php echo $erro;?></h1>
                <?php } ?>
                <form action="login.php" method="POST">
                    <label for="username">Nome:</label>
                    <input type="text" id="username" name="username" required>
                    <br>
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                    <br>
                    <button type="submit" name="enter">Entrar</button>
                </form>
                </div>
        </>

    </div>

    </div>
</body>
</html>