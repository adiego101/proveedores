
<fieldset>

  <h1>Información Impositiva</h1><br>

  <label for="cuit">Cuit:</label><br>
  <input type="text" class="form-control" placeholder="ingrese el cuit de la empresa" aria-describedby="basic-addon1" id="cuit" name="cuit" ><br>

  <!--En este caso, se deben recuperar los datos de la BD -->
  <label for="tipo_de_sociedad">Tipo de sociedad:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="tipo_de_sociedad" name="tipo_de_sociedad">
    <option selected value="UNIPERSONAL">UNIPERSONAL</option>
    <option value="SOCIEDAD ANONIMA">SOCIEDAD ANONIMA</option>
    <option value="SOCIEDAD DE RESPONSABILIDAD LIMITADA">SOCIEDAD DE RESPONSABILIDAD LIMITADA</option>
    <option value="SOCIEDAD DE HECHO">SOCIEDAD DE HECHO</option>
    <option value="SOCIEDAD DEL EXTERIOR INSCRIPTA EN EL PAIS">SOCIEDAD DEL EXTERIOR INSCRIPTA EN EL PAIS</option>
    <option value="SOCIEDAD DEL EXTERIOR NO INSCRIPTA EN EL PAIS">SOCIEDAD DEL EXTERIOR NO INSCRIPTA EN EL PAIS</option>
    <option value="COOPERATIVA">COOPERATIVA</option>
    <option value="OTRAS SOCIEDADES">OTRAS SOCIEDADES</option>
  </select>
  <br>


  <!--En este caso, se deben recuperar los datos de la BD -->
  <label for="situacion_iva">Situación IVA:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="situacion_iva" name="situacion_iva">
    <option selected value="RESPONSABLE INSCRIPTO">RESPONSABLE INSCRIPTO</option>
    <option value="MONOTRIBUTISTA">MONOTRIBUTISTA</option>
    <option value="NO ALCANZADO">NO ALCANZADO</option>
    <option value="OTROS">OTROS</option>
  </select>
  <br>

  <label for="excento_en_cod_de_actividad">Excento en código de actividad:</label><br>
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese el código de la actividad en la que se encuentra excento" id="excento_en_cod_de_actividad" name="excento_en_cod_de_actividad" required><br>

  <!--En este caso, se deben recuperar los datos de la BD -->
  <label for="en_la_provincia_de">En la provincia de:</label><br>
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese la provincia en la que se encuentra excento" id="en_la_provincia_de" name="en_la_provincia_de" required><br>

  
  <div class="row">
    <label>Corresponde retención:</label>
    <div class="form-check">
      <div class="col-sm">
        <input type="radio" id="retencion" name="retencion" value="1">SI
      </div>
      <div class="col-sm">
        <input type="radio" id="retencion" name="retencion" value="0">NO
      </div>
    </div>
  </div>
  <!-- NI EN EL FORMULARIO NI EN LA BASE DE DATOS SE SOLICITA UN MOTIVO DE EXCLUSION
  <label for="motivo-exclusion">Motivo de la exclusión:</label><br>
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="En caso de corresponder, indique el motivo" id="motivo-exclusion" name="motivo-exclusion"><br>
  -->
  <br>
  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>

