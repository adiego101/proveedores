<fieldset>
    <h1>Otros Datos</h1>
    <br>
    <h5>Calculo del indice de compra local</h5>

    <label for="fact-sc">Porcentaje de facturacion en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="porcentaje-sc" name="porcentaje-sc"
        required><br>

    <label for="gastos-sc">Porcentaje de Gastos en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="gastos-sc" name="gastos-sc"
        required><br>

    <label for="manodeobra-sc">Porcentaje de Mano de Obra en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="manodeobra-sc" name="manodeobra-sc"
        required><br>

    <label for="antiguedad-sc">Antiguedad en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="antiguedad-sc" name="antiguedad-sc"
        required><br>

        <div class="container">
          <div class="row">
              <div class="col-sm">
                  <input type="checkbox" id="dom-fiscal" value="dom-fiscal">
                  <label for="dom-fiscal">Domicilio Fiscal</label><br>
                  
  
              </div>
              <div class="col-sm">
                  <input type="checkbox" id="val-Agregado" value="val-Agregado">
                  <label for="val-Agregado">Valor Agregado</label><br>
                  
              </div>
          </div>
      </div><br>

      <label for="valor-indice">Valor del indice:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="valor-indice" name="valor-indice"
        required disabled><br>

    <h5>Proveedor Santacruceño</h5>

    <label for="tamaño-empresa">Tamaño de la Empresa:</label><br>


    <select class="form-control" aria-describedby="basic-addon1" id="tamaño-empresa" name="tamaño-empresa">
        <option selected value="micro">Micro</option>
        <option value="macro">Macro</option>
        <option value="mediana">Mediana</option>
        <option value="grande">Grande</option>

    </select><br>


    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />

    <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>

</fieldset>
