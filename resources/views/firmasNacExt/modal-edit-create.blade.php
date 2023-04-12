<!-- Modal -->
<div id="modal_denominaciones" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar Denominación</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm">
                    @include('firmasNacExt.form')
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="numero_fila_denominacion" name="numero_fila_denominacion" type="hidden">
                    <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                    <button type="button" class="btn btn-outline-danger btn_cancel_modal" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

