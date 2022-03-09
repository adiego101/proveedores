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
                <input type="text" class="form-control" placeholder="Ingrese el porcentaje de facturación" aria-describedby="basic-addon1" id="actualizar_facturacion" name="actualizar_facturacion" maxlength="4" value="{{$ponderacion->valor_ponderacion}}" pattern="^[0-9]*(\.?)[0-9]+$" required><br>

            @break
            @case ('Gastos')

                <label for="actualizar_gastos">Gastos:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el porcentaje de gastos" aria-describedby="basic-addon1" id="actualizar_gastos" name="actualizar_gastos" maxlength="4" value="{{$ponderacion->valor_ponderacion}}" pattern="^[0-9]*(\.?)[0-9]+$" required><br>
                                  
            @break
            @case ('Mano_Obra')

                <label for="actualizar_obra">Mano de Obra:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el porcentaje de mano de obra" aria-describedby="basic-addon1" id="actualizar_obra" name="actualizar_obra" maxlength="4" value="{{$ponderacion->valor_ponderacion}}" pattern="^[0-9]*(\.?)[0-9]+$" required><br>
            </div>                 
            @break
            @case ('Antiguedad')
            <div class="col-sm">
                <label for="actualizar_antiguedad">Antiguedad:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la antiguedad en Santa Cruz" aria-describedby="basic-addon1" id="actualizar_antiguedad" name="actualizar_antiguedad" maxlength="4" value="{{$ponderacion->valor_ponderacion}}" pattern="^[0-9]*(\.?)[0-9]+$" required><br>
                                     
            @break
            @case ('Dom_fiscal')

                <label for="actualizar_domicilio">Domicilio Fiscal:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el domicilio fiscal" aria-describedby="basic-addon1" id="actualizar_domicilio" name="actualizar_domicilio" maxlength="4" value="{{$ponderacion->valor_ponderacion}}" pattern="^[0-9]*(\.?)[0-9]+$" required><br>
                                      
            @break
            @case ('Valor_Agregado')

                <label for="actualizar_agregado">Valor Agregado:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el valor agregado" aria-describedby="basic-addon1" id="actualizar_agregado" name="actualizar_agregado" maxlength="4" value="{{$ponderacion->valor_ponderacion}}" pattern="^[0-9]*(\.?)[0-9]+$" required><br>
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
                    <input type="number" class="form-control" placeholder="Ingrese el rango del índice local inicial" aria-describedby="basic-addon1" id="local_inicial" name="local_inicial" min="0" max="100" value="{{$jerarquia->valor_desde}}" required><br>
                </div>
                
                <div class="col-sm">
                    <label for="local_final">valor final:</label><br>
                    <input type="number" class="form-control" placeholder="Ingrese el rango del índice local final" aria-describedby="basic-addon1" id="local_final" name="local_final" min="0" max="100" value="{{$jerarquia->valor_hasta}}" required><br>
                </div>
            </div>
                 
            @break
            @case ('Intermedio')

            <h3>Intermedio:</h3>
            <div class="row">
                <div class="col-sm">
                  
                    <label for="intermedio_inicial">valor inicial:</label><br>
                    <input type="number" class="form-control" placeholder="Ingrese el rango del índice intermedio inicial" aria-describedby="basic-addon1" id="intermedio_inicial" name="intermedio_inicial" min="0" max="100" value="{{$jerarquia->valor_desde}}" required> 
                </div>
                
                <div class="col-sm">
                    <label for="intermedio_final">valor final:</label><br>
                    <input type="number" class="form-control" placeholder="Ingrese el rango del índice intermedio final" aria-describedby="basic-addon1" id="intermedio_final" name="intermedio_final" min="0" max="100" value="{{$jerarquia->valor_hasta}}" required> 
                </div>
            </div>

            @break
            @case ('Foráneo')

            <br>
            <h3>Foráneo:</h3>
            <div class="row">
                <div class="col-sm">
                  
                    <label for="foraneo_inicial">valor inicial:</label><br>
                    <input type="number" class="form-control" placeholder="Ingrese el rango del índice foráneo inicial" aria-describedby="basic-addon1" id="foraneo_inicial" name="foraneo_inicial" min="0" max="100" value="{{$jerarquia->valor_desde}}" required><br>
                </div>
                
                <div class="col-sm">
                    <label for="foraneo_final">valor final:</label><br>
                    <input type="number" class="form-control" placeholder="Ingrese el rango del índice foráneo final" aria-describedby="basic-addon1" id="foraneo_final" name="foraneo_final" min="0" max="100" value="{{$jerarquia->valor_hasta}}" required><br> 
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


<!--Incluimos el modal para validar los campos -->

@include('modales.validarFormularioFormulas')

@endsection


@push('js')

<!--Validacion de campos del formulario -->

<script type="text/javascript">

    let formulario_formulas = document.getElementById("actualizar_formulas");

    formulario_formulas.addEventListener("submit", function(event){

        //Detenemos el envio del formulario
        event.preventDefault();
        
        let comodin_formulas = true;
        let texto_formulas;

        //Obtenemos los valores de cada campo
        let foraneo_inicial = document.getElementById('foraneo_inicial').value;
        let foraneo_final = document.getElementById('foraneo_final').value;
        let intermedio_inicial = document.getElementById('intermedio_inicial').value;
        let intermedio_final = document.getElementById('intermedio_final').value;
        let local_inicial = document.getElementById('local_inicial').value;
        let local_final = document.getElementById('local_final').value;

        //Transformamos los valores obtenidos a numeros enteros (Casting)
        let foraneo_inicial_entero = parseInt(foraneo_inicial);
        let foraneo_final_entero = parseInt(foraneo_final);
        let intermedio_inicial_entero = parseInt(intermedio_inicial);
        let intermedio_final_entero = parseInt(intermedio_final);
        let local_inicial_entero = parseInt(local_inicial);
        let local_final_entero = parseInt(local_final);

        if (foraneo_inicial_entero  >= foraneo_final_entero) 
        {
            comodin_formulas = false;
            texto_formulas = "El rango del índice foráneo inicial NO puede ser mayor o igual al rango del índice foráneo final";
        }
        else if (intermedio_inicial_entero  >= intermedio_final_entero) 
        {
            comodin_formulas = false;
            texto_formulas ="El rango del índice intermedio inicial NO puede ser mayor o igual al rango del índice intermedio final";
        } 
        else if (local_inicial_entero  >= local_final_entero) 
        {
            comodin_formulas = false;
            texto_formulas ="El rango del índice local inicial NO puede ser mayor o igual al rango del índice local final";
        }
        else if (foraneo_final_entero  >= intermedio_inicial_entero) 
        {
            comodin_formulas = false;
            texto_formulas ="El rango del índice foráneo final NO puede ser mayor o igual al rango del índice intermedio inicial";
        }
        else if (intermedio_final_entero  >= local_inicial_entero) 
        {
            comodin_formulas = false;
            texto_formulas ="El rango del índice intermedio final NO puede ser mayor o igual al rango del índice local inicial";
        }


        if (!comodin_formulas)
        {
            //Desplegamos el modal
            $('#modal_validar_formulario_formulas').modal('show');

            //Enviamos los valores recuperados anteriormente al input del modal
            $('#modal_aviso_formulas').text(texto_formulas);
        }


        if (comodin_formulas)
        {
            this.submit();
        }

    }, false);

</script>

@endpush

@push('css')
    <style>
        input:invalid:required {

            border: 1px dashed red;
        }

        input:hover:invalid:required {

            border: 2px dashed red;
        }
    </style>
@endpush

