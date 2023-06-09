<fieldset>
    <h1>Registro de Pagos de inscripción y renovación</h1><br>

    <label for="fecha_pago">Fecha:</label><br>
    <input type="date" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago" aria-describedby="basic-addon1" id="fecha_pago"><br>

    <label for="importe_pago">Importe:</label><br>
    <input type="text" class="form-control" onkeypress="return valideKey(event);" placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1" id="importe_pago" maxlength="9">
    <small class="small" id="small-importe_pago"></small>


    <br>

    <label for="nro_comprobante_asip">Nro de Comprobante ASIP:</label><br>
    <input type="text" class="form-control" onkeypress="return valideKey(event);" placeholder="Ingrese Nro de Comprobante ASIP" aria-describedby="basic-addon1" id="nro_comprobante_asip" >
    <small class="small" id="small-nro_comprobante_asip"></small>


    <br>
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

    <!--Incluimos el modal para editar los campos de un pago-->

    @include('modales.editarPago')

    <!--Incluimos el modal para validar un pago -->

    @include('modales.validarPago')

</fieldset>

@push('js')



    <script type="text/javascript">

$('#importe_pago').keyup(validarimporte_pago);

function validarimporte_pago() {

    if (!(/^[0-9]+$/.test($('#importe_pago').val()))) {
        if($('#importe_pago').val() != ""){

        mostrarError('#importe_pago', '#small-importe_pago', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de Importe</strong> debe contener solamente dígitos numéricos.</div>');
        return false;
        }
    }
    ocultarError('#importe_pago', '#small-importe_pago');
    return true;
}


        let fecha;
        let importe;
        let observaciones_pago;
        let fecha_clasica_pago;
        let indice = 1;

        $("#add_pago").on("click", function(e) {

            fecha = $('#fecha_pago').val();
            importe = $('#importe_pago').val();
            nro_comprobante_asip = $('#nro_comprobante_asip').val();
            observaciones_pago = $('#observaciones_pago').val();
            fecha_clasica_pago = fecha.split('-').reverse().join('/');

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let fecha_css = document.getElementById("fecha_pago");
            let importe_css = document.getElementById("importe_pago");


            if(fecha.length != 0 && importe.length != 0 && validarimporte_pago()){

                //borra la fila con el mensaje vacio
                $("#row_pago").remove();

                $("#body_table_pago").append(
                    '<tr id="row_pago' + indice + '">' +
                        '<td> <div id="fecha_pago_text' + indice + '">' + fecha_clasica_pago +'</div></td>'+
                        '<td> <div id="importe_pago_text' + indice + '">' + importe +'</div></td>'+
                        '<td> <div id="observaciones_pago_text' + indice + '">' + observaciones_pago +'</div></td>'+
                        '<td>'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="fecha_pago' + indice + '" name="fechas_pagos[]" readonly value="' + fecha + '">' +
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="importe_pago' + indice + '" name="importes_pagos[]" readonly value="' + importe + '">' +
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="observaciones_pago' + indice + '" name="observaciones_pagos[]" readonly value="' + observaciones_pago + '">' +

                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="nro_comprobante_asip' + indice + '" name="nros_comprobantes_asip[]" readonly value="' + nro_comprobante_asip + '">' +
                        '<button type="button" name="edit" id="' + indice + '" class="btn btn-warning btn-sm btn_edit_pago" title="editar pago"><indice class="fas fa-edit"></i></button>' +
                        '<button type="button" name="remove" id="' + indice + '" class="btn btn-danger btn-sm btn_remove_pago" title="quitar pago"><indice class="fas fa-trash"></i></button>' +
                        '</td>' +
                    '</tr>'
                );

                indice++;

                //Limpiamos cada campo luego de presionar el botón Agregar Pago

                document.getElementById("fecha_pago").value = "";
                document.getElementById("importe_pago").value = "";
                document.getElementById("nro_comprobante_asip").value = "";

                document.getElementById("observaciones_pago").value = "";

                fecha_css.style.border = '1px solid #DFDFDF';
                importe_css.style.border = '1px solid #DFDFDF';

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pago Guardado',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

            } else {

                if(fecha.length == 0){

                    fecha_css.style.border = '2px dashed red';
                }
                else{
                    fecha_css.style.border = '1px solid #DFDFDF';

                }

                if(importe.length == 0){

                    importe_css.style.border = '2px dashed red';

                }
                else{
                    importe_css.style.border = '1px solid #DFDFDF';

                }

               //Desplegamos el modal
               $('#modal_validar_pago').modal('show');
            }

        });


        $(document).on("click", ".btn_remove_pago", function() {

            //cuando da click al boton quitar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //borra la fila
            $("#row_pago" + button_id + "").remove();

            Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Pago dado de baja',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

            })

            var cant_filas_pago = document.getElementById("body_table_pago").rows.length;

            if(cant_filas_pago == 0){

                $("#body_table_pago").append(
                '<tr id="row_pago" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>'
                );
            }
        });


        //Cargamos los inputs del modal con los datos de la fila de la tabla

        $(document).on("click", ".btn_edit_pago", function() {

            //cuando da click al boton editar, obtenemos el id del boton
            let button_id = $(this).attr("id");
            //Recuperamos los valores de los campos pertenecientes a una fila
            let modal_fecha = $("#fecha_pago" + button_id).val();
            let modal_nro_comprobante_asip = $("#nro_comprobante_asip" + button_id).val();
            let modal_importe = $("#importe_pago" + button_id).val();

            let modal_observaciones = $("#observaciones_pago" + button_id).val();

            //Desplegamos el modal
            $('#modal_pago').modal('show');

            //Enviamos los valores recuperados anteriormente a los inputs del modal
            $('#modal_fecha').val(modal_fecha);
            $('#modal_importe').val(modal_importe);
            $('#modal_nro_comprobante_asip').val(modal_nro_comprobante_asip);

            $('#modal_observaciones').val(modal_observaciones);
            $('#numero_fila_pago').val(button_id);

        });

    </script>

@endpush
