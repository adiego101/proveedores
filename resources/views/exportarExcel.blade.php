@extends('layouts')

@section('content2')

<h1>Descargar Excel:</h1>
<br>

<form action="{{ route('exportar') }}"  method="GET">
    <select class="form-control" aria-describedby="basic-addon1" name="tipo_descarga" id="tipo_descarga">
            <option>TODOS LOS PROVEEDORES</option>
            <option>PROVEEDORES POR LOCALIDAD</option>
            <option>PROVEEDORES POR ACTIVIDAD</option>
            <option>PROVEEDORES POR SECTOR</option>
            <option>PROVEEDORES POR PALABRA CLAVE</option>
    </select>
    <br>
    <div class="row" id="proveedores_por_localidad" style="display:none;">
        <label for="pais_descarga">Pais:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="pais_descarga" name="pais_descarga">
            @forelse($paises as $pais)
                <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
            @empty
                <option value=" "></option>
            @endforelse
        </select>

        <label for="provincia_descarga">Provincia:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="provincia_descarga" name="provincia_descarga">
            <option value=" ">Seleccione una provincia</option>
            @forelse($provincias as $provincia)
                <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
            @empty
                <option value=" "></option>
            @endforelse
        </select>

        <label for="localidad_descarga">Localidad:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="localidad_descarga" name="localidad_descarga">
            <option value=" ">Seleccione una localidad</option>
        </select>

    </div>
    <div class="row" id="proveedores_por_actividad" style="display:none;">
        <label for="actividad_descarga">Actividad:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="actividad_descarga" name="actividad_descarga">
            @forelse($actividades_economicas as $actividad)
                <option selected value="{{$actividad->id_actividad_economica}}">{{$actividad->cod_actividad}}-{{$actividad->desc_actividad}}</option>
            @empty
                <option value=" "></option>
            @endforelse
        </select>
    </div>
    <div class="row" id="proveedores_por_sector" style="display:none;">
        <label for="sector_descarga">Sector:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="sector_descarga" name="sector_descarga">
            @forelse($sectores as $sector)
                <option selected value="{{$sector->id_sector}}">{{$sector->desc_sector}}</option>
            @empty
                <option value=" "></option>
            @endforelse
        </select>
    </div>
    <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="btn-group">
            <button type="submit" class="btn btn-outline-success" id="exportar">
                Descargar
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                </svg>
            </button>
        </div>
    </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia_descarga').change(function(){
			recargarListaDescarga();
		});

        $('#tipo_descarga').change(function() {
            let tipo_descarga = $('#tipo_descarga').val();
            switch (tipo_descarga) {
                case 'PROVEEDORES POR LOCALIDAD':
                    $('#proveedores_por_localidad').show();
                    $('#proveedores_por_actividad').hide();
                    $('#proveedores_por_sector').hide();
                    break;
                case 'PROVEEDORES POR ACTIVIDAD':
                    $('#proveedores_por_localidad').hide();
                    $('#proveedores_por_actividad').show();
                    $('#proveedores_por_sector').hide();
                    break;
                case 'PROVEEDORES POR SECTOR':
                    $('#proveedores_por_localidad').hide();
                    $('#proveedores_por_actividad').hide();
                    $('#proveedores_por_sector').show();
                    break;
                default:
                    $('#proveedores_por_localidad').hide();
                    $('#proveedores_por_actividad').hide();
                    $('#proveedores_por_sector').hide();
                    break;

            }
        });

        /*$('#localidad_descarga').change(function() {
            if($("#localidad_descarga").val()!=''){
                //let localidad=;
                $('#vinculo_descarga').attr("href","{{asset('/exportar/localidad/"+$("#localidad_descarga").val()+"')}}");
            }
        });
        $('#exportar').click(function(){
            if($('#tipo_descarga').val()=='TODOS LOS PROVEEDORES'){
                console.log('Llama a metodo exportarProveedores');
                exportarProveedores();
            }
            if($('#tipo_descarga').val()=='PROVEEDORES POR LOCALIDAD')
                exportarProveedoresLocalidad($('#localidad_descarga').val());
                
        });*/
	})

	function recargarListaDescarga(){
		$.ajax({
			type:"GET",
			url:"localidades/"+$('#provincia_descarga').val(),
			success:function(r){
				$('#localidad_descarga').html(r);
			}
		});
	}

    function exportarProveedores(){
        console.log('Entro a metodo exportarProveedores');
        $.ajax({
                type:"GET",
                url:"/Laravel-Apps/rupae-interfaces/public/exportar",
                success:function(){
                    window.location('/Laravel-Apps/rupae-interfaces/public/exportar');
                    alert("descaga correcta!!");
                }
            });
    }

    function exportarProveedoresLocalidad($id_localidad){
        $.ajax({
                type:"GET",
                url:"/Laravel-Apps/rupae-interfaces/public/exportar/".$id_localidad,
                success:function(){
                    alert("descaga correcta!!");
                }
            });
    }
    
</script>
@endsection