<fieldset>
    <div class="row">
        <div class="col-sm">
            <label for="producto_elaborado">Producto elaborado:</label><br>
            <input list="productos" name="producto_elaborado" id="producto_elaborado"  class="form-control" placeholder="Ingrese o seleccione el producto que produce">
            <datalist id="productos">
                @forelse($productos as $producto)
                    <option value="{{$producto->producto_elaborado}}">
                @empty
                    <option value=" ">
                @endforelse
            </datalist>
            <br>

            <label for="rnpa">RNPA:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="rnpa"
            name="rnpa" placeholder="Ingrese el RNPA"><br>
        </div>

        <div class="col-sm">
            <label for="unidad_producida">Unidad producida:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="unidad_producida"
            name="unidad_producida" placeholder="Ingrese la cantidad de unidades producidas"><br>

            <label for="produccion_total">Capacidad de producción total:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="produccion_total" name="produccion_total" placeholder="Ingrese la producción total"><br>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_producto" class="btn btn-success">Agregar Producto</a>
            </div>
        </div>
    </div>
    <br>
</fieldset>
