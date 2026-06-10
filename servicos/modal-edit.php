<div class="modal fade" id="modalEditar<?php echo $servico['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-secondary" style="background-color: #1e2125;">

            <div class="modal-header border-secondary">
                <h5 class="text-white fw-semibold">
                    <i class="bi bi-pencil-square me-2"></i> Editar Serviço
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <form action="update.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-white">
                    
                    <input type="hidden" name="id" value="<?php echo $servico['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label small text-muted">Nome do Serviço</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($servico['nome']); ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Preço (R$)</label>
                            <input type="number" step="0.01" name="preco" class="form-control" value="<?php echo $servico['preco']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Duração (minutos)</label>
                            <input type="number" name="duracao" class="form-control" value="<?php echo $servico['duracao']; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Descrição do Serviço</label>
                        <textarea name="descricao" class="form-control" rows="3"><?php echo htmlspecialchars($servico['descricao']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Foto do Serviço (Deixe em branco para manter a atual)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="background-color: #343a40; border: none;">Cancelar</button>
                    <button type="submit" class="btn btn-login px-4 py-2">Atualizar Serviço</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- finalizado -->