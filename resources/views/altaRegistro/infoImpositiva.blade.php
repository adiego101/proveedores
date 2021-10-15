
<fieldset> 

  <h1>Información Impositiva</h1><br>   

  <label for="cuit">Cuit:</label><br>
  <input type="text" class="form-control" placeholder="ingrese el cuit de la empresa" aria-describedby="basic-addon1" id="cuit" name="cuit" required><br>

  <!--En este caso, se deben recuperar los datos de la BD -->
  <label for="tipo-sociedad">Tipo de sociedad:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="tipo-sociedad" name="tipo-sociedad">
    <option selected value="M">Masculino</option>
    <option value="F">Femenino</option>
  </select>
  <br>


  <!--En este caso, se deben recuperar los datos de la BD -->
  <label for="situacion-iva">Situación IVA:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="situacion-iva" name="situacion-iva">
    <option selected value="M">Masculino</option>
    <option value="F">Femenino</option>
  </select>
  <br>

  <label for="excento-actividad">Excento en código de actividad:</label><br>
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese el código de la actividad" id="excento-actividad" name="excento-actividad" required><br>

  <!--En este caso, se deben recuperar los datos de la BD -->
  <label for="excento-provincia">En la provincia de:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="excento-provincia" name="excento-provincia">
    <option selected value="M">Masculino</option>
    <option value="F">Femenino</option>
  </select>
  <br>

  <p>Corresponde retención:</p>
  <div>
    <input type="radio" id="corresponde" name="retencion" value="si" checked>
    <label for="corresponde">SI</label>

    <input type="radio" id="no-corresponde" name="retencion" value="no">
    <label for="no-corresponde">NO</label>
  </div>

  <label for="motivo-exclusion">Motivo de la exclusión:</label><br>
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="En caso de corresponder, indique el motivo" id="motivo-exclusion" name="motivo-exclusion"><br>
    
  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />    
      
</fieldset>

<fieldset>

  <h1>Impuestos sobre ingresos brutos</h1><br>   

  <label for="ingresos-brutos">Número de ingresos brutos:</label><br>
  <input type="number" class="form-control" placeholder="ingrese el número de ingresos brutos" aria-describedby="basic-addon1" id="ingresos-brutos" name="ingresos-brutos" required><br>

  <label for="jurisdiccion">Jurisdicción:</label><br>
  <input type="text" class="form-control" placeholder="ingrese su jurisdicción" aria-describedby="basic-addon1" id="jurisdiccion" name="jurisdiccion" required><br>

   <!--En este caso, se deben recuperar los datos de la BD -->
   <label for="contribuyente">Tipo de contribuyente:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="contribuyente" name="contribuyente">
    <option selected value="puro">Puro Santa Cruz</option>
    <option value="multilateral">Convenio multilateral</option>
  </select>
  <br>


  <div class="container">
    <div class="row">
      <div class="col-sm">
        <label for="habilitacion-municipal">Número de habilitación municipal:</label><br>
        <input type="number" class="form-control" placeholder="ingrese el número de habilitación municipal" aria-describedby="basic-addon1" id="habilitacion-municipal" name="habilitacion-municipal" required><br>
      </div>
      <div class="col-sm">
        <label for="localidad">Localidad:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la localidad correspondiente" aria-describedby="basic-addon1" id="localidad" name="localidad" required><br>
      </div>
    </div>

    <div class="row">
      <div class="col-sm">
        <label for="inscripcion-juridicas">Número de inscripción personas jurídicas:</label><br>
        <input type="number" class="form-control" placeholder="ingrese el número de inscripción de personas jurídicas" aria-describedby="basic-addon1" id="inscripcion-juridicas" name="inscripcion-juridicas" required><br>
      </div>
      <div class="col-sm">
        <label for="provincia-juridicas">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia-juridicas" name="provincia-juridicas" required><br>
      </div>
    </div>

    <div class="row">
      <div class="col-sm">
        <label for="registro-comercio">Registro público de comercio:</label><br>
        <input type="text" class="form-control" placeholder="ingrese el registro público de comercio" aria-describedby="basic-addon1" id="registro-comercio" name="registro-comercio" required><br>
      </div>
      <div class="col-sm">
        <label for="provincia-comercio">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia-comercio" name="provincia-comercio" required><br>
      </div>
    </div>

    <div class="row">
      <div class="col-sm">
        <label for="inspeccion-justicia">Inspección general de justicia:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la inspección general de justicia" aria-describedby="basic-addon1" id="inspeccion-justicia" name="inspeccion-justicia" required><br>
      </div>
      <div class="col-sm">
        <label for="provincia-justicia">Provincia:</label><br>
        <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente" aria-describedby="basic-addon1" id="provincia-justicia" name="provincia-justicia" required><br>
      </div>
    </div>
  </div>

  <label for="domicilio-fiscal">Domicilio fiscal:</label><br>
  <input type="text" class="form-control" placeholder="ingrese su domicilio fiscal" aria-describedby="basic-addon1" id="domicilio-fiscal" name="domicilio-fiscal" required><br>

  <!--En este caso, se deben recuperar las localidades de la BD -->
  <label for="localidad-fiscal">Localidad fiscal:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="localidad-fiscal" name="localidad-fiscal">
    <option selected value="M">Masculino</option>
    <option value="F">Femenino</option>
  </select>
  <br>

  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />    

</fieldset>
    
