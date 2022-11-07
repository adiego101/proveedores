<fieldset>
<div class="row">
        <h1>Referencias Bancarias</h1>
</div>

<br/>
    <div class="row">
        <div class="col-sm">
            <label for="nombre_banco">Banco con el que opera:</label><br>
                <select class="js-example-basic-single" aria-describedby="basic-addon1" id="nombre_banco" name="nombre_banco">
                     @forelse($bancos as $banco)
                       <option value="{{$banco->nombre_banco}}">{{$banco->nombre_banco}}</option> 
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
            <br />

            <label for="tipo_cuenta">Tipo de cuenta:</label><br>
            <input type="text" class="form-control" placeholder="Ingrese el tipo de cuenta" aria-describedby="basic-addon1" id="tipo_cuenta" name="tipo_cuenta" maxlength="50">
            <br>
        </div>

        <div class="col-sm">
            <label for="sucursal">Sucursal:</label><br>
            <select class="js-example-basic-single" aria-describedby="basic-addon1" id="sucursal" name="sucursal">
               {{-- @forelse($sucursales as $sucursal)
                   <!-- <option value="{{$sucursal->desc_sucursal}}">{{$sucursal->desc_sucursal}}</option> 
                @empty
                    <option value=" "></option>
                @endforelse --> --}}
            </select>
            <br />

            <label for="nro_cuenta">Nº de cuenta:</label><br>
            <input type="text" class="form-control" placeholder="Ingrese el Nº de cuenta" aria-describedby="basic-addon1" id="nro_cuenta" name="nro_cuenta" maxlength="50">
            <br>

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

    
    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


    <!--Incluimos el modal para editar los campos de una referencia bancaria-->

    @include('modales.editarReferenciaBancaria')

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

            nombre_banco = $("#nombre_banco").val();
            sucursal = $("#sucursal").val();
            tipo_cuenta = $("#tipo_cuenta").val();
            nro_cuenta = $("#nro_cuenta").val();

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let sucursal_css = document.getElementById("sucursal");
            let tipo_cuenta_css = document.getElementById("tipo_cuenta");
            let nro_cuenta_css = document.getElementById("nro_cuenta");

            if(sucursal != " " && tipo_cuenta.length != 0 && nro_cuenta.length != 0) {

                //borra la fila con el mensaje vacio
                $("#row_banco").remove();

                $("#body_table_banco").append(
                    '<tr id="row_banco' + n +'">'+
                            '<td> <div id="nombre_banco_text' + n + '">' + nombre_banco +'</div></td>'+
                            '<td> <div id="sucursal_text' + n + '">' + sucursal +'</div></td>'+
                            '<td> <div id="tipo_cuenta_text' + n + '">' + tipo_cuenta +'</div></td>'+
                            '<td> <div id="nro_cuenta_text' + n + '">' + nro_cuenta +'</div></td>'+
                            '<td>'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="nombre_banco' + n +'" name="nombres_bancos[]" readonly value="' + nombre_banco +'">'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="sucursal' + n +'" name="sucursales[]" readonly value="' + sucursal +'">'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="tipo_cuenta' + n +'" name="tipos_cuentas[]" readonly value="' + tipo_cuenta +'">'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="nro_cuenta' + n +'" name="nros_cuentas[]" readonly value="' + nro_cuenta +'">'+
                            '<button type="button" name="edit" id="' + n + '" class="btn btn-warning btn-sm btn_edit_banco" title="editar banco"><indice class="fas fa-edit"></i></button>' +
                            '<button type="button" name="remove" id="' + n +'" class="btn btn-danger btn-sm btn_remove_banco" title="quitar banco"><i class="fas fa-trash"></i></button>'+
                            '</td>'+
                    '</tr>'
                );

                n++;

                //Limpiamos cada campo luego de presionar el botón Agregar Banco

                document.getElementById("tipo_cuenta").value = "";
                document.getElementById("nro_cuenta").value = "";

                tipo_cuenta_css.style.border = '1px solid #DFDFDF';
                nro_cuenta_css.style.border = '1px solid #DFDFDF';

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Banco Guardado',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true

                    })


            } else {

                if(sucursal == " "){

                    sucursal_css.style.border = '2px dashed red';
                }

                if(tipo_cuenta.length == 0){

                    tipo_cuenta_css.style.border = '2px dashed red';
                }

                if(nro_cuenta.length == 0){

                    nro_cuenta_css.style.border = '2px dashed red';
                }


                //Desplegamos el modal
                $('#modal_validar_referencia').modal('show');

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
            let modal_sucursal = $("#sucursal" + button_id).val();
            let modal_tipo_cuenta = $("#tipo_cuenta" + button_id).val();
            let modal_nro_cuenta = $("#nro_cuenta" + button_id).val();

            //Desplegamos el modal
            $('#modal_banco').modal('show');

            //Enviamos los valores recuperados anteriormente a los inputs del modal
            $('#modal_nombre_banco').val(modal_nombre_banco);
            $('#modal_sucursal').val(modal_sucursal);
            $('#modal_tipo_cuenta').val(modal_tipo_cuenta);
            $('#modal_nro_cuenta').val(modal_nro_cuenta);
            $('#numero_fila_banco').val(button_id);

        });


    </script>
@endpush

</fieldset>
