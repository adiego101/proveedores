
<fieldset>

<div class="row">
        <h1>Patente y Seguro</h1>
</div>

<br/>

<input type="checkbox" id="vehiculos_afectados" name="vehiculos_afectados" value="0">
<label for="vehiculos_afectados">Posee vehículos afectados a la actividad económica que desarrolla</label><br>
<br>

<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <div class="row">
        <div class="col-sm">
            <label for="marca_vehiculo">Marca:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="marca_vehiculo" name="marcas[]" /><br />

            <label for="dominio_vehiculo">Dominio:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="dominio_vehiculo" name="dominios[]" /><br />
        </div>

        <div class="col-sm">
            <label for="modelo_vehiculo">Modelo:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modelo_vehiculo" name="modelos[]" /><br />

            <label for="inscripto_en_vehiculo">Inscripto en:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="inscripto_en_vehiculo" name="inscriptos[]" /><br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_vehiculo" class="btn btn-success">Agregar Vehículo</a>
            </div>
        </div>
    </div>
<br>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Dominio</th>
                    <th>Inscripto en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_vehiculo"></tbody>
        </table>
    </div>

    <br />

    <hr>

<input type="checkbox" id="seguros_sta_cruz"  name="seguros_sta_cruz" value="0">
<label for="seguros_sta_cruz">Posee seguros contratados con promotores residentes en nuestra provincia</label><br>
<br>

    <div class="row">
        <div class="col-sm">
            <label for="poliza">Poliza:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la poliza" aria-describedby="basic-addon1" id="poliza" name="polizas[]" /><br />

            <label for="asegurado">Asegurado:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el asegurado" aria-describedby="basic-addon1" id="asegurado" name="asegurados[]" /><br />
        </div>

        <div class="col-sm">
            <label for="agencia">Agencia:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la agencia" aria-describedby="basic-addon1" id="agencia" name="agencias[]" /><br />

            <label for="vigencia">Vigencia hasta:</label><br />
            <input type="date" class="form-control" placeholder="Ingrese la fecha de vigencia" aria-describedby="basic-addon1" id="vigencia" name="vigencias[]" /><br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_seguro" class="btn btn-success">Agregar Seguro</a>
            </div>
        </div>
    </div>
<br>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Poliza</th>
                    <th>Agencia</th>
                    <th>Asegurado</th>
                    <th>Vigencia hasta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_seguro"></tbody>
        </table>


    </div>

    <br />

    <hr>

<input type="checkbox" id="servicio_personal_especializado" name="servicio_personal_especializado"  value="0">
<label for="servicio_personal_especializado">Utiliza como sede de la actividad económica que desarrolla algún inmueble que tribute impuesto inmobiliario en localidades de la Provincia de Santa Cruz</label><br>
<br>

<label for="domicilio_sede">Domicilio:</label><br />
<input type="text" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="domicilio_sede" name="domicilios_sedes[]" /><br />

<div class="row">
        <div class="col-sm">
            <!--En este caso, se deben recuperar las provincias de la BD -->
            <label for="provincia_sede">Provincia:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="provincia_sede" name="provincia_sede">
            <option value=" ">Seleccione una provincia</option>
            @forelse($provincias as $provincia)
                <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
            @empty
                <option value=" "></option>
            @endforelse
            </select>
            <br>
        </div>

        <div class="col-sm">
            <!--En este caso, se deben recuperar las localidades_sedes de la BD -->
            <label for="localidad_sede">Localidad:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="localidad_sede" name="localidades_sedes[]">
                <option value=" ">Seleccione una localidad</option>
            </select>
            <br>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_sede" class="btn btn-success">Agregar sede</a>
            </div>
        </div>
    </div>
