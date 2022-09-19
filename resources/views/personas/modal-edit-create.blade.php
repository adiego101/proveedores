<div class="modal fade" id="edit_persona" role="dialog" aria-labelledby="editPersonaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPersonaModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('personas.form')
          <input id="numero_fila_persona" name="numero_fila_persona" type="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn_edit_modal">Editar</button>
        <button type="button" class="btn btn-secondary btn_cancel_modal" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
