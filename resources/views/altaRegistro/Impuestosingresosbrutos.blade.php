<fieldset>

  <h1>Impuestos sobre ingresos brutos y habilitaciones</h1><br>

  <h4>Ingresos brutos:</h4><br>

  <label for="nro_ingresos_brutos">Número de ingresos brutos:</label><br>
  <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de ingresos brutos" aria-describedby="basic-addon1" id="nro_ingresos_brutos" name="nro_ingresos_brutos" maxlength="9"><br>

  <label for="jurisdiccion">Jurisdicción:</label><br>
  <input type="text" class="form-control" placeholder="Ingrese su jurisdicción" aria-describedby="basic-addon1" id="jurisdiccion" name="jurisdiccion" maxlength="20"><br>

  <label for="tipo_contribuyente">Tipo de contribuyente:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="tipo_contribuyente" name="tipo_contribuyente">
    <option selected value="Contribuyente Puro">Contribuyente Puro</option>
    <option value="Contribuyente Convenio Multilateral">Contribuyente Convenio Multilateral</option>
  </select>

  <br>

  <hr>

  <h4>Habilitaciones:</h4><br>

  <label for="nro_habilitacion_municipal">Número de habilitación municipal:</label><br>
  <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de habilitación municipal" aria-describedby="basic-addon1" id="nro_habilitacion_municipal" name="nro_habilitacion_municipal" maxlength="20"><br>

  <div class="container">
    <div class="row">
      <div class="col-sm">
        <label for="provincia_habilitacion">Provincia:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="provincia_habilitacion" name="provincia_habilitacion">
          <option value=" ">Seleccione una provincia</option>
          @forelse($provincias as $provincia)
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @empty
            <option value=" "></option>
          @endforelse
        </select>
        <br>
      </div>
      <div class="col-sm">
        <label for="localidad_habilitacion">Localidad:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="localidad_habilitacion" name="localidad_habilitacion">
          <option value=" ">Seleccione una localidad</option>
        </select>
        <br>
      </div>
    </div>
<hr>
    <div class="row">
      <div class="col-sm">
        <label for="nro_inscripcion_personas_juridicas">Número de inscripción personas jurídicas:</label><br>
        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de inscripción de personas jurídicas" aria-describedby="basic-addon1" id="nro_inscripcion_personas_juridicas" name="nro_inscripcion_personas_juridicas" maxlength="4"><br>
      </div>

      <div class="col-sm">
        <label for="provincia_inscrip_personas_jur">Provincia:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="provincia_inscrip_personas_jur" name="provincia_inscrip_personas_jur">
          <option value=" ">Seleccione una provincia</option>
          @forelse($provincias as $provincia)
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @empty
            <option value=" "></option>
          @endforelse
        </select>
        <br>
      </div>
    </div>

    <div class="row">
      <div class="col-sm">
        <label for="registro_publico_de_comercio">Registro público de comercio:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el registro público de comercio" aria-describedby="basic-addon1" id="registro_publico_de_comercio" name="registro_publico_de_comercio" maxlength="20"><br>
      </div>

      <div class="col-sm">
        <label for="provincia_registro_publico">Provincia:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="provincia_registro_publico" name="provincia_registro_publico">
          <option value=" ">Seleccione una provincia</option>
          @forelse($provincias as $provincia)
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @empty
            <option value=" "></option>
          @endforelse
        </select>
        <br>
      </div>
    </div>

    <div class="row">
      <div class="col-sm">
        <label for="inspeccion_gral_justicia">Inspección general de justicia:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese la inspección general de justicia" aria-describedby="basic-addon1" id="inspeccion_gral_justicia" name="inspeccion_gral_justicia" maxlength="20"><br>
      </div>

      <div class="col-sm">
        <label for="provincia_inspeccion_justicia">Provincia:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="provincia_inspeccion_justicia" name="provincia_inspeccion_justicia">
          <option value=" ">Seleccione una provincia</option>
          @forelse($provincias as $provincia)
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
          @empty
            <option value=" "></option>
          @endforelse
        </select>
        <br>
      </div>
    </div>
  </div>

  <br>

  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


  <script type="text/javascript">
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
			url:"localidades/"+$('#provincia_habilitacion').val(),
			success:function(r){
				$('#localidad_habilitacion').html(r);
			}
		});
	}
</script>

</fieldset>
