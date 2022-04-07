<fieldset>

    <h1>Datos del domicilio fiscal</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_fiscal">Calle:</label><br>
                <input type="text" class="form-control limpiar" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_fiscal" name="calle_fiscal" @if ( $mode == "show") readonly @endif maxlength="50"
value="{{ isset($proveedor_domicilio_fiscal->calle) ? $proveedor_domicilio_fiscal->calle : '' }}"><br>

                <label for="dpto_fiscal">Departamento:</label><br>
                <input type="text" class="form-control limpiar" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_fiscal" name="dpto_fiscal" @if ( $mode == "show") readonly @endif maxlength="10"
value="{{ isset($proveedor_domicilio_fiscal->dpto) ? $proveedor_domicilio_fiscal->dpto : '' }}"><br>

                <label for="lote_fiscal">Lote:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control limpiar" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_fiscal" name="lote_fiscal" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_fiscal->lote) ? $proveedor_domicilio_fiscal->lote : '' }}" maxlength="4">
                <small class="small" id="small-lote-fiscal"></small>
                <br>

                <label for="entreCalles_fiscal">Entre Calles:</label><br>
                <input type="text" class="form-control limpiar" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_fiscal" name="entreCalles_fiscal" @if ( $mode == "show") readonly @endif maxlength="70"
value="{{ isset($proveedor_domicilio_fiscal->entre_calles) ? $proveedor_domicilio_fiscal->entre_calles : '' }}"><br>

                <label for="monoblock_fiscal">Monoblock:</label><br>
                <input type="text" class="form-control limpiar" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_fiscal" name="monoblock_fiscal" @if ( $mode == "show") readonly @endif maxlength="10"
value="{{ isset($proveedor_domicilio_fiscal->monoblock) ? $proveedor_domicilio_fiscal->monoblock : '' }}"><br>

                <label for="pais_fiscal">Pais:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" @if ( $mode == "show") disabled @endif id="pais_fiscal" name="pais_fiscal">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="localidad_fiscal">Localidad:</label><br>
                <select class="form-control" @if ( $mode == "show") disabled @endif aria-describedby="basic-addon1" id="localidad_fiscal" name="localidad_fiscal">
                <option value="{{isset($proveedor_localidades_fiscal->nombre_localidad) ? $proveedor_localidades_fiscal->nombre_localidad : '' }}">{{isset($proveedor_localidades_fiscal->nombre_localidad) ? $proveedor_localidades_fiscal->nombre_localidad : 'Seleccione una localidad' }}</option>
                </select>
                <br>

                    <div class="field_email_fiscal">

                        @forelse($proveedor_email_fiscal as $email_fiscal)

                            <label for="email_fiscal">Correo electrónico:</label><br>
                            <input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_fiscal" name="email_fiscal[]" @if ( $mode == "show") readonly @endif value="{{$email_fiscal->email}}" maxlength="50"> <br>
                        @empty
                            <label for="email_fiscal">Correo electrónico:</label><br>
                            <input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_fiscal" name="email_fiscal[]" maxlength="50"> <br>
                        @endforelse

                    </div>
                    @if ( $mode != "show" && count($proveedor_email_fiscal) < 3)

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="javascript:void(0);" class="add_email_fiscal" title="Agregue un nuevo correo"><input type="button" @if ( $mode == "show") readonly @endif value="Agregar nuevo correo" class="btn btn-outline-success"></a>
                    </div>
@endif
            </div>
            <div class="col-sm">

                <label for="numero_fiscal">Número:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control limpiar" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_fiscal" name="numero_fiscal" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_fiscal->numero) ? $proveedor_domicilio_fiscal->numero : '' }}" maxlength="5">
                <small class="small" id="small-numero-fiscal"></small>
                <br>

                <label for="puerta_fiscal">Puerta:</label><br>
                <input type="text" class="form-control limpiar" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_fiscal" name="puerta_fiscal" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_fiscal->puerta) ? $proveedor_domicilio_fiscal->puerta : '' }}" maxlength="4"><br>

                <label for="manzana_fiscal">Manzana:</label><br>
                <input type="text" class="form-control limpiar" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_fiscal" name="manzana_fiscal" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_fiscal->manzana) ? $proveedor_domicilio_fiscal->manzana : '' }}" maxlength="5"><br>

                <label for="oficina_fiscal">Oficina:</label><br>
                <input type="text" class="form-control limpiar" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_fiscal" name="oficina_fiscal" @if ( $mode == "show") readonly @endif maxlength="4"
value="{{ isset($proveedor_domicilio_fiscal->oficina) ? $proveedor_domicilio_fiscal->oficina : '' }}"><br>

                <label for="barrio_fiscal">Barrio:</label><br>
                <input type="text" class="form-control limpiar" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_fiscal" name="barrio_fiscal" @if ( $mode == "show") readonly @endif maxlength="50"
