@extends('layouts')

@section('content2')
<form action="{{ route('productos.guardar', ['id' => $producto->id_producto]) }}"  method="POST">
    @csrf
<fieldset>
    <div class="row">
        <div class="col-sm">
            <label for="producto_elaborado">Producto elaborado:</label><br>
            <input list="productos" name="producto_elaborado" id="producto_elaborado" value="{{ isset($producto->producto_elaborado) ? $producto->producto_elaborado : '' }}"  class="form-control" placeholder="Ingrese o seleccione el producto que produce">
            <datalist id="productos">
                @forelse($productos as $producto2)

                    <option value="{{$producto2->producto_elaborado}}">

                @empty
                    <option value=" ">
                @endforelse
            </datalist>
            <br>

            <label for="rnpa">RNPA:</label><br>
            <input type="text" class="form-control" value="{{ isset($producto->rnpa) ? $producto->rnpa : '' }}" aria-describedby="basic-addon1" id="rnpa"
            name="rnpa" placeholder="Ingrese el RNPA"><br>
        </div>

        <div class="col-sm">
            <label for="Producida_unidad">Unidad producida:</label><br>
            <input type="number" value="{{ isset($producto->Producida_unidad) ? $producto->Producida_unidad : '' }}" class="form-control" aria-describedby="basic-addon1" id="Producida_unidad"
            name="Producida_unidad" placeholder="Ingrese la cantidad de unidades producidas"><br>

            <label for="capacidad_produccion_total">Capacidad de producción total:</label><br>
            <input type="number" value="{{ isset($producto->capacidad_produccion_total) ? $producto->capacidad_produccion_total : '' }}" class="form-control" aria-describedby="basic-addon1" id="capacidad_produccion_total" name="capacidad_produccion_total" placeholder="Ingrese la producción total"><br>
        </div>
    </div>
    <br>
</fieldset>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        <button type="submit" name="guardarproducto" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>
    </div>
</div>
</form>

@endsection
