<div class="modal fade" id="modalServico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-secondary" style="background-color: #1e2125;">

            <div class="modal-header border-secondary">
                <h5 class="text-white fw-semibold">
                    <i class="bi bi-scissors me-2"></i> Adicionar Novo Serviço
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <form action="create.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-white">
                    <?php if (!empty($erro_lista)) { ?>
                    <div class="alert alert-danger-custom mb-3" role="alert">
                        <?php foreach ($erro_lista as $index => $item) { ?>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <div><?php echo htmlspecialchars($item); ?></div>
                            </div>
                            <?php if ($index < count($erro_lista) - 1) echo '<hr class="my-2 border-danger-subtle">'; ?>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    
                    <div class="mb-3">
                        <label class="form-label small text-muted">Nome do Serviço</label>
                        <input type="text" name="nome" class="form-control bg-dark text-white border-secondary" placeholder="Ex: Corte Degradê" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Preço (R$)</label>
                            <input type="number" step="0.01" name="preco" class="form-control bg-dark text-white border-secondary" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Duração (minutos)</label>
                            <input type="number" name="duracao" class="form-control bg-dark text-white border-secondary" placeholder="Ex: 30" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Descrição do Serviço</label>
                        <textarea name="descricao" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="O que inclui nesse serviço..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Foto do Serviço (1080 x 1080)</label>
                        <input type="file" name="foto" class="form-control bg-dark text-white border-secondary" accept="image/*" required>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn-azul-custom" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: #75b798; border: none; color: #1e2125; font-weight: 600;">Salvar Serviço</button>
                </div>
            </form>

        </div>
    </div>
</div>