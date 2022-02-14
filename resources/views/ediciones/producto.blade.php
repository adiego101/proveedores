@extends('layouts')

@section('content2')
@if ( $mode != "show")
@if ($mode != "edit")

<form action="{{ route('productos.crear', ['id' => $id]) }}"  method="POST">

@else

<form action="{{ route('productos.guardar', ['id' => $producto->id_producto]) }}"  method="POST">

@endif

    @csrf
    @endif

<fieldset>
    <div class="row">
        <div class="col-sm">
            <label for="producto_elaborado">Producto elaborado:</label><br>
            <input @if ( $mode == "show") readonly @endif list="productos" name="producto_elaborado" id="producto_elaborado" value="{{ isset($producto->producto_elaborado) ? $producto->producto_elaborado : '' }}"  class="form-control" placeholder="Ingrese o seleccione el producto que produce">
            <datalist id="productos">
                @forelse($productos as $producto2)

                    <option value="{{$producto2->producto_elaborado}}">

                @empty
                    <option value=" ">
                @endforelse
            </datalist>
            <br>

            <label for="rnpa">RNPA:</label><br>
            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" value="{{ isset($producto->rnpa) ? $producto->rnpa : '' }}" aria-describedby="basic-addon1" id="rnpa" name="rnpa" placeholder="Ingrese el RNPA" maxlength="20"><br>
        </div>

        <div class="col-sm">
            <label for="Producida_unidad">Unidad producida:</label><br>
            <input @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" value="{{ isset($producto->Producida_unidad) ? $producto->Producida_unidad : '' }}" class="form-control" aria-describedby="basic-addon1" id="Producida_unidad"
            name="Producida_unidad" placeholder="Ingrese la cantidad de unidades producidas" maxlength="9"><br>

            <label for="capacidad_produccion_total">Capacidad de producción total:</label><br>
            <input @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" value="{{ isset($producto->capacidad_produccion_total) ? $producto->capacidad_produccion_total : '' }}" class="form-control" aria-describedby="basic-addon1" id="capacidad_produccion_total" name="capacidad_produccion_total" placeholder="Ingrese la producción total" maxlength="9"><br>
        </div>
    </div>
    <br>
</fieldset>


@if ( $mode != "show")

@if ($mode != "edit")

<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $id, 'tab' => "actividad"]) }}">atras</a>

@else
<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $producto->id_proveedor, 'tab' => "actividad"]) }}">atras</a>

@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">

        <button type="submit" name="guardarproducto" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>

    </div>
</div>
</form>
@else
<a class="btn btn-secondary" style="float: left" href="{{ route('verRegistro', ['id' => $producto->id_proveedor, 'tab' => "actividad"]) }}">atras</a>

@endif

@endsection
