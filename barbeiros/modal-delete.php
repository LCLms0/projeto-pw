<div class="modal fade" id="modalDeletarBarbeiro<?php echo $barbeiro['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-secondary bg-dark text-white text-center p-3">
            <div class="modal-body">
                <i class="bi bi-exclamation-triangle text-danger mb-3" style="font-size: 3rem;"></i>
                <h5 class="fw-semibold text-white mb-2">Excluir Barbeiro?</h5>
                <p class="text-white small">Tem certeza que quer remover <strong class="text-primary">"<?php echo htmlspecialchars($barbeiro['nome']); ?>"</strong> da equipe? Essa ação é permanente.</p>
                
                <form action="delete.php" method="POST" class="mt-4 d-flex justify-content-center gap-2">
                    <input type="hidden" name="id" value="<?php echo $barbeiro['id']; ?>">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" style="background-color: #343a40; border: none;">Não</button>
                    <button type="submit" class="btn btn-danger btn-sm px-3">Sim, Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>