@extends('layouts')

@section('content2')

<h1>Actualizar Fórmulas</h1>

<br>

<h2>Ponderación:</h2>

<div class="container">
    <div class="row">
    @foreach($ponderaciones as $ponderacion)
        @switch($ponderacion->desc_ponderacion)
            @case ('Facturacion')
            <div class="col-sm">                  
                <label for="actualizar_facturacion">Facturación:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el porcentaje de facturación" aria-describedby="basic-addon1" id="actualizar_facturacion" name="actualizar_facturacion" value="{{$ponderacion->valor_ponderacion}}"><br>

            @break
            @case ('Gastos')

                <label for="actualizar_gastos">Gastos:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el porcentaje de gastos" aria-describedby="basic-addon1" id="actualizar_gastos" name="actualizar_gastos" value="{{$ponderacion->valor_ponderacion}}"><br>
                                  
            @break
            @case ('Mano_Obra')

                <label for="actualizar_obra">Mano de Obra:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el porcentaje de mano de obra" aria-describedby="basic-addon1" id="actualizar_obra" name="actualizar_obra" value="{{$ponderacion->valor_ponderacion}}"><br>
            </div>                 
            @break
            @case ('Antiguedad')
            <div class="col-sm">
                <label for="actualizar_antiguedad">Antiguedad:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la antiguedad en Santa Cruz" aria-describedby="basic-addon1" id="actualizar_antiguedad" name="actualizar_antiguedad" value="{{$ponderacion->valor_ponderacion}}"><br>
                                     
            @break
            @case ('Dom_fiscal')

                <label for="actualizar_domicilio">Domicilio Fiscal:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el domicilio fiscal" aria-describedby="basic-addon1" id="actualizar_domicilio" name="actualizar_domicilio" value="{{$ponderacion->valor_ponderacion}}"><br>
                                      
            @break
            @case ('Valor_Agregado')

                <label for="actualizar_agregado">Valor Agregado:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el valor agregado" aria-describedby="basic-addon1" id="actualizar_agregado" name="actualizar_agregado" value="{{$ponderacion->valor_ponderacion}}"><br>
            </div>                  
            @break
        @endswitch
    @endforeach
    </div>
</div>

    <hr>

<h2>Jerarquía e Índice:</h2>

    <div class="container">
        <label for="actualizar_local">Local:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el rango del índice local" aria-describedby="basic-addon1" id="actualizar_local" name="actualizar_local" maxlength="40"><br>

        <label for="actualizar_intermedio">Intermedio:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el rango del índice intermedio" aria-describedby="basic-addon1" id="actualizar_intermedio" name="actualizar_intermedio" maxlength="10"><br>

        <label for="actualizar_foraneo">Foráneo:</label><br>
        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el rango del índice foráneo" aria-describedby="basic-addon1" id="actualizar_foraneo" name="actualizar_foraneo" maxlength="3"><br>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="btn-group">
            <button type="submit" name="actualizar" class="btn btn-success"> {{ 'Actualizar' }} </button>
        </div>
    </div>

@endsection
