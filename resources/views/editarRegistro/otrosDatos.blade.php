<fieldset>
    <h1>Otros Datos</h1>
    <br>
    <h5>Calculo del indice de compra local</h5>

    <label for="porc_facturacion">Porcentaje de facturacion en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->porc_facturacion) ? $proveedor->porc_facturacion : '' }}" id="porc_facturacion"
        name="porc_facturacion"><br>

    <label for="porc_gasto">Porcentaje de Gastos en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->porc_gasto) ? $proveedor->porc_gasto : '' }}" id="porc_gasto"
        name="porc_gasto"><br>

    <label for="porc_mo">Porcentaje de Mano de Obra en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->porc_mo) ? $proveedor->porc_mo : '' }}" id="porc_mo" name="porc_mo"><br>

    <label for="antiguedad">Antiguedad en Santa Cruz:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->antiguedad) ? $proveedor->antiguedad : '' }}" id="antiguedad"
        name="antiguedad"><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <input type="checkbox" value="{{ isset($proveedor->dom_fiscal) ? $proveedor->dom_fiscal : '' }}"
                    id="dom_fiscal" value="dom_fiscal">
                <label for="dom_fiscal">Domicilio Fiscal</label><br>


            </div>
            <div class="col-sm">
                <input type="checkbox"
                    value="{{ isset($proveedor->valor_agregado) ? $proveedor->valor_agregado : '' }}"
                    id="valor_agregado" value="valor_agregado">
                <label for="valor_agregado">Valor Agregado</label><br>

            </div>
        </div>
    </div><br>

    <label for="valor-indice">Valor del indice:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="valor-indice" name="valor-indice"
        disabled><br>

    <h5>Proveedor Santacruceño</h5>

    <label for="tamaño">Tamaño de la Empresa:</label><br>


    <select class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->tamaño) ? $proveedor->tamaño : '' }}" id="tamaño" name="tamaño">
        <option selected value="micro">Micro</option>
        <option value="macro">Macro</option>
        <option value="mediana">Mediana</option>
        <option value="grande">Grande</option>

    </select><br>


    <div class="row navbuttons pt-5">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-primary btnPrevious">Previous</a>
        </div>
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Next</a>
        </div>
    </div>

</fieldset>
