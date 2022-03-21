@extends('layouts')

@section('content2')
@if ( $mode != "show")

@if ($mode != "edit")

<form action="{{ route('sedes.crear', ['id' => $id]) }}"  method="POST">

@else

<form action="{{ route('sedes.guardar', ['id' => $sede->id_proveedor_sede]) }}"  method="POST">

@endif

    @csrf
    @endif

<fieldset>

<h1>Sede</h1>

<br/>

<label for="Domicilio">Domicilio:</label><br />
<input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($sede->Domicilio) ? $sede->Domicilio : '' }}" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="Domicilio" name="Domicilio" maxlength="50" required/><br />

<div class="row">
        <div class="col-sm">
            <label for="provincia_sede">Provincia:</label><br>
            <select  @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="provincia_sede" name="provincia_sede" required>
            <option value="">Seleccione una provincia</option>
            @forelse($provincias as $provincia)
                @if (isset($provinciaid))
                    @if ($provincia->id_provincia == $provinciaid)
                        <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @else
                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @endif
                @else
                    <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                @endif
            @empty
                <option value=" "></option>
            @endforelse
            </select>
            <br>
        </div>

        <div class="col-sm">
            <label for="Localidad">Localidad:</label><br>
            <select  @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="Localidad" name="Localidad" required>
                <option value="">Seleccione una localidad</option>
            </select>
            <br>

        </div>
    </div>
</fieldset>


@if ( $mode != "show")

@if ($mode != "edit")

<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $id, 'tab' => "patente"]) }}">atras</a>

@else
<a class="btn btn-secondary" style="float: left" href="{{ route('modificarRegistro', ['id' => $sede->id_proveedor, 'tab' => "patente"]) }}">atras</a>

@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        <button type="submit" name="guardarSede" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>
    </div>
</div>

</form>

@else

<a class="btn btn-secondary" style="float: left" href="{{ route('verRegistro', ['id' => $sede->id_proveedor, 'tab' => "patente"]) }}">atras</a>

@endif

@push('js')

<script type="text/javascript">

window.onload = function(){
    recargarLista();
        };

    $(document).ready(function(){

        $('#provincia_sede').change(function(){
            recargarListaSeguro();
        });
    })
</script>

<script type="text/javascript">

    function recargarLista(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/')}}/{{isset($sede->Localidad) ? $sede->Localidad : ''}}",
            success:function(r){
                $('#Localidad').html(r);
            }
        });
    }

    function recargarListaSeguro(){
            $.ajax({
                type:"GET",
                url:"{{url('localidades/')}}/"+$('#provincia_sede').val(),
                success:function(r){
                    $('#Localidad').html(r);
                }
            });
        }

</script>
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

@endsection
