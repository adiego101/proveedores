<fieldset>

    <h1>Datos del Domicilio legal</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_legal">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_legal" name="calle_legal" value="{{ isset($proveedor_domicilio_legal->calle) ? $proveedor_domicilio_legal->calle : '' }}"><br>

                <label for="dpto_legal">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_legal" name="dpto_legal" value="{{ isset($proveedor_domicilio_legal->dpto) ? $proveedor_domicilio_legal->dpto : '' }}"><br>

                <label for="lote_legal">Lote:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_legal" name="lote_legal" value="{{ isset($proveedor_domicilio_legal->lote) ? $proveedor_domicilio_legal->lote : '' }}"><br>

                <label for="entreCalles_legal">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_legal" name="entreCalles_legal" value="{{ isset($proveedor_domicilio_legal->entre_calles) ? $proveedor_domicilio_legal->entre_calles : '' }}"><br>

                <label for="monoblock_legal">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_legal" name="monoblock_legal" value="{{ isset($proveedor_domicilio_legal->monoblock) ? $proveedor_domicilio_legal->monoblock : '' }}"><br>

                <!--En este caso, se deben recuperar los paises de la BD -->
                <label for="pais_legal">Pais:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="pais_legal" name="pais_legal">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <!--En este caso, se deben recuperar las localidades de la BD -->
                <label for="localidad_legal">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_legal" name="localidad_legal">
                <option value=" ">Seleccione una localidad</option>
                </select>
                <br>

                <!--FALTA VALIDAR -->
                <label for="representante_legal">Representante:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el nombre del representante legal" aria-describedby="basic-addon1" id="representante_legal" name="representante_legal" ><br>

                <label for="email_legal">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_legal" name="email_legal[]" ><br>
                <div class="field_email_legal">

                </div>
                <label for="telefono_legal">Teléfono:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono"
                    aria-describedby="basic-addon1" id="telefono_legal" name="telefono_legal[]" >
                <div class="field_telefono_legal">

                </div>
            </div>
            <div class="col-sm">

                <label for="numero_legal">Número:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_legal" name="numero_legal"  value="{{ isset($proveedor_domicilio_legal->numero) ? $proveedor_domicilio_legal->numero : '' }}"><br>

                <label for="puerta_legal">Puerta:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_legal" name="puerta_legal" value="{{ isset($proveedor_domicilio_legal->puerta) ? $proveedor_domicilio_legal->puerta : '' }}"><br>

                <label for="manzana_legal">Manzana:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_legal" name="manzana_legal" value="{{ isset($proveedor_domicilio_legal->manzana) ? $proveedor_domicilio_legal->manzana : '' }}"><br>

                <label for="oficina_legal">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_legal" name="oficina_legal" value="{{ isset($proveedor_domicilio_legal->oficina) ? $proveedor_domicilio_legal->oficina : '' }}"><br>

                <label for="barrio_legal">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_legal" name="barrio_legal" value="{{ isset($proveedor_domicilio_legal->barrio) ? $proveedor_domicilio_legal->barrio : '' }}"><br>

                <!--En este caso, se deben recuperar las provincias de la BD -->
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
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp_legal" name="cp_legal" placeholder="Ingrese el código postal" value="{{ isset($proveedor_domicilio_legal->codigo_postal) ? $proveedor_domicilio_legal->codigo_postal : '' }}"><br>

                <!--FALTA VALIDAR -->
                <label for="dni_legal">Dni:</label><br>
                <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el dni del representante legal" aria-describedby="basic-addon1" id="dni_legal" name="dni_legal" >
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_email_legal" title="Agregue un nuevo correo"><input type="button" value="Agregar Correo" class="btn btn-success"></a>
                </div>
                <br>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_legal" title="Agregue un nuevo teléfono"><input type="button" value="Agregar Teléfono" class="btn btn-success"></a>
                </div>

            </div>
        </div>

    </div>
    <br>
    <div class="row navbuttons pt-5">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-primary btnPrevious">Previous</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Next</a>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono_legal = $('.add_telefono_legal');
        var wrapper_telefono_legal = $('.field_telefono_legal');


        //Nuevo campo html (agregar un nuevo teléfono)
        var fieldHTML_telefono_legal = '<div>'+
                                 '<br>'+
                                    '<label for="telefono_legal">Teléfono:</label><br>'+
                                    '<input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_legal" name="telefono_legal[]" >'+
                                    '<a href="javascript:void(0);" class="remove_telefono_legal" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
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
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_legal" name="email_legal[]" >'+
                                    '<a href="javascript:void(0);" class="remove_email_legal" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
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
			url:"localidades/"+$('#provincia_legal').val(),
			success:function(r){
				$('#localidad_legal').html(r);
			}
		});
	}
</script>

</fieldset>
