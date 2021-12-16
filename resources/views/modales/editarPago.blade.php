<!-- Modal -->
<div id="modal_pago" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar Pago</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm">
                        <label for="modal_fecha">Fecha:</label><br />
                        <input type="date" class="form-control" placeholder="Fecha" aria-describedby="basic-addon1"
                            id="modal_fecha" /><br />

                        <label for="modal_importe">Importe:</label><br />
                        <input type="text" class="form-control" placeholder="Importe" aria-describedby="basic-addon1"
                            id="modal_importe" /><br />

                        <label for="modal_observaciones">Observaciones:</label><br />
                        <input type="text" class="form-control" placeholder="Observaciones"
                            aria-describedby="basic-addon1" id="modal_observaciones" /><br />
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="numero_fila_pago" name="numero_fila_pago" type="hidden">
                    <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')


    <script type="text/javascript">
        //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

        $(document).on("click", ".btn_edit_modal", function() {

            //Obtenemos el numero de la fila que queremos modificar
            var id_filapago = $("#numero_fila_pago").val();

            //Recuperamos los valores de los campos del modal
            var modal_fecha = $("#modal_fecha").val();
            var modal_importe = $("#modal_importe").val();
            var modal_observaciones = $("#modal_observaciones").val();

            //Ocultamos el modal
            $('#modal_pago').modal('hide');

            //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
            $('#fecha_pago' + id_filapago).val(modal_fecha);
            $('#importe_pago' + id_filapago).val(modal_importe);
            $('#observaciones_pago' + id_filapago).val(modal_observaciones);

        });
    </script>
@endpush