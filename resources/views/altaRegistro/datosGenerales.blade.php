<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social"  autofocus><br>

    <label for="nombre_fantasia">Nombre de fantasía:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia" ><br>

    <!-- El cuit se utiliza en esta primer etapa -->

    <label for="cuit">Cuit:</label><br>
    <input type="number" class="form-control"  onkeypress="return valideKey(event);" placeholder="Ingrese el número de cuit de la empresa" aria-describedby="basic-addon1" id="cuit" name="cuit" ><br>
    <br>

    <hr>
    <label for="representante_legal">Representante Legal:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre del representante legal" aria-describedby="basic-addon1" id="representante_legal" name="representante_legal" ><br>

    <label for="dni_legal">Dni:</label><br>
    <input type="number"  onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el dni del representante legal" aria-describedby="basic-addon1" id="dni_legal" name="dni_legal" >
    <br>

    <label for="observaciones">Observaciones:</label><br>
    <textarea id="observaciones" name="observaciones" class="form-control" placeholder="ingrese las observaciones que considere necesarias"></textarea>
    <br>

    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>
