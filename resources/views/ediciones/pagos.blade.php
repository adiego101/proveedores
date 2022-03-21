@extends('layouts')

@section('content2')
@if ( $mode != "show")

@if ($mode != "edit")

<form action="{{ route('pagos.crear', ['id' => $id]) }}"  method="POST">

@else

<form action="{{ route('pagos.guardar', ['id' => $pago->id_pagos]) }}"  method="POST">

@endif

    @csrf
@endif
<fieldset>

    <h1>Pagos</h1>

    <label for="fecha">Fecha:</label><br>
    <input @if ( $mode == "show") readonly @endif type="date" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago"
        aria-describedby="basic-addon1" id="fecha" value="{{ isset($pago->fecha) ? date('Y-m-d',strtotime($pago->fecha)) : '' }}" name="fecha" required><br>

    <label for="importe">Importe:</label><br>
    <input @if ( $mode == "show") readonly @endif type="text" class="form-control" onkeypress="return valideKey(event);" placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1" value="{{ isset($pago->importe) ? $pago->importe : '' }}" id="importe" name="importe" maxlength="9" required><br>

    <label for="observaciones">Observaciones:</label><br>
    <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese las observaciones del pago" aria-describedby="basic-addon1" id="observaciones" value="{{ isset($pago->observaciones) ? $pago->observaciones : '' }}" name="observaciones" maxlength="50"><br>

</fieldset>


@if ( $mode != "show")

@if ($mode != "edit")

<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $id, 'tab' => "pago"]) }}">atras</a>

@else

<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $pago->id_proveedor, 'tab' => "pago"]) }}">atras</a>

@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        <button type="submit" name="guardarPago" class="btn btn-success"> {{ 'Guardar' }} </button>
    </div>
</div>

</form>

@else

<a class="btn btn-secondary" style="float: left" href="{{ route('verRegistro', ['id' => $pago->id_proveedor, 'tab' => "pago"]) }}">atras</a>

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
