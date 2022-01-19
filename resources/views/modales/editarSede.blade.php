<!-- Modal -->
<div id="modal_sede" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Editar Sede</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm">
                            <label for="modal_domicilio_sede">Domicilio:</label><br />
                            <input type="text" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="modal_domicilio_sede" name="modal_domicilio_sede" /><br />
                        </div>

                        <div class="col-sm">
                            <label for="modal_localidad_sede">Localidad:</label><br />
                            <input type="text" class="form-control" placeholder="Ingrese la localidad" aria-describedby="basic-addon1" id="modal_localidad_sede" name="modal_localidad_sede" /><br />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="numero_fila_sede" name="numero_fila_sede" type="hidden">
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
                var id_fila = $("#numero_fila_sede").val();

                //Recuperamos los valores de los campos del modal
                var modal_domicilio = $("#modal_domicilio_sede").val();
                var modal_localidad = $("#modal_localidad_sede").val();

                //Ocultamos el modal
                $('#modal_sede').modal('hide');

                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                $('#domicilio_sede'+id_fila).val(modal_domicilio);
                $('#localidad_sede'+id_fila).val(modal_localidad);

                //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                $('#domicilio_sede_text'+id_fila).text(modal_domicilio);
                $('#localidad_sede_text'+id_fila).text(modal_localidad);

            });
</script>
