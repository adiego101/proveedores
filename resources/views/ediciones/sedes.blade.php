@extends('layouts')

@section('content2')
<form action="{{ route('sedes.guardar', ['id' => $sede->id_proveedor_sede]) }}"  method="POST">
    @csrf
<fieldset>

<h1>Sede</h1>

<br/>

<label for="Domicilio">Domicilio:</label><br />
<input type="text" value="{{ isset($sede->Domicilio) ? $sede->Domicilio : '' }}" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="Domicilio" name="Domicilio" /><br />

<div class="row">
        <div class="col-sm">
            <!--En este caso, se deben recuperar las provincias de la BD -->
            <label for="provincia_sede">Provincia:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="provincia_sede" name="provincia_sede">
            {{--<option value=" ">Seleccione una provincia</option>--}}

            @forelse($provincias as $provincia)

                @if ($provincia->id_provincia == $provinciaid)

                    <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>

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
            <!--En este caso, se deben recuperar las localidades_sedes de la BD -->
            <label for="Localidad">Localidad:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="Localidad" name="Localidad">
                <option value=" ">Seleccione una localidad</option>
            </select>
            <br>

        </div>
    </div>
</fieldset>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="btn-group">
        <button type="submit" name="guardarSede" class="btn btn-success"> {{ 'Guardar Cambios' }} </button>
    </div>
</div>
</form>
@push('js')
<script type="text/javascript">

window.onload = function(){
    //console.log("{{url('localidadSelect/'.$sede->Localidad)}}");
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
            url:"{{url('localidadSelect/'.$sede->Localidad)}}",
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
@endpush

@endsection
