<div class="modal fade" id="modalDetalhes<?php echo $servico['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title fw-semibold"><?php echo htmlspecialchars($servico['nome']); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="/projeto-pw/public/uploads/<?php echo htmlspecialchars($servico['foto']); ?>" class="img-fluid rounded mb-3" style="max-height: 300px; width: 100%; object-fit: cover;">
                
                <div class="d-flex justify-content-center gap-4 my-3">
                    <span class="fs-5"><i class="bi bi-clock text-muted me-1"></i> <?php echo $servico['duracao']; ?> minutos</span>
                    <span class="fs-5 fw-bold" style="color: #75b798;">R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?></span>
                </div>
                
                <hr class="border-secondary">
                
                <p class="text-start p-2" style="color: #c0c0c0; white-space: pre-line; font-size: 0.95rem;">
                    <?php echo htmlspecialchars($servico['descricao']); ?>
                </p>
            </div>
            <div class="modal-footer border-top border-secondary">
                <button type="button" class="btn-azul-custom" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>