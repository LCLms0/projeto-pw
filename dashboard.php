<?php
require_once __DIR__ . '/auth/security.php';
require_once __DIR__ . '/config/config.php';

// 1. Conta o total de Serviços
$stmt_servicos = $pdo->query("SELECT COUNT(*) FROM servicos");
$total_servicos = $stmt_servicos->fetchColumn();

// 2. Conta o total de Barbeiros
$stmt_barbeiros = $pdo->query("SELECT COUNT(*) FROM barbeiros");
$total_barbeiros = $stmt_barbeiros->fetchColumn();

// 3. Conta o total de Clientes
$stmt_clientes = $pdo->query("SELECT COUNT(*) FROM clientes");
$total_clientes = $stmt_clientes->fetchColumn();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Barber Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/projeto-pw/public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row vh-100">
            <?php include __DIR__ . '/includes/sidebar.php'; ?>    
            
            <div class="col-md-9 col-lg-10 p-4 bg-dark">
                <div class="p-4 rounded-3 mb-4 painel-bg">
                    
                    <h1 class="text-white montserrat mb-1">
                        <i class="bi bi-speedometer2 me-2 text-primary"></i> Painel de Controle
                    </h1>
                    <h2 class="fs-5 text-white-50 mb-4">
                        Bem-vindo de volta! Aqui está o resumo em tempo real da sua barbearia.
                    </h2>

                    <div class="row g-4 mb-4">
                        
                        <div class="col-10 col-sm-6 col-lg-4 mx-auto">
                            <div class="p-4 rounded-3 text-white h-100 d-flex align-items-center justify-content-between card-dashboard-info card-azul">
                                <div>
                                    <span class="text-white-50 small text-uppercase fw-bold d-block mb-1 label-card-dashboard">Clientes Ativos</span>
                                    <h3 class="fs-1 fw-bold mb-0 montserrat"><?php echo $total_clientes; ?></h3>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center icone-container-dashboard">
                                    <i class="bi bi-people-fill fs-2 text-white"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 col-sm-6 col-lg-4 mx-auto">
                            <div class="p-4 rounded-3 text-white h-100 d-flex align-items-center justify-content-between card-dashboard-info card-verde">
                                <div>
                                    <span class="text-white-50 small text-uppercase fw-bold d-block mb-1 label-card-dashboard">Equipe / Barbeiros</span>
                                    <h3 class="fs-1 fw-bold mb-0 montserrat"><?php echo $total_barbeiros; ?></h3>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center icone-container-dashboard">
                                    <i class="bi bi-scissors fs-2 text-white"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 col-sm-6 col-lg-4 mx-auto">
                            <div class="p-4 rounded-3 text-white h-100 d-flex align-items-center justify-content-between card-dashboard-info card-laranja">
                                <div>
                                    <span class="text-white-50 small text-uppercase fw-bold d-block mb-1 label-card-dashboard">Serviços no Menu</span>
                                    <h3 class="fs-1 fw-bold mb-0 montserrat"><?php echo $total_servicos; ?></h3>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center icone-container-dashboard">
                                    <i class="bi bi-card-checklist fs-2 text-white"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="p-4 rounded-3 mt-4 atalho-box-dashboard">
                        <h4 class="text-white fs-5 mb-3 montserrat"><i class="bi bi-lightning-charge me-2 text-primary"></i>Acesso Rápido</h4>
                        <p class="text-white-50 small">Utilize o menu lateral para navegar entre os módulos, efetuar novos cadastros ou atualizar as tabelas do sistema de forma dinâmica.</p>
                    </div>

                </div> 
            </div>   
        </div>           
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>