<fieldset>

    <h1>Datos del domicilio real</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_real">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_real" name="calle_real" value="{{ isset($proveedor_domicilio_real->calle) ? $proveedor_domicilio_real->calle : '' }}"><br>

                <label for="dpto_real">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_real" name="dpto_real" value="{{ isset($proveedor_domicilio_real->dpto) ? $proveedor_domicilio_real->dpto : '' }}"><br>

                <label for="lote_real">Lote:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_real" name="lote_real" value="{{ isset($proveedor_domicilio_real->lote) ? $proveedor_domicilio_real->lote : '' }}"><br>

                <label for="entreCalles_real">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_real" name="entreCalles_real" value="{{ isset($proveedor_domicilio_real->entre_calles) ? $proveedor_domicilio_real->entre_calles : '' }}"><br>

                <label for="monoblock_real">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_real" name="monoblock_real" value="{{ isset($proveedor_domicilio_real->monoblock) ? $proveedor_domicilio_real->monoblock : '' }}"><br>

                <!--En este caso, se deben recuperar los paises de la BD -->
                <label for="pais_real">Pais:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="pais_real" name="pais_real">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <!--En este caso, se deben recuperar las localidades de la BD -->
                <label for="localidad_real">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_real" name="localidad_real">
                <option value="{{isset($proveedor_localidades_real->nombre_localidad) ? $proveedor_localidades_real->nombre_localidad : '' }}">{{isset($proveedor_localidades_real->nombre_localidad) ? $proveedor_localidades_real->nombre_localidad : 'Seleccione una localidad' }}</option>
                </select>
                <br>

                <label for="pagina_web">Página web:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la página web"
                    aria-describedby="basic-addon1" id="pagina_web" name="pagina_web" value="{{ isset($proveedor->pagina_web) ? $proveedor->pagina_web : '' }}"><br>

                {{--<label for="email_real">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_real" name="email_real[]" ><br>--}}
                <div class="field_email_real">

                    @forelse($proveedor_email_real as $email_real)

                        <label for="email_real">Correo electrónico:</label><br>
                        <input type="email"  onkeypress="return valideKey(event);" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_real" name="email_real[]" value="{{$email_real->email}}"> <br>
                    @empty

                    @endforelse

                </div>

                {{--<label for="telefono_real">Teléfono:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" ><br>
                --}}
                <div class="field_telefono_real">

                    @forelse($proveedor_telefono_real as $telefono_real)

                        <label for="telefono_real">Teléfono:</label><br>
                        <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" value="{{$telefono_real->nro_tel}}"> <br>
                    @empty

                    @endforelse

                </div>
            </div>
            <div class="col-sm">

                <label for="numero_real">Número:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_real" name="numero_real" value="{{ isset($proveedor_domicilio_real->numero) ? $proveedor_domicilio_real->numero : '' }}"><br>

                <label for="puerta_real">Puerta:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_real" name="puerta_real" value="{{ isset($proveedor_domicilio_real->puerta) ? $proveedor_domicilio_real->puerta : '' }}"><br>

                <label for="manzana_real">Manzana:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_real" name="manzana_real" value="{{ isset($proveedor_domicilio_real->manzana) ? $proveedor_domicilio_real->manzana : '' }}"><br>

                <label for="oficina_real">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_real" name="oficina_real" value="{{ isset($proveedor_domicilio_real->oficina) ? $proveedor_domicilio_real->oficina : '' }}"><br>

                <label for="barrio_real">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_real" name="barrio_real" value="{{ isset($proveedor_domicilio_real->barrio) ? $proveedor_domicilio_real->barrio : '' }}"><br>

                <!--En este caso, se deben recuperar las provincias de la BD -->
                <label for="provincia_real">Provincia:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="provincia_real" name="provincia_real">
                <option value="{{isset($proveedor_provincias_real->nombre_provincia) ? $proveedor_provincias_real->nombre_provincia : '' }}">{{isset($proveedor_provincias_real->nombre_provincia) ? $proveedor_provincias_real->nombre_provincia : 'Seleccione una provincia' }}</option>
                    @forelse($provincias as $provincia)
                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="cp_real">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp_real" name="cp_real" placeholder="Ingrese el código postal" value="{{ isset($proveedor_domicilio_real->codigo_postal) ? $proveedor_domicilio_real->codigo_postal : '' }}"><br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_email_real" title="Agregue un nuevo correo"><input type="button" value="Agregar Correo" class="btn btn-success"></a>
                </div>
                <br>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_real" title="Agregue un nuevo teléfono"><input type="button" value="Agregar Teléfono" class="btn btn-success"></a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row navbuttons pt-5">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-primary btnPrevious">Anterior</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono_real = $('.add_telefono_real');
        var wrapper_telefono_real = $('.field_telefono_real');


        //Nuevo campo html (agregar un nuevo teléfono)
        var fieldHTML_telefono_real = '<div>'+
                                 '<br>'+
                                    '<label for="telefono_real">Teléfono:</label><br>'+
                                    '<input type="number" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" >'+
                                    '<a href="javascript:void(0);" class="remove_telefono_real" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
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
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_real" name="email_real[]" >'+
                                    '<a href="javascript:void(0);" class="remove_email_real" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
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

</fieldset>
