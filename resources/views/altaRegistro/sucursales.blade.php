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
            <label for="localidad_sucursal">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_sucursal" name="localidad_sucursal">
                    @foreach($localidades as $localidad)
                    <option selected value="{{$localidad->nombre_localidad}}">{{$localidad->nombre_localidad}}</option>
                    @endforeach
                </select>
                <br>

                <label for="email_sucursal">Correo electrónico:</label><br>
                <input type="email" class="form-control email_sucursal" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1"><br>
                <div class="field_email_sucursal">

                </div>

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

            <label for="telefono_sucursal">Teléfono:</label><br>
                <input type="number" class="form-control telefono_sucursal" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" >
                <div class="field_telefono_sucursal">

                </div>

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



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script type="text/javascript">

        let nombre_sucursal;
        let calle;
        let barrio;
        //let telefono;
        let entre_calle;
        let numero;
        let departamento;
        let i = 1; //contador para asignar id al boton que borrara la fila
        $("#add_sucursal").on("click", function(e) {
            nombre_sucursal=$('#nombre_sucursal').val();
            if(nombre_sucursal=''){
                $('#errors').show();
                $('#vinetas_error').append("<li>Para agregar una SUCURSAL debe especificar su NOMBRE.</li>");
                return false;
            }
            calle = $("#calle").val();
            barrio = $("#barrio").val();
            //telefono = $("#nro_tel").val();
            entre_calle = $("#entre_calles").val();
            numero = $("#numero").val();
            departamento = $("#dpto").val();
            email = $("#email").val();
            if(email=''){
                $('#errors').show();
                $('#vinetas_error').append("<li>Para agregar una SUCURSAL debe especificar su EMAIL.</li>");
                return false;
            }

            let valoresTelefonos = [];
            let telefono = "";
            $('.telefono_sucursal').each(function(){
                telefono = $(this).val();
                if(telefono != '')
                    valoresTelefonos.push(telefono);
                else{
                    $('#errors').show();
                    $('#vinetas_error').append("<li>Para agregar una SUCURSAL debe especificar al menos 1 (UN) TELEFONO.</li>");
                    return false;
                }
            });

            let telefono_aux = '';
            for(i in valoresTelefonos){
                telefono_aux = telefono_aux + valoresTelefonos[i] + '/';
            }

            $("#body_table").append(
                '<tr id="row' + i +'">'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="calle' + i +'" name="calles[]" readonly value="' + calle +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="barrio' + i +'" name="barrios[]" readonly value="' + barrio +'"></td>'+
                    '<td><input type="number" class="form-control" aria-describedby="basic-addon1" id="nro_tel' + i +'" name="Telefonos_sucursales[]" value="'+telefono_aux+'" readonly></td>'+
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
                var modal_calle = $("#calle"+ button_id).val();
                var modal_numero = $("#numero"+ button_id).val();
                var modal_entre_calles = $("#entre_calles"+ button_id).val();
                var modal_barrio = $("#barrio"+ button_id).val();
                var modal_departamento = $("#dpto"+ button_id).val();
                var modal_telefono = $("#nro_tel"+ button_id).val();
                var modal_email = $("#email"+ button_id).val();

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

<script type="text/javascript">
    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono_sucursal = $('.add_telefono_sucursal');
        var wrapper_telefono_sucursal = $('.field_telefono_sucursal');


        //Nuevo campo html (agregar un nuevo teléfono)
        var fieldHTML_telefono_sucursal = '<div>'+
                                 '<br>'+
                                    '<label for="telefono_sucursal">Teléfono:</label><br>'+
                                    '<input type="number" class="form-control telefono_sucursal" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" >'+
                                    '<a href="javascript:void(0);" class="remove_telefono_sucursal" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                 '<br>'+
                                '</div>';


        var x = 1; //Contador inicial, comienza en 1
        $(addTelefono_sucursal).click(function() {
            if (x < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                x++; //Incrementa el contador en 1
                $(wrapper_telefono_sucursal).append(fieldHTML_telefono_sucursal); // Agrega un nuevo campo html (telefono)
            }
        });
        $(wrapper_telefono_sucursal).on('click', '.remove_telefono_sucursal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (telefono)
            x--; //Decrementa el contador en 1
        });



        var addEmail_sucursal = $('.add_email_sucursal');
        var wrapper_email_sucursal = $('.field_email_sucursal');

        //Nuevo campo html (agregar un nuevo correo)
        var fieldHTML_email_sucursal = '<div>'+
                                    '<label for="email_sucursal">Correo electrónico:</label><br>'+
                                    '<input type="email" class="form-control email_sucursal" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" >'+
                                    '<a href="javascript:void(0);" class="remove_email_sucursal" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                    '<br>'+
                                    '<br>'+
                                '</div>';



        var i = 1; //Contador inicial, comienza en 1
        $(addEmail_sucursal).click(function() {
            if (i < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                i++; //Incrementa el contador en 1
                $(wrapper_email_sucursal).append(fieldHTML_email_sucursal); // Agrega un nuevo campo html (correo)
            }
        });
        $(wrapper_email_sucursal).on('click', '.remove_email_sucursal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (correo)
            i--; //Decrementa el contador en 1
        });
    });
</script>
</fieldset>
