<!-- Modal -->
<div id="editarPagoModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar Pago</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    </div>

    <br />

    <!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <div class="row">
        <div class="col-sm">
            <label for="modal_fecha">Fecha:</label><br />
            <input type="text" class="form-control" placeholder="Fecha" aria-describedby="basic-addon1"
                id="modal_fecha"/><br />

            <label for="modal_importe">Importe:</label><br />
            <input type="text" class="form-control" placeholder="Importe" aria-describedby="basic-addon1"
                id="modal_importe" /><br />

            <label for="modal_observaciones">Observaciones:</label><br />
            <input type="text" class="form-control" placeholder="Observaciones" aria-describedby="basic-addon1"
                id="modal_observaciones" /><br />
        </div>

        <div class="modal-footer">
            <input id="numero_filasu" name="numero_filasu" type="hidden">
            <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
</div>
</div>
@push('js')


<script type="text/javascript">

    //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

    $(document).on("click", ".btn_edit_modal", function() {

                //Obtenemos el numero de la fila que queremos modificar
                var id_filasu = $("#numero_filasu").val();

                //Recuperamos los valores de los campos del modal
                var modal_fecha = $("#modal_fecha").val();
                var modal_importe = $("#modal_importe").val();
                var modal_observaciones = $("#modal_observaciones").val();

                //Ocultamos el modal
                $('#editarPagoModal').modal('hide');

                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                $('#fecha'+id_filasu).val(modal_fecha);
                $('#importe'+id_filasu).val(modal_importe);
                $('#observaciones'+id_filasu).val(modal_observaciones);

            });
</script>
@endpush