<fieldset>

  <h1>Impuestos sobre ingresos brutos</h1><br>

  <label for="nro_ingresos_brutos">Número de ingresos brutos:</label><br>
  <input type="number" class="form-control" placeholder="ingrese el número de ingresos brutos" aria-describedby="basic-addon1" id="nro_ingresos_brutos" name="nro_ingresos_brutos" required><br>

  <label for="jurisdiccion">Jurisdicción:</label><br>
  <input type="text" class="form-control" placeholder="ingrese su jurisdicción" aria-describedby="basic-addon1" id="jurisdiccion" name="jurisdiccion" ><br>

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
        <input type="number" class="form-control" placeholder="ingrese el número de habilitación municipal" aria-describedby="basic-addon1" id="nro_habilitacion_municipal" name="nro_habilitacion_municipal" required><br>
      </div>
      <div class="col-sm">
        <label for="localidad_habilitacion">Localidad:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la localidad correspondiente" aria-describedby="basic-addon1" id="localidad_habilitacion" name="localidad_habilitacion" required><br>
      </div>
    </div>

    <div class="row">
      <div class="col-sm">
        <label for="nro_inscripcion_personas_juridicas">Número de inscripción personas jurídicas:</label><br>
        <input type="number" class="form-control" placeholder="ingrese el número de inscripción de personas jurídicas" aria-describedby="basic-addon1" id="nro_inscripcion_personas_juridicas" name="nro_inscripcion_personas_juridicas" required><br>
      </div>
      <div class="col-sm">
        <label for="provincia_inscrip_personas_jur">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia-juridicas" name="provincia-juridicas" required><br>
      </div>
    </div>

    <div class="row">
      <div class="col-sm">
        <label for="registro_publico_de_comercio">Registro público de comercio:</label><br>
        <input type="text" class="form-control" placeholder="ingrese el registro público de comercio" aria-describedby="basic-addon1" id="registro_publico_de_comercio" name="registro_publico_de_comercio" required><br>
      </div>
      <div class="col-sm">
        <label for="provincia_registro_publico">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia_registro_publico" name="provincia_registro_publico" required><br>
      </div>
    </div>

    <div class="row">
      <div class="col-sm">
        <label for="inspeccion_gral_justicia">Inspección general de justicia:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la inspección general de justicia" aria-describedby="basic-addon1" id="inspeccion_gral_justicia" name="inspeccion_gral_justicia" required><br>
      </div>
      <div class="col-sm">
        <label for="provincia_inspeccion_justicia">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia_inspeccion_justicia" name="provincia_inspeccion_justicia" required><br>
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
  <h1>Datos del Domicilio fiscal</h1><br>
  <div class="container">
    <div class="row">
      <div class="col-sm">
        <label for="calle-fiscal">Calle:</label><br>
        <input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1"
            id="calle-fiscal" name="calle-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="numero-fiscal">Numero:</label><br>
        <input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1"
            id="numero-fiscal" name="numero-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="lote-fiscal">Lote:</label><br>
        <input type="text" class="form-control" placeholder="lote:" aria-describedby="basic-addon1"
            id="lote-fiscal" name="lote-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="entreCalles-fiscal">Entre Calle:</label><br>
        <input type="text" class="form-control" placeholder="Entre Calles:" aria-describedby="basic-addon1"
            id="entreCalles-fiscal" name="entreCalles-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="monoblock-fiscal">Monoblock:</label><br>
        <input type="text" class="form-control" placeholder="Monoblock:" aria-describedby="basic-addon1"
            id="monoblock-fiscal" name="monoblock-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="departamento-fiscal">Departamento:</label><br>
        <input type="text" class="form-control" placeholder="Departamento:" aria-describedby="basic-addon1"
            id="departamento-fiscal" name="departamento-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="puerta-fiscal">Puerta:</label><br>
        <input type="text" class="form-control" placeholder="Puerta:" aria-describedby="basic-addon1"
            id="puerta-fiscal" name="puerta-fiscal"><br>    
      </div>
      <div class="col-sm">
        <label for="oficina-fiscal">Oficina:</label><br>
        <input type="text" class="form-control" placeholder="Oficina:" aria-describedby="basic-addon1"
            id="oficina-fiscal" name="oficina-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="manzana-fiscal">Manzana:</label><br>
        <input type="text" class="form-control" placeholder="Manzana:" aria-describedby="basic-addon1"
            id="manzana-fiscal" name="manzana-fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="barrio-fiscal">Barrio:</label><br>
        <input type="text" class="form-control" placeholder="Barrio:" aria-describedby="basic-addon1"
            id="barrio-fiscal" name="barrio-fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <!--En este caso, se deben recuperar las localidades de la BD -->
        <label for="localidad-fiscal">Localidad:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="localidad-fiscal"
            name="localidad-fiscal">
            <option selected value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
      </div>
      <div class="col-sm">
        <label for="provincia-fiscal">Provincia:</label><br>
        <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia-fiscal"
            name="provincia-fiscal" required disabled><br>
      </div>
    </div>
  </div>
  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>

