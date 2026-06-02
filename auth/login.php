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
    <title>Login | Control Barber </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

</head>
    <body>
    <div class="container-fluid">        
        <div class="row vh-100">
            
            <div class="col-12 col-md-7 border-end border-primary fundo-esquerdo-imagem">   
            </div>

            <div class="col-12 col-md-5 d-flex flex-column justify-content-center align-items-center bg-dark p-4">
                    

                <div class="caixa-login w-100" style="max-width: 400px;">
                    <h1 class="text-white text-center fs-2 mb-4 roboto-mono">Login</h1>

                    <form action="login.php" method="POST">

                        <?php if (!empty($erro)) { ?>
                        <div class="alert alert-danger-custom d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>
                        <?php echo htmlspecialchars($erro); ?>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nome" required>
                            <label for="username">Nome:</label>
                        </div>
                        
                        <div class="form-floating mb-4 position-relative">
                            <input type="password" class="form-control pe-5" id="password" name="password" placeholder="Senha" required>
                            <label for="password">Senha:</label>
                            <span class="position-absolute end-0 top-50 translate-middle-y me-3 text-secondary" style="cursor: pointer; z-index: 10;" id="togglePassword">
                                <i class="bi bi-eye" id="iconeOlho"></i>
                            </span>
                        </div>
                        
                        <button type="submit" name="enter" class="btn-login text-uppercase w-100 py-3 mt-2">
                            Acessar Painel
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const iconeOlho = document.querySelector('#iconeOlho');

        togglePassword.addEventListener('click', function () {
            // Modifica o tipo do input entre password e text
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Alterna o desenho do ícone do olho
            iconeOlho.classList.toggle('bi-eye');
            iconeOlho.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>