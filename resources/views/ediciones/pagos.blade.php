@extends('layouts')

@section('content2')
@if ( $mode != "show")

<form action="{{ route('pagos.guardar', ['id' => $pago->id_pagos]) }}"  method="POST">
    @csrf
@endif
<fieldset>
    <h1>Pagos</h1>

    <label for="fecha">Fecha:</label><br>
    <input type="date" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago"
        aria-describedby="basic-addon1" id="fecha" value="{{ isset($pago->fecha) ? date('Y-m-d',strtotime($pago->fecha)) : '' }}" name="fecha"><br>

    <label for="importe">Importe:</label><br>
    <input type="number" class="form-control" {{--onkeypress="return valideKey(event);"--}}
        placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1" value="{{ isset($pago->importe) ? $pago->importe : '' }}" id="importe" name="importe"><br>

    <label for="observaciones">Observaciones:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese las observaciones del pago"
        aria-describedby="basic-addon1" id="observaciones" value="{{ isset($pago->observaciones) ? $pago->observaciones : '' }}" name="observaciones"><br>

</fieldset>
@if ( $mode != "show")

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        <button type="submit" name="guardarPago" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>
    </div>
</div>
</form>
@endif

@endsection
