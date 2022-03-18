<fieldset>

<div class="row">
        <h1>Patente y Seguro</h1>
</div>

<br/>

<h4>Vehículos:</h4><br>

    <div class="row">
        <div class="col-sm">
            <label for="marca_vehiculo">Marca:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="marca_vehiculo" maxlength="40"/><br />

            <label for="dominio_vehiculo">Dominio:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="dominio_vehiculo" maxlength="7"/><br />
        </div>

        <div class="col-sm">
            <label for="modelo_vehiculo">Modelo:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modelo_vehiculo" maxlength="40"/><br />

            <label for="inscripto_en_vehiculo">Inscripto en:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="inscripto_en_vehiculo" maxlength="20"/><br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <input type="button" id="add_vehiculo" class="btn btn-success" value="Agregar Vehículo"></input>
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

<h4>Seguros:</h4><br>

    <div class="row">
        <div class="col-sm">
            <label for="poliza">Póliza:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la póliza" aria-describedby="basic-addon1" id="poliza" maxlength="20"/><br />

            <label for="asegurado">Asegurado:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el asegurado" aria-describedby="basic-addon1" id="asegurado" maxlength="40"/><br />
        </div>

        <div class="col-sm">
            <label for="agencia">Agencia:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la agencia" aria-describedby="basic-addon1" id="agencia" maxlength="40"/><br />

            <label for="vigencia">Vigencia hasta:</label><br />
            <input type="date" class="form-control" placeholder="Ingrese la fecha de vigencia" aria-describedby="basic-addon1" id="vigencia" /><br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <input type="button" id="add_seguro" class="btn btn-success" value="Agregar Seguro"></input>
            </div>
        </div>
    </div>
<br>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Póliza</th>
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

<h4>Sedes:</h4><br>

<label for="domicilio_sede">Domicilio:</label><br />
<input type="text" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="domicilio_sede" maxlength="50"/><br />

<div class="row">
        <div class="col-sm">
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
            <label for="localidad_sede">Localidad:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="localidad_sede" name="localidad_sede">
                <option value=" ">Seleccione una localidad</option>
            </select>
            <br>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <input type="button" id="add_sede" class="btn btn-success" value="Agregar Sede"></input>
            </div>
        </div>
    </div>
