<fieldset>

    <h1>Datos del Domicilio legal</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_legal">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_legal" name="calle_legal"><br>

                <label for="dpto_legal">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_legal" name="dpto_legal"><br>

                <label for="lote_legal">Lote:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_legal" name="lote_legal"><br>

                <label for="entreCalles_legal">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_legal" name="entreCalles_legal"><br>

                <label for="monoblock_legal">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_legal" name="monoblock_legal"><br>

                <!--En este caso, se deben recuperar las localidades de la BD -->
                <label for="localidad_legal">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_legal" name="localidad_legal">
                    <option selected value="M">Localidad 1</option>
                    <option value="F">Localidad 2</option>
                </select>
                <br>

                <label for="provincia_legal">Provincia:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia_legal"
                    name="provincia_legal"  disabled><br>

                <label for="telefono_legal">Teléfono:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de teléfono"
                    aria-describedby="basic-addon1" id="telefono_legal" name="telefono_legal" ><br>

                <label for="representante_legal">Representante:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el nombre del representante legal" aria-describedby="basic-addon1" id="representante_legal" name="representante_legal" ><br>

                <!-- <label for="fax-legal">Fax:</label><br>
            <input type="text" class="form-control" placeholder="ingrese su fax" aria-describedby="basic-addon1" id="fax-legal" name="fax-legal" ><br> -->


                <!-- <label for="observaciones">Observaciones:</label><br>
                        <textarea id="observaciones" name="observaciones" rows="10" cols="101" placeholder="ingrese las observaciones que considere necesarias"></textarea> -->


            </div>
            <div class="col-sm">

                <label for="numero_legal">Número:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_legal" name="numero_legal"><br>

                <label for="puerta_legal">Puerta:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_legal" name="puerta_legal"><br>

                <label for="manzana_legal">Manzana:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_legal" name="manzana_legal"><br>

                <label for="oficina_legal">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_legal" name="oficina_legal"><br>

                <label for="barrio_legal">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_legal" name="barrio_legal"><br>

                <label for="pais_legal">Pais:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="pais_legal"
                    name="pais_legal"  disabled><br>

                <label for="cp_legal">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp_legal" name="cp_legal" disabled><br>

                <label for="email_legal">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_legal" name="email_legal" ><br>

                <label for="dni_legal">Dni:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el dni del representante legal" aria-describedby="basic-addon1" id="dni_legal" name="dni_legal" ><br>

            </div>
        </div>

    </div>
    
    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
    
</fieldset>