<br>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Domicilio</th>
                    <th>Localidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_sede"></tbody>
        </table>

    </div>

    <br />


    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


    <!--Incluimos el modal para editar los campos de un vehiculo -->
    @include('modales.editarVehiculo')

    <!--Incluimos el modal para editar los campos de un seguro -->
    @include('modales.editarSeguro')

    <!--Incluimos el modal para editar los campos de una sede -->
    @include('modales.editarSede')


    <script type="text/javascript">

        let marca;
        let modelo;
        let dominio;
        let inscripto_en;
        let j = 1; //contador para asignar id al boton que borrara la fila
        $("#add_vehiculo").on("click", function(e) {

            marca = $("#marca_vehiculo").val();
            modelo = $("#modelo_vehiculo").val();
            dominio = $("#dominio_vehiculo").val();
            inscripto_en = $("#inscripto_en_vehiculo").val();


            $("#body_table_vehiculo").append(
                '<tr id="row_vehiculo' + j +'">'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="marca_vehiculo' + j +'" name="marcas[]" readonly value="' + marca +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="modelo_vehiculo' + j +'" name="modelos[]" readonly value="' + modelo +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="dominio_vehiculo' + j +'" name="dominios[]" readonly value="' + dominio +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="inscripto_en_vehiculo' + j +'" name="inscriptos[]" readonly value="'+ inscripto_en +'"></td>'+
                    '<td><button type="button" name="edit" id="'+ j +'" class="btn btn-warning btn-sm btn_edit_vehiculo" title="editar vehículo"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + j +'" class="btn btn-danger btn-sm btn_remove_vehiculo" title="quitar vehículo"><i class="fas fa-trash"></i></button></td>'+
                '</tr>'
            );


            j++;

            //Limpiamos cada campo luego de presionar el botón Agregar vehículo

            document.getElementById("marca_vehiculo").value = "";
            document.getElementById("modelo_vehiculo").value = "";
            document.getElementById("dominio_vehiculo").value = "";
            document.getElementById("inscripto_en_vehiculo").value = "";


            $(document).on("click", ".btn_remove_vehiculo", function() {

                //cuando da click al boton quitar, obtenemos el id del boton
                let button_id = $(this).attr("id");

                //borra la fila
                $("#row_vehiculo" + button_id + "").remove();
            });


              //Cargamos los inputs del modal con los datos de la fila de la tabla

              $(document).on("click", ".btn_edit_vehiculo", function() {

                //cuando da click al boton editar, obtenemos el id del boton
                let button_id = $(this).attr("id");

                //Recuperamos los valores de los campos pertenecientes a una fila
                let modal_marca = $("#marca_vehiculo"+ button_id).val();
                let modal_modelo = $("#modelo_vehiculo"+ button_id).val();
                let modal_dominio = $("#dominio_vehiculo"+ button_id).val();
                let modal_inscripto = $("#inscripto_en_vehiculo"+ button_id).val();

                //Desplegamos el modal
                $('#modal_vehiculo').modal('show');

                //Enviamos los valores recuperados anteriormente a los inputs del modal
                $('#modal_marca_vehiculo').val(modal_marca);
                $('#modal_modelo_vehiculo').val(modal_modelo);
                $('#modal_dominio_vehiculo').val(modal_dominio);
                $('#modal_inscripto_en_vehiculo').val(modal_inscripto);
                $('#numero_fila_vehiculo').val(button_id);

            });

        });
    </script>

    <script type="text/javascript">

        let poliza;
        let agencia;
        let asegurado;
        let vigencia;
        let k = 1; //contador para asignar id al boton que borrara la fila
        $("#add_seguro").on("click", function(e) {

            poliza = $("#poliza").val();
            agencia = $("#agencia").val();
            asegurado = $("#asegurado").val();
            vigencia = $("#vigencia").val();


            $("#body_table_seguro").append(
                '<tr id="row_seguro' + k +'">'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="poliza' + k +'" name="polizas[]" readonly value="' + poliza +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="agencia' + k +'" name="agencias[]" readonly value="' + agencia +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="asegurado' + k +'" name="asegurados[]" readonly value="' + asegurado +'"></td>'+
                    '<td><input type="date" class="form-control" aria-describedby="basic-addon1" id="vigencia' + k +'" name="vigencias[]" readonly value="'+ vigencia +'"></td>'+
                    '<td><button type="button" name="edit" id="'+ k +'" class="btn btn-warning btn-sm btn_edit_seguro" title="editar seguro"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + k +'" class="btn btn-danger btn-sm btn_remove_seguro" title="quitar seguro"><i class="fas fa-trash"></i></button></td>'+
                '</tr>'
            );


            k++;

            //Limpiamos cada campo luego de presionar el botón Agregar vehículo

            document.getElementById("poliza").value = "";
            document.getElementById("agencia").value = "";
            document.getElementById("asegurado").value = "";
            document.getElementById("vigencia").value = "";


            $(document).on("click", ".btn_remove_seguro", function() {

                //cuando da click al boton quitar, obtenemos el id del boton
                let button_id = $(this).attr("id");

                //borra la fila
                $("#row_seguro" + button_id + "").remove();
            });


            //Cargamos los inputs del modal con los datos de la fila de la tabla

            $(document).on("click", ".btn_edit_seguro", function() {

                //cuando da click al boton editar, obtenemos el id del boton
                let button_id = $(this).attr("id");

                //Recuperamos los valores de los campos pertenecientes a una fila
                let modal_poliza = $("#poliza"+ button_id).val();
                let modal_agencia = $("#agencia"+ button_id).val();
                let modal_asegurado = $("#asegurado"+ button_id).val();
                let modal_vigencia = $("#vigencia"+ button_id).val();

                //Desplegamos el modal
                $('#modal_seguro').modal('show');

                //Enviamos los valores recuperados anteriormente a los inputs del modal
                $('#modal_poliza').val(modal_poliza);
                $('#modal_agencia').val(modal_agencia);
                $('#modal_asegurado').val(modal_asegurado);
                $('#modal_vigencia').val(modal_vigencia);
                $('#numero_fila_seguro').val(button_id);

            });

        });
    </script>


    <script type="text/javascript">

    let domicilio;
    let localidad;
    let l = 1; //contador para asignar id al boton que borrara la fila
    $("#add_sede").on("click", function(e) {

        domicilio = $("#domicilio_sede").val();
        localidad = $("#localidad_sede").val();


        $("#body_table_sede").append(
            '<tr id="row_sede' + l +'">'+
                '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="domicilio_sede' + l +'" name="domicilios_sedes[]" readonly value="' + domicilio +'"></td>'+
                '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="localidad_sede' + l +'" name="localidades_sedes[]" readonly value="' + localidad +'"></td>'+
                '<td><button type="button" name="edit" id="'+ l +'" class="btn btn-warning btn-sm btn_edit_sede" title="editar sede"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + l +'" class="btn btn-danger btn-sm btn_remove_sede" title="quitar sede"><i class="fas fa-trash"></i></button></td>'+
            '</tr>'
        );


        l++;

        //Limpiamos cada campo luego de presionar el botón Agregar Sede

        document.getElementById("domicilio_sede").value = "";


        $(document).on("click", ".btn_remove_sede", function() {

            //cuando da click al boton quitar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //borra la fila
            $("#row_sede" + button_id + "").remove();
        });


        //Cargamos los inputs del modal con los datos de la fila de la tabla

        $(document).on("click", ".btn_edit_sede", function() {

                //cuando da click al boton editar, obtenemos el id del boton
                let button_id = $(this).attr("id");

                //Recuperamos los valores de los campos pertenecientes a una fila
                let modal_domicilio = $("#domicilio_sede"+ button_id).val();
                let modal_localidad = $("#localidad_sede"+ button_id).val();

                //Desplegamos el modal
                $('#modal_sede').modal('show');

                //Enviamos los valores recuperados anteriormente a los inputs del modal
                $('#modal_domicilio_sede').val(modal_domicilio);
                $('#modal_localidad_sede').val(modal_localidad);
                $('#numero_fila_sede').val(button_id);

            });

    });
    </script>


    <script type="text/javascript">
        $(document).ready(function(){

            $('#provincia_sede').change(function(){
                recargarListaSeguro();
            });
        })
    </script>

    <script type="text/javascript">
        function recargarListaSeguro(){
            $.ajax({
                type:"GET",
                url:"localidades/"+$('#provincia_sede').val(),
                success:function(r){
                    $('#localidad_sede').html(r);
                }
            });
        }
    </script>


</fieldset>