<br>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Domicilio</th>
                    <th>Provincia</th>
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


    <!--Incluimos el modal para validar un vehiculo -->
    @include('modales.validarVehiculo')

    <!--Incluimos el modal para validar un seguro -->
    @include('modales.validarSeguro')

    <!--Incluimos el modal para validar una sede -->
    @include('modales.validarSede')

    @push('js')

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

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let marca_css = document.getElementById("marca_vehiculo");
            let modelo_css = document.getElementById("modelo_vehiculo");
            let dominio_css = document.getElementById("dominio_vehiculo");
            let inscripto_en_css = document.getElementById("inscripto_en_vehiculo");

            if(marca.length != 0 && modelo.length != 0 && dominio.length != 0 && inscripto_en.length != 0){

                $("#body_table_vehiculo").append(
                    '<tr id="row_vehiculo' + j +'">'+
                        '<td> <div id="marca_vehiculo_text' + j +'">' + marca +'</div></td>'+
                        '<td> <div id="modelo_vehiculo_text' + j +'">' + modelo +'</div></td>'+
                        '<td> <div id="dominio_vehiculo_text' + j +'">' + dominio +'</div></td>'+
                        '<td> <div id="inscripto_en_vehiculo_text' + j +'">' + inscripto_en +'</div></td>'+
                        '<td>'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="marca_vehiculo' + j +'" name="marcas[]" readonly value="' + marca +'">'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="modelo_vehiculo' + j +'" name="modelos[]" readonly value="' + modelo +'">'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="dominio_vehiculo' + j +'" name="dominios[]" readonly value="' + dominio +'">'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="inscripto_en_vehiculo' + j +'" name="inscriptos[]" readonly value="'+ inscripto_en +'">'+
                        '<button type="button" name="edit" id="'+ j +'" class="btn btn-warning btn-sm btn_edit_vehiculo" title="editar vehículo"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + j +'" class="btn btn-danger btn-sm btn_remove_vehiculo" title="quitar vehículo"><i class="fas fa-trash"></i></button>'+
                        '</td>'+
                    '</tr>'
                );


                j++;

                //Limpiamos cada campo luego de presionar el botón Agregar vehículo

                document.getElementById("marca_vehiculo").value = "";
                document.getElementById("modelo_vehiculo").value = "";
                document.getElementById("dominio_vehiculo").value = "";
                document.getElementById("inscripto_en_vehiculo").value = "";

                marca_css.style.border = '1px solid #DFDFDF';
                modelo_css.style.border = '1px solid #DFDFDF';
                dominio_css.style.border = '1px solid #DFDFDF';
                inscripto_en_css.style.border = '1px solid #DFDFDF';

            } else {

                if(marca.length == 0){

                    marca_css.style.border = '2px dashed red';
                }

                if(modelo.length == 0){

                    modelo_css.style.border = '2px dashed red';
                }

                if(dominio.length == 0){

                    dominio_css.style.border = '2px dashed red';
                }

                if(inscripto_en.length == 0){

                    inscripto_en_css.style.border = '2px dashed red';
                }
                
                
                /*Definir bien cuales campos deben ser requeridos y luego mostrar un mensaje en un modal*/
                //Desplegamos el modal
                $('#modal_validar_vehiculo').modal('show');
            }

        });


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

    </script>


    <script type="text/javascript">

        let poliza;
        let agencia;
        let asegurado;
        let vigencia;
        let vigencia_clasica;
        let k = 1; //contador para asignar id al boton que borrara la fila
        $("#add_seguro").on("click", function(e) {

            poliza = $("#poliza").val();
            agencia = $("#agencia").val();
            asegurado = $("#asegurado").val();
            vigencia = $("#vigencia").val();

            vigencia_clasica = vigencia.split('-').reverse().join('/');

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let poliza_css = document.getElementById("poliza");
            let agencia_css = document.getElementById("agencia");
            let asegurado_css = document.getElementById("asegurado");
            let vigencia_css = document.getElementById("vigencia");

            if(poliza.length != 0 && agencia.length != 0 && asegurado.length != 0 && vigencia.length != 0){

                $("#body_table_seguro").append(
                    '<tr id="row_seguro' + k +'">'+
                        '<td> <div id="poliza_text' + k +'">' + poliza +'</div></td>'+
                        '<td> <div id="agencia_text' + k +'">' + agencia +'</div></td>'+
                        '<td> <div id="asegurado_text' + k +'">' + asegurado +'</div></td>'+
                        '<td> <div id="vigencia_text' + k +'">' + vigencia_clasica +'</div></td>'+
                        '<td>'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="poliza' + k +'" name="polizas[]" readonly value="' + poliza +'">'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="agencia' + k +'" name="agencias[]" readonly value="' + agencia +'">'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="asegurado' + k +'" name="asegurados[]" readonly value="' + asegurado +'">'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="vigencia' + k +'" name="vigencias[]" readonly value="'+ vigencia +'">'+
                        '<button type="button" name="edit" id="'+ k +'" class="btn btn-warning btn-sm btn_edit_seguro" title="editar seguro"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + k +'" class="btn btn-danger btn-sm btn_remove_seguro" title="quitar seguro"><i class="fas fa-trash"></i></button>'+
                        '</td>'+
                    '</tr>'
                );


                k++;

                //Limpiamos cada campo luego de presionar el botón Agregar vehículo

                document.getElementById("poliza").value = "";
                document.getElementById("agencia").value = "";
                document.getElementById("asegurado").value = "";
                document.getElementById("vigencia").value = "";

                poliza_css.style.border = '1px solid #DFDFDF';
                agencia_css.style.border = '1px solid #DFDFDF';
                asegurado_css.style.border = '1px solid #DFDFDF';
                vigencia_css.style.border = '1px solid #DFDFDF';
            
            } else {

                if(poliza.length == 0){

                    poliza_css.style.border = '2px dashed red';
                }

                if(agencia.length == 0){

                    agencia_css.style.border = '2px dashed red';
                }

                if(asegurado.length == 0){

                    asegurado_css.style.border = '2px dashed red';
                }

                if(vigencia.length == 0){

                    vigencia_css.style.border = '2px dashed red';
                }
                

                /*Definir bien cuales campos deben ser requeridos y luego mostrar un mensaje en un modal*/
                //Desplegamos el modal
                $('#modal_validar_seguro').modal('show');
            }

        });


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

    </script>


    <script type="text/javascript">

    let domicilio;
    let id_localidad;
    let valor_localidad;
    let provincia_sede;
    let l = 1; //contador para asignar id al boton que borrara la fila
    $("#add_sede").on("click", function(e) {

        domicilio = $("#domicilio_sede").val();
        id_localidad = $("#localidad_sede").val(); // Capturamos el valor del select (el id)
        valor_localidad = $("#localidad_sede").find('option:selected').text(); // Capturamos el texto del option seleccionado
        provincia_sede = $("#provincia_sede").val();
        
        /*console.log("Provincia: "+provincia_sede);
        console.log("localidad: "+localidad);
        if(localidad != " "){
            console.log("No es vacio");
        }else{
            console.log("Es vacio");
        }*/

        //Obtenemos los campos obligatorios para aplicarles estilos css
        let domicilio_sede_css = document.getElementById("domicilio_sede");
        let localidad_sede_css = document.getElementById("localidad_sede");
        let provincia_sede_css = document.getElementById("provincia_sede");

        if(domicilio.length != 0 && id_localidad != " " && provincia_sede != " "){

        $("#body_table_sede").append(
            '<tr id="row_sede' + l +'">'+
                '<td> <div id="domicilio_sede_text' + l +'">' + domicilio +'</div></td>'+
                '<td> <div id="provincia_sede_text' + l +'">' + provincia_sede +'</div></td>'+
                '<td> <div id="localidad_sede_text' + l +'">' + valor_localidad +'</div></td>'+
                '<td>'+
                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="domicilio_sede' + l +'" name="domicilios_sedes[]" readonly value="' + domicilio +'">'+
                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="localidad_sede' + l +'" name="localidades_sedes[]" readonly value="' + id_localidad +'">'+
                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="provincia_sede' + l +'" name="provincias_sedes[]" readonly value="' + provincia_sede +'">'+
                '<button type="button" name="edit" id="'+ l +'" class="btn btn-warning btn-sm btn_edit_sede" title="editar sede"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + l +'" class="btn btn-danger btn-sm btn_remove_sede" title="quitar sede"><i class="fas fa-trash"></i></button>'+
                '</td>'+
            '</tr>'
        );


        l++;

        //Limpiamos cada campo luego de presionar el botón Agregar Sede

        document.getElementById("domicilio_sede").value = "";

        domicilio_sede_css.style.border = '1px solid #DFDFDF';
        localidad_sede_css.style.border = '1px solid #DFDFDF';
        provincia_sede_css.style.border = '1px solid #DFDFDF';

        } else {
   
            if(domicilio.length == 0){

                domicilio_sede_css.style.border = '2px dashed red';
            }

            if(id_localidad == " "){

                localidad_sede_css.style.border = '2px dashed red';
            }

            if(provincia_sede == " "){

                provincia_sede_css.style.border = '2px dashed red';
            }


            /*Definir bien cuales campos deben ser requeridos y luego mostrar un mensaje en un modal*/
            //Desplegamos el modal
            $('#modal_validar_sede').modal('show');
        }

    });


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
        let modal_provincia = $("#provincia_sede"+ button_id).val();

        //Desplegamos el modal
        $('#modal_sede').modal('show');

        //Enviamos los valores recuperados anteriormente a los inputs del modal
        $('#modal_domicilio_sede').val(modal_domicilio);
        $('#modal_localidad_sede').val(modal_localidad);
        $('#modal_provincia_sede').val(modal_provincia);
        $('#numero_fila_sede').val(button_id);

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

    @endpush

</fieldset>
