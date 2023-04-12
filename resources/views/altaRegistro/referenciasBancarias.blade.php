<fieldset>
<div class="row">
        <h1>Referencias Bancarias</h1>
</div>

<br/>
    @include('bancos.form', ['mode'=>'create'])
    <br>
<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <a id="add_banco" class="btn btn-success">Agregar Banco</a>
        </div>
    </div>
</div>
<br>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Bancos con los que opera</th>
                    <th>Sucursal</th>
                    <th>Tipo cuenta</th>
                    <th>Nº cuenta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_banco"></tbody>
        </table>
    </div>

    <br />

    <hr>

    
    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" data-tipo='banco' value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" data-tipo='banco' value="Siguiente" />


    <!--Incluimos el modal para editar los campos de una referencia bancaria-->

    @include('bancos.modal-edit-create',['mode'=>'edit'])

    <!--Incluimos el modal para validar una referencia bancaria -->

    @include('modales.validarReferenciaBancaria')

@push('js')

    <script type="text/javascript">
        let nombre_banco;
        let sucursal;
        let tipo_cuenta;
        let nro_cuenta;
        let n = 1; //contador para asignar id al boton que borrara la fila

        $("#add_banco").on("click", function(e) {

            nombre_banco = $("#nombre_banco_create").val();
            sucursal = $("#localidad_sucursal_create").val();
            tipo_cuenta = $("#tipo_cuenta_create").val();
            nro_cuenta = $("#nro_cuenta_create").val();

            if(nombre_banco!='' && sucursal != '' && tipo_cuenta!= '' && nro_cuenta != '') 
            {
                //borra la fila con el mensaje vacio
                $("#row_banco").remove();

                $("#body_table_banco").append(
                    '<tr id="row_banco' + n +'">'+
                            '<td> <div id="nombre_banco_text' + n + '">' + nombre_banco +'</div></td>'+
                            '<td> <div id="sucursal_text' + n + '">' + $("#localidad_sucursal_create option:selected").text() +'</div></td>'+
                            '<td> <div id="tipo_cuenta_text' + n + '">' + tipo_cuenta +'</div></td>'+
                            '<td> <div id="nro_cuenta_text' + n + '">' + nro_cuenta +'</div></td>'+
                            '<td>'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="nombre_banco' + n +'" name="nombres_bancos[]" readonly value="' + nombre_banco +'">'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="provincia_sucursal' + n +'" name="provincia_sucursales[]" readonly value="' + $("#provincia_sucursal_create").val() +'">'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="localidad_sucursal' + n +'" name="localidad_sucursales[]" readonly value="' + $("#localidad_sucursal_create").val() +'">'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="tipo_cuenta' + n +'" name="tipos_cuentas[]" readonly value="' + tipo_cuenta +'">'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="nro_cuenta' + n +'" name="nros_cuentas[]" readonly value="' + nro_cuenta +'">'+
                            '<button type="button" name="edit" id="' + n + '" class="btn btn-warning btn-sm btn_edit_banco" title="editar banco"><indice class="fas fa-edit"></i></button>' +
                            '<button type="button" name="remove" id="' + n +'" class="btn btn-danger btn-sm btn_remove_banco" title="quitar banco"><i class="fas fa-trash"></i></button>'+
                            '</td>'+
                    '</tr>'
                );

                n++;

                //Limpiamos cada campo luego de presionar el botón Agregar Banco

                nombre_banco = $("#nombre_banco_create option:first").attr('selected','selected').change();
                sucursal = $("#provincia_sucursal_create option:first").attr('selected','selected').change();
                $("#localidad_sucursal_create").empty();
                $("#localidad_sucursal_create").append("<option val=''>Seleccione una localidad</option>");
                tipo_cuenta = $("#tipo_cuenta_create").val('');
                nro_cuenta = $("#nro_cuenta_create").val('');

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Banco Guardado',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else {
                if(nombre_banco == '')
                {
                    $("#nombre_banco_create").parents('.form-group').find('.select2-selection').css('border', '1px solid red');
                    mostrarError($("#nombre_banco_create"), '#small-banco-head', '<div class="alert alert-danger mt-3 pt-1">El BANCO <strong>no</strong> puede quedar vacío.</div>');    
                }

                if(sucursal == ''){
                    $("#localidad_sucursal_create").parents('.form-group').find('.select2-selection').css('border', '1px solid red');
                    mostrarError($("#localidad_sucursal_create"), '#small-localidad-sucursal-head', '<div class="alert alert-danger mt-3 pt-1">La LOCALIDAD DE SUCURSAL <strong>no</strong> puede quedar vacío.</div>');
                }

                if(tipo_cuenta == '')
                    mostrarError($("#tipo_cuenta_create"), '#small-tipo-cuenta-head', '<div class="alert alert-danger mt-3 pt-1">El TIPO DE CUENTA <strong>no</strong> puede quedar vacío.</div>');
                if(nro_cuenta == '')
                    mostrarError($("#nro_cuenta_create"), '#small-nro-cuenta-head', '<div class="alert alert-danger mt-3 pt-1">El NRO DE CUENTA <strong>no</strong> puede quedar vacío.</div>');
            }

        });


        $(document).on("click", ".btn_remove_banco", function() {

            //cuando da click al boton quitar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //borra la fila
            $("#row_banco" + button_id + "").remove();

            Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Banco dado de baja',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

                var cant_filas_banco = document.getElementById("body_table_banco").rows.length;

                /*Si al eliminar una fila, la tabla esta vacia, volvemos a mostrar el mensaje de aviso*/
               if(cant_filas_banco == 0){

                    $("#body_table_banco").append(
                        '<tr id="row_banco" class="alert alert-light" role="alert">'+
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

        $(document).on("click", ".btn_edit_banco", function() {
            //cuando da click al boton editar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //Recuperamos los valores de los campos pertenecientes a una fila
            let modal_nombre_banco = $("#nombre_banco" + button_id).val();
            let modal_provincia_sucursal = $("#provincia_sucursal" + button_id).val();
            let modal_localidad_sucursal = $("#localidad_sucursal" + button_id).val();
            let modal_tipo_cuenta = $("#tipo_cuenta" + button_id).val();
            let modal_nro_cuenta = $("#nro_cuenta" + button_id).val();

            //Desplegamos el modal
            $('#modal_banco').modal('show');

            //Enviamos los valores recuperados anteriormente a los inputs del modal
            $("#nombre_banco_edit option[value='"+modal_nombre_banco+"']").attr('selected','selected').change();
            $("#provincia_sucursal_edit option[value='"+modal_provincia_sucursal+"']").attr('selected','selected').change();
            recargarLocalidadSucursal($('#provincia_sucursal_edit').val(),$('#localidad_sucursal_edit'), button_id);
            $('#tipo_cuenta_edit').val(modal_tipo_cuenta);
            $('#nro_cuenta_edit').val(modal_nro_cuenta);
            $('#numero_fila_banco').val(button_id);
        });

        $(document).ready(function(){
            $("#nombre_banco_create").change(function(){
                if ($('#nombre_banco_create').val()!='')
                {
                    $("#nombre_banco_create").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
                    ocultarError('#nombre_banco_create', '#small-banco-head');
                }
            });
            $("#localidad_sucursal_create").change(function(){
                if ($('#localidad_sucursal_create').val()!='')
                {
                    $("#localidad_sucursal_create").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
                    ocultarError('#localidad_sucursal_create', '#small-localidad-sucursal-head');
                }
            });

            $("#tipo_cuenta_create").keyup(function(){
                ocultarError('#tipo_cuenta_create', '#small-tipo-cuenta-head');
            });

            $("#nro_cuenta_create").keyup(function(){
                ocultarError('#nro_cuenta_create', '#small-nro-cuenta-head');
            });

            $('#nombre_banco_edit').change(function(){
                if($('#nombre_banco_edit').val()!='')
                {
                    $("#nombre_banco_edit").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
                    ocultarError($('#nombre_banco_edit'), '#small-banco-edit');
                }
            });

            $('#tipo_cuenta_edit').keyup(function(){
                    ocultarError($('#tipo_cuenta_edit'), '#small-tipo-cuenta-edit');
            });

            $('#localidad_sucursal_edit').change(function(){
                if($('#localidad_sucursal_edit').val()!='')
                {
                    $("#localidad_sucursal_edit").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
                    ocultarError($('#localidad_sucursal_edit'), '#small-localidad-sucursal-edit');
                }
            });

            $('#nro_cuenta_edit').keyup(function(){
                ocultarError($('#nro_cuenta_edit'), '#small-nro-cuenta-edit');
            });
        });

    </script>
@endpush

</fieldset>
