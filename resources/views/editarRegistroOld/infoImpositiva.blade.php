<fieldset>

    <h1>Información Impositiva</h1><br>

    <label for="cuit">Cuit:</label><br>
    <input type="text" class="form-control" placeholder="ingrese el cuit de la empresa" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->cuit) ? $proveedor->cuit : '' }}" id="cuit" name="cuit"><br>

    <!--En este caso, se deben recuperar los datos de la BD -->
    <label for="tipo_de_sociedad">Tipo de sociedad:</label><br>
    <select class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->tipo_de_sociedad) ? $proveedor->tipo_de_sociedad : '' }}" id="tipo_de_sociedad"
        name="tipo_de_sociedad">
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
    <select class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->situacion_iva) ? $proveedor->situacion_iva : '' }}" id="situacion_iva"
        name="situacion_iva">
        <option selected value="M">Masculino</option>
        <option value="F">Femenino</option>
    </select>
    <br>

    <label for="exento_en_cod_de_actividad">Excento en código de actividad:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1"
        placeholder="Ingrese el código de la actividad"
        value="{{ isset($proveedor->exento_en_cod_de_actividad) ? $proveedor->exento_en_cod_de_actividad : '' }}" id="exento_en_cod_de_actividad"
        name="exento_en_cod_de_actividad"><br>

    <!--En este caso, se deben recuperar los datos de la BD -->
    <label for="en_la_provincia_de">En la provincia de:</label><br>
    <select class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->en_la_provincia_de) ? $proveedor->en_la_provincia_de : '' }}" id="en_la_provincia_de"
        name="en_la_provincia_de">
        <option selected value="M">Masculino</option>
        <option value="F">Femenino</option>
    </select>
    <br>

    <p>Corresponde retención:</p>
    <div>
        <input type="radio" value="{{ isset($proveedor->retencion) || $proveedor->retencion != 1 ? $proveedor->retencion : '' }}"
            id="corresponde" name="retencion" checked>
        <label for="corresponde">SI</label>

        <input type="radio" value="{{ isset($proveedor->retencion) || $proveedor->retencion != 0  ? $proveedor->retencion : '' }}"
            id="no-corresponde" name="retencion" >
        <label for="no-corresponde">NO</label>
    </div>

    <label for="motivo-exclusion">Motivo de la exclusión:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1"
        placeholder="En caso de corresponder, indique el motivo"
        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="motivo-exclusion"
        name="motivo-exclusion"><br>

        <div class="row navbuttons pt-5">
            <div class="col-6 col-sm-auto" id="btnPrevious">
                <a class="btn btn-primary btnPrevious">Previous</a>
            </div>
            <div class="col-6 col-sm-auto" id="btnNext">
                <a class="btn btn-primary btnNext">Next</a>
            </div>

        </div>

</fieldset>

