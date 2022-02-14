@extends('layouts')

@section('content2')
@if ( $mode != "show")

@if ($mode != "edit")

<form action="{{ route('patentes.crear', ['id' => $id]) }}"  method="POST">

@else

<form action="{{ route('patentes.guardar', ['id' => $patente->id_proveedor_patente]) }}"  method="POST">

@endif

    @csrf
    @endif

<fieldset>

<h1>Vehículo</h1>

<br/>

    <div class="row">
        <div class="col-sm">
            <label for="marca">Marca:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->marca) ? $patente->marca : '' }}" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="marca" name="marca" maxlength="40"/><br />

            <label for="dominio">Dominio:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->dominio) ? $patente->dominio : '' }}" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="dominio" name="dominio" maxlength="7"/><br />
        </div>

        <div class="col-sm">
            <label for="modelo">Modelo:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->modelo) ? $patente->modelo : '' }}" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modelo" name="modelo" maxlength="40"/><br />

            <label for="inscripto_en">Inscripto en:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->inscripto_en) ? $patente->inscripto_en : '' }}" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="inscripto_en" name="inscripto_en" maxlength="20"/><br />

        </div>
    </div>

</fieldset>


@if ( $mode != "show")

@if ($mode != "edit")

<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $id, 'tab' => "patente"]) }}">atras</a>

@else
<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $patente->id_proveedor, 'tab' => "patente"]) }}">atras</a>

@endif

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
