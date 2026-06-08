<div class="modal fade" id="modalEditarCliente<?php echo $cliente['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-secondary" style="background-color: #1e2125;">
            <div class="modal-header border-secondary">
                <h5 class="text-white fw-semibold">
                    <i class="bi bi-pencil-square me-2"></i> Editar Cliente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form action="update.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-white">
                    <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefone / Celular</label>
                            <input type="text" name="telefone" class="form-control" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Serviço Favorito</label>
                            <select name="servico_favorito_id" class="form-control text-white" style="background-color: rgba(0,0,0,0.2);">
                                <option value="" class="bg-dark text-muted">Nenhum / Variado</option>
                                <?php foreach ($lista_servicos as $s) { 
                                    $selected = ($s['id'] == $cliente['servico_favorito_id']) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $s['id']; ?>" class="bg-dark text-white" <?php echo $selected; ?>><?php echo htmlspecialchars($s['nome']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto do Cliente (Deixe em branco para manter a atual)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="background-color: #343a40; border: none;">Cancelar</button>
                    <button type="submit" class="btn btn-login px-4 py-2">Atualizar Dados</button>
                </div>
            </form>
        </div>
    </div>
</div>