<fieldset>

    <h1>Datos del Domicilio legal</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_legal">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_legal" name="calle_legal" maxlength="50"><br>

                <label for="dpto_legal">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_legal" name="dpto_legal" maxlength="10"><br>

                <label for="lote_legal">Lote:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_legal" name="lote_legal" maxlength="4">
                <small class="small" id="small-lote-legal"></small>
                <br>

                <label for="entreCalles_legal">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_legal" name="entreCalles_legal" maxlength="70"><br>

                <label for="monoblock_legal">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_legal" name="monoblock_legal" maxlength="10"><br>

                <label for="pais_legal">País:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="pais_legal" name="pais_legal">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="localidad_legal">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_legal" name="localidad_legal">
                    <option value=" ">Seleccione una localidad</option>
                </select>
                <br>

               <label for="email_legal">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_legal" name="email_legal[]" maxlength="50"><br>
                <div class="field_email_legal">

                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_email_legal" title="Agregue un nuevo correo"><input type="button" value="Agregar nuevo correo" class="btn btn-outline-success"></a>
                </div>
                <br>

                <!-- <label for="telefono_legal">Teléfono:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_legal" name="telefono_legal[]" maxlength="14"> -->

            </div>
            <div class="col-sm">

                <label for="numero_legal">Número:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_legal" name="numero_legal" maxlength="5">
                <small class="small" id="small-numero-legal"></small>
                <br>

                <label for="puerta_legal">Puerta:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_legal" name="puerta_legal" maxlength="4"><br>

                <label for="manzana_legal">Manzana:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_legal" name="manzana_legal" maxlength="5"><br>

                <label for="oficina_legal">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_legal" name="oficina_legal" maxlength="4"><br>

                <label for="barrio_legal">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_legal" name="barrio_legal" maxlength="50"><br>

                <label for="provincia_legal">Provincia:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="provincia_legal" name="provincia_legal">
                    <option value=" ">Seleccione una provincia</option>
                    @forelse($provincias as $provincia)
                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="cp_legal">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp_legal" name="cp_legal" placeholder="Ingrese el código postal" maxlength="8"><br>

                <div class="row">
                    <div class="col-sm">
                        <label for="telefono_legal_cod">Código de área:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_legal_cod" name="telefono_legal_cod[]" maxlength="4">
                        <small class="small" id="small-telefono-legal-cod"></small>
                    </div>
                    <div class="col-sm">
                        <label for="telefono_legal">Número de Teléfono:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_legal" name="telefono_legal[]" maxlength="14">
                        <small class="small" id="small-telefono-legal"></small>
                    </div>
                </div>
                <div class="field_telefono_legal">

                </div>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_legal" title="Agregue un nuevo teléfono"><input type="button" value="Agregar nuevo teléfono" class="btn btn-outline-success"></a>
                </div>

            </div>
        </div>

    </div>
    <br>
    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />



