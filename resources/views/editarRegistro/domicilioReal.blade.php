<fieldset>

    <h1>Datos del domicilio real</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_real">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_real" name="calle_real" @if ( $mode == "show") readonly @endif maxlength="40"
value="{{ isset($proveedor_domicilio_real->calle) ? $proveedor_domicilio_real->calle : '' }}"><br>

                <label for="dpto_real">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_real" name="dpto_real" @if ( $mode == "show") readonly @endif maxlength="10"
value="{{ isset($proveedor_domicilio_real->dpto) ? $proveedor_domicilio_real->dpto : '' }}"><br>

                <label for="lote_real">Lote:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_real" name="lote_real" @if ( $mode == "show") readonly @endif maxlength="3"
value="{{ isset($proveedor_domicilio_real->lote) ? $proveedor_domicilio_real->lote : '' }}"><br>

                <label for="entreCalles_real">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_real" name="entreCalles_real" @if ( $mode == "show") readonly @endif maxlength="50"
value="{{ isset($proveedor_domicilio_real->entre_calles) ? $proveedor_domicilio_real->entre_calles : '' }}"><br>

                <label for="monoblock_real">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_real" name="monoblock_real" @if ( $mode == "show") readonly @endif maxlength="10"
value="{{ isset($proveedor_domicilio_real->monoblock) ? $proveedor_domicilio_real->monoblock : '' }}"><br>

                <label for="pais_real">Pais:</label><br>
                <select class="form-control" @if ( $mode == "show") disabled @endif aria-describedby="basic-addon1" id="pais_real" name="pais_real">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="localidad_real">Localidad:</label><br>
                <select class="form-control"  @if ( $mode == "show") disabled @endif   aria-describedby="basic-addon1" id="localidad_real" name="localidad_real">
                </select>
                <br>

                <label for="pagina_web">Página web:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la página web"
                    aria-describedby="basic-addon1" id="pagina_web" name="pagina_web" @if ( $mode == "show") readonly @endif maxlength="30"
value="{{ isset($proveedor->pagina_web) ? $proveedor->pagina_web : '' }}"><br>

                <div class="field_email_real">

                    @forelse($proveedor_email_real as $email_real)

                        <label for="email_real">Correo electrónico:</label><br>
                        <input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_real" name="email_real[]" @if ( $mode == "show") readonly @endif value="{{$email_real->email}}" maxlength="30"> <br>
                    @empty
                        <label for="email_real">Correo electrónico:</label><br>
                        <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_real" name="email_real[]" maxlength="30"><br>
                    @endforelse

                </div>

                <div class="field_telefono_real">

                    @forelse($proveedor_telefono_real as $telefono_real)

                        <label for="telefono_real">Teléfono:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" @if ( $mode == "show") readonly @endif
value="{{$telefono_real->nro_tel}}" maxlength="14"> <br>
                    @empty
                        <label for="telefono_real">Teléfono:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" maxlength="14"><br>
                    @endforelse

                </div>
            </div>
            <div class="col-sm">

                <label for="numero_real">Número:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_real" name="numero_real" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_real->numero) ? $proveedor_domicilio_real->numero : '' }}" maxlength="4"><br>

                <label for="puerta_real">Puerta:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_real" name="puerta_real" @if ( $mode == "show") readonly @endif maxlength="4"
value="{{ isset($proveedor_domicilio_real->puerta) ? $proveedor_domicilio_real->puerta : '' }}"><br>

                <label for="manzana_real">Manzana:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_real" name="manzana_real" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_real->manzana) ? $proveedor_domicilio_real->manzana : '' }}" maxlength="3"><br>

                <label for="oficina_real">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_real" name="oficina_real" @if ( $mode == "show") readonly @endif maxlength="4"
value="{{ isset($proveedor_domicilio_real->oficina) ? $proveedor_domicilio_real->oficina : '' }}"><br>

                <label for="barrio_real">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_real" name="barrio_real" @if ( $mode == "show") readonly @endif maxlength="20"
