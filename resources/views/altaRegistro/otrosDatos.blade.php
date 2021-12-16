<fieldset>
    <h1>Otros Datos</h1>
    <br>
    <div class="row">
        <div class="col col-sm-6">
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
            
            <label for="dom_fiscal">Domicilio Fiscal:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="dom_fiscal" name="dom_fiscal"
                ><br>

                <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <input type="checkbox" id="valor_agregado" value="valor_agregado">
                        <label for="valor_agregado">Valor Agregado</label><br>

                    </div>
                </div>
            </div><br>

            <label for="valor-indice">Valor del indice:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="valor-indice" name="valor-indice"
                disabled><br>
        </div>
        <div class="col col-sm-2"></div>
        <div class="col col-sm-4">
            <div>
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th text-align="center" colspan="2">PONDERACIÓN</th>
                        </tr>
                        <tr>
                            <th>Facturación</th>
                            <td>valor</td>
                        </tr>
                        <tr>
                            <th>Gastos</th>
                            <td>valor</td>
                        </tr>
                        <tr>
                            <th>Mano de Obra</th>
                            <td>valor</td>
                        </tr>
                        <tr>
                            <th>Antiguedad</th>
                            <td>valor</td>
                        </tr>
                        <tr>
                            <th>Dom Fiscal</th>
                            <td>valor</td>
                        </tr>
                        <tr>
                            <th>Valor Agregado</th>
                            <td>valor</td>
                        </tr>
                    </thead>
                    <tbody id="body_ponderacion_table"></tbody>
                </table>
            </div>
            <br>
            <div>
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>   
                            <th>JERARQUÍA</th>
                            <th>ÍNDICE</th>
                        </tr>
                        <tr>
                            <th>LOCAL</th>
                            <td>valor</td>
                        </tr>
                        <tr>
                            <th>INTERMEDIO</th>
                            <td>valor</td>
                        </tr>
                        <tr>
                            <th>FORANEO</th>
                            <td>valor</td>
                        </tr>
                    </thead>
                    <tbody id="body_jerarquia_table"></tbody>
                </table>
            </div>
        </div>
    </div>
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
