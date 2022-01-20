@extends('layouts')

@section('content2')
@if ( $mode != "show")

<form action="{{ route('patentes.guardar', ['id' => $patente->id_proveedor_patente]) }}"  method="POST">
    @csrf
    @endif

<fieldset>

<h1>Patente</h1>


<br/>

<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <div class="row">
        <div class="col-sm">
            <label for="marca">Marca:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->marca) ? $patente->marca : '' }}" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="marca" name="marca" /><br />

            <label for="dominio">Dominio:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->dominio) ? $patente->dominio : '' }}" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="dominio" name="dominio" /><br />
        </div>

        <div class="col-sm">
            <label for="modelo">Modelo:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->modelo) ? $patente->modelo : '' }}" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modelo" name="modelo" /><br />

            <label for="inscripto_en">Inscripto en:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->inscripto_en) ? $patente->inscripto_en : '' }}" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="inscripto_en" name="inscripto_en" /><br />

        </div>
    </div>

</fieldset>


@if ( $mode != "show")
<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $patente->id_proveedor, 'tab' => "patente"]) }}">atras</a>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        <button type="submit" name="guardarPatente" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>
    </div>
</div>
</form>
@else
<a class="btn btn-secondary" style="float: left" href="{{ route('verRegistro', ['id' => $patente->id_proveedor, 'tab' => "patente"]) }}">atras</a>

@endif


@endsection
