<?php
require_once __DIR__ . '/../auth/security.php';
require_once __DIR__ . '/../config/config.php';
// Busca todos os serviços cadastrados (do mais novo pro mais antigo)
$stmt = $pdo->prepare("SELECT * FROM servicos ORDER BY id DESC");
$stmt->execute();
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <button class="btn-login px-3 py-2 w-25" data-bs-toggle="modal" data-bs-target="#modalServico">
                            Adicionar Serviço
                        </button>

                        <div class="position-relative" style="width: 100%; max-width: 350px;">
                            <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                                <i class="bi bi-search text-primary"></i>
                            </span>
                        </div>
                    </div>

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
    
                    <div class="card-exibir w-100 mt-2">
                        <?php if (empty($servicos)) { ?>
                            <p class="text-muted text-center my-4">Nenhum serviço cadastrado ainda.</p>
                        <?php } else { ?>
                            
                            <div class="container-scroll-servicos">
                                <div class="grid-servicos">
                                    <?php foreach ($servicos as $servico) { ?>
                                        
                                        <div class="card-servico-custom" data-bs-toggle="modal" data-bs-target="#modalDetalhes<?php echo $servico['id']; ?>">
                                            <img src="/projeto-pw/public/uploads/<?php echo htmlspecialchars($servico['foto']); ?>" class="card-servico-img" alt="<?php echo htmlspecialchars($servico['nome']); ?>">
                                            
                                            <div class="card-servico-corpo">
                                                <h3 class="text-white fs-5 mb-1 montserrat"><?php echo htmlspecialchars($servico['nome']); ?></h3>
                                                
                                                <div class="text-muted small mb-2">
                                                    <i class="bi bi-clock me-1"></i> <?php echo $servico['duracao']; ?> min
                                                </div>
                                                
                                                <p class="descricao-cortada">
                                                    <?php echo htmlspecialchars($servico['descricao']); ?>
                                                </p>
                                                
                                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                                    <span class="preco-servico">R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?></span>
                                                    
                                                    <div>
                                                        <button class="btn btn-sm btn-outline-secondary me-1" title="Editar"><i class="bi bi-pencil"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Deletar"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php include __DIR__ . '/modal-details.php'; ?>

                                    <?php } ?>
                                </div>
                            </div>
                            
                        <?php } ?>
                    </div>
                </div> 
            </div>   
        </div>           
    </div>

    <?php include __DIR__ . '/modal-create.php'; ?>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Se o PHP devolveu erros de validação, força o modal de cadastro a abrir
        <?php if (!empty($erro_lista)) { ?>
            var meuModal = new bootstrap.Modal(document.getElementById('modalServico'));
            meuModal.show();
        <?php } ?>

        // Pesquisa dinâmica em tempo real
        const inputPesquisa = document.getElementById('pesquisaServico');
        if (inputPesquisa) {
            inputPesquisa.addEventListener('input', function() {
                const termo = this.value.toLowerCase().trim();
                const cards = document.querySelectorAll('.card-servico-custom');

                cards.forEach(card => {
                    const nomeServico = card.querySelector('h3').textContent.toLowerCase();
                    if (nomeServico.includes(termo)) {
                        card.style.display = "flex"; 
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>