<div class="modal fade" id="modalEditarBarbeiro<?php echo $barbeiro['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-secondary" style="background-color: #1e2125;">
            <div class="modal-header border-secondary">
                <h5 class="text-white fw-semibold">
                    <i class="bi bi-pencil-square me-2"></i> Editar Barbeiro
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form action="update.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-white">
                    <input type="hidden" name="id" value="<?php echo $barbeiro['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($barbeiro['nome']); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefone / WhatsApp</label>
                            <input type="text" name="telefone" class="form-control" value="<?php echo htmlspecialchars($barbeiro['telefone']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Especialidade Principal</label>
                            <select name="servico_id" class="form-control text-white" style="background-color: rgba(0,0,0,0.2);">
                                <option value="" class="bg-dark text-muted">Clássico / Geral</option>
                                <?php foreach ($lista_servicos as $s) { 
                                    $selected = ($s['id'] == $barbeiro['servico_id']) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $s['id']; ?>" class="bg-dark text-white" <?php echo $selected; ?>><?php echo htmlspecialchars($s['nome']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biografia / Resumo</label>
                        <textarea name="bio" class="form-control" rows="3"><?php echo htmlspecialchars($barbeiro['bio']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto de Perfil (Deixe em branco para manter a atual)</label>
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

<!-- finalizado -->