@extends('layouts')

@section('content2')
<form action="{{ route('sucursales.guardar', ['id' => $sucursal->id_sucursal]) }}"  method="POST">
    @csrf
    <fieldset>
    <div class="row">
        <h1>Sucursales</h1>
    </div>

    <br />

<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <label for="nombre_sucursal">Nombre Sucursal:</label><br />
    <input type="text" class="form-control" value="{{ isset($sucursal->nombre_sucursal) ? $sucursal->nombre_sucursal : '' }}" placeholder="Ingrese el nombre de la sucursal" aria-describedby="basic-addon1" id="nombre_sucursal" name="nombre_sucursal" /><br />

    <div class="row">
        <div class="col-sm">
            <label for="calle">Calle:</label><br />
            <input type="text" class="form-control" value="{{ isset($sucursal->calle) ? $sucursal->calle : '' }}" placeholder="Ingrese la calle de la sucursal" aria-describedby="basic-addon1" id="calle" name="calle"  /><br />

            <label for="dpto">Departamento:</label><br />
            <input type="text" class="form-control" value="{{ isset($sucursal->dpto) ? $sucursal->dpto : '' }}" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto" name="dpto" /><br />

            <label for="lote">Lote:</label><br />
            <input type="number"  onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->lote) ? $sucursal->lote : '' }}" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote" name="lote" /><br />

            <label for="entre_calles">Entre Calles:</label><br />
            <input type="text" class="form-control" value="{{ isset($sucursal->entre_calles) ? $sucursal->entre_calles : '' }}" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entre_calles" name="entre_calles"/><br />

            <label for="monoblock">Monoblock:</label><br />
            <input type="text" class="form-control" value="{{ isset($sucursal->monoblock) ? $sucursal->monoblock : '' }}" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock" name="monoblock" /><br />

            <!--En este caso, se deben recuperar los paises de la BD -->
            <label for="pais">Pais:</label><br>
                <select  class="form-control" aria-describedby="basic-addon1" id="pais" name="pais">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

            <!--En este caso, se deben recuperar las localidades de la BD -->
            <label for="id_localidad">Localidad:</label><br>
                <select class="form-control"  aria-describedby="basic-addon1" id="id_localidad" name="id_localidad">
                </select>
                <br>

                <label for="email">Correo electrónico:</label><br>
                <input id="email" value="{{ isset($sucursal_email->email) ? $sucursal_email->email : '' }}" type="email" class="form-control email" placeholder="ejemplo@dominio.com"
                   name="email" aria-describedby="basic-addon1"><br>
                <div class="field_email">

                </div>

        </div>

        <div class="col-sm">
            <label for="numero">Número:</label><br />
            <input type="number"  onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->numero) ? $sucursal->numero : '' }}" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero" name="numero"/><br />

            <label for="puerta">Puerta:</label><br />
            <input type="number"  onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->puerta) ? $sucursal->puerta : '' }}" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta" name="puerta" /><br />

            <label for="manzana">Manzana:</label><br />
            <input type="number"  onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->manzana) ? $sucursal->manzana : '' }}" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana" name="manzana" /><br />

            <label for="oficina">Oficina:</label><br />
            <input type="text" class="form-control" value="{{ isset($sucursal->oficina) ? $sucursal->oficina : '' }}" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina" name="oficina" /><br />

            <label for="barrio">Barrio:</label><br />
            <input type="text" class="form-control" value="{{ isset($sucursal->barrio) ? $sucursal->barrio : '' }}" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio"  name="barrio"/><br />

            <!--En este caso, se deben recuperar las provincias de la BD -->
            <label for="provincia">Provincia:</label><br>
            <select class="form-control" value="{{ isset($sucursal->poliza) ? $sucursal->poliza : '' }}" aria-describedby="basic-addon1" id="provincia" name="provincia">
            <option value=" ">Seleccione una provincia</option>
            @forelse($provincias as $provincia)

                @if ($provincia->id_provincia == $provinciaid)

                    <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>

                @else

                    <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>


                @endif

            @empty
            <option value=" "></option>
            @endforelse
            </select>
            <br>

            <label for="codigo_postal">Código Postal:</label><br>
            <input type="text" class="form-control" value="{{ isset($sucursal->codigo_postal) ? $sucursal->codigo_postal : '' }}" aria-describedby="basic-addon1" id="codigo_postal" name="codigo_postal" placeholder="Ingrese el código postal"><br>

            <label for="nro_tel">Teléfono:</label><br>
                <input type="number" name="nro_tel" value="{{ isset($sucursal_telefono->nro_tel) ? $sucursal_telefono->nro_tel : '' }}" id="nro_tel" onkeypress="return valideKey(event);" class="form-control telefono" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" >
            <!--    <div class="field_telefono d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono" title="Agregue un nuevo teléfono"><input type="button" value="Agregar Teléfono" class="btn btn-success"></a>
                </div> -->
            <br>

</fieldset>
@push('js')
<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia').change(function(){
			recargarListaSucursal();
		});
	})
    window.onload = function(){
    recargarListaSucursal2();
        };
</script>


<script type="text/javascript">
	function recargarListaSucursal(){
		$.ajax({
			type:"GET",
			url:"{{url('localidades/')}}/"+$('#provincia').val(),
			success:function(r){
				$('#id_localidad').html(r);
			}
		});
	}
    function recargarListaSucursal2(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/'.$sucursal->id_localidad)}}",
            success:function(r){
                $('#id_localidad').html(r);
            }
        });
    }
</script>
@endpush
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        <button type="submit" name="guardarPago" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>
    </div>
</div>
</form>

@endsection
