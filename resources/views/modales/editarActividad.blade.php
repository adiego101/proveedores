<!-- Modal -->
<div id="modal_actividad" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Editar Actividad</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm">
                            <!--En este caso, se deben recuperar los tipos de actividad de la BD -->
                            <label for="modal_tipo_actividad">Tipo de Actividad:</label><br>
                               
                                <br />
                        </div>

                        <div class="col-sm">
                            <!--En este caso, se deben recuperar las actividades de la BD -->
                            <label for="modal_actividad">Actividad:</label><br>
                             
                                <br />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="numero_fila_actividad" name="numero_fila_actividad" type="hidden">
                        <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

