<!-- Modal -->
<div id="modal_banco" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar referencia bancaria</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                @include('bancos.form')
            </div>
            <div class="modal-footer">
                <input id="numero_fila_banco" name="numero_fila_banco" type="hidden">
                <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                <button type="button" class="btn btn-outline-danger btn_cancel_modal" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
