
@extends('layouts')

@section('content2')
@if ( $mode != "show")

@if ($mode != "edit")

<form action="{{ route('actividades.crear', ['id' => $id]) }}"  method="POST">

@else

<form action="{{ route('actividades.guardar', ['id' => $actividad->id_actividad_proveedor]) }}"  method="POST">

@endif

    @csrf

@endif
<fieldset>
<div class="row">
        <h1>Actividad</h1>
</div>

<br/>
    <div class="row">
        <div class="col-sm">
            <label for="tipo_actividad">Tipo de Actividad:</label><br>
                <select @if ( $mode == "show") disabled @endif
                 class="form-control" aria-describedby="basic-addon1" id="tipo_actividad" name="tipo_actividad">
                    @forelse($tipos_actividades as $tipo_actividad)
                    @if ($mode == "create")
                        <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                    @else
                        @if ($tipo_actividad->id_tipo_actividad == $actividad->id_tipo_actividad)
                            <option selected="selected" value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                        @endif
                    @endif
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
            <br />
        </div>

        <div class="col-sm">
            <label for="actividad">Actividad:</label><br>
            <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="actividad_1" name="actividad_1">
            @forelse($actividades as $actividad2)
            @if ($mode == "create")
            <option value="{{$actividad2->desc_actividad}}">{{$actividad2->cod_actividad}} - {{$actividad2->desc_actividad}}</option>
            @else
            @if($actividad2->id_actividad_economica == $actividad->id_actividad_economica)
                    <option selected="selected" value="{{$actividad2->desc_actividad}}">{{$actividad2->cod_actividad}} - {{$actividad2->desc_actividad}}</option>
                @else
                    <option value="{{$actividad2->desc_actividad}}">{{$actividad2->cod_actividad}} - {{$actividad2->desc_actividad}}</option>
                @endif
            @endif

            @empty
                <option value=" "></option>
            @endforelse
            </select>
            <br />
        </div>
    </div>
    <br>
</fieldset>


@if ( $mode != "show")

@if ($mode != "edit")

<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $id, 'tab' => "actividad"]) }}">atras</a>

@else
<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $actividad->id_proveedor, 'tab' => "actividad"]) }}">atras</a>

@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
     <div class="btn-group">
        <button type="submit" name="guardarActividades" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>
    </div>
</div>

</form>

@else
<a class="btn btn-secondary" style="float: left" href="{{ route('verRegistro', ['id' => $actividad->id_proveedor, 'tab' => "actividad"]) }}">atras</a>

@endif

@endsection
@push('js')
    <script type="text/javascript">
    function valideKey(evt){

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) { // espacio.
          return true;
        } else if(code>=48 && code<=57) { // es un numero.
          return true;
        } else{ // otras teclas
        console.log("no es un numero");
          return false;
        }
    }
    </script>
@endpush
