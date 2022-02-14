<fieldset>

    <h1>Datos del Domicilio legal</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_legal">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_legal" name="calle_legal" @if ( $mode == "show") readonly @endif maxlength="40"
value="{{ isset($proveedor_domicilio_legal->calle) ? $proveedor_domicilio_legal->calle : '' }}"><br>

                <label for="dpto_legal">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_legal" name="dpto_legal" @if ( $mode == "show") readonly @endif maxlength="10"
value="{{ isset($proveedor_domicilio_legal->dpto) ? $proveedor_domicilio_legal->dpto : '' }}"><br>

                <label for="lote_legal">Lote:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_legal" name="lote_legal" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_legal->lote) ? $proveedor_domicilio_legal->lote : '' }}" maxlength="3"><br>

                <label for="entreCalles_legal">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_legal" name="entreCalles_legal" @if ( $mode == "show") readonly @endif maxlength="50"
value="{{ isset($proveedor_domicilio_legal->entre_calles) ? $proveedor_domicilio_legal->entre_calles : '' }}"><br>

                <label for="monoblock_legal">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_legal" name="monoblock_legal" @if ( $mode == "show") readonly @endif maxlength="10"
value="{{ isset($proveedor_domicilio_legal->monoblock) ? $proveedor_domicilio_legal->monoblock : '' }}"><br>

                <label for="pais_legal">Pais:</label><br>
                <select class="form-control" @if ( $mode == "show") disabled @endif aria-describedby="basic-addon1" id="pais_legal" name="pais_legal">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="localidad_legal">Localidad:</label><br>
                <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="localidad_legal" name="localidad_legal">
                </select>
                <br>

                    <div class="field_email_legal">

                        @forelse($proveedor_email_legal as $email_legal)

                            <label for="email_legal">Correo electrónico:</label><br>
                            <input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_legal" name="email_legal[]" @if ( $mode == "show") readonly @endif value="{{$email_legal->email}}" maxlength="30"> <br>
                        @empty
                            <label for="email_legal">Correo electrónico:</label><br>
                            <input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_legal" name="email_legal[]" maxlength="30"> <br>
                        @endforelse

                    </div>

                    <div class="field_telefono_legal">

                        @forelse($proveedor_telefono_legal as $telefono_legal)

                            <label for="telefono_legal">Teléfono:</label><br>
                            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_legal" name="telefono_legal[]" @if ( $mode == "show") readonly @endif value="{{$telefono_legal->nro_tel}}" maxlength="14"> <br>
                        @empty
                            <label for="telefono_legal">Teléfono:</label><br>
                            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_legal" name="telefono_legal[]" maxlength="14"> <br>
                        @endforelse

                    </div>
            </div>
            <div class="col-sm">

                <label for="numero_legal">Número:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_legal" name="numero_legal"  @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_legal->numero) ? $proveedor_domicilio_legal->numero : '' }}" maxlength="4"><br>

                <label for="puerta_legal">Puerta:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_legal" name="puerta_legal" @if ( $mode == "show") readonly @endif maxlength="4"
value="{{ isset($proveedor_domicilio_legal->puerta) ? $proveedor_domicilio_legal->puerta : '' }}"><br>

                <label for="manzana_legal">Manzana:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_legal" name="manzana_legal" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_legal->manzana) ? $proveedor_domicilio_legal->manzana : '' }}" maxlength="3"><br>

                <label for="oficina_legal">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_legal" name="oficina_legal" @if ( $mode == "show") readonly @endif maxlength="4"
value="{{ isset($proveedor_domicilio_legal->oficina) ? $proveedor_domicilio_legal->oficina : '' }}"><br>

                <label for="barrio_legal">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_legal" name="barrio_legal" @if ( $mode == "show") readonly @endif maxlength="20"
value="{{ isset($proveedor_domicilio_legal->barrio) ? $proveedor_domicilio_legal->barrio : '' }}"><br>

                <label for="provincia_legal">Provincia:</label><br>
                <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="provincia_legal" name="provincia_legal">
                <option value="{{isset($proveedor_provincias_legal->nombre_provincia) ? $proveedor_provincias_legal->nombre_provincia : '' }}">{{isset($proveedor_provincias_legal->nombre_provincia) ? $proveedor_provincias_legal->nombre_provincia : 'Seleccione una provincia' }}</option>
                    @forelse($provincias as $provincia)
                        @if ($provincia->id_provincia == $provinciaidLegal)
                            <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                        @else
                            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                        @endif
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="cp_legal">Código Postal:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cp_legal" name="cp_legal" placeholder="Ingrese el código postal" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor_domicilio_legal->codigo_postal) ? $proveedor_domicilio_legal->codigo_postal : '' }}" maxlength="4"><br>

@if ( $mode != "show")

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_email_legal" title="Agregue un nuevo correo"><input type="button" @if ( $mode == "show") readonly @endif value="Agregar Correo" class="btn btn-success"></a>
                </div>
                <br>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_legal" title="Agregue un nuevo teléfono"><input type="button" @if ( $mode == "show") readonly @endif value="Agregar Teléfono" class="btn btn-success"></a>
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
        var addTelefono_legal = $('.add_telefono_legal');
        var wrapper_telefono_legal = $('.field_telefono_legal');


        //Nuevo campo html (agregar un nuevo teléfono)
        var fieldHTML_telefono_legal = '<div>'+
                                 '<br>'+
                                    '<label for="telefono_legal">Teléfono:</label><br>'+
                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_legal" name="telefono_legal[]" maxlength="14">'+
                                    '<a href="javascript:void(0);" class="remove_telefono_legal" title="Elimine el teléfono"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                 '<br>'+
                                '</div>';


        var x = 1; //Contador inicial, comienza en 1

        $(addTelefono_legal).click(function() {
            if (x < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                x++; //Incrementa el contador en 1
                $(wrapper_telefono_legal).append(fieldHTML_telefono_legal); // Agrega un nuevo campo html (telefono)
            }
        });
        $(wrapper_telefono_legal).on('click', '.remove_telefono_legal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (telefono)
            x--; //Decrementa el contador en 1
        });



        var addEmail_legal = $('.add_email_legal');
        var wrapper_email_legal = $('.field_email_legal');

        //Nuevo campo html (agregar un nuevo correo)
        var fieldHTML_email_legal = '<div>'+
                                    '<label for="email_legal">Correo electrónico:</label><br>'+
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_legal" name="email_legal[]" maxlength="30">'+
                                    '<a href="javascript:void(0);" class="remove_email_legal" title="Elimine el correo"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                    '<br>'+
                                    '<br>'+
                                '</div>';


        var i = 1; //Contador inicial, comienza en 1

        $(addEmail_legal).click(function() {
            if (i < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                i++; //Incrementa el contador en 1
                $(wrapper_email_legal).append(fieldHTML_email_legal); // Agrega un nuevo campo html (correo)
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
            url:"{{url('localidades')}}/"+$('#provincia_legal').val(),
			success:function(r){
				$('#localidad_legal').html(r);
			}
		});
	}


    function recargarListaLegal2(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/')}}/{{isset($proveedor_domicilio_legal->id_localidad) ? $proveedor_domicilio_legal->id_localidad : ''}}",
            success:function(r){
                $('#localidad_legal').html(r);
            }
        });
    }
</script>
@endpush

</fieldset>
