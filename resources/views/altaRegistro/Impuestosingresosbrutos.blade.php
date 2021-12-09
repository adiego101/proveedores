<fieldset>

  <h1>Impuestos sobre ingresos brutos</h1><br>

  <label for="nro_ingresos_brutos">Número de ingresos brutos:</label><br>
  <input type="number" class="form-control" placeholder="Ingrese el número de ingresos brutos" aria-describedby="basic-addon1" id="nro_ingresos_brutos" name="nro_ingresos_brutos" ><br>

  <label for="jurisdiccion">Jurisdicción:</label><br>
  <input type="text" class="form-control" placeholder="Ingrese su jurisdicción" aria-describedby="basic-addon1" id="jurisdiccion" name="jurisdiccion" ><br>

   <!--En este caso, se deben recuperar los datos de la BD -->
   <label for="tipo_contribuyente">Tipo de contribuyente:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="tipo_contribuyente" name="tipo_contribuyente">
    <option selected value="Contribuyente Puro">Contribuyente Puro</option>
    <option value="Contribuyente Convenio Multilateral">Contribuyente Convenio Multilateral</option>
  </select>
  <br>


  <div class="container">
    <div class="row">
      <div class="col-sm">
        <label for="nro_habilitacion_municipal">Número de habilitación municipal:</label><br>
        <input type="number" class="form-control" placeholder="Ingrese el número de habilitación municipal" aria-describedby="basic-addon1" id="nro_habilitacion_municipal" name="nro_habilitacion_municipal" ><br>
      </div>
      <div class="col-sm">
        <label for="localidad_habilitacion">Localidad:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese la localidad correspondiente" aria-describedby="basic-addon1" id="localidad_habilitacion" name="localidad_habilitacion" ><br>
      </div>
    </div>

    <div class="row">

      <div class="col-sm">
        <label for="nro_inscripcion_personas_juridicas">Número de inscripción personas jurídicas:</label><br>
        <input type="number" class="form-control" placeholder="Ingrese el número de inscripción de personas jurídicas" aria-describedby="basic-addon1" id="nro_inscripcion_personas_juridicas" name="nro_inscripcion_personas_juridicas" ><br>
      </div>

      <div class="col-sm">
        <label for="provincia_inscrip_personas_jur">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia_inscrip_personas_jur" name="provincia_inscrip_personas_jur" ><br>
      </div>

    </div>

    <div class="row">

      <div class="col-sm">
        <label for="registro_publico_de_comercio">Registro público de comercio:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el registro público de comercio" aria-describedby="basic-addon1" id="registro_publico_de_comercio" name="registro_publico_de_comercio" ><br>
      </div>

      <div class="col-sm">
        <label for="provincia_registro_publico">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia_registro_publico" name="provincia_registro_publico" ><br>
      </div>

    </div>

    <div class="row">

      <div class="col-sm">
        <label for="inspeccion_gral_justicia">Inspección general de justicia:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese la inspección general de justicia" aria-describedby="basic-addon1" id="inspeccion_gral_justicia" name="inspeccion_gral_justicia" ><br>
      </div>

      <div class="col-sm">
        <label for="provincia_inspeccion_justicia">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia_inspeccion_justicia" name="provincia_inspeccion_justicia" ><br>
      </div>

    </div>

  </div>
  <!-- CAMBIO POR NUEVO FORMATO DE DOMICILIO
  <label for="domicilio-fiscal">Domicilio fiscal:</label><br>
  <input type="text" class="form-control" placeholder="ingrese su domicilio fiscal" aria-describedby="basic-addon1" id="domicilio-fiscal" name="domicilio-fiscal" ><br>

  En este caso, se deben recuperar las localidades de la BD
  <label for="localidad-fiscal">Localidad fiscal:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="localidad-fiscal" name="localidad-fiscal">
    <option selected value="M">Masculino</option>
    <option value="F">Femenino</option>
  </select>
  <br>
  -->
  <br>
  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
</fieldset>
