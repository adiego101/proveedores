@extends('layouts')

@section('content2')
@if ( $mode != "show")
@if ($mode != "edit")

<form action="{{ route('sucursales.crear', ['id' => $id]) }}"  method="POST">

@else

<form action="{{ route('sucursales.guardar', ['id' => $sucursal->id_sucursal]) }}"  method="POST">

@endif
@csrf
@endif

    <fieldset>
    <div class="row">
        <h1>Sucursales</h1>
    </div>

    <br />

    <label for="nombre_sucursal">Nombre Sucursal:</label><br />
     <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->nombre_sucursal) ? $sucursal->nombre_sucursal : '' }}" placeholder="Ingrese el nombre de la sucursal" aria-describedby="basic-addon1" id="nombre_sucursal" name="nombre_sucursal" maxlength="50" required/><br />

    <div class="row">
        <div class="col-sm">
            <label for="calle">Calle:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->calle) ? $sucursal->calle : '' }}" placeholder="Ingrese la calle de la sucursal" aria-describedby="basic-addon1" id="calle" name="calle" maxlength="50"/><br />

            <label for="dpto">Departamento:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->dpto) ? $sucursal->dpto : '' }}" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto" name="dpto" maxlength="10"/><br />

            <label for="lote">Lote:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->lote) ? $sucursal->lote : '' }}" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote" name="lote" maxlength="4"/><br />

            <label for="entre_calles">Entre Calles:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->entre_calles) ? $sucursal->entre_calles : '' }}" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entre_calles" name="entre_calles" maxlength="70"/><br />

            <label for="monoblock">Monoblock:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->monoblock) ? $sucursal->monoblock : '' }}" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock" name="monoblock" maxlength="10"/><br />

            <label for="pais">Pais:</label><br>
                <select  @if ( $mode == "show") disabled @endif   class="form-control" aria-describedby="basic-addon1" id="pais" name="pais" required>
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="id_localidad">Localidad:</label><br>
                <select  @if ( $mode == "show") disabled @endif  class="form-control"  aria-describedby="basic-addon1" id="id_localidad" name="id_localidad" required>
                    <option value="">Seleccione una localidad</option>
                </select>
                <br>

                <label for="email">Correo electrónico:</label><br>
                 <input @if ( $mode == "show") readonly @endif  id="email" value="{{ isset($sucursal_email->email) ? $sucursal_email->email : '' }}" type="email" class="form-control email" placeholder="ejemplo@dominio.com"
                   name="email" aria-describedby="basic-addon1" maxlength="50"><br>
                <div class="field_email">

                </div>

        </div>

        <div class="col-sm">
            <label for="numero">Número:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->numero) ? $sucursal->numero : '' }}" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero" name="numero" maxlength="5"/><br />

            <label for="puerta">Puerta:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->puerta) ? $sucursal->puerta : '' }}" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta" name="puerta" maxlength="4"/><br />

            <label for="manzana">Manzana:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->manzana) ? $sucursal->manzana : '' }}" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana" name="manzana" maxlength="5"/><br />

            <label for="oficina">Oficina:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->oficina) ? $sucursal->oficina : '' }}" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina" name="oficina" maxlength="4"/><br />

            <label for="barrio">Barrio:</label><br />
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->barrio) ? $sucursal->barrio : '' }}" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio" name="barrio" maxlength="50"/><br />

            <label for="provincia">Provincia:</label><br>
            <select  @if ( $mode == "show") disabled @endif  class="form-control" value="{{ isset($sucursal->poliza) ? $sucursal->poliza : '' }}" aria-describedby="basic-addon1" id="provincia" name="provincia" required>
            <option value="">Seleccione una provincia</option>
                @if ($mode == "create")
                    @forelse($provincias as $provincia)
                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                @else
                    @forelse($provincias as $provincia)

                    @if ($provincia->id_provincia == $provinciaid)
                        <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @else
                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                @endif

                @empty
                <option value=" "></option>
                @endforelse
                @endif

            </select>
            <br>

            <label for="codigo_postal">Código Postal:</label><br>
             <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->codigo_postal) ? $sucursal->codigo_postal : '' }}" aria-describedby="basic-addon1" id="codigo_postal" name="codigo_postal" placeholder="Ingrese el código postal" maxlength="8"><br>

            <label for="nro_tel">Teléfono:</label><br>
            <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" name="nro_tel" value="{{ isset($sucursal_telefono->nro_tel) ? $sucursal_telefono->nro_tel : '' }}" id="nro_tel" class="form-control telefono" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" maxlength="14">
            <!--    <div class="field_telefono d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono" title="Agregue un nuevo teléfono"> <input @if ( $mode == "show") readonly @endif  type="button" value="Agregar Teléfono" class="btn btn-success"></a>
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

        {{isset($sucursal->id_localidad) ? 'recargarListaSucursal2();' : ''}}

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
            url:"{{url('localidadSelect/')}}/{{isset($sucursal->id_localidad) ? $sucursal->id_localidad : ''}}",
            success:function(r){
                $('#id_localidad').html(r);
            }
        });
    }
</script>
@endpush
@if ( $mode != "show")

@if ($mode != "edit")

<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $id, 'tab' => "sucursal"]) }}">atras</a>

@else
<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $sucursal->id_proveedor, 'tab' => "sucursal"]) }}">atras</a>

@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        <button type="submit" name="guardarSucursal" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>
    </div>
</div>

</form>

@else

<a class="btn btn-secondary" style="float: left" href="{{ route('verRegistro', ['id' => $sucursal->id_proveedor, 'tab' => "sucursal"]) }}">atras</a>

@endif

@endsection
@push('js')
    <script type="text/javascript">
    function valideKey(evt){

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) { // espacio.
          return true;
        } else if(code>=48 && code<=57) { // es un numero.
          return true;
        } else{ // otras teclas
        console.log("no es un numero");
          return false;
        }
    }
    </script>
@endpush