<script type="text/javascript">


    $('#lote_legal').keyup(validarLoteLegal);

    function validarLoteLegal() {

        if (!(/^[0-9]+$/.test($('#lote_legal').val()))) {
            if($('#lote_legal').val() != ""){


            mostrarError('#lote_legal', '#small-lote-legal', '<div class="alert alert-danger mt-3 pt-1">El <strong>lote</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#lote_legal', '#small-lote-legal');
        return true;
    }


    $('#numero_legal').keyup(validarNumeroLegal);

    function validarNumeroLegal() {

        if (!(/^[0-9]+$/.test($('#numero_legal').val()))) {
            if($('#numero_legal').val() != ""){

            mostrarError('#numero_legal', '#small-numero-legal', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de la calle</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#numero_legal', '#small-numero-legal');
        return true;
    }


    $('#telefono_legal_cod').keyup(validarTelefonoLegalCod);

    function validarTelefonoLegalCod() {

        if (!(/^[0-9]+$/.test($('#telefono_legal_cod').val()))) {
            if($('#telefono_legal_cod').val() != ""){

            mostrarError('#telefono_legal_cod', '#small-telefono-legal-cod', '<div class="alert alert-danger mt-3 pt-1">El <strong>código de área</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#telefono_legal_cod', '#small-telefono-legal-cod');
        return true;
    }



    $('#telefono_legal').keyup(validarTelefonoLegal);

    function validarTelefonoLegal() {

        if (!(/^[0-9]+$/.test($('#telefono_legal').val()))) {
            if($('#telefono_legal').val() != ""){

            mostrarError('#telefono_legal', '#small-telefono-legal', '<div class="alert alert-danger mt-3 pt-1">El <strong>teléfono</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#telefono_legal', '#small-telefono-legal');
        return true;
    }



    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono_legal = $('.add_telefono_legal');
        var wrapper_telefono_legal = $('.field_telefono_legal');
        var x = 1; //Contador inicial, comienza en 1

        $(addTelefono_legal).click(function() {

            //Nuevo campo html (agregar un nuevo teléfono)
            var fieldHTML_telefono_legal = '<div>'+'<div class="row">'+
                                 '<div class="col-sm">'+
                                 '<br>'+
                                 '<label for="telefono_legal_cod' + x +'">Código de área:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_legal_cod' + x +'" name="telefono_legal_cod[]" maxlength="4">'+
                                    '</div>'+
                                    '<div class="col-sm">'+
                                    '<br>'+
                                    '<label for="telefono_legal' + x +'">Número de Teléfono:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_legal' + x +'" name="telefono_legal[]" maxlength="14">'+
                                    '</div>'+
                                 '<br>'+
                                 '<br>'+
                                '</div>'+
                                '<a href="javascript:void(0);" class="remove_telefono_legal" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+

                                '</div>';


            if(x == 1){

                //Obtenemos el valor del campo, al clickear el botón Agregar Teléfono
                let tel_legal = document.getElementById('telefono_legal').value;
                var cod_tel_legal = document.getElementById('telefono_legal_cod').value;

                //Si el campo teléfono no se encuentra vacío, permite agregar un segundo campo.
                if (tel_legal.length != 0 && cod_tel_legal.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (x < maxField) {

                        x++; //Incrementa el contador en 1

                        $(wrapper_telefono_legal).append(fieldHTML_telefono_legal); // Agrega un nuevo campo html (telefono)
                    }
                }

            } else {

                var y = x - 1;

                //Obtenemos el valor del campo dinamico x, al clickear el botón Agregar Teléfono
                var tel_legal_dinamico = document.getElementById('telefono_legal' + y).value;
                var cod_tel_legal_dinamico = document.getElementById('telefono_legal_cod' + y).value;

                //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                if (tel_legal_dinamico.length != 0 && cod_tel_legal_dinamico.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (x < maxField) {

                        x++; //Incrementa el contador en 1

                        $(wrapper_telefono_legal).append(fieldHTML_telefono_legal); // Agrega un nuevo campo html (telefono)
                    }
                }
            }

        });



        $(wrapper_telefono_legal).on('click', '.remove_telefono_legal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (telefono)
            x--; //Decrementa el contador en 1
        });



        var addEmail_legal = $('.add_email_legal');
        var wrapper_email_legal = $('.field_email_legal');
        var i = 1; //Contador inicial, comienza en 1

        $(addEmail_legal).click(function() {

            //Nuevo campo html (agregar un nuevo correo)
            var fieldHTML_email_legal = '<div>'+
                                    '<label for="email_legal' + i +'">Correo electrónico:</label><br>'+
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_legal' + i +'" name="email_legal[]" maxlength="50">'+
                                    '<a href="javascript:void(0);" class="remove_email_legal" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                    '<br>'+
                                    '<br>'+
                                '</div>';


            if(i == 1){

                //Obtenemos el valor del campo, al clickear el botón Agregar Correo
                let email_legal = document.getElementById('email_legal').value;

                //Si el campo email no se encuentra vacío, permite agregar un segundo campo.
                if (email_legal.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (i < maxField) {

                        i++; //Incrementa el contador en 1

                        $(wrapper_email_legal).append(fieldHTML_email_legal); // Agrega un nuevo campo html (correo)
                    }
                }

            } else {

                var y = i - 1;

                //Obtenemos el valor del campo dinamico x, al clickear el botón Agregar Correo
                var email_legal_dinamico = document.getElementById('email_legal' + y).value;

                //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                if (email_legal_dinamico.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (i < maxField) {

                        i++; //Incrementa el contador en 1

                        $(wrapper_email_legal).append(fieldHTML_email_legal); // Agrega un nuevo campo html (correo)
                    }
                }
            }

        });


        $(wrapper_email_legal).on('click', '.remove_email_legal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (correo)
            i--; //Decrementa el contador en 1
        });
    });

</script>


<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia_legal').change(function(){
			recargarListaLegal();
		});
	})
</script>

<script type="text/javascript">
	function recargarListaLegal(){
		$.ajax({
			type:"GET",
			url:"{{url('localidades/')}}/"+$('#provincia_legal').val(),
			success:function(r){
				$('#localidad_legal').html(r);
			}
		});
	}
</script>

</fieldset>
