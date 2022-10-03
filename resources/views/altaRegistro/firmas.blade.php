<fieldset>

    <h1>Firmas Nacionales y Extranjeras que representa</h1>

    <br>
      
    @include('firmasNacExt.form', ['mode'=>'create'])

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a id="add_denominacion" class="btn btn-success">Agregar Denominación</a>
    </div>

    <br>

    <div>
        <table class="table table-hover" id="firmas_nac_ext">
            <thead>
                <tr>
                    <th>Denominación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_denominacion"></tbody>
        </table>
    </div>

    <br />

    <hr>

    
    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" data-tipo='firma' value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" data-tipo='firma' value="Siguiente" />


    <!--Incluimos el modal para editar una denominación-->

    @include('firmasNacExt.modal-edit-create',['mode'=>'edit'])

    <!--Incluimos el modal para validar una denominación -->

    @include('modales.validarFirma')

</fieldset>

@push('js')
    <script type="text/javascript">

        var cant_filas_firma = $("#body_table_denominacion > tr").length;
        var cant_columnas_firma = $("#firmas_nac_ext > thead> tr > th").length;
console.log("cantidad de columnas denominacion ="+cant_columnas_firma);
        if(cant_filas_firma == 0)
            $("#body_table_denominacion").append(
                '<tr id="row_denominacion" class="alert alert-light" role="alert">No hay registros'+
                '<td colspan="'+cant_columnas_firma+'" align="center">No hay registros</td>'+
                '</tr>');

    </script>

    <script type="text/javascript">

        let denominacion;
        let i = 1; //contador para asignar id al boton que borrara la fila

        $("#add_denominacion").on("click", function(e) {

            denominacion = $('#denominacion_{{$mode}}').val();
            if(denominacion!= '')
            {

                //borra la fila con el mensaje vacio
                $("#row_denominacion").remove();

                $("#body_table_denominacion").append(
                    '<tr id="row_denominacion' + i + '">' +
                        '<td> <div id="denominacion_text' + i + '">' + denominacion +'</div></td>'+
                        '<td>'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="denominacion' + i + '" name="denominaciones[]" readonly value="' + denominacion + '">' +
                        '<button type="button" name="edit" id="' + i + '" class="btn btn-warning btn-sm btn_edit_denominacion" title="editar denominacion"><indice class="fas fa-edit"></i></button>' +
                        '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-sm btn_remove_denominacion" title="quitar denominacion"><indice class="fas fa-trash"></i></button>' +
                        '</td>' +
                    '</tr>'
                );

                i++;

                //Limpiamos cada campo luego de presionar el botón Agregar Denominacion

                $('#denominacion_{{$mode}}').val('');
                ocultarError($('#denominacion_{{$mode}}'), '#small-denominacion-head');

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Denominación Guardada',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

            } 
            else 
            {
                event.preventDefault();
                mostrarError($("#denominacion_{{$mode}}"), '#small-denominacion-head', '<div class="alert alert-danger mt-3 pt-1">La DENOMINACIÓN de la firma nacional o extranjera que representa <strong>no</strong> puede quedar vacía.</div>');
            }

        });


            $(document).on("click", ".btn_remove_denominacion", function() {

            //cuando da click al boton quitar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //borra la fila
            $("#row_denominacion" + button_id + "").remove();

            Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Denominación dada de baja',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

            })

            var cant_filas_denominacion = $("#body_table_denominacion > tr").length;

            if(cant_filas_denominacion == 0){

                $("#body_table_denominacion").append(
                '<tr id="row_denominacion" class="alert alert-light" role="alert">'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                '</tr>'
                );
            }
            });



        //Cargamos el input del modal con el dato de la fila de la tabla

        $(document).on("click", ".btn_edit_denominacion", function() {

            //cuando da click al boton editar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //Recuperamos el valor del campo perteneciente a una fila
            let modal_denominacion = $("#denominacion" + button_id).val();
      
            //Desplegamos el modal
            $('#modal_denominaciones').modal('show');

            //Enviamos el valor recuperado anteriormente al input del modal
            $('#denominacion_edit').val(modal_denominacion);
            $('#numero_fila_denominacion').val(button_id);

        });

    </script>

@endpush
