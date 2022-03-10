<fieldset>

  <h1>Información Impositiva</h1><br>

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

  <label for="situacion_iva">Situación IVA:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="situacion_iva" name="situacion_iva">
    <option selected value="RESPONSABLE INSCRIPTO">RESPONSABLE INSCRIPTO</option>
    <option value="MONOTRIBUTISTA">MONOTRIBUTISTA</option>
    <option value="NO ALCANZADO">NO ALCANZADO</option>
    <option value="OTROS">OTROS</option>
  </select>
  <br>

  <label for="exento_en_cod_de_actividad">Excento en código de actividad:</label><br>
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese el código de la actividad en la que se encuentra excento" id="exento_en_cod_de_actividad" name="exento_en_cod_de_actividad" maxlength="20"><br>

  <label for="en_la_provincia_de">En la provincia de:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" id="en_la_provincia_de" name="en_la_provincia_de">
    <option value=" ">Seleccione una provincia</option>
    @forelse($provincias as $provincia)
      <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
    @empty
      <option value=" "></option>
    @endforelse
  </select>
  <br>

  <div class="row">
    <label>Corresponde retención:</label>
    <div class="form-check">
      <div class="col-sm">
        <label><input type="radio" id="retencion" name="retencion" value="1" checked>SI</label>
      </div>
      <div class="col-sm">
        <label><input type="radio" id="retencion" name="retencion" value="0">NO</label>
      </div>
    </div>
  </div>

  <br>

  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>
