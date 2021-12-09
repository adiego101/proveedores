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
    </div>

    <br />
    
<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

<div class="row">
        <div class="col-sm">
            <label for="modal_domicilio">Domicilio:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="modal_domicilio" name="domicilios[]" /><br />
        </div>

        <div class="col-sm">
            <label for="modal_localidad">Localidad:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la localidad" aria-describedby="basic-addon1" id="modal_localidad" name="localidades[]" /><br />

            <div class="modal-footer">
                <input id="numero_fila" name="numero_fila" type="hidden">
                <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script type="text/javascript">

    //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

    $(document).on("click", ".btn_edit_modal", function() {
                
                //Obtenemos el numero de la fila que queremos modificar
                var id_fila = $("#numero_fila").val();

                //Recuperamos los valores de los campos del modal
                var modal_domicilio = $("#modal_domicilio").val();
                var modal_localidad = $("#modal_localidad").val();

                //Ocultamos el modal
                $('#modal_sede').modal('hide'); 
            
                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                $('#domicilio'+id_fila).val(modal_domicilio);
                $('#localidad'+id_fila).val(modal_localidad);
                
            });
</script>