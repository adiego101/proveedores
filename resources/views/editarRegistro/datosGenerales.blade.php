<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social:</label><br>
    <input type="text" class="form-control" placeholder="ingrese la razón social" aria-describedby="basic-addon1"
        id="razon_social" name="razon_social" value="<?php echo $proveedor->razon_social;?>"><br>

    <label for="nombre_fantasia">Nombre de fantasía:</label><br>
    <input type="text" class="form-control" placeholder="ingrese el nombre de fantasía" aria-describedby="basic-addon1"
        id="nombre_fantasia" name="nombre_fantasia" value="<?php echo $proveedor->nombre_fantasia;?>" ><br>

    <!-- El cuit se utiliza en esta primer etapa -->

    <label for="cuit">cuit:</label><br>
    <input type="number" class="form-control" placeholder="ingrese el cuit de la empresa" aria-describedby="basic-addon1"
        id="cuit" name="cuit" value="<?php echo $proveedor->cuit;?>" ><br>

    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>
