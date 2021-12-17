<fieldset>
    <div class="row">
        <h1>Sucursales en la Provincia de Santa Cruz</h1>
    </div>

    <br />

<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <label for="nombre_sucursal">Nombre Sucursal:</label><br />
    <input type="text" class="form-control" placeholder="Ingrese el nombre de la sucursal" aria-describedby="basic-addon1" id="nombre_sucursal" /><br />

    <div class="row">
        <div class="col-sm">
            <label for="calle">Calle:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la calle de la sucursal" aria-describedby="basic-addon1" id="calle" /><br />

            <label for="dpto">Departamento:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto" /><br />

            <label for="lote">Lote:</label><br />
            <input type="number" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote" name="lotes[]" /><br />

            <label for="entre_calles">Entre Calles:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entre_calles" /><br />

            <label for="monoblock">Monoblock:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock" name="monoblocks[]" /><br />

            <!--En este caso, se deben recuperar las localidades de la BD -->
            <label for="localidad">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad" name="localidad">
                    <option selected value="M">Localidad 1</option>
                    <option value="F">Localidad 2</option>
                </select>
                <br>

            <label for="email">Correo electrónico:</label><br />
            <input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email" name="correos_electronicos[]" /><br />
        </div>

        <div class="col-sm">
            <label for="numero">Número:</label><br />
            <input type="number" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero" /><br />

            <label for="puerta">Puerta:</label><br />
            <input type="number" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta" name="puertas[]" /><br />

            <label for="manzana">Manzana:</label><br />
            <input type="number" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana" name="manzanas[]" /><br />

            <label for="oficina">Oficina:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina" name="oficinas[]" /><br />

            <label for="barrio">Barrio:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio" /><br />

            <label for="codigo_postal">Código Postal:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="codigo_postal" name="codigo_postal" placeholder="Ingrese el código postal"><br>

            <label for="nro_tel">Teléfono:</label><br />
            <input type="number" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese el número de teléfono" id="nro_tel" /><br /><br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_sucursal" class="btn btn-success">Agregar Sucursal</a>
            </div>
            <br>
        </div>
    </div>

    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Calle</th>
                    <th>Barrio</th>
                    <th>Teléfono</th>
                    <th>Entre calle</th>
                    <th>Número</th>
                    <th>Departamento</th>
                    <th>email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table"></tbody>
        </table>
    </div>

    <br />

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


    <!--Incluimos el modal para editar los campos -->

    @include('modales.editarSucursal')

</fieldset>

@push('js')

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
                '<tr id="row_sucursal' + i +'">'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="calle' + i +'" name="calles[]" readonly value="' + calle +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="barrio' + i +'" name="barrios[]" readonly value="' + barrio +'"></td>'+
                    '<td><input type="number" class="form-control" aria-describedby="basic-addon1" id="nro_tel' + i +'" name="Telefonos_sucursales[]" readonly value="' + telefono +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="entre_calles' + i +'" name="entreCalles[]" readonly value="'+ entre_calle +'"></td>'+
                    '<td><input type="number" class="form-control" aria-describedby="basic-addon1" id="numero' + i +'" name="numeros[]" readonly value="'+numero+'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="dpto' + i +'" name="dptos[]" readonly value="'+ departamento +'"></td>'+
                    '<td><input type="email" class="form-control" aria-describedby="basic-addon1" id="email' + i +'" name="correos_electronicos[]" readonly value="'+ email +'"></td>'+
                    '<td><button type="button" name="edit" id="'+ i +'" class="btn btn-warning btn-sm btn_edit_sucursal" title="editar sucursal"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + i +'" class="btn btn-danger btn-sm btn_remove_sucursal" title="quitar sucursal"><i class="fas fa-trash"></i></button></td>'+
                '</tr>'
            );

            i++;
        });

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



            $(document).on("click", ".btn_remove_sucursal", function() {

                //cuando da click al boton quitar, obtenemos el id del boton
                var button_id = $(this).attr("id");

                //borra la fila
                $("#row_sucursal" + button_id + "").remove();
            });



            //Cargamos los inputs del modal con los datos de la fila de la tabla

            $(document).on("click", ".btn_edit_sucursal", function() {

                //cuando da click al boton editar, obtenemos el id del boton
                var button_id = $(this).attr("id");

                //Recuperamos los valores de los campos pertenecientes a una fila
                var modal_calle = $("#calle"+ button_id).val();
                var modal_numero = $("#numero"+ button_id).val();
                var modal_entre_calles = $("#entre_calles"+ button_id).val();
                var modal_barrio = $("#barrio"+ button_id).val();
                var modal_departamento = $("#dpto"+ button_id).val();
                var modal_telefono = $("#nro_tel"+ button_id).val();
                var modal_email = $("#email"+ button_id).val();

                //Desplegamos el modal
                $('#myModal_sucursal').modal('show');

                //Enviamos los valores recuperados anteriormente a los inputs del modal
                $('#modal_calle').val(modal_calle);
                $('#modal_numero').val(modal_numero);
                $('#modal_entre_calles').val(modal_entre_calles);
                $('#modal_barrio').val(modal_barrio);
                $('#modal_dpto').val(modal_departamento);
                $('#modal_nro_tel').val(modal_telefono);
                $('#modal_email').val(modal_email);
                $('#numero_filasu').val(button_id);


        });
    </script>
    @endpush


