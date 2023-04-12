<div class="modal fade" id="add_banco" role="dialog" aria-labelledby="addBancoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBancoModalLabel">Nueva referencia bancaria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('bancos.form')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn_cancel_modal" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="store_banco">Guardar</button>
      </div>
    </div>
  </div>
</div>