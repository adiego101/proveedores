@extends('layouts')

@section('content2')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<h1>Actualizar Fórmulas</h1>

<br>

<h2>Ponderación:</h2>

<form id="actualizar_formulas" action="{{ route('actualizar_formulas') }}"  method="POST">
@csrf
<div class="container">
    <div class="row">
    @if(isset($ponderaciones))
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
    @endif
    </div>
</div>

    <hr>

    <h2>Jerarquía e Índice:</h2>

    <div class="container">  
    @if(isset($jerarquias))
    @foreach($jerarquias as $jerarquia)
        @switch($jerarquia->desc_jerarquia_compre_local)
            @case ('Local')
            <h3>Local:</h3>
            <div class="row">
                <div class="col-sm">
                  
                    <label for="local_inicial">valor inicial:</label><br>
                    <input type="text" class="form-control" placeholder="Ingrese el rango del índice local inicial" aria-describedby="basic-addon1" id="local_inicial" name="local_inicial" maxlength="40" value="{{$jerarquia->valor_desde}}"><br>
                </div>
                
                <div class="col-sm">
                    <label for="local_final">valor final:</label><br>
                    <input type="text" class="form-control" placeholder="Ingrese el rango del índice local final" aria-describedby="basic-addon1" id="local_final" name="local_final" maxlength="40" value="{{$jerarquia->valor_hasta}}"><br>
                </div>
            </div>
                 
            @break
            @case ('Intermedio')

            <h3>Intermedio:</h3>
            <div class="row">
                <div class="col-sm">
                  
                    <label for="intermedio_inicial">valor inicial:</label><br>
                    <input type="text" class="form-control" placeholder="Ingrese el rango del índice intermedio inicial" aria-describedby="basic-addon1" id="intermedio_inicial" name="intermedio_inicial" maxlength="10" value="{{$jerarquia->valor_desde}}"> 
                </div>
                
                <div class="col-sm">
                    <label for="intermedio_final">valor final:</label><br>
                    <input type="text" class="form-control" placeholder="Ingrese el rango del índice intermedio final" aria-describedby="basic-addon1" id="intermedio_final" name="intermedio_final" maxlength="10" value="{{$jerarquia->valor_hasta}}"> 
                </div>
            </div>

            @break
            @case ('Foráneo')

            <br>
            <h3>Foráneo:</h3>
            <div class="row">
                <div class="col-sm">
                  
                    <label for="foraneo_inicial">valor inicial:</label><br>
                    <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el rango del índice foráneo inicial" aria-describedby="basic-addon1" id="foraneo_inicial" name="foraneo_inicial" maxlength="3" value="{{$jerarquia->valor_desde}}"><br>
                </div>
                
                <div class="col-sm">
                    <label for="foraneo_final">valor final:</label><br>
                    <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el rango del índice foráneo final" aria-describedby="basic-addon1" id="foraneo_final" name="foraneo_final" maxlength="3" value="{{$jerarquia->valor_hasta}}"><br> 
                </div>
            </div>
                       
            @break
        @endswitch
    @endforeach
    @endif
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="btn-group">
            <button type="submit" name="actualizar" class="btn btn-success"> {{ 'Actualizar' }} </button>
        </div>
    </div>

</form>

@endsection
