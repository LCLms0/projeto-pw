<div class="modal fade" id="modalBarbeiro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-secondary" style="background-color: #1e2125;">
            <div class="modal-header border-secondary">
                <h5 class="text-white fw-semibold">
                    <i class="bi bi-person-plus me-2"></i> Adicionar Novo Barbeiro
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form action="create.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="nome" class="form-control" placeholder="Ex: Lucas Silva" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefone / WhatsApp</label>
                            <input type="text" name="telefone" class="form-control" placeholder="(00) 00000-0000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Especialidade Principal</label>
                            <select name="servico_id" class="form-control text-white" style="background-color: rgba(0,0,0,0.2);">
                                <option value="" class="bg-dark text-muted">Clássico / Geral</option>
                                <?php foreach ($lista_servicos as $s) { ?>
                                    <option value="<?php echo $s['id']; ?>" class="bg-dark text-white"><?php echo htmlspecialchars($s['nome']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biografia / Resumo</label>
                        <textarea name="bio" class="form-control" rows="3" placeholder="Conte um pouco sobre a experiência dele..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto de Perfil</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="background-color: #343a40; border: none;">Cancelar</button>
                    <button type="submit" class="btn btn-login px-4 py-2">Salvar Barbeiro</button>
                </div>
            </form>
        </div>
    </div>
</div>