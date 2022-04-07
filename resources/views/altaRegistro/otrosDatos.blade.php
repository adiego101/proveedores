<fieldset>
    <h1>Otros Datos</h1>
    <br>
    <div class="row">
        <div class="col col-sm-6">
            <h5>Cálculo del índice de compra local</h5>
            <br>

            <label for="porc_facturacion">Porcentaje de facturación en Santa Cruz:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="porc_facturacion" name="porc_facturacion" placeholder="Ingrese el porcentaje de facturación" min="0" max="100">
            <small class="small" id="small-porc_facturacion"></small>
            <br>

            <label for="porc_gasto">Porcentaje de Gastos en Santa Cruz:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="porc_gasto" name="porc_gasto" placeholder="Ingrese el porcentaje de gastos" min="0" max="100">
            <small class="small" id="small-porc_gasto"></small>
            <br>

            <label for="porc_mo">Porcentaje de Mano de Obra en Santa Cruz:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="porc_mo" name="porc_mo" placeholder="Ingrese el porcentaje de mano de obra" min="0" max="100">
            <small class="small" id="small-porc_mo"></small>
            <br>

            <label for="antiguedad">Antiguedad en Santa Cruz:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="antiguedad" name="antiguedad" placeholder="Ingrese la antiguedad en Santa Cruz" min="0" max="1000">
            <small class="small" id="small-antiguedad"></small>
            <br>

            <label for="dom_fiscal">Porcentaje de Domicilio Fiscal en Santa Cruz:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="dom_fiscal" name="dom_fiscal" placeholder="Ingrese el domicilio fiscal" min="0" max="100">
            <small class="small" id="small-dom_fiscal"></small>
            <br>

            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <input type="checkbox" id="valor_agregado" name="valor_agregado" value="0">
                        <label for="valor_agregado">Valor Agregado</label><br>
                    </div>
                </div>
            </div>

            <br>

            <label for="valor_indice_rupae">Valor del índice:</label><br>
            <input type="text" class="form-control" style="font-weight: bold;" aria-describedby="basic-addon1" readonly id="valor_indice_rupae" name="valor_indice_rupae" >
            <br>

            <label for="desc_jerarquia_compre_local">Proveedor:</label><br>
            <input type="text" class="form-control" style="font-weight: bold;" aria-describedby="basic-addon1" id="desc_jerarquia_compre_local" name="desc_jerarquia_compre_local" readonly>
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
                                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="local_jerarquia_hasta" hidden value="{{$jerarquia->valor_hasta}}">
                                    @break
                                    @case ('Intermedio')
                                        <tr>
                                            <th>INTERMEDIO</th>
                                            <td>
                                            <input type="text" class="form-control" aria-describedby="basic-addon1" id="intermedio_jerarquia" name="intermedio_jerarquia" readonly value="{{$jerarquia->valor_desde}}-{{$jerarquia->valor_hasta}}">
                                            </td>
                                        </tr>
                                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="intermedio_jerarquia_hasta" hidden value="{{$jerarquia->valor_hasta}}">
                                    @break
                                    @case ('Foráneo')
                                        <tr>
                                            <th>FORÁNEO</th>
                                            <td>
                                            <input type="text" class="form-control" aria-describedby="basic-addon1" id="foraneo_jerarquia" name="foraneo_jerarquia" readonly value="{{$jerarquia->valor_desde}}-{{$jerarquia->valor_hasta}}">
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


    <select class="form-control" aria-describedby="basic-addon1" id="id_tamanio_empresa" name="id_tamanio_empresa">
        <option selected value="1">Micro</option>
        <option value="2">Pequeña</option>
        <option value="3">Mediana</option>
        <option value="4">Grande</option>
        <option value="5">Otros</option>
    </select>

    <br>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />

</fieldset>

@push('js')

    <script type="text/javascript">

        $('#porc_facturacion').keyup(validarPorcFacturacion);

        function validarPorcFacturacion() {
   
            if (parseInt($('#porc_facturacion').val()) < 0 || parseInt($('#porc_facturacion').val()) > 100) {

                mostrarError('#porc_facturacion', '#small-porc_facturacion', '<div class="alert alert-danger mt-3 pt-1">El <strong>porcentaje de facturación</strong> debe ser mayor o igual que 0 y menor o igual que 100.</div>');
                return false;
            }
            ocultarError('#porc_facturacion', '#small-porc_facturacion');
            return true;
        }



        $('#porc_gasto').keyup(validarPorcGasto);

        function validarPorcGasto() {

            if (parseInt($('#porc_gasto').val()) < 0 || parseInt($('#porc_gasto').val()) > 100) {

                mostrarError('#porc_gasto', '#small-porc_gasto', '<div class="alert alert-danger mt-3 pt-1">El <strong>porcentaje de gastos</strong> debe ser mayor o igual que 0 y menor o igual que 100.</div>');
                return false;
            }
            ocultarError('#porc_gasto', '#small-porc_gasto');
            return true;
        }


        $('#porc_mo').keyup(validarPorcMo);

        function validarPorcMo() {

            if (parseInt($('#porc_mo').val()) < 0 || parseInt($('#porc_mo').val()) > 100) {

                mostrarError('#porc_mo', '#small-porc_mo', '<div class="alert alert-danger mt-3 pt-1">El <strong>porcentaje de mano de obra</strong> debe ser mayor o igual que 0 y menor o igual que 100.</div>');
                return false;
            }
            ocultarError('#porc_mo', '#small-porc_mo');
            return true;
        }



        $('#dom_fiscal').keyup(validarPorcDomFiscal);

        function validarPorcDomFiscal() {

            if (parseInt($('#dom_fiscal').val()) < 0 || parseInt($('#dom_fiscal').val()) > 100) {

                mostrarError('#dom_fiscal', '#small-dom_fiscal', '<div class="alert alert-danger mt-3 pt-1">El <strong>porcentaje de domicilio fiscal</strong> debe ser mayor o igual que 0 y menor o igual que 100.</div>');
                return false;
            }
            ocultarError('#dom_fiscal', '#small-dom_fiscal');
            return true;
        }



        $('#antiguedad').keyup(validarAntiguedad);

        function validarAntiguedad() {

            if (parseInt($('#antiguedad').val()) < 0 || parseInt($('#antiguedad').val()) > 1000) {

                mostrarError('#antiguedad', '#small-antiguedad', '<div class="alert alert-danger mt-3 pt-1">La <strong>antiguedad</strong> ingresada no está permitida.</div>');
                return false;
            }
            ocultarError('#antiguedad', '#small-antiguedad');
            return true;
        }


        $("#document").ready(function(){

            $("#porc_facturacion").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                //console.log(valor_agregado);
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!=''){
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                    mostrarProveedor($("#valor_indice_rupae").val());
                }
                else
                    $("#valor_indice_rupae").val('');

            });


            $("#porc_gasto").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!=''){
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                    mostrarProveedor($("#valor_indice_rupae").val());
                }
                else
                    $("#valor_indice_rupae").val('');

            });


            $("#porc_mo").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!=''){
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                    mostrarProveedor($("#valor_indice_rupae").val());
                }
                else
                    $("#valor_indice_rupae").val('');

            });


            $("#dom_fiscal").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!=''){
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                    mostrarProveedor($("#valor_indice_rupae").val());
                }
                else
                    $("#valor_indice_rupae").val('');

            });


            $("#antiguedad").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!=''){
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                    mostrarProveedor($("#valor_indice_rupae").val());
                }
                else
                    $("#valor_indice_rupae").val('');

            });


            $("#valor_agregado").change(function() {
                let porc_facturacion = $("#porc_facturacion").val();
                let porc_gasto = $("#porc_gasto").val();
                let porc_mo = $("#porc_mo").val();
                let dom_fiscal = $("#dom_fiscal").val();
                let antiguedad = $("#antiguedad").val();
                let valor_agregado = $("#valor_agregado").val();
                if(porc_facturacion!='' && porc_gasto!=''&& porc_mo!='' && dom_fiscal!='' && antiguedad!=''){
                    calcular_indice(porc_facturacion, porc_gasto, porc_mo, dom_fiscal, antiguedad, valor_agregado);
                    mostrarProveedor($("#valor_indice_rupae").val());
                }
                else
                    $("#valor_indice_rupae").val('');
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
                $("#valor_indice_rupae").val( porc_facturacion*facturacion_ponderacion+
                                        porc_gasto*gastos_ponderacion+
                                        porc_mo*mano_obra_ponderacion+
                                        25*antiguedad_ponderacion+
                                        dom_fiscal*dom_fiscal_ponderacion+
                                        valor_agregado*valor_agregado_ponderacion);
            else
                if(antiguedad < 11)
                    $("#valor_indice_rupae").val( porc_facturacion*facturacion_ponderacion+
                                            porc_gasto*gastos_ponderacion+
                                            porc_mo*mano_obra_ponderacion+
                                            50*antiguedad_ponderacion+
                                            dom_fiscal*dom_fiscal_ponderacion+
                                            valor_agregado*valor_agregado_ponderacion);
                else
                    if(antiguedad<21)
                        $("#valor_indice_rupae").val( porc_facturacion*facturacion_ponderacion+
                                                porc_gasto*gastos_ponderacion+
                                                porc_mo*mano_obra_ponderacion+
                                                75*antiguedad_ponderacion+
                                                dom_fiscal*dom_fiscal_ponderacion+
                                                valor_agregado*valor_agregado_ponderacion);
                    else
                        /*$("#valor_indice_rupae").val( porc_facturacion*facturacion_ponderacion+
                                                    porc_gasto*gastos_ponderacion+
                                                    porc_mo*mano_obra_ponderacion+
                                                    100*antiguedad_ponderacion+
                                                    dom_fiscal*dom_fiscal_ponderacion+
                                                    valor_agregado*valor_agregado_ponderacion);*/
                        $("#valor_indice_rupae").val('Sin resultados');           
        }

        function mostrarProveedor(valor_indice_rupae){

            if(valor_indice_rupae != 'Sin resultados') {

                if(valor_indice_rupae>=parseInt($("#foraneo_jerarquia_desde").val()))
                    if(valor_indice_rupae<=parseInt($("#foraneo_jerarquia_hasta").val()))
                        $("#desc_jerarquia_compre_local").val('PROVEEDOR FORANEO');
                    else if(valor_indice_rupae<=parseInt($("#intermedio_jerarquia_hasta").val()))
                            $("#desc_jerarquia_compre_local").val('PROVEEDOR INTERMEDIO');
                        else if(valor_indice_rupae<=parseInt($("#local_jerarquia_hasta").val()))
                            $("#desc_jerarquia_compre_local").val('PROVEEDOR LOCAL');
                            else
                                $("#desc_jerarquia_compre_local").val('Sin resultados');

            } else {
                
                $("#desc_jerarquia_compre_local").val('Sin resultados');
            }
        }

    </script>

@endpush