value="{{ isset($proveedor_domicilio_fiscal->barrio) ? $proveedor_domicilio_fiscal->barrio : '' }}"><br>

                <label for="provincia_fiscal">Provincia:</label><br>
                <select class="form-control" @if ( $mode == "show") disabled @endif aria-describedby="basic-addon1" id="provincia_fiscal" name="provincia_fiscal">
                <option value="{{isset($proveedor_provincias_fiscal->nombre_provincia) ? $proveedor_provincias_fiscal->nombre_provincia : '' }}">{{isset($proveedor_provincias_fiscal->nombre_provincia) ? $proveedor_provincias_fiscal->nombre_provincia : 'Seleccione una provincia' }}</option>
                    @forelse($provincias as $provincia)
                        @if ($provincia->id_provincia == $provinciaidFiscal)
                            <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                        @else
                            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                        @endif
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="cp_fiscal">Código Postal:</label><br>
                <input type="text" class="form-control limpiar" aria-describedby="basic-addon1" id="cp_fiscal" name="cp_fiscal" placeholder="Ingrese el código postal" @if ( $mode == "show") readonly @endif maxlength="8"
value="{{ isset($proveedor_domicilio_fiscal->codigo_postal) ? $proveedor_domicilio_fiscal->codigo_postal : '' }}"><br>

                <div class="field_telefono_fiscal">

                    <div class="row">

                        <div class="col-sm">
                        @forelse($proveedor_telefono_fiscal as $telefono_fiscal)
                            <label for="telefono_fiscal_cod">Código de área:</label><br>
                            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_fiscal_cod" name="telefono_fiscal_cod[]" @if ( $mode == "show") readonly @endif value="{{$telefono_fiscal->cod_area_tel}}" maxlength="4">
                            <small class="small" id="small-telefono-fiscal-cod"></small>
                            <br>
                        @empty
                            <label for="telefono_fiscal_cod">Código de área:</label><br>
                            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_fiscal_cod" name="telefono_fiscal_cod[]" maxlength="4">
                            <small class="small" id="small-telefono-fiscal-cod"></small>
                            <br>
                            @endforelse
                        </div>

                        <div class="col-sm">
                        @forelse($proveedor_telefono_fiscal as $telefono_fiscal)
                            <label for="telefono_fiscal">Número de Teléfono:</label><br>
                            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_fiscal" name="telefono_fiscal[]" @if ( $mode == "show") readonly @endif value="{{$telefono_fiscal->nro_tel}}" maxlength="14">
                            <small class="small" id="small-telefono-fiscal"></small>
                            <br>
                        @empty
                            <label for="telefono_fiscal">Número de Teléfono:</label><br>
                            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_fiscal" name="telefono_fiscal[]" maxlength="14">
                            <small class="small" id="small-telefono-fiscal"></small>
                            <br>
                            @endforelse
                        </div>

                    </div>

                </div>
                @if ( $mode != "show" && count($proveedor_telefono_fiscal) < 3)

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_fiscal" title="Agregue un nuevo teléfono"><input type="button" @if ( $mode == "show") readonly @endif value="Agregar nuevo teléfono" class="btn btn-outline-success"></a>
                </div>
@endif
            </div>
        </div>

    </div>
    <br>
        <div class="row navbuttons ">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>


@push('js')

