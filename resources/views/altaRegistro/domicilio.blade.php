<fieldset>

    <h1>Datos del domicilio {{$tipo_domicilio}}</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_{{$tipo_domicilio}}">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_{{$tipo_domicilio}}" name="calle_{{$tipo_domicilio}}" maxlength="50"><br>

                <label for="dpto_{{$tipo_domicilio}}">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_{{$tipo_domicilio}}" name="dpto_{{$tipo_domicilio}}" maxlength="10"><br>

                <label for="lote_{{$tipo_domicilio}}">Lote:</label><br>
                <input type="text"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_{{$tipo_domicilio}}" name="lote_{{$tipo_domicilio}}" maxlength="4">
                <small class="small" id="small-lote-{{$tipo_domicilio}}"></small>
                <br>

                <label for="entreCalles_{{$tipo_domicilio}}">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_{{$tipo_domicilio}}" name="entreCalles_{{$tipo_domicilio}}" maxlength="70"><br>

                <label for="monoblock_{{$tipo_domicilio}}">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_{{$tipo_domicilio}}" name="monoblock_{{$tipo_domicilio}}" maxlength="10"><br>

                <label for="pais_{{$tipo_domicilio}}">País:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="pais_{{$tipo_domicilio}}" name="pais_{{$tipo_domicilio}}">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="localidad_{{$tipo_domicilio}}">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_{{$tipo_domicilio}}" name="localidad_{{$tipo_domicilio}}">
                    <option value=" ">Seleccione una localidad</option>
                </select>
                <br>

                @if($tipo_domicilio=='real')
                    <label for="pagina_web">Página web:</label><br>
                    <input type="text" class="form-control" placeholder="Ingrese la página web"
                        aria-describedby="basic-addon1" id="pagina_web" name="pagina_web" maxlength="50"><br>
                @endif

                <label for="email_{{$tipo_domicilio}}">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_{{$tipo_domicilio}}" name="email_{{$tipo_domicilio}}[]" maxlength="50"><br>
                <div class="field_email_{{$tipo_domicilio}}">

                </div>


                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_email_{{$tipo_domicilio}}" title="Agregue un nuevo correo"><input type="button" value="Agregar nuevo correo" class="btn btn-outline-success"></a>
                </div>

               <!-- <label for="telefono_real">Teléfono:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" maxlength="14"> -->

            </div>
            <div class="col-sm">

                <label for="numero_{{$tipo_domicilio}}">Número:</label><br>
                <input type="text"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_{{$tipo_domicilio}}" name="numero_{{$tipo_domicilio}}" maxlength="5">
                <small class="small" id="small-numero-{{$tipo_domicilio}}"></small>
                <br>

                <label for="puerta_{{$tipo_domicilio}}">Puerta:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la puerta" aria-describedby="basic-addon1" id="puerta_{{$tipo_domicilio}}" name="puerta_{{$tipo_domicilio}}" maxlength="4"><br>

                <label for="manzana_{{$tipo_domicilio}}">Manzana:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_{{$tipo_domicilio}}" name="manzana_{{$tipo_domicilio}}" maxlength="5"><br>

                <label for="oficina_{{$tipo_domicilio}}">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_{{$tipo_domicilio}}" name="oficina_{{$tipo_domicilio}}" maxlength="4"><br>

                <label for="barrio_{{$tipo_domicilio}}">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_{{$tipo_domicilio}}" name="barrio_{{$tipo_domicilio}}" maxlength="50"><br>

                <label for="provincia_{{$tipo_domicilio}}">Provincia:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="provincia_{{$tipo_domicilio}}" name="provincia_{{$tipo_domicilio}}">
                    <option value=" ">Seleccione una provincia</option>
                    @forelse($provincias as $provincia)
                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="cp_{{$tipo_domicilio}}">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp_{{$tipo_domicilio}}" name="cp_{{$tipo_domicilio}}" placeholder="Ingrese el código postal" maxlength="8"><br>
                
                @if($tipo_domicilio =='real')
                <br>
                <br>
                <br>
                <br>
                @endif

                <div class="row">
                    <div class="col-sm">
                        <label for="telefono_{{$tipo_domicilio}}_cod">Código de área:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_{{$tipo_domicilio}}_cod" name="telefono_{{$tipo_domicilio}}_cod[]" maxlength="4">
                        <small class="small" id="small-telefono-{{$tipo_domicilio}}-cod"></small>
                    </div>
                    <div class="col-sm">
                        <label for="telefono_{{$tipo_domicilio}}">Número de Teléfono:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_{{$tipo_domicilio}}" name="telefono_{{$tipo_domicilio}}[]" maxlength="14">
                        <small class="small" id="small-telefono-{{$tipo_domicilio}}"></small>
                    </div>
                </div>
                <div class="field_telefono_{{$tipo_domicilio}}">

                </div>
                <br>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_{{$tipo_domicilio}}" title="Agregue un nuevo teléfono"><input type="button" value="Agregar nuevo teléfono" class="btn btn-outline-success"></a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


