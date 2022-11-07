<fieldset>

    <h1>Firmas Nacionales y Extranjeras que representa</h1>

    <br>
      
    <label for="denominacion">Denominación:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese la denominación" aria-describedby="basic-addon1" id="denominacion" name="denominacion" maxlength="50">

    <br>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a id="add_denominacion" class="btn btn-success">Agregar Denominación</a>
    </div>

    <br>

    <div>
        <table class="table table-hover">
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

    
    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


    <!--Incluimos el modal para editar una denominación-->

    @include('modales.editarFirma')

    <!--Incluimos el modal para validar una denominación -->

    @include('modales.validarFirma')

</fieldset>

@push('js')

    <script type="text/javascript">

        let denominacion;
        let i = 1; //contador para asignar id al boton que borrara la fila

        $("#add_denominacion").on("click", function(e) {

            denominacion = $('#denominacion').val();

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let denominacion_css = document.getElementById("denominacion");


            if(denominacion.length != 0){

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

                document.getElementById("denominacion").value = "";
                
                denominacion_css.style.border = '1px solid #DFDFDF';

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Denominación Guardada',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

            } else {

                if(denominacion.length == 0){

                    denominacion_css.style.border = '2px dashed red';
                }

            //Desplegamos el modal
            $('#modal_validar_denominacion').modal('show');
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

            var cant_filas_denominacion = document.getElementById("body_table_denominacion").rows.length;

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
            $('#modal_denominacion').val(modal_denominacion);
            $('#numero_fila_denominacion').val(button_id);

        });

    </script>

@endpush
