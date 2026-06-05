<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços | Barber Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/projeto-pw/public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Changa+One:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row vh-100">
            <?php include __DIR__ . '/../includes/sidebar.php'; ?>    
            <div class="col-md-9 col-lg-10 p-4 bg-dark">
                <div class="p-4 rounded-3 mb-4 d-flex flex-column" style="background-color: #1e2125;">
                    <h1 class="text-white montserrat">
                        <i class="bi bi-card-checklist me-2"></i> Serviços
                    </h1>
                    <h2 class="fs-5 text-white mb-4">
                        Ajuste preços, durações e detalhes dos serviços disponíveis para entregar a melhor experiência e cuidado aos seus clientes.
                    </h2>

                    <button class="btn-login px-3 py-2 w-25 mb-4" data-bs-toggle="modal" data-bs-target="#modalServico">
                        Adicionar Serviço
                    </button>

                    <?php if (!empty($_SESSION['sucesso_servico'])) { ?>
                    <div class="alert-success-custom d-flex align-items-center mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2" style="font-size: 1.1rem;"></i>
                        <div>
                            <?php 
                                echo htmlspecialchars($_SESSION['sucesso_servico']); 
                                unset($_SESSION['sucesso_servico']); 
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="card-exibir">
                        </div>
                </div>
            </div>   
        </div>           
    </div>
    <?php include __DIR__ . '/modal-create.php'; ?>
<?php if (!empty($erro_lista)) { ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var meuModal = new bootstrap.Modal(document.getElementById('modalServico'));
        meuModal.show();
    });
</script>
<?php } ?>
</body>
</html>