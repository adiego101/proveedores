<!-- Modal -->
<div id="modal_seguro" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Editar Seguro</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <label for="modal_poliza">Póliza:</label><br />
                    <input type="text" class="form-control" placeholder="Ingrese la póliza" aria-describedby="basic-addon1" id="modal_poliza" name="modal_poliza" maxlength="20"/>
                    <br />

                    <label for="modal_agencia">Agencia:</label><br />
                    <input type="text" class="form-control" placeholder="Ingrese la agencia" aria-describedby="basic-addon1" id="modal_agencia" name="modal_agencia" maxlength="40"/>
                    <br />

                    <label for="modal_asegurado">Asegurado:</label><br />
                    <input type="text" class="form-control" placeholder="Ingrese el asegurado" aria-describedby="basic-addon1" id="modal_asegurado" name="modal_asegurado" maxlength="40"/>
                    <br />
                     
                    <label for="modal_vigencia">Vigencia hasta:</label><br />
                    <input type="date" class="form-control" placeholder="Ingrese la fecha de vigencia" aria-describedby="basic-addon1" id="modal_vigencia" name="modal_vigencia" />
                    <br />
                    
                    <div class="modal-footer">
                        <input id="numero_fila_seguro" name="numero_fila_seguro" type="hidden">
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
                var id_fila = $("#numero_fila_seguro").val();

                //Recuperamos los valores de los campos del modal
                var modal_poliza = $("#modal_poliza").val();
                var modal_asegurado = $("#modal_asegurado").val();
                var modal_agencia = $("#modal_agencia").val();
                var modal_vigencia = $("#modal_vigencia").val();

                //Ocultamos el modal
                $('#modal_seguro').modal('hide');

                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                $('#poliza'+id_fila).val(modal_poliza);
                $('#asegurado'+id_fila).val(modal_asegurado);
                $('#agencia'+id_fila).val(modal_agencia);
                $('#vigencia'+id_fila).val(modal_vigencia);

                //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                var modal_vigencia_clasica = modal_vigencia.split('-').reverse().join('/');
                $('#poliza_text'+id_fila).text(modal_poliza);
                $('#asegurado_text'+id_fila).text(modal_asegurado);
                $('#agencia_text'+id_fila).text(modal_agencia);
                $('#vigencia_text'+id_fila).text(modal_vigencia_clasica);

            });
</script>
