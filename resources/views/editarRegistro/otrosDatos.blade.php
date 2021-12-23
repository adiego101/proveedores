<fieldset>
    <h1>Otros Datos</h1>
    <br>
    <div class="row">
        <div class="col col-sm-6">
            <h5>Calculo del indice de compra local</h5>

            <label for="porc_facturacion">Porcentaje de facturacion en Santa Cruz:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ isset($proveedor->porc_facturacion) ? $proveedor->porc_facturacion : '' }}" id="porc_facturacion" name="porc_facturacion"
                ><br>

            <label for="porc_gasto">Porcentaje de Gastos en Santa Cruz:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ isset($proveedor->porc_gasto) ? $proveedor->porc_gasto : '' }}" id="porc_gasto" name="porc_gasto"
                ><br>

            <label for="porc_mo">Porcentaje de Mano de Obra en Santa Cruz:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ isset($proveedor->porc_mo) ? $proveedor->porc_mo : '' }}" id="porc_mo" name="porc_mo"
                ><br>

            <label for="antiguedad">Antiguedad en Santa Cruz:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ isset($proveedor->antiguedad) ? $proveedor->antiguedad : '' }}" id="antiguedad" name="antiguedad"
                ><br>

            <label for="dom_fiscal">Domicilio Fiscal:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" value="{{ isset($proveedor->dom_fiscal) ? $proveedor->dom_fiscal : '' }}"
                    id="dom_fiscal" name="dom_fiscal"
                ><br>

                <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <input type="checkbox" @if (isset($proveedor->valor_agregado) ? $proveedor->valor_agregado : '0') checked
                        value="1"
                    @else value="0" @endif
                    id="valor_agregado"  name="valor_agregado">
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
            @if(isset($ponderaciones))
                <div>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th text-align="center" colspan="2">PONDERACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ponderaciones as $ponderacion)
                                @switch($ponderacion->desc_ponderacion)
                                    @case ('Facturacion')
                                        <tr>
                                            <th>Facturación</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="facturacion_ponderacion" name="facturacion_ponderacion" readonly value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Gastos')
                                        <tr>
                                            <th>Gastos</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="gastos_ponderacion" name="gastos_ponderacion" readonly value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Mano_Obra')
                                        <tr>
                                            <th>Mano de Obra</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="mano_obra_ponderacion" name="mano_obra_ponderacion" readonly value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Antiguedad')
                                        <tr>
                                            <th>Antiguedad</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="antiguedad_ponderacion" name="antiguedad_ponderacion" readonly value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Dom_fiscal')
                                        <tr>
                                            <th>Dom Fiscal</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="dom_fiscal_ponderacion" name="dom_fiscal_ponderacion" readonly value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Valor_Agregado')
                                        <tr>
                                            <th>Valor Agregado</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="valor_agregado_ponderacion" name="valor_agregado_ponderacion" readonly value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                @endswitch
                            @endforeach
                    </table>
                </div>
            @endif
            <br>
            @if(isset($jerarquias))
                <div>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>JERARQUÍA</th>
                                <th>ÍNDICE</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($jerarquias as $jerarquia)
                                @switch($jerarquia->desc_jerarquia_compre_local)
                                    @case ('Local')
                                        <tr>
                                            <th>LOCAL</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="local_jerarquia" name="local_jerarquia" readonly value="{{$jerarquia->valor_desde}}-{{$jerarquia->valor_hasta}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Intermedio')
                                        <tr>
                                            <th>INTERMEDIO</th>
                                            <td>
                                            <input type="text" class="form-control" aria-describedby="basic-addon1" id="intermedio_jerarquia" name="intermedio_jerarquia" readonly value="{{$jerarquia->valor_desde}}-{{$jerarquia->valor_hasta}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Foráneo')
                                        <tr>
                                            <th>FORANEO</th>
                                            <td>
                                            <input type="text" class="form-control" aria-describedby="basic-addon1" id="foraneo_jerarquia" name="foraneo_jerarquia" readonly value="{{$jerarquia->valor_desde}}-{{$jerarquia->valor_hasta}}">
                                            </td>
                                        </tr>
                                    @break
                                @endswitch
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <label for="tamaño">Tamaño de la Empresa:</label><br>


    <select class="form-control" aria-describedby="basic-addon1" id="id_tamanio_empresa" name="id_tamanio_empresa">
        <option {{ ($proveedor->id_tamanio_empresa=="1") ? "selected"  : "" }} value="1">Micro</option>
        <option {{ ($proveedor->id_tamanio_empresa=="2") ? "selected"  : "" }} value="2">Pequeña</option>
        <option {{ ($proveedor->id_tamanio_empresa=="3") ? "selected"  : "" }} value="3">Mediana</option>
        <option {{ ($proveedor->id_tamanio_empresa=="4") ? "selected"  : "" }} value="4">Grande</option>
        <option {{ ($proveedor->id_tamanio_empresa=="5") ? "selected"  : "" }} value="5">Otros</option>
    </select><br>


    <div class="row navbuttons pt-5">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-primary btnPrevious">Anterior</a>
        </div>
    </div>

</fieldset>

@push('js')
    <script type="text/javascript">
        $("#document").ready(function(){
            $("#porc_facturacion").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                console.log(valor_agregado);
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!='')
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                else
                    $("#valor_indice").val('');
            });
            $("#porc_gasto").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!='')
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                else
                    $("#valor_indice").val('');
            });
            $("#porc_mo").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!='')
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                else
                    $("#valor_indice").val('');
            });
            $("#dom_fiscal").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!='')
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                else
                    $("#valor_indice").val('');
            });
            $("#antiguedad").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!='')
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                else
                    $("#valor_indice").val('');
            });
            $("#valor_agregado").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!='')
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                else
                    $("#valor_indice").val('');
            });


        });

        function calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado) {
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
            console.log(valor_agregado);
            if(antiguedad < 6)
                $("#valor_indice").val( porc_facturacion*facturacion_ponderacion+
                                        porc_gasto*gastos_ponderacion+
                                        porc_mo*mano_obra_ponderacion+
                                        25*antiguedad_ponderacion+
                                        dom_fiscal*dom_fiscal_ponderacion+
                                        valor_agregado*valor_agregado_ponderacion);
            else
                if(antiguedad < 11)
                    $("#valor_indice").val( porc_facturacion*facturacion_ponderacion+
                                            porc_gasto*gastos_ponderacion+
                                            porc_mo*mano_obra_ponderacion+
                                            50*antiguedad_ponderacion+
                                            dom_fiscal*dom_fiscal_ponderacion+
                                            valor_agregado*valor_agregado_ponderacion);
                else
                    if(antiguedad<21)
                        $("#valor_indice").val( porc_facturacion*facturacion_ponderacion+
                                                porc_gasto*gastos_ponderacion+
                                                porc_mo*mano_obra_ponderacion+
                                                75*antiguedad_ponderacion+
                                                dom_fiscal*dom_fiscal_ponderacion+
                                                valor_agregado*valor_agregado_ponderacion);
                    else
                        $("#valor_indice").val( porc_facturacion*facturacion_ponderacion+
                                                    porc_gasto*gastos_ponderacion+
                                                    porc_mo*mano_obra_ponderacion+
                                                    100*antiguedad_ponderacion+
                                                    dom_fiscal*dom_fiscal_ponderacion+
                                                    valor_agregado*valor_agregado_ponderacion);
        }

        function calcular(){
            let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);

    }


    </script>
@endpush
