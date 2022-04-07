<fieldset>

    <h1>Datos del domicilio real</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_real">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_real" name="calle_real" maxlength="50"><br>

                <label for="dpto_real">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_real" name="dpto_real" maxlength="10"><br>

                <label for="lote_real">Lote:</label><br>
                <input type="text"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_real" name="lote_real" maxlength="4"><br>

                <label for="entreCalles_real">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_real" name="entreCalles_real" maxlength="70"><br>

                <label for="monoblock_real">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_real" name="monoblock_real" maxlength="10"><br>

                <label for="pais_real">País:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="pais_real" name="pais_real">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="localidad_real">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_real" name="localidad_real">
                    <option value=" ">Seleccione una localidad</option>
                </select>
                <br>

                <label for="pagina_web">Página web:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la página web"
                    aria-describedby="basic-addon1" id="pagina_web" name="pagina_web" maxlength="50"><br>

                <label for="email_real">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_real" name="email_real[]" maxlength="50"><br>
                <div class="field_email_real">

                </div>


                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_email_real" title="Agregue un nuevo correo"><input type="button" value="Agregar nuevo correo" class="btn btn-outline-success"></a>
                </div>

               <!-- <label for="telefono_real">Teléfono:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" maxlength="14"> -->

            </div>
            <div class="col-sm">

                <label for="numero_real">Número:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_real" name="numero_real" maxlength="5"><br>

                <label for="puerta_real">Puerta:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la puerta" aria-describedby="basic-addon1" id="puerta_real" name="puerta_real" maxlength="4"><br>

                <label for="manzana_real">Manzana:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_real" name="manzana_real" maxlength="5"><br>

                <label for="oficina_real">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_real" name="oficina_real" maxlength="4"><br>

                <label for="barrio_real">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_real" name="barrio_real" maxlength="50"><br>

                <label for="provincia_real">Provincia:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="provincia_real" name="provincia_real">
                    <option value=" ">Seleccione una provincia</option>
                    @forelse($provincias as $provincia)
                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="cp_real">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp_real" name="cp_real" placeholder="Ingrese el código postal" maxlength="8"><br>

                <br>
                <br>
                <br>
                <br>


                <div class="row">
                    <div class="col-sm">
                        <label for="telefono_real_cod">Código de área:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_real_cod" name="telefono_real_cod[]" maxlength="4">
                    </div>
                    <div class="col-sm">
                        <label for="telefono_real">Número de Teléfono:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" maxlength="14">
                    </div>
                </div>
                <div class="field_telefono_real">

                </div>
                <br>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_real" title="Agregue un nuevo teléfono"><input type="button" value="Agregar nuevo teléfono" class="btn btn-outline-success"></a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


<script type="text/javascript">
    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono_real = $('.add_telefono_real');
        var wrapper_telefono_real = $('.field_telefono_real');
        var x = 1; //Contador inicial, comienza en 1

        $(addTelefono_real).click(function() {

            //Nuevo campo html (agregar un nuevo teléfono)
            var fieldHTML_telefono_real = '<div>'+'<div class="row">'+
                                 '<div class="col-sm">'+
                                 '<br>'+
                                 '<label for="telefono_real_cod' + x +'">Código de área:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_real_cod' + x +'" name="telefono_real_cod[]" maxlength="4">'+
                                    '</div>'+
                                    '<div class="col-sm">'+
                                    '<br>'+
                                    '<label for="telefono_real' + x +'">Número de Teléfono:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_real' + x +'" name="telefono_real[]" maxlength="14">'+
                                    '</div>'+
                                 '<br>'+
                                 '<br>'+
                                 '</div>'+
                                    '<a href="javascript:void(0);" class="remove_telefono_real" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                 '</div>';

            if(x == 1){

                //Obtenemos el valor del campo, al clickear el botón Agregar Teléfono
                let tel_real = document.getElementById('telefono_real').value;
                var cod_tel_real = document.getElementById('telefono_real_cod').value;

                //Si el campo teléfono no se encuentra vacío, permite agregar un segundo campo.
                if (tel_real.length != 0 && cod_tel_real.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (x < maxField) {

                        x++; //Incrementa el contador en 1

                        $(wrapper_telefono_real).append(fieldHTML_telefono_real); // Agrega un nuevo campo html (telefono)
                    }
                }

            } else {

                var y = x - 1;

                //Obtenemos el valor del campo dinamico x, al clickear el botón Agregar Teléfono
                var tel_real_dinamico = document.getElementById('telefono_real' + y).value;
                var cod_tel_real_dinamico = document.getElementById('telefono_real_cod' + y).value;

                //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                if (tel_real_dinamico.length != 0 && cod_tel_real_dinamico.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (x < maxField) {

                        x++; //Incrementa el contador en 1

                        $(wrapper_telefono_real).append(fieldHTML_telefono_real); // Agrega un nuevo campo html (telefono)
                    }
                }
            }

        });


        $(wrapper_telefono_real).on('click', '.remove_telefono_real', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (telefono)
            x--; //Decrementa el contador en 1
        });


        var addEmail_real = $('.add_email_real');
        var wrapper_email_real = $('.field_email_real');
        var i = 1; //Contador inicial, comienza en 1

        $(addEmail_real).click(function() {

            //Nuevo campo html (agregar un nuevo correo)
            var fieldHTML_email_real = '<div>'+
                                    '<label for="email_real' + i +'">Correo electrónico:</label><br>'+
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_real' + i +'" name="email_real[]" maxlength="50">'+
                                    '<a href="javascript:void(0);" class="remove_email_real" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                    '<br>'+
                                    '<br>'+
                                '</div>';

            if(i == 1){

                //Obtenemos el valor del campo, al clickear el botón Agregar Correo
                let email_real = document.getElementById('email_real').value;

                //Si el campo email no se encuentra vacío, permite agregar un segundo campo.
                if (email_real.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (i < maxField) {

                        i++; //Incrementa el contador en 1

                        $(wrapper_email_real).append(fieldHTML_email_real); // Agrega un nuevo campo html (correo)
                    }
                }

            } else {

                var y = i - 1;

                //Obtenemos el valor del campo dinamico x, al clickear el botón Agregar Correo
                var email_real_dinamico = document.getElementById('email_real' + y).value;

                //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                if (email_real_dinamico.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (i < maxField) {

                        i++; //Incrementa el contador en 1

                        $(wrapper_email_real).append(fieldHTML_email_real); // Agrega un nuevo campo html (correo)
                    }
                }
            }

        });


        $(wrapper_email_real).on('click', '.remove_email_real', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (correo)
            i--; //Decrementa el contador en 1
        });
    });

</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia_real').change(function(){
			recargarListaReal();
		});
	})
</script>

<script type="text/javascript">
	function recargarListaReal(){
		$.ajax({
			type:"GET",
			url:"{{url('localidades/')}}/"+$('#provincia_real').val(),
			success:function(r){
				$('#localidad_real').html(r);
			}
		});
	}
</script>

</fieldset>