value="{{ isset($proveedor_domicilio_real->barrio) ? $proveedor_domicilio_real->barrio : '' }}"><br>

                <label for="provincia_real">Provincia:</label><br>
                <select class="form-control" @if ( $mode == "show") disabled @endif aria-describedby="basic-addon1" id="provincia_real" name="provincia_real">
                <option value="{{isset($proveedor_provincias_real->nombre_provincia) ? $proveedor_provincias_real->nombre_provincia : '' }}">{{isset($proveedor_provincias_real->nombre_provincia) ? $proveedor_provincias_real->nombre_provincia : 'Seleccione una provincia' }}</option>
                    @forelse($provincias as $provincia)
                        @if ($provincia->id_provincia == $provinciaidReal)
                            <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                        @else
                            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                        @endif                    
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="cp_real">Código Postal:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cp_real" name="cp_real" placeholder="Ingrese el código postal" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_real->codigo_postal) ? $proveedor_domicilio_real->codigo_postal : '' }}" maxlength="4"><br>

@if ( $mode != "show")

                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_email_real" title="Agregue un nuevo correo"><input type="button" @if ( $mode == "show") readonly @endif value="Agregar Correo" class="btn btn-success"></a>
                </div>
                <br>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_real" title="Agregue un nuevo teléfono"><input type="button" @if ( $mode == "show") readonly @endif value="Agregar Teléfono" class="btn btn-success"></a>
                </div>
@endif
            </div>
        </div>
    </div>

    <br>

    <div class="row navbuttons ">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-primary btnPrevious">Anterior</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>
@push('js')


<script type="text/javascript">
    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono_real = $('.add_telefono_real');
        var wrapper_telefono_real = $('.field_telefono_real');


        //Nuevo campo html (agregar un nuevo teléfono)
        var fieldHTML_telefono_real = '<div>'+
                                 '<br>'+
                                    '<label for="telefono_real">Teléfono:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" maxlength="14">'+
                                    '<a href="javascript:void(0);" class="remove_telefono_real" title="Elimine el teléfono"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                 '<br>'+
                                '</div>';


        var x = 1; //Contador inicial, comienza en 1
        $(addTelefono_real).click(function() {
            if (x < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                x++; //Incrementa el contador en 1
                $(wrapper_telefono_real).append(fieldHTML_telefono_real); // Agrega un nuevo campo html (telefono)
            }
        });
        $(wrapper_telefono_real).on('click', '.remove_telefono_real', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (telefono)
            x--; //Decrementa el contador en 1
        });



        var addEmail_real = $('.add_email_real');
        var wrapper_email_real = $('.field_email_real');

        //Nuevo campo html (agregar un nuevo correo)
        var fieldHTML_email_real = '<div>'+
                                    '<label for="email_real">Correo electrónico:</label><br>'+
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_real" name="email_real[]" maxlength="30">'+
                                    '<a href="javascript:void(0);" class="remove_email_real" title="Elimine el correo"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                    '<br>'+
                                    '<br>'+
                                '</div>';



        var i = 1; //Contador inicial, comienza en 1
        $(addEmail_real).click(function() {
            if (i < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                i++; //Incrementa el contador en 1
                $(wrapper_email_real).append(fieldHTML_email_real); // Agrega un nuevo campo html (correo)
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
  window.onload = function(){
        console.log("localidad real");
        };
    function recargarListaRealEdit2(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/'.$proveedor_domicilio_real->id_localidad)}}",
            success:function(r){
                $('#localidad_real').html(r);
            }
        });
    };

	$(document).ready(function(){

		$('#provincia_real').change(function(){
			recargarListaRealEdit();
		});
	})
</script>

<script type="text/javascript">
	function recargarListaRealEdit(){
		$.ajax({
			type:"GET",
			url:"localidades/"+$('#provincia_real').val(),
			success:function(r){
				$('#localidad_real').html(r);
			}
		});
	}


</script>

@endpush
</fieldset>
