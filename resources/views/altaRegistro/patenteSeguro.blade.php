
<fieldset>

<div class="row">
        <h1>Patente y Seguro</h1>
</div>

<br/>

<input type="checkbox" id="vehiculos_afectados" name="vehiculos_afectados" value="0">
<label for="vehiculos_afectados">Posee vehículos afectados a la actividad económica que desarrolla</label><br>


<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <div class="row">
        <div class="col-sm">
            <label for="marca">Marca:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="marca" name="marcas[]" /><br />

            <label for="dominio">Dominio:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="dominio" name="dominios[]" /><br />
        </div>

        <div class="col-sm">
            <label for="modelo">Modelo:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modelo" name="modelos[]" /><br />

            <label for="inscripto_en">Inscripto en:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="inscripto_en" name="inscriptos[]" /><br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_sucursal" class="btn btn-success">Agregar Vehículo</a>
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
                    <th>Teléfono</th>
                    <th>Dominio</th>
                    <th>Inscripto en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_vehiculo"></tbody>
        </table>
    </div>

    <br />

    
<input type="checkbox" id="seguros_sta_cruz"  name="seguros_sta_cruz" value="0">
<label for="seguros_sta_cruz">Posee seguros contratados con promotores residentes en nuestra provincia</label><br>


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

            <label for="vigente_hasta">Vigencia hasta:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la fecha de vigencia" aria-describedby="basic-addon1" id="vigente_hasta" name="vigentes[]" /><br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_sucursal" class="btn btn-success">Agregar Seguro</a>
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

<input type="checkbox" id="servicio_personal_especializado" name="servicio_personal_especializado"  value="0">
<label for="servicio_personal_especializado">Utiliza como sede de la actividad económica que desarrolla algún inmueble que tribute impuesto inmobiliario en localidades de la Provincia de Santa Cruz</label><br>


<div class="row">
        <div class="col-sm">
            <label for="domicilio">Domicilio:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="domicilio" name="domicilios[]" /><br />
        </div>

        <div class="col-sm">
            <label for="localidad">Localidad:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la localidad" aria-describedby="basic-addon1" id="localidad" name="localidades[]" /><br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_sucursal" class="btn btn-success">Agregar sede</a>
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


    <!--Incluimos el modal para editar los campos -->

    @include('editarRegistro.modalSucursalesEdit')



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script type="text/javascript">

        let calle;
        let barrio;
        let telefono;
        let entre_calle;
        let numero;
        let departamento;
        let i = 1; //contador para asignar id al boton que borrara la fila
        $("#add_sucursal").on("click", function(e) {

            calle = $("#calle").val();
            barrio = $("#barrio").val();
            telefono = $("#nro_tel").val();
            entre_calle = $("#entre_calles").val();
            numero = $("#numero").val();
            departamento = $("#dpto").val();
            email = $("#email").val();
            

            $("#body_table").append(
                '<tr id="row' + i +'">'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="calle' + i +'" name="calles[]" readonly value="' + calle +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="barrio' + i +'" name="barrios[]" readonly value="' + barrio +'"></td>'+
                    '<td><input type="number" class="form-control" aria-describedby="basic-addon1" id="nro_tel' + i +'" name="Telefonos_sucursales[]" readonly value="' + telefono +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="entre_calles' + i +'" name="entreCalles[]" readonly value="'+ entre_calle +'"></td>'+
                    '<td><input type="number" class="form-control" aria-describedby="basic-addon1" id="numero' + i +'" name="numeros[]" readonly value="'+numero+'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="dpto' + i +'" name="dptos[]" readonly value="'+ departamento +'"></td>'+
                    '<td><input type="email" class="form-control" aria-describedby="basic-addon1" id="email' + i +'" name="correos_electronicos[]" readonly value="'+ email +'"></td>'+
                    '<td><button type="button" name="edit" id="'+ i +'" class="btn btn-warning btn-sm btn_edit" title="editar sucursal"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + i +'" class="btn btn-danger btn-sm btn_remove" title="quitar sucursal"><i class="fas fa-trash"></i></button></td>'+
                '</tr>'
            );

            i++;

            //Limpiamos cada campo luego de presionar el botón Agregar Sucursal

            document.getElementById("calle").value = "";
            document.getElementById("numero").value = "";

            //document.getElementById("lote").value = "";
            document.getElementById("entre_calles").value = "";
            //document.getElementById("monoblock").value = "";
            //document.getElementById("localidad").value = "";
            document.getElementById("email").value = "";
            document.getElementById("dpto").value = "";
            //document.getElementById("puerta").value = "";
            //document.getElementById("oficina").value = "";
            //document.getElementById("manzana").value = "";

            document.getElementById("barrio").value = "";
            document.getElementById("nro_tel").value = "";



            $(document).on("click", ".btn_remove", function() {

                //cuando da click al boton quitar, obtenemos el id del boton
                var button_id = $(this).attr("id");

                //borra la fila
                $("#row" + button_id + "").remove(); 
            });



            //Cargamos los inputs del modal con los datos de la fila de la tabla

            $(document).on("click", ".btn_edit", function() {
                
                //cuando da click al boton editar, obtenemos el id del boton
                var button_id = $(this).attr("id");
      
                //Recuperamos los valores de los campos pertenecientes a una fila
                var modal_calle=$("#calle"+ button_id).val();
                var modal_numero=$("#numero"+ button_id).val();
                var modal_entre_calles=$("#entre_calles"+ button_id).val();
                var modal_barrio=$("#barrio"+ button_id).val();
                var modal_departamento=$("#dpto"+ button_id).val();
                var modal_telefono=$("#nro_tel"+ button_id).val();
                var modal_email=$("#email"+ button_id).val();

                //Desplegamos el modal
                $('#myModal').modal('show'); 
            
                //Enviamos los valores recuperados anteriormente a los inputs del modal
                $('#modal_calle').val(modal_calle);
                $('#modal_numero').val(modal_numero);
                $('#modal_entre_calles').val(modal_entre_calles);
                $('#modal_barrio').val(modal_barrio);
                $('#modal_dpto').val(modal_departamento);
                $('#modal_nro_tel').val(modal_telefono);
                $('#modal_email').val(modal_email);
                $('#numero_fila').val(button_id);
                
            });
            
        });
    </script>
</fieldset>

