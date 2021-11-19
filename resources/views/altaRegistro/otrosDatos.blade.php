<fieldset>
    <h1>Otros Datos</h1>
    <br>
    <h5>Calculo del indice de compra local</h5>

    <label for="porc_facturacion">Porcentaje de facturacion en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="porc_facturacion" name="porc_facturacion"
        ><br>

    <label for="porc_gasto">Porcentaje de Gastos en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="porc_gasto" name="porc_gasto"
        ><br>

    <label for="porc_mo">Porcentaje de Mano de Obra en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="porc_mo" name="porc_mo"
        ><br>

    <label for="antiguedad">Antiguedad en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="antiguedad" name="antiguedad"
        ><br>

        <div class="container">
          <div class="row">
              <div class="col-sm">
                  <input type="checkbox" id="dom_fiscal" value="dom_fiscal">
                  <label for="dom_fiscal">Domicilio Fiscal</label><br>


              </div>
              <div class="col-sm">
                  <input type="checkbox" id="valor_agregado" value="valor_agregado">
                  <label for="valor_agregado">Valor Agregado</label><br>

              </div>
          </div>
      </div><br>

      <label for="valor-indice">Valor del indice:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="valor-indice" name="valor-indice"
         disabled><br>

    <h5>Proveedor Santacruceño</h5>

    <label for="tamaño">Tamaño de la Empresa:</label><br>


    <select class="form-control" aria-describedby="basic-addon1" id="tamaño" name="tamaño">
        <option selected value="micro">Micro</option>
        <option value="macro">Macro</option>
        <option value="mediana">Mediana</option>
        <option value="grande">Grande</option>

    </select><br>


    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />

    <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>

</fieldset>