<script type="text/javascript">

    $('#lote_fiscal').keyup(validarLoteFiscal);

    function validarLoteFiscal() {

        if (!(/^[0-9]+$/.test($('#lote_fiscal').val()))) {
            if($('#lote_fiscal').val() != ""){

            mostrarError('#lote_fiscal', '#small-lote-fiscal', '<div class="alert alert-danger mt-3 pt-1">El <strong>lote</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#lote_fiscal', '#small-lote-fiscal');
        return true;
    }


    $('#numero_fiscal').keyup(validarNumeroFiscal);

    function validarNumeroFiscal() {

        if (!(/^[0-9]+$/.test($('#numero_fiscal').val()))) {
            if($('#numero_fiscal').val() != ""){

            mostrarError('#numero_fiscal', '#small-numero-fiscal', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de la calle</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#numero_fiscal', '#small-numero-fiscal');
        return true;
    }


    $('#telefono_fiscal_cod').keyup(validarTelefonoFiscalCod);

    function validarTelefonoFiscalCod() {

        if (!(/^[0-9]+$/.test($('#telefono_fiscal_cod').val()))) {
            if($('#telefono_fiscal_cod').val() != ""){

            mostrarError('#telefono_fiscal_cod', '#small-telefono-fiscal-cod', '<div class="alert alert-danger mt-3 pt-1">El <strong>código de área</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#telefono_fiscal_cod', '#small-telefono-fiscal-cod');
        return true;
    }



    $('#telefono_fiscal').keyup(validarTelefonoFiscal);

    function validarTelefonoFiscal() {

        if (!(/^[0-9]+$/.test($('#telefono_fiscal').val()))) {
            if($('#telefono_fiscal').val() != ""){

            mostrarError('#telefono_fiscal', '#small-telefono-fiscal', '<div class="alert alert-danger mt-3 pt-1">El <strong>teléfono</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#telefono_fiscal', '#small-telefono-fiscal');
        return true;
    }





    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono_fiscal = $('.add_telefono_fiscal');
        var wrapper_telefono_fiscal = $('.field_telefono_fiscal');
        var x = 1; //Contador inicial, comienza en 1

        $(addTelefono_fiscal).click(function() {

            //Nuevo campo html (agregar un nuevo teléfono)
            var fieldHTML_telefono_fiscal =  '<div>'+'<div class="row">'+
                                 '<div class="col-sm">'+
                                 '<br>'+
                                 '<label for="telefono_fiscal_cod' + x +'">Código de área:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_fiscal_cod' + x +'" name="telefono_fiscal_cod[]" maxlength="4">'+
                                    '</div>'+
                                    '<div class="col-sm">'+
                                    '<br>'+
                                    '<label for="telefono_fiscal' + x +'">Número de Teléfono:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_fiscal' + x +'" name="telefono_fiscal[]" maxlength="14">'+
                                    '</div>'+
                                '</div>'+
                                '<a href="javascript:void(0);" class="remove_telefono_fiscal" title="Elimine el teléfono"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                '</div>';


            if(x == 1){

                //Obtenemos el valor del campo, al clickear el botón Agregar Teléfono
                let tel_fiscal = document.getElementById('telefono_fiscal').value;
                var cod_tel_fiscal = document.getElementById('telefono_fiscal_cod').value;

                //Si el campo teléfono no se encuentra vacío, permite agregar un segundo campo.
                if (tel_fiscal.length != 0 && cod_tel_fiscal.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (x < maxField) {

                        x++; //Incrementa el contador en 1

                        $(wrapper_telefono_fiscal).append(fieldHTML_telefono_fiscal); // Agrega un nuevo campo html (telefono)
                    }
                }

            } else {

                var y = x - 1;

                //Obtenemos el valor del campo dinamico x, al clickear el botón Agregar Teléfono
                var tel_fiscal_dinamico = document.getElementById('telefono_fiscal' + y).value;
                var cod_tel_fiscal_dinamico = document.getElementById('telefono_fiscal_cod' + y).value;

                //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                if (tel_fiscal_dinamico.length != 0 && cod_tel_fiscal_dinamico.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (x < maxField) {

                        x++; //Incrementa el contador en 1

                        $(wrapper_telefono_fiscal).append(fieldHTML_telefono_fiscal); // Agrega un nuevo campo html (telefono)
                    }
                }
            }

        });


        $(wrapper_telefono_fiscal).on('click', '.remove_telefono_fiscal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (telefono)
            x--; //Decrementa el contador en 1
        });



        var addEmail_fiscal = $('.add_email_fiscal');
        var wrapper_email_fiscal = $('.field_email_fiscal');
        var i = 1; //Contador inicial, comienza en 1

        $(addEmail_fiscal).click(function() {

            //Nuevo campo html (agregar un nuevo correo)
            var fieldHTML_email_fiscal = '<div>'+
                                    '<label for="email_fiscal' + i +'">Correo electrónico:</label><br>'+
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_fiscal' + i +'" name="email_fiscal[]" maxlength="50">'+
                                    '<a href="javascript:void(0);" class="remove_email_fiscal" title="Elimine el correo"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                    '<br>'+
                                    '<br>'+
                                '</div>';



            if(i == 1){

                //Obtenemos el valor del campo, al clickear el botón Agregar Correo
                let email_fiscal = document.getElementById('email_fiscal').value;

                //Si el campo email no se encuentra vacío, permite agregar un segundo campo.
                if (email_fiscal.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (i < maxField) {

                        i++; //Incrementa el contador en 1

                        $(wrapper_email_fiscal).append(fieldHTML_email_fiscal); // Agrega un nuevo campo html (correo)
                    }
                }

            } else {

                var y = i - 1;

                //Obtenemos el valor del campo dinamico x, al clickear el botón Agregar Correo
                var email_fiscal_dinamico = document.getElementById('email_fiscal' + y).value;

                //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                if (email_fiscal_dinamico.length != 0){

                    //Verifica el numero maximo de campos a agregar, con el limite establecido
                    if (i < maxField) {

                        i++; //Incrementa el contador en 1

                        $(wrapper_email_fiscal).append(fieldHTML_email_fiscal); // Agrega un nuevo campo html (correo)
                    }
                }
            }

        });


        $(wrapper_email_fiscal).on('click', '.remove_email_fiscal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (correo)
            i--; //Decrementa el contador en 1
        });

    });

</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia_fiscal').change(function(){
			recargarListaFiscal();
		});
	})
</script>

<script type="text/javascript">
	function recargarListaFiscal(){
		$.ajax({
			type:"GET",
            url:"{{url('localidades')}}/"+$('#provincia_fiscal').val(),
			success:function(r){
				$('#localidad_fiscal').html(r);
			}
		});
	}
    function recargarListaFiscal2(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/')}}/{{isset($proveedor_domicilio_fiscal->id_localidad) ? $proveedor_domicilio_fiscal->id_localidad : ''}}",
            success:function(r){
                $('#localidad_fiscal').html(r);
            }
        });
    }
</script>
@endpush

</fieldset>
