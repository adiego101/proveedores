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
                        <input type="checkbox" id="valor_agregado" name="valor_agregado" value="0">
                        <label for="valor_agregado">Valor Agregado</label><br>


                    </div>
                </div>
            </div><br>

            <label for="valor-indice">Valor del indice:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="valor_indice" name="valor_indice"
                disabled>
            <br>
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
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="facturacion_ponderacion" name="facturacion_ponderacion" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Facturacion'? $ponderaciones->valor_ponderacion:''}}"></td>
                        </tr>
                        <tr>
                            <th>Gastos</th>
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="gastos_ponderacion" name="gastos_ponderacion" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Gastos'? $ponderaciones->valor_ponderacion:''}}"></td>
                        </tr>
                        <tr>
                            <th>Mano de Obra</th>
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="mano_obra_ponderacion" name="mano_obra_ponderacion" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Mano_Obra'? $ponderaciones->valor_ponderacion:''}}"></td>
                        </tr>
                        <tr>
                            <th>Antiguedad</th>
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="antiguedad_ponderacion" name="antiguedad_ponderacion" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Antiguedad'? $ponderaciones->valor_ponderacion:''}}"></td>
                        </tr>
                        <tr>
                            <th>Dom Fiscal</th>
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="dom_fiscal_ponderacion" name="dom_fiscal_ponderacion" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Dom_fiscal'? $ponderaciones->valor_ponderacion:''}}"></td>
                        </tr>
                        <tr>
                            <th>Valor Agregado</th>
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="valor_agregado_ponderacion" name="valor_agregado_ponderacion" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Valor_Agregado'? $ponderaciones->valor_ponderacion:''}}"></td>
                        </tr>
                    </thead>
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
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="local_jerarquia" name="local_jerarquia" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Local'? $ponderaciones->valor_ponderacion:''}}"></td>
                        </tr>
                        <tr>
                            <th>INTERMEDIO</th>
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="intermedio_jerarquia" name="intermedio_jerarquia" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Intermedio'? $ponderaciones->valor_ponderacion:''}}"></td>
                        </tr>
                        <tr>
                            <th>FORANEO</th>
                            <td><input type="text" class="form-control" aria-describedby="basic-addon1" id="foraneo_jerarquia" name="foraneo_jerarquia" readonly value="{{isset($ponderaciones->desc_ponderacion) && $ponderaciones->desc_ponderacion=='Foraneo'? $ponderaciones->valor_ponderacion:''}}""></td>
                        </tr>
                    </thead>
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

@push('js')
    <script type="text/javascript">
        $("#document").ready(function(){
            let porc_facturacion = $("#porc_facturacion").val();
            let porc_gasto = $("#porc_gasto").val();
            let porc_mo = $("#porc_mo").val();
            let dom_fiscal = $("#dom_fiscal").val();
            let antiguedad = $("#antiguedad").val();
            let valor_agregado = $("#valor_agregado").val();
            if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!='' && valor_agregado!=''){
                let facturacion_ponderacion = $("#facturacion_ponderacion").val();
                let gastos_ponderacion = $("#gastos_ponderacion").val();
                let mano_obra_ponderacion = $("#mano_obra_ponderacion").val();
                let antiguedad_ponderacion = $("#antiguedad_ponderacion").val();
                let dom_fiscal_ponderacion = $("#dom_fiscal_ponderacion").val();
                let valor_agregado_ponderacion = $("#valor_agregado_ponderacion").val();
                let local_jerarquia = $("#local_jerarquia").val();
                let intermedio_jerarquia = $("#intermedio_jerarquia").val();
                let foraneo_jerarquia = $("#foraneo_jerarquia").val();
                if(valor_agregado == 1)
                    valor_agregado=100;
                else
                    valor_agregado=0;
                if(antiguedad < 6)
                    $("#valor_indice").val( porc_facturacion*facturacion_ponderacion+
                                            porc_gasto*gastos_ponderacion+
                                            porc_mo*mano_obra_ponderacion+
                                            25*antiguedad_ponderacion+
                                            dom_fiscal*dom_fiscal_ponderacion+
                                            100*valor_agregado_ponderacion);
                else
                    if(antiguedad < 11)
                        $("#valor_indice").val( porc_facturacion*facturacion_ponderacion+
                                                porc_gasto*gastos_ponderacion+
                                                porc_mo*mano_obra_ponderacion+
                                                50*antiguedad_ponderacion+
                                                dom_fiscal*dom_fiscal_ponderacion+
                                                100*valor_agregado_ponderacion);
                    else
                        if(antiguedad<21)
                            $("#valor_indice").val( porc_facturacion*facturacion_ponderacion+
                                                    porc_gasto*gastos_ponderacion+
                                                    porc_mo*mano_obra_ponderacion+
                                                    75*antiguedad_ponderacion+
                                                    dom_fiscal*dom_fiscal_ponderacion+
                                                    100*valor_agregado_ponderacion);
                        else
                            $("#valor_indice").val( porc_facturacion*facturacion_ponderacion+
                                                        porc_gasto*gastos_ponderacion+
                                                        porc_mo*mano_obra_ponderacion+
                                                        100*antiguedad_ponderacion+
                                                        dom_fiscal*dom_fiscal_ponderacion+
                                                        100*valor_agregado_ponderacion);
            }
        });
    </script>
@endpush
