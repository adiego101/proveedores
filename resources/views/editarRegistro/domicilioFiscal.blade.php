<fieldset>


    <h1>Datos del Domicilio fiscal</h1><br>
  <div class="container">
    <div class="row">
      <div class="col-sm">
        <label for="calle-fiscal">Calle:</label><br>
        <input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1"
            id="calle-fiscal" name="calle-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="numero-fiscal">Numero:</label><br>
        <input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1"
            id="numero-fiscal" name="numero-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="lote-fiscal">Lote:</label><br>
        <input type="text" class="form-control" placeholder="lote:" aria-describedby="basic-addon1"
            id="lote-fiscal" name="lote-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="entreCalles-fiscal">Entre Calle:</label><br>
        <input type="text" class="form-control" placeholder="Entre Calles:" aria-describedby="basic-addon1"
            id="entreCalles-fiscal" name="entreCalles-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="monoblock-fiscal">Monoblock:</label><br>
        <input type="text" class="form-control" placeholder="Monoblock:" aria-describedby="basic-addon1"
            id="monoblock-fiscal" name="monoblock-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="departamento-fiscal">Departamento:</label><br>
        <input type="text" class="form-control" placeholder="Departamento:" aria-describedby="basic-addon1"
            id="departamento-fiscal" name="departamento-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="puerta-fiscal">Puerta:</label><br>
        <input type="text" class="form-control" placeholder="Puerta:" aria-describedby="basic-addon1"
            id="puerta-fiscal" name="puerta-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="oficina-fiscal">Oficina:</label><br>
        <input type="text" class="form-control" placeholder="Oficina:" aria-describedby="basic-addon1"
            id="oficina-fiscal" name="oficina-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="manzana-fiscal">Manzana:</label><br>
        <input type="text" class="form-control" placeholder="Manzana:" aria-describedby="basic-addon1"
            id="manzana-fiscal" name="manzana-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="barrio-fiscal">Barrio:</label><br>
        <input type="text" class="form-control" placeholder="Barrio:" aria-describedby="basic-addon1"
            id="barrio-fiscal" name="barrio-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <!--En este caso, se deben recuperar las localidades de la BD -->
        <label for="localidad-fiscal">Localidad:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="localidad-fiscal"
            name="localidad-fiscal">
            <option selected value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
      </div>
      <div class="col-sm">
        <label for="provincia-fiscal">Provincia:</label><br>
        <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia-fiscal"
            name="provincia-fiscal" required disabled><br>
      </div>
    </div>
  </div>
  <div class="row navbuttons pt-5">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-primary btnPrevious">Previous</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Next</a>
    </div>
</div>

</fieldset>
