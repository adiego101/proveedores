<fieldset>

  <h1>Información Impositiva</h1><br>

  <label for="tipo_de_sociedad">Tipo de sociedad:</label><br>
  <select class="form-control" aria-describedby="basic-addon1" value="{{ isset($proveedor->tipo_de_sociedad) ? $proveedor->tipo_de_sociedad : '' }}" id="tipo_de_sociedad" name="tipo_de_sociedad">
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
  <select class="form-control" aria-describedby="basic-addon1" value="{{ isset($proveedor->situacion_iva) ? $proveedor->situacion_iva : '' }}" id="situacion_iva" name="situacion_iva">
    <option selected value="RESPONSABLE INSCRIPTO">RESPONSABLE INSCRIPTO</option>
    <option value="MONOTRIBUTISTA">MONOTRIBUTISTA</option>
    <option value="NO ALCANZADO">NO ALCANZADO</option>
    <option value="OTROS">OTROS</option>
  </select>
  <br>

  <label for="exento_en_cod_de_actividad">Excento en código de actividad:</label><br>
  <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese el código de la actividad en la que se encuentra excento" value="{{ isset($proveedor->exento_en_cod_de_actividad) ? $proveedor->exento_en_cod_de_actividad : '' }}" id="exento_en_cod_de_actividad" name="exento_en_cod_de_actividad" ><br>

  <!--En este caso, se deben recuperar las provincias de la BD -->
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
        <input type="radio" value="{{ isset($proveedor->retencion) || $proveedor->retencion != 1 ? $proveedor->retencion : '' }}"
            id="retencion" name="retencion" value="1" checked>SI
      </div>
      <div class="col-sm">
        <input type="radio" value="{{ isset($proveedor->retencion) || $proveedor->retencion != 0  ? $proveedor->retencion : '' }}"  id="retencion" name="retencion" value="0">NO
      </div>
    </div>
  </div>

  <br>

  <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
  <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>