<script type="text/javascript">


    $('#lote_{{$tipo_domicilio}}').keyup(validarLote);

    function validarLote() {

        if (!(/^[0-9]+$/.test($('#lote_{{$tipo_domicilio}}').val()))) {
            if($('#lote_{{$tipo_domicilio}}').val() != ""){
            mostrarError('#lote_{{$tipo_domicilio}}', '#small-lote-{{$tipo_domicilio}}', '<div class="alert alert-danger mt-3 pt-1">El <strong>lote</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#lote_{{$tipo_domicilio}}', '#small-lote-{{$tipo_domicilio}}');
        return true;
    }


    $('#numero_{{$tipo_domicilio}}').keyup(validarNumero);

    function validarNumero() {

        if (!(/^[0-9]+$/.test($('#numero_{{$tipo_domicilio}}').val()))) {
            if($('#numero_{{$tipo_domicilio}}').val() != ""){

            mostrarError('#numero_{{$tipo_domicilio}}', '#small-numero-{{$tipo_domicilio}}', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de la calle</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#numero_{{$tipo_domicilio}}', '#small-numero-{{$tipo_domicilio}}');
        return true;
    }


    $('#telefono_{{$tipo_domicilio}}_cod').keyup(validarTelefonoCod);

    function validarTelefonoCod() {

        if (!(/^[0-9]+$/.test($('#telefono_{{$tipo_domicilio}}_cod').val()))) {
            if($('#telefono_{{$tipo_domicilio}}_cod').val() != ""){

            mostrarError('#telefono_{{$tipo_domicilio}}_cod', '#small-telefono-{{$tipo_domicilio}}-cod', '<div class="alert alert-danger mt-3 pt-1">El <strong>código de área</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#telefono_{{$tipo_domicilio}}_cod', '#small-telefono-{{$tipo_domicilio}}-cod');
        return true;
    }



    $('#telefono_{{$tipo_domicilio}}').keyup(validarTelefono);

    function validarTelefono() {

        if (!(/^[0-9]+$/.test($('#telefono_{{$tipo_domicilio}}').val()))) {
            if($('#telefono_{{$tipo_domicilio}}').val() != ""){

            mostrarError('#telefono_{{$tipo_domicilio}}', '#small-telefono-{{$tipo_domicilio}}', '<div class="alert alert-danger mt-3 pt-1">El <strong>teléfono</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#telefono_{{$tipo_domicilio}}', '#small-telefono-{{$tipo_domicilio}}');
        return true;
    }



    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono = $('.add_telefono_{{$tipo_domicilio}}');
        var wrapper_telefono = $('.field_telefono_{{$tipo_domicilio}}');
        var x = 1; //Contador inicial, comienza en 1


        $(addTelefono).click(function() {

            //Nuevo campo html (agregar un nuevo teléfono)
            var fieldHTML_telefono = '<div>'+'<div class="row">'+
                                 '<div class="col-sm">'+
                                 '<br>'+
                                 '<label for="telefono_{{$tipo_domicilio}}_cod' + x +'">Código de área:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_{{$tipo_domicilio}}_cod' + x +'" name="telefono_{{$tipo_domicilio}}_cod[]" maxlength="4">'+
                                    '</div>'+
                                    '<div class="col-sm">'+
                                    '<br>'+
                                    '<label for="telefono_{{$tipo_domicilio}}' + x +'">Número de Teléfono:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_{{$tipo_domicilio}}' + x +'" name="telefono_{{$tipo_domicilio}}[]" maxlength="14">'+
                                    '</div>'+
                                 '<br>'+
                                 '<br>'+
                                 '</div>'+
                                    '<a href="javascript:void(0);" class="remove_telefono_{{$tipo_domicilio}}" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                 '</div>';

            if(x == 1){

                //Obtenemos el valor del campo, al clickear el botón Agregar Teléfono
                let tel = document.getElementById('telefono_{{$tipo_domicilio}}').value;
                var cod_tel = document.getElementById('telefono_{{$tipo_domicilio}}_cod').value;

                //Si el campo teléfono no se encuentra vacío, permite agregar un segundo campo.
                if (tel.length != 0 && cod_tel.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (x < maxField) {

                        x++; //Incrementa el contador en 1

                        $(wrapper_telefono).append(fieldHTML_telefono); // Agrega un nuevo campo html (telefono)
                    }
                }

            } else {

                var y = x - 1;

                //Obtenemos el valor del campo dinamico x, al clickear el botón Agregar Teléfono
                var tel_dinamico = document.getElementById('telefono_{{$tipo_domicilio}}' + y).value;
                var cod_tel_dinamico = document.getElementById('telefono_{{$tipo_domicilio}}_cod' + y).value;

                //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                if (tel_dinamico.length != 0 && cod_tel_dinamico.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (x < maxField) {

                        x++; //Incrementa el contador en 1

                        $(wrapper_telefono).append(fieldHTML_telefono); // Agrega un nuevo campo html (telefono)
                    }
                }
            }

        });


        $(wrapper_telefono).on('click', '.remove_telefono_{{$tipo_domicilio}}', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (telefono)
            x--; //Decrementa el contador en 1
        });


        var addEmail = $('.add_email_{{$tipo_domicilio}}');
        var wrapper_email = $('.field_email_{{$tipo_domicilio}}');
        var i = 1; //Contador inicial, comienza en 1

        $(addEmail).click(function() {

            //Nuevo campo html (agregar un nuevo correo)
            var fieldHTML_email= '<div>'+
                                    '<label for="email_{{$tipo_domicilio}}' + i +'">Correo electrónico:</label><br>'+
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_{{$tipo_domicilio}}' + i +'" name="email_{{$tipo_domicilio}}[]" maxlength="50">'+
                                    '<a href="javascript:void(0);" class="remove_email_{{$tipo_domicilio}}" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                    '<br>'+
                                    '<br>'+
                                '</div>';

            if(i == 1){

                //Obtenemos el valor del campo, al clickear el botón Agregar Correo
                let email = document.getElementById('email_{{$tipo_domicilio}}').value;

                //Si el campo email no se encuentra vacío, permite agregar un segundo campo.
                if (email.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (i < maxField) {

                        i++; //Incrementa el contador en 1

                        $(wrapper_email).append(fieldHTML_email); // Agrega un nuevo campo html (correo)
                    }
                }

            } else {

                var y = i - 1;

                //Obtenemos el valor del campo dinamico x, al clickear el botón Agregar Correo
                var email_dinamico = document.getElementById('email_{{$tipo_domicilio}}' + y).value;

                //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                if (email_dinamico.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (i < maxField) {

                        i++; //Incrementa el contador en 1

                        $(wrapper_email).append(fieldHTML_email); // Agrega un nuevo campo html (correo)
                    }
                }
            }

        });


        $(wrapper_email).on('click', '.remove_email_{{$tipo_domicilio}}', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (correo)
            i--; //Decrementa el contador en 1
        });

    });

</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia_{{$tipo_domicilio}}').change(function(){
            console.log("detecta cambio en provincia "+$(this).val());
			recargarLista('{{$tipo_domicilio}}', $(this).val());
		});
	})
</script>

<script type="text/javascript">
	function recargarLista(tipo_domicilio, provincia){
        console.log("llama a funcion para cargar localidades ");
		$.ajax({
			type:"GET",
			url:"{{url('localidades/')}}/"+provincia,
			success:function(r){
				$('#localidad_'+tipo_domicilio).html(r);
			}
		});
	}
</script>

</fieldset>
