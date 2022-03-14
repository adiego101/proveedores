<fieldset>
    <h1>Otros Datos</h1>
    <br>
    <div class="row">
        <div class="col col-sm-6">
            <h5>Cálculo del índice de compra local</h5>

            <label for="porc_facturacion">Porcentaje de facturación en Santa Cruz:</label><br>
            <input  @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1"
value="{{ isset($proveedor->porc_facturacion) ? $proveedor->porc_facturacion : '' }}" id="porc_facturacion" name="porc_facturacion" placeholder="Ingrese el porcentaje de facturación" maxlength="9"><br>

            <label for="porc_gasto">Porcentaje de Gastos en Santa Cruz:</label><br>
            <input  @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1"
value="{{ isset($proveedor->porc_gasto) ? $proveedor->porc_gasto : '' }}" id="porc_gasto" name="porc_gasto" placeholder="Ingrese el porcentaje de gastos" maxlength="9"><br>

            <label for="porc_mo">Porcentaje de Mano de Obra en Santa Cruz:</label><br>
            <input  @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1"
value="{{ isset($proveedor->porc_mo) ? $proveedor->porc_mo : '' }}" id="porc_mo" name="porc_mo" placeholder="Ingrese el porcentaje de mano de obra" maxlength="9"><br>

            <label for="antiguedad">Antiguedad en Santa Cruz:</label><br>
            <input  @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1"
value="{{ isset($proveedor->antiguedad) ? $proveedor->antiguedad : '' }}" id="antiguedad" name="antiguedad" placeholder="Ingrese la antiguedad en Santa Cruz" maxlength="3"><br>

            <label for="dom_fiscal">Domicilio Fiscal:</label><br>
            <input  @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1"
value="{{ isset($proveedor->dom_fiscal) ? $proveedor->dom_fiscal : '' }}" id="dom_fiscal" name="dom_fiscal" placeholder="Ingrese el domicilio fiscal" maxlength="9"><br>

                <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <input id="valor_agregado"  name="valor_agregado" @if ( $mode == "show") onclick="return false" @endif    type="checkbox" @if (isset($proveedor->valor_agregado) ? $proveedor->valor_agregado : '0') checked

value="1"
                    @else
value="0" @endif
>
                        <label for="valor_agregado">Valor Agregado</label><br>


                    </div>
                </div>
            </div><br>

            <label for="valor-indice">Valor del indice:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="valor_indice" name="valor_indice" disabled>
            <br>

            <label for="proveedor">Proveedor:</label><br>
            <input type="text" class="form-control" style="font-weight: bold;" aria-describedby="basic-addon1" id="proveedor" name="proveedor" disabled>
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
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="facturacion_ponderacion" name="facturacion_ponderacion" readonly
value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Gastos')
                                        <tr>
                                            <th>Gastos</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="gastos_ponderacion" name="gastos_ponderacion" readonly
value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Mano_Obra')
                                        <tr>
                                            <th>Mano de Obra</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="mano_obra_ponderacion" name="mano_obra_ponderacion" readonly
value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Antiguedad')
                                        <tr>
                                            <th>Antiguedad</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="antiguedad_ponderacion" name="antiguedad_ponderacion" readonly
value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Dom_fiscal')
                                        <tr>
                                            <th>Dom Fiscal</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="dom_fiscal_ponderacion" name="dom_fiscal_ponderacion" readonly
value="{{$ponderacion->valor_ponderacion}}">
                                            </td>
                                        </tr>
                                    @break
                                    @case ('Valor_Agregado')
                                        <tr>
                                            <th>Valor Agregado</th>
                                            <td>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="valor_agregado_ponderacion" name="valor_agregado_ponderacion" readonly
value="{{$ponderacion->valor_ponderacion}}">
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
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="local_jerarquia" name="local_jerarquia" readonly
value="{{$jerarquia->valor_desde}}-{{$jerarquia->valor_hasta}}">
                                            </td>
                                        </tr>
                                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="local_jerarquia_hasta" hidden value="{{$jerarquia->valor_hasta}}">
                                    @break
                                    @case ('Intermedio')
                                        <tr>
                                            <th>INTERMEDIO</th>
                                            <td>
                                            <input type="text" class="form-control" aria-describedby="basic-addon1" id="intermedio_jerarquia" name="intermedio_jerarquia" readonly
value="{{$jerarquia->valor_desde}}-{{$jerarquia->valor_hasta}}">
                                            </td>
                                        </tr>
                                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="intermedio_jerarquia_hasta" hidden value="{{$jerarquia->valor_hasta}}">
                                    @break
                                    @case ('Foráneo')
                                        <tr>
                                            <th>FORANEO</th>
                                            <td>
                                            <input type="text" class="form-control" aria-describedby="basic-addon1" id="foraneo_jerarquia" name="foraneo_jerarquia" readonly
value="{{$jerarquia->valor_desde}}-{{$jerarquia->valor_hasta}}">
                                            </td>
                                        </tr>
                                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="foraneo_jerarquia_desde" hidden value="{{$jerarquia->valor_desde}}">
                                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="foraneo_jerarquia_hasta" hidden value="{{$jerarquia->valor_hasta}}">
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


    <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="id_tamanio_empresa" name="id_tamanio_empresa">
        <option {{ ($proveedor->id_tamanio_empresa=="1") ? "selected"  : "" }}
value="1">Micro</option>
        <option {{ ($proveedor->id_tamanio_empresa=="2") ? "selected"  : "" }}
value="2">Pequeña</option>
        <option {{ ($proveedor->id_tamanio_empresa=="3") ? "selected"  : "" }}
value="3">Mediana</option>
        <option {{ ($proveedor->id_tamanio_empresa=="4") ? "selected"  : "" }}
value="4">Grande</option>
        <option {{ ($proveedor->id_tamanio_empresa=="5") ? "selected"  : "" }}
value="5">Otros</option>
    </select><br>


    <div class="row navbuttons ">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
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
                let valor_indice;
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
            mostrarProveedor($("#valor_indice").val());
        }

        function mostrarProveedor(valor_indice){
            if(valor_indice>=parseInt($("#foraneo_jerarquia_desde").val()))
                if(valor_indice<=parseInt($("#foraneo_jerarquia_hasta").val()))
                    $("#proveedor").val('PROVEEDOR FORANEO');
                else if(valor_indice<=parseInt($("#intermedio_jerarquia_hasta").val()))
                        $("#proveedor").val('PROVEEDOR INTERMEDIO');
                    else if(valor_indice<=parseInt($("#local_jerarquia_hasta").val()))
                        $("#proveedor").val('PROVEEDOR LOCAL');
                        else    
                            $("#proveedor").val('');
        }
    </script>

@endpush
