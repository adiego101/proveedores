<fieldset>
    <div class="row">
        <h1>Sucursales</h1>
    </div>

    <br />

<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <label for="nombre_sucursal">Nombre Sucursal:</label><br />
    <input type="text" class="form-control" placeholder="Ingrese el nombre de la sucursal" aria-describedby="basic-addon1" id="nombre_sucursal" /><br />

    <div class="row">
        <div class="col-sm">
            <label for="calle_sucursal">Calle:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la calle de la sucursal" aria-describedby="basic-addon1" id="calle_sucursal" /><br />

            <label for="dpto_sucursal">Departamento:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_sucursal" /><br />

            <label for="lote_sucursal">Lote:</label><br />
            <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_sucursal" name="lotes[]" /><br />

            <label for="entre_calles_sucursal">Entre Calles:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entre_calles_sucursal" /><br />

            <label for="monoblock_sucursal">Monoblock:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_sucursal" name="monoblocks[]" /><br />

            <!--En este caso, se deben recuperar los paises de la BD -->
            <label for="pais_sucursal">Pais:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="pais_sucursal" name="pais_sucursal">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

            <!--En este caso, se deben recuperar las localidades de la BD -->
            <label for="localidad_sucursal">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_sucursal" name="localidad_sucursal">
                <option value=" ">Seleccione una localidad</option>
                </select>
                <br>

                <label for="email_sucursal">Correo electrónico:</label><br>
                <input id="email_sucursal" type="email" class="form-control email_sucursal" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1"><br>
                <div class="field_email_sucursal">

                </div>

        </div>

        <div class="col-sm">
            <label for="numero_sucursal">Número:</label><br />
            <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_sucursal" /><br />

            <label for="puerta_sucursal">Puerta:</label><br />
            <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_sucursal" name="puertas[]" /><br />

            <label for="manzana_sucursal">Manzana:</label><br />
            <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_sucursal" name="manzanas[]" /><br />

            <label for="oficina_sucursal">Oficina:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_sucursal" name="oficinas[]" /><br />

            <label for="barrio_sucursal">Barrio:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_sucursal" /><br />

            <!--En este caso, se deben recuperar las provincias de la BD -->
            <label for="provincia_sucursal">Provincia:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="provincia_sucursal" name="provincia_sucursal">
            <option value=" ">Seleccione una provincia</option>
                @forelse($provincias as $provincia)
                    <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                @empty
                    <option value=" "></option>
                @endforelse
            </select>
            <br>

            <label for="codigo_postal_sucursal">Código Postal:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="codigo_postal_sucursal" name="codigo_postal" placeholder="Ingrese el código postal"><br>

            <label for="telefono_sucursal">Teléfono:</label><br>
                <input type="number" id="telefono_sucursal" onkeypress="return valideKey(event);" class="form-control telefono_sucursal" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" >
            <!--    <div class="field_telefono_sucursal d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_sucursal" title="Agregue un nuevo teléfono"><input type="button" value="Agregar Teléfono" class="btn btn-success"></a>
                </div> -->
            <br>

</fieldset>
@push('js')
<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia_sucursal').change(function(){
			recargarListaSucursal();
		});
	})
</script>

<script type="text/javascript">
	function recargarListaSucursal(){
		$.ajax({
			type:"GET",
			url:"localidades/"+$('#provincia_sucursal').val(),
			success:function(r){
				$('#localidad_sucursal').html(r);
			}
		});
	}
</script>
@endpush
