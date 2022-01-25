<fieldset>

  <h1>Información Impositiva</h1><br>

  <label for="tipo_de_sociedad">Tipo de sociedad:</label><br>
  <select  @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1"  id="tipo_de_sociedad" name="tipo_de_sociedad">
    <option {{ ($proveedor->tipo_de_sociedad=="UNIPERSONAL") ? "selected"  : "" }}
value="UNIPERSONAL">UNIPERSONAL</option>
    <option {{ ($proveedor->tipo_de_sociedad=="SOCIEDAD ANONIMA") ? "selected"  : "" }}
value="SOCIEDAD ANONIMA">SOCIEDAD ANONIMA</option>
    <option {{ ($proveedor->tipo_de_sociedad=="SOCIEDAD DE RESPONSABILIDAD LIMITADA") ? "selected"  : "" }}
value="SOCIEDAD DE RESPONSABILIDAD LIMITADA">SOCIEDAD DE RESPONSABILIDAD LIMITADA</option>
    <option {{ ($proveedor->tipo_de_sociedad=="SOCIEDAD DE HECHO") ? "selected"  : "" }}
value="SOCIEDAD DE HECHO">SOCIEDAD DE HECHO</option>
    <option {{ ($proveedor->tipo_de_sociedad=="SOCIEDAD DEL EXTERIOR INSCRIPTA EN EL PAIS") ? "selected"  : "" }}
value="SOCIEDAD DEL EXTERIOR INSCRIPTA EN EL PAIS">SOCIEDAD DEL EXTERIOR INSCRIPTA EN EL PAIS</option>
    <option {{ ($proveedor->tipo_de_sociedad=="SOCIEDAD DEL EXTERIOR NO INSCRIPTA EN EL PAIS") ? "selected"  : "" }}
value="SOCIEDAD DEL EXTERIOR NO INSCRIPTA EN EL PAIS">SOCIEDAD DEL EXTERIOR NO INSCRIPTA EN EL PAIS</option>
    <option {{ ($proveedor->tipo_de_sociedad=="COOPERATIVA") ? "selected"  : "" }}
value="COOPERATIVA">COOPERATIVA</option>
    <option {{ ($proveedor->tipo_de_sociedad=="OTRAS SOCIEDADES") ? "selected"  : "" }}
value="OTRAS SOCIEDADES">OTRAS SOCIEDADES</option>
  </select>
  <br>

  <label for="situacion_iva">Situación IVA:</label><br>
  <select  @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="situacion_iva" name="situacion_iva">
    <option  {{ ($proveedor->situacion_iva=="RESPONSABLE INSCRIPTO") ? "selected"  : "" }}
value="RESPONSABLE INSCRIPTO">RESPONSABLE INSCRIPTO</option>
    <option  {{ ($proveedor->situacion_iva=="MONOTRIBUTISTA") ? "selected"  : "" }}
value="MONOTRIBUTISTA">MONOTRIBUTISTA</option>
    <option  {{ ($proveedor->situacion_iva=="NO ALCANZADO") ? "selected"  : "" }}
value="NO ALCANZADO">NO ALCANZADO</option>
    <option  {{ ($proveedor->situacion_iva=="OTROS") ? "selected"  : "" }}
value="OTROS">OTROS</option>
  </select>
  <br>

  <label for="exento_en_cod_de_actividad">Excento en código de actividad:</label><br>
  <input  @if ( $mode == "show") readonly @endif type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese el código de la actividad en la que se encuentra excento" value="{{ isset($proveedor->exento_en_cod_de_actividad) ? $proveedor->exento_en_cod_de_actividad : '' }}" id="exento_en_cod_de_actividad" name="exento_en_cod_de_actividad" maxlength="20"><br>

  <label for="en_la_provincia_de">En la provincia de:</label><br>
  <select  @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="en_la_provincia_de" name="en_la_provincia_de">
    <option value=" ">Seleccione una provincia</option>
    @forelse($provincias as $provincia)
        @if ($provincia->nombre_provincia ==$proveedor->en_la_provincia_de )
            <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
        @else
            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
        @endif    
    @empty
      <option value=" "></option>
    @endforelse
  </select>
  <br>

  <div class="row">
    <label>Corresponde retención:</label>
    <div class="form-check">
      <div class="col-sm">
        <input  @if ( $mode == "show") disabled @endif type="radio" {{ ($proveedor->retencion=="1") ? "checked"  : "" }} id="retencion" name="retencion" value="1" >SI
      </div>
      <div class="col-sm">
        <input  @if ( $mode == "show") disabled @endif type="radio" {{ ($proveedor->retencion=="0") ? "checked"  : "" }}  id="retencion" name="retencion" value="0" >NO
      </div>
    </div>
  </div>

  <br>

  <div class="row navbuttons ">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-primary btnPrevious">Anterior</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>

</fieldset>
