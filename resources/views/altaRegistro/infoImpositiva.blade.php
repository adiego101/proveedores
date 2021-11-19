
<fieldset>

  <h1>Información Impositiva</h1><br>

  <label for="cuit">Cuit:</label><br>
  <input type="text" class="form-control" placeholder="Ingrese el número de cuit de la empresa" aria-describedby="basic-addon1" id="cuit" name="cuit" ><br>

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
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese el código de la actividad en la que se encuentra excento" id="excento_en_cod_de_actividad" name="excento_en_cod_de_actividad" ><br>

  <!--En este caso, se deben recuperar los datos de la BD -->
  <label for="en_la_provincia_de">En la provincia de:</label><br>
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese la provincia en la que se encuentra excento" id="en_la_provincia_de" name="en_la_provincia_de" ><br>


  <div class="row">
    <label>Corresponde retención:</label>
    <div class="form-check">
      <div class="col-sm">
        <input type="radio" id="retencion" name="retencion" value="1" checked>SI
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
<!--
  <h1>Datos del Domicilio fiscal</h1><br>
  <div class="container">
    <div class="row">
      <div class="col-sm">
        <label for="calle_fiscal">Calle:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1"
            id="calle_fiscal" name="calle_fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="numero_fiscal">Número:</label><br>
        <input type="number" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1"
            id="numero_fiscal" name="numero_fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="lote_fiscal">Lote:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_fiscal" name="lote_fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="entreCalles_fiscal">Entre Calles:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_fiscal" name="entreCalles_fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="monoblock_fiscal">Monoblock:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_fiscal" name="monoblock_fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="departamento_fiscal">Departamento:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="departamento_fiscal" name="departamento_fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="puerta_fiscal">Puerta:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_fiscal" name="puerta_fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="oficina_fiscal">Oficina:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1"
            id="oficina_fiscal" name="oficina_fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <label for="manzana_fiscal">Manzana:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_fiscal" name="manzana_fiscal"><br>
      </div>
      <div class="col-sm">
        <label for="barrio_fiscal">Barrio:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1"
            id="barrio_fiscal" name="barrio_fiscal"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm"> -->
        <!--En este caso, se deben recuperar las localidades de la BD -->
       <!-- <label for="localidad_fiscal">Localidad:</label><br>
        <select class="form-control" aria-describedby="basic-addon1" id="localidad_fiscal"
            name="localidad_fiscal">
            <option selected value="M">Localidad 1</option>
            <option value="F">Localidad 2</option>
        </select>
      </div>
      <div class="col-sm">
        <label for="provincia_fiscal">Provincia:</label><br>
        <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia_fiscal"
            name="provincia_fiscal"  disabled><br>
      </div>
    </div>
  </div> -->
  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>

