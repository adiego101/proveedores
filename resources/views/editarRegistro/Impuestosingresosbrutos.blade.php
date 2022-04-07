<fieldset>

  <h1>Impuestos sobre ingresos brutos y habilitaciones</h1><br>

  <h4>Ingresos brutos:</h4><br>

  <label for="nro_ingresos_brutos">Número de ingresos brutos:</label><br>
  <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control limpiar" placeholder="Ingrese el número de ingresos brutos" aria-describedby="basic-addon1" value="{{ isset($proveedor->nro_ingresos_brutos) ? $proveedor->nro_ingresos_brutos : '' }}" id="nro_ingresos_brutos" name="nro_ingresos_brutos" maxlength="9">
  <small class="small" id="small-nro_ingresos_brutos"></small>
  <br>

  <label for="jurisdiccion">Jurisdicción:</label><br>
  <input @if ( $mode == "show") readonly @endif  type="text" class="form-control limpiar" placeholder="Ingrese su jurisdicción" aria-describedby="basic-addon1"
value="{{ isset($proveedor->jurisdiccion) ? $proveedor->jurisdiccion : '' }}" id="jurisdiccion" name="jurisdiccion" maxlength="40"><br>

  <label for="tipo_contribuyente">Tipo de contribuyente:</label><br>
  <select @if ( $mode == "show") disabled @endif  class="form-control" aria-describedby="basic-addon1"  id="tipo_contribuyente" name="tipo_contribuyente">
    <option {{ ($proveedor->tipo_contribuyente=="Contribuyente Puro") ? "selected"  : "" }}
value="Contribuyente Puro">Contribuyente Puro</option>
    <option {{ ($proveedor->tipo_contribuyente=="Contribuyente Convenio Multilateral") ? "selected"  : "" }}
value="Contribuyente Convenio Multilateral">Contribuyente Convenio Multilateral</option>
  </select>

  <br>

  <hr>

  <h4>Habilitaciones:</h4><br>

  <label for="nro_habilitacion_municipal">Número de habilitación municipal:</label><br>
  <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control limpiar" placeholder="Ingrese el número de habilitación municipal" aria-describedby="basic-addon1" value="{{ isset($proveedor->nro_habilitacion_municipal) ? $proveedor->nro_habilitacion_municipal : '' }}" id="nro_habilitacion_municipal" name="nro_habilitacion_municipal" maxlength="20">
  <small class="small" id="small-nro_habilitacion_municipal"></small>
  <br>

  <div class="container">
    <div class="row">
      <div class="col-sm">
        <label for="provincia_habilitacion">Provincia:</label><br>
        <select @if ( $mode == "show") disabled @endif  class="form-control" aria-describedby="basic-addon1" id="provincia_habilitacion" name="provincia_habilitacion">
        <option value=" ">Seleccione una provincia</option>
          @forelse($provincias as $provincia)
            @if(!empty($proveedor->localidad_habilitacion))
            @if ($provincia->id_provincia == $localidades->where("id_localidad",$proveedor->localidad_habilitacion)->first()->id_provincia )
            <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>

            @else
            <option value=" ">Seleccione una provincia</option>
            @endif

            @endif
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>


          @empty
            <option value=" "></option>
          @endforelse
        </select>
        <br>
      </div>

      <div class="col-sm">
        <label for="localidad_habilitacion">Localidad:</label><br>
        <select @if ( $mode == "show") disabled @endif  class="form-control" aria-describedby="basic-addon1" id="localidad_habilitacion" name="localidad_habilitacion">
          <option value=" ">Seleccione una localidad</option>
        </select>
        <br>
      </div>
    </div>
