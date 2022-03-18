<fieldset>
    <h1>Pagos</h1>
    <br>
    <h4>Tipo de Proveedor:</h4><br>

    <input type="checkbox" id="prov_estado" value="0" name="prov_estado">
    <label for="prov_estado">Proveedor del Estado</label><br>

    <input type="checkbox" id="prov_minero" value="0" name="prov_minero">
    <label for="prov_minero">Proveedor Minero</label><br>

    <input type="checkbox" id="prov_petrolero" value="0" name="prov_petrolero">
    <label for="prov_petrolero">Proveedor Petrolero</label><br>

    <input type="checkbox" id="prov_provincial" value="0" name="prov_provincial">
    <label for="prov_provincial">Productor Provincial</label><br>

    <br>

    <hr>

    <h4>Registro de Pagos de inscripción y renovación:</h4><br>

    <label for="fecha_pago">Fecha:</label><br>
    <input type="date" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago"
        aria-describedby="basic-addon1" id="fecha_pago"><br>

    <label for="importe_pago">Importe:</label><br>
    <input type="text" class="form-control" onkeypress="return valideKey(event);" placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1" id="importe_pago" maxlength="9"><br>

    <label for="observaciones_pago">Observaciones:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese las observaciones del pago"
        aria-describedby="basic-addon1" id="observaciones_pago" maxlength="50"><br>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a id="add_pago" class="btn btn-success">Agregar Pago</a>
    </div>
    <br>

    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Importe</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_pago"></tbody>
        </table>
    </div>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

    <!--Incluimos el modal para editar los campos de un pago-->

    @include('modales.editarPago')

    <!--Incluimos el modal para validar un pago -->

    @include('modales.validarPago')

</fieldset>

@push('js')

    <script type="text/javascript">

        let fecha;
        let importe;
        let observaciones_pago;
        let fecha_clasica_pago;
        let indice = 1;

        $("#add_pago").on("click", function(e) {

            fecha = $('#fecha_pago').val();
            importe = $('#importe_pago').val();
            observaciones_pago = $('#observaciones_pago').val();
            fecha_clasica_pago = fecha.split('-').reverse().join('/');

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let fecha_css = document.getElementById("fecha_pago");
            let importe_css = document.getElementById("importe_pago");


            if(fecha.length != 0 && importe.length != 0){

                $("#body_table_pago").append(
                    '<tr id="row_pago' + indice + '">' +
                        '<td> <div id="fecha_pago_text' + indice + '">' + fecha_clasica_pago +'</div></td>'+
                        '<td> <div id="importe_pago_text' + indice + '">' + importe +'</div></td>'+
                        '<td> <div id="observaciones_pago_text' + indice + '">' + observaciones_pago +'</div></td>'+
                        '<td>'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="fecha_pago' + indice + '" name="fechas_pagos[]" readonly value="' + fecha + '">' +
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="importe_pago' + indice + '" name="importes_pagos[]" readonly value="' + importe + '">' +
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="observaciones_pago' + indice + '" name="observaciones_pagos[]" readonly value="' + observaciones_pago + '">' +
                        '<button type="button" name="edit" id="' + indice + '" class="btn btn-warning btn-sm btn_edit_pago" title="editar pago"><indice class="fas fa-edit"></i></button>' +
                        '<button type="button" name="remove" id="' + indice + '" class="btn btn-danger btn-sm btn_remove_pago" title="quitar pago"><indice class="fas fa-trash"></i></button>' +
                        '</td>' +
                    '</tr>'
                );

                indice++;

                //Limpiamos cada campo luego de presionar el botón Agregar Pago

                document.getElementById("fecha_pago").value = "";
                document.getElementById("importe_pago").value = "";
                document.getElementById("observaciones_pago").value = "";

                fecha_css.style.border = '1px solid #DFDFDF';
                importe_css.style.border = '1px solid #DFDFDF';

            } else {

                if(fecha.length == 0){

                    fecha_css.style.border = '2px dashed red';
                }

                if(importe.length == 0){

                    importe_css.style.border = '2px dashed red';
                }
                

                /*Definir bien cuales campos deben ser requeridos y luego mostrar un mensaje en un modal*/
               //Desplegamos el modal
               $('#modal_validar_pago').modal('show');
            }

        });


        $(document).on("click", ".btn_remove_pago", function() {

            //cuando da click al boton quitar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //borra la fila
            $("#row_pago" + button_id + "").remove();
        });


        //Cargamos los inputs del modal con los datos de la fila de la tabla

        $(document).on("click", ".btn_edit_pago", function() {

            //cuando da click al boton editar, obtenemos el id del boton
            let button_id = $(this).attr("id");
            //Recuperamos los valores de los campos pertenecientes a una fila
            let modal_fecha = $("#fecha_pago" + button_id).val();
            let modal_importe = $("#importe_pago" + button_id).val();
            let modal_observaciones = $("#observaciones_pago" + button_id).val();

            //Desplegamos el modal
            $('#modal_pago').modal('show');

            //Enviamos los valores recuperados anteriormente a los inputs del modal
            $('#modal_fecha').val(modal_fecha);
            $('#modal_importe').val(modal_importe);
            $('#modal_observaciones').val(modal_observaciones);
            $('#numero_fila_pago').val(button_id);

        });

    </script>

@endpush
