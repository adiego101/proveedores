@extends('layouts')

@section('content2')
@if ( $mode != "show")

@if ($mode != "edit")

<form action="{{ route('seguros.crear', ['id' => $id]) }}"  method="POST">

@else

<form action="{{ route('seguros.guardar', ['id' => $seguro->id_proveedor_seguro]) }}"  method="POST">

@endif

    @csrf
    @endif

<fieldset>

        <h1>Seguro</h1>

<br/>

<br>

    <div class="row">
        <div class="col-sm">
            <label for="poliza">Poliza:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($seguro->poliza) ? $seguro->poliza : '' }}" class="form-control" placeholder="Ingrese la poliza" aria-describedby="basic-addon1" id="poliza" name="poliza" maxlength="20" required/><br />

            <label for="asegurado">Asegurado:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($seguro->asegurado) ? $seguro->asegurado : '' }}" class="form-control" placeholder="Ingrese el asegurado" aria-describedby="basic-addon1" id="asegurado" name="asegurado" maxlength="40" required/><br />
        </div>

        <div class="col-sm">
            <label for="agencia">Agencia:</label><br />
            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($seguro->agencia) ? $seguro->agencia : '' }}" class="form-control" placeholder="Ingrese la agencia" aria-describedby="basic-addon1" id="agencia" name="agencia" maxlength="40" required/><br />

            <label for="vigencia_hasta">Vigencia hasta:</label><br />
            <input @if ( $mode == "show") readonly @endif type="date" value="{{ isset($seguro->vigencia_hasta) ? date('Y-m-d',strtotime($seguro->vigencia_hasta)) : '' }}" class="form-control" placeholder="Ingrese la fecha de vigencia" aria-describedby="basic-addon1" id="vigencia_hasta" name="vigencia_hasta" required/><br />


        </div>
    </div>
</fieldset>


@if ( $mode != "show")

@if ($mode != "edit")

<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $id, 'tab' => "patente"]) }}">atras</a>

@else
<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $seguro->id_proveedor, 'tab' => "patente"]) }}">atras</a>

@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        @if ($mode != "edit")

        <button type="submit" name="crearSeguro" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>

        @else

        <button type="submit" name="guardarSeguro" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>

        @endif
    </div>
</div>

</form>

@else

<a class="btn btn-secondary" style="float: left" href="{{ route('verRegistro', ['id' => $seguro->id_proveedor, 'tab' => "patente"]) }}">atras</a>

@endif

@endsection