<hr>
    <div class="row">

      <div class="col-sm">
        <label for="nro_inscripcion_personas_juridicas">Número de inscripción personas jurídicas:</label><br>
        <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control limpiar" placeholder="Ingrese el número de inscripción de personas jurídicas" aria-describedby="basic-addon1" value="{{ isset($proveedor->nro_inscripcion_personas_juridicas) ? $proveedor->nro_inscripcion_personas_juridicas : '' }}" id="nro_inscripcion_personas_juridicas" name="nro_inscripcion_personas_juridicas" maxlength="4">
        <small class="small" id="small-nro_inscripcion_personas_juridicas"></small>
      </div>

      <div class="col-sm">
        <label for="provincia_inscrip_personas_jur">Provincia:</label><br>
        <select @if ( $mode == "show") disabled @endif  class="form-control" aria-describedby="basic-addon1" value="{{ isset($proveedor->provincia_inscrip_personas_jur) ? $proveedor->provincia_inscrip_personas_jur : '' }}" id="provincia_inscrip_personas_jur" name="provincia_inscrip_personas_jur">
        <option value=" ">Seleccione una provincia</option>
        @foreach($provincias as $provincia)
          @if ($provincia->nombre_provincia ==$proveedor->provincia_inscrip_personas_jur )
            <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @else
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @endif
        @endforeach
        </select>
        <br>
      </div>

    </div>

    <div class="row">

      <div class="col-sm">
        <label for="registro_publico_de_comercio">Registro público de comercio:</label><br>
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control limpiar" placeholder="Ingrese el registro público de comercio" aria-describedby="basic-addon1"
value="{{ isset($proveedor->registro_publico_de_comercio) ? $proveedor->registro_publico_de_comercio : '' }}" id="registro_publico_de_comercio"  name="registro_publico_de_comercio" maxlength="20"><br>
      </div>

      <div class="col-sm">
        <label for="provincia_registro_publico">Provincia:</label><br>
        <select @if ( $mode == "show") disabled @endif  class="form-control" aria-describedby="basic-addon1" id="provincia_registro_publico" name="provincia_registro_publico">
        <option value=" ">Seleccione una provincia</option>
        @foreach($provincias as $provincia)
          @if ($provincia->nombre_provincia ==$proveedor->provincia_registro_publico )
            <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @else
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @endif
        @endforeach
        </select>
        <br>
      </div>

    </div>

    <div class="row">

      <div class="col-sm">
        <label for="inspeccion_gral_justicia">Inspección general de justicia:</label><br>
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control limpiar" placeholder="Ingrese la inspección general de justicia" aria-describedby="basic-addon1"
value="{{ isset($proveedor->inspeccion_gral_justicia) ? $proveedor->inspeccion_gral_justicia : '' }}" name="inspeccion_gral_justicia" maxlength="20"><br>
      </div>

      <div class="col-sm">
        <label for="provincia_inspeccion_justicia">Provincia:</label><br>
        <select @if ( $mode == "show") disabled @endif  class="form-control" aria-describedby="basic-addon1" id="provincia_inspeccion_justicia" name="provincia_inspeccion_justicia">
        <option value=" ">Seleccione una provincia</option>
        @foreach($provincias as $provincia)
          @if ($provincia->nombre_provincia ==$proveedor->provincia_inspeccion_justicia )
            <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @else
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @endif
        @endforeach
        </select>
        <br>
      </div>

    </div>

  </div>

  <br>

  <div class="row navbuttons ">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>

@push('js')

  <script type="text/javascript">

    $('#nro_inscripcion_personas_juridicas').keyup(validarnro_inscripcion_personas_juridicas);

    function validarnro_inscripcion_personas_juridicas() {

        if (!(/^[0-9]+$/.test($('#nro_inscripcion_personas_juridicas').val()))) {
            if($('#nro_inscripcion_personas_juridicas').val() != ""){

            mostrarError('#nro_inscripcion_personas_juridicas', '#small-nro_inscripcion_personas_juridicas', '<div class="alert alert-danger mt-3 pt-1">El <strong>Número de inscripción personas jurídicas</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#nro_inscripcion_personas_juridicas', '#small-nro_inscripcion_personas_juridicas');
        return true;
    }

    $('#nro_ingresos_brutos').keyup(validarnro_ingresos_brutos);

    function validarnro_ingresos_brutos() {

        if (!(/^[0-9]+$/.test($('#nro_ingresos_brutos').val()))) {
            if($('#nro_ingresos_brutos').val() != ""){

            mostrarError('#nro_ingresos_brutos', '#small-nro_ingresos_brutos', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de ingresos brutos</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#nro_ingresos_brutos', '#small-nro_ingresos_brutos');
        return true;
    }

    $('#nro_habilitacion_municipal').keyup(validarnro_habilitacion_municipal);

    function validarnro_habilitacion_municipal() {

        if (!(/^[0-9]+$/.test($('#nro_habilitacion_municipal').val()))) {
            if($('#nro_habilitacion_municipal').val() != ""){

            mostrarError('#nro_habilitacion_municipal', '#small-nro_habilitacion_municipal', '<div class="alert alert-danger mt-3 pt-1">El <strong>Número de habilitación municipal</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#nro_habilitacion_municipal', '#small-nro_habilitacion_municipal');
        return true;
    }



	$(document).ready(function(){

		$('#provincia_habilitacion').change(function(){
			recargarListaHabilitacion();
		});
	})
</script>

<script type="text/javascript">
	function recargarListaHabilitacion(){
		$.ajax({
			type:"GET",
            url:"{{url('localidades')}}/"+$('#provincia_habilitacion').val(),

			success:function(r){
				$('#localidad_habilitacion').html(r);
			}
		});
	}
    function recargarListaHabilitacion2(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/'.$proveedor->localidad_habilitacion)}}",
            success:function(r){
                $('#localidad_habilitacion').html(r);
            }
        });
	}
</script>

@endpush

</fieldset>
