<div class="modal fade" id="modalDetalhesCliente<?php echo $cliente['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-secondary" style="background-color: #1e2125;">
            <div class="modal-header border-secondary">
                <h5 class="text-white fw-semibold">
                    <i class="bi bi-eye me-2 text-primary"></i> Ficha do Cliente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body text-white">
                
                <div class="mb-3 pb-2 border-bottom border-secondary-subtle">
                    <span class="label-detalhe">Nome do Cliente:</span>
                    <p class="fs-5 fw-semibold text-white mb-0"><?php echo htmlspecialchars($cliente['nome']); ?></p>
                </div>

                <div class="row mb-3 pb-2 border-bottom border-secondary-subtle">
                    <div class="col-6 border-end border-secondary-subtle">
                        <span class="label-detalhe">Telefone de Contato:</span>
                        <p class="fs-6 fw-semibold text-white mb-0"><?php echo htmlspecialchars($cliente['telefone']); ?></p>
                    </div>
                    <div class="col-6 ps-3">
                        <span class="label-detalhe">Serviço Preferido:</span>
                        <p class="fs-6 fw-semibold text-primary mb-0">
                            <i class="bi bi-heart-fill text-danger me-1 small"></i> 
                            <?php echo !empty($cliente['servico_favorito']) ? htmlspecialchars($cliente['servico_favorito']) : 'Não informado'; ?>
                        </p>
                    </div>
                </div>

                <div class="mb-2">
                    <span class="label-detalhe">Foto de Perfil:</span>
                    <div class="rounded overflow-hidden border border-secondary" style="max-height: 240px; background-color: rgba(0, 0, 0, 0.2);">
                        <img src="/public/uploads/<?php echo htmlspecialchars($cliente['foto']); ?>" 
                             class="w-100 h-100" 
                             style="object-fit: cover; max-height: 240px;" 
                             alt="Foto de <?php echo htmlspecialchars($cliente['nome']); ?>">
                    </div>
                </div>

            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="background-color: #343a40; border: none;">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!--finalizado -->