<!-- Modal -->
<div id="modal_vehiculo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Editar Vehículo</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                            <div class="col-sm">
                                <label for="modal_marca_vehiculo">Marca:</label><br />
                                <input type="text" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="modal_marca_vehiculo" name="modal_marca_vehiculo" /><br />

                                <label for="modal_dominio_vehiculo">Dominio:</label><br />
                                <input type="text" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="modal_dominio_vehiculo" name="modal_dominio_vehiculo" /><br />
                            </div>

                            <div class="col-sm">
                                <label for="modal_modelo_vehiculo">Modelo:</label><br />
                                <input type="text" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modal_modelo_vehiculo" name="modal_modelo_vehiculo" /><br />

                                <label for="modal_inscripto_en_vehiculo">Inscripto en:</label><br />
                                <input type="text" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="modal_inscripto_en_vehiculo" name="modal_inscripto_en_vehiculo" /><br />
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input id="numero_fila_vehiculo" name="numero_fila_vehiculo" type="hidden">
                        <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">

    //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

    $(document).on("click", ".btn_edit_modal", function() {

                //Obtenemos el numero de la fila que queremos modificar
                var id_fila = $("#numero_fila_vehiculo").val();

                //Recuperamos los valores de los campos del modal
                var modal_marca = $("#modal_marca_vehiculo").val();
                var modal_dominio = $("#modal_dominio_vehiculo").val();
                var modal_modelo = $("#modal_modelo_vehiculo").val();
                var modal_inscripto = $("#modal_inscripto_en_vehiculo").val();

                //Ocultamos el modal
                $('#modal_vehiculo').modal('hide');

                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                $('#marca_vehiculo'+id_fila).val(modal_marca);
                $('#dominio_vehiculo'+id_fila).val(modal_dominio);
                $('#modelo_vehiculo'+id_fila).val(modal_modelo);
                $('#inscripto_en_vehiculo'+id_fila).val(modal_inscripto);

            });
</script>
