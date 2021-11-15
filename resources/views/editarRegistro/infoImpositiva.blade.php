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
        <option selected value="M">Masculino</option>
        <option value="F">Femenino</option>
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

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>

<fieldset>

    <h1>Impuestos sobre ingresos brutos</h1><br>

    <label for="nro_ingresos_brutos">Número de ingresos brutos:</label><br>
    <input type="number" class="form-control" placeholder="ingrese el número de ingresos brutos"
        aria-describedby="basic-addon1"
        value="{{ isset($proveedor->nro_ingresos_brutos) ? $proveedor->nro_ingresos_brutos : '' }}" id="nro_ingresos_brutos"
        name="nro_ingresos_brutos"><br>

    <label for="jurisdiccion">Jurisdicción:</label><br>
    <input type="text" class="form-control" placeholder="ingrese su jurisdicción" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->jurisdiccion) ? $proveedor->jurisdiccion : '' }}" id="jurisdiccion"
        name="jurisdiccion"><br>

    <!--En este caso, se deben recuperar los datos de la BD -->
    <label for="tipo_contribuyente">Tipo de tipo_contribuyente:</label><br>
    <select class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->tipo_contribuyente) ? $proveedor->tipo_contribuyente : '' }}" id="tipo_contribuyente"
        name="tipo_contribuyente">
        <option selected value="puro">Puro Santa Cruz</option>
        <option value="multilateral">Convenio multilateral</option>
    </select>
    <br>


    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="nro_habilitacion_municipal">Número de habilitación municipal:</label><br>
                <input type="number" class="form-control" placeholder="ingrese el número de habilitación municipal"
                    aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->nro_habilitacion_municipal) ? $proveedor->nro_habilitacion_municipal : '' }}"
                    id="nro_habilitacion_municipal" name="nro_habilitacion_municipal"><br>
            </div>
            <div class="col-sm">
                <label for="localidad_habilitacion">localidad:</label><br>
                <input type="text" class="form-control" placeholder="ingrese la localidad correspondiente"
                    aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->localidad_habilitacion) ? $proveedor->localidad_habilitacion : '' }}"
                    id="localidad_habilitacion" name="localidad_habilitacion"><br>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <label for="nro_inscripcion_personas_juridicas">Número de inscripción personas jurídicas:</label><br>
                <input type="number" class="form-control"
                    placeholder="ingrese el número de inscripción de personas jurídicas" aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->nro_inscripcion_personas_juridicas) ? $proveedor->nro_inscripcion_personas_juridicas : '' }}"
                    id="nro_inscripcion_personas_juridicas" name="nro_inscripcion_personas_juridicas"><br>
            </div>
            <div class="col-sm">
                <label for="provincia_inscrip_personas_jur">Provincia:</label><br>
                <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente"
                    aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->provincia_inscrip_personas_jur) ? $proveedor->provincia_inscrip_personas_jur : '' }}"
                    id="provincia_inscrip_personas_jur" name="provincia_inscrip_personas_jur"><br>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <label for="registro_publico_de_comercio">Registro público de comercio:</label><br>
                <input type="text" class="form-control" placeholder="ingrese el registro público de comercio"
                    aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->registro_publico_de_comercio) ? $proveedor->registro_publico_de_comercio : '' }}"
                    id="registro_publico_de_comercio" name="registro_publico_de_comercio"><br>
            </div>
            <div class="col-sm">
                <label for="provincia_registro_publico">Provincia:</label><br>
                <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente"
                    aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->provincia_registro_publico) ? $proveedor->provincia_registro_publico : '' }}"
                    id="provincia_registro_publico" name="provincia_registro_publico"><br>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <label for="inspeccion_gral_justicia">Inspección general de justicia:</label><br>
                <input type="text" class="form-control" placeholder="ingrese la inspección general de justicia"
                    aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->inspeccion_gral_justicia) ? $proveedor->inspeccion_gral_justicia : '' }}"
                    id="inspeccion_gral_justicia" name="inspeccion_gral_justicia"><br>
            </div>
            <div class="col-sm">
                <label for="provincia_inspeccion_justicia">Provincia:</label><br>
                <input type="text" class="form-control" placeholder="ingrese la provincia correspondiente"
                    aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->provincia_inspeccion_justicia) ? $proveedor->provincia_inspeccion_justicia : '' }}"
                    id="provincia_inspeccion_justicia" name="provincia_inspeccion_justicia"><br>
            </div>
        </div>
    </div>

    <label for="dom_fiscal">Domicilio fiscal:</label><br>
    <input type="text" class="form-control" placeholder="ingrese su domicilio fiscal" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->dom_fiscal) ? $proveedor->dom_fiscal : '' }}" id="dom_fiscal"
        name="dom_fiscal"><br>

    <!--En este caso, se deben recuperar las localidad_habilitaciones de la BD -->
    <label for="localidad-fiscal">localidad fiscal:</label><br>
    <select class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->localidad_fiscal) ? $proveedor->localidad_fiscal : 'Campo a modelar' }}" id="localidad-fiscal"
        name="localidad-fiscal">
        <option selected value="M">Masculino</option>
        <option value="F">Femenino</option>
    </select>
    <br>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>
