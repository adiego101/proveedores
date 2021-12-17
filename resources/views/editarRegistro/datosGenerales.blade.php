<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social"
        value="{{ isset($proveedor->razon_social) ? $proveedor->razon_social : '' }}"  autofocus><br>

    <label for="nombre_fantasia">Nombre de fantasía:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia"  name="nombre_fantasia"
        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" ><br>

    <label for="cuit">Cuit:</label><br>
    <input type="number" class="form-control"  onkeypress="return valideKey(event);" placeholder="Ingrese el número de cuit de la empresa" aria-describedby="basic-addon1" id="cuit" name="cuit"
        value="{{ isset($proveedor->cuit) ? $proveedor->cuit : '' }}" ><br>

    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>
