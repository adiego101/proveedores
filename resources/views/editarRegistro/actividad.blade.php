<fieldset>
    <h1>Actividad</h1>
    <br>
    <label for="facturacion_anual_alcanzada">Facturacion anual alcanzada:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="facturacion_anual_alcanzada"
        name="facturacion_anual_alcanzada"
        value="{{ isset($proveedor->facturacion_anual_alcanzada) ? $proveedor->facturacion_anual_alcanzada : '' }}"><br>

    <label for="rne">Registro Nacional de Establecimientos (RNE) N°:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="rne" name="rne"
        value="{{ isset($proveedor->rne) ? $proveedor->rne : '' }}"><br>

    <label for="codigo_de_actividades">Codigo de actividades</label><br>
    <input type="text" class=" text-danger form-control" aria-describedby="basic-addon1" id="codigo_de_actividades"
        name="codigo_de_actividades" value="{{ isset($proveedor->codigo_de_actividades) ? $proveedor->codigo_de_actividades : 'no se encuentra cargado el campo' }}"><br>

    <label for="nomina_productos">Nomina de Principales Productos Elaborados:</label><br>
    <input type="text" class="text-danger form-control" aria-describedby="basic-addon1" id="nomina_productos"
        name="nomina_productos" value="{{ isset($proveedor->nomina_productos) ? $proveedor->nomina_productos : 'no se encuentra cargado el campo' }}"><br>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />

    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>
