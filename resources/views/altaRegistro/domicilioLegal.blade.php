<fieldset>
    <h1>Datos del Domicilio legal</h1><br>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle-legal">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1"
                    id="calle-legal" name="calle-legal"><br>

                <label for="numero-legal">Numero:</label><br>
                <input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1"
                    id="numero-legal" name="numero-legal"><br>

                <label for="lote-legal">Lote:</label><br>
                <input type="text" class="form-control" placeholder="lote:" aria-describedby="basic-addon1"
                    id="lote-legal" name="lote-legal"><br>

                <label for="entreCalles-legal">Entre Calle:</label><br>
                <input type="text" class="form-control" placeholder="Entre Calles:" aria-describedby="basic-addon1"
                    id="entreCalles-legal" name="entreCalles-legal"><br>

                <label for="monoblock-legal">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Monoblock:" aria-describedby="basic-addon1"
                    id="monoblock-legal" name="monoblock-legal"><br>

                <!--En este caso, se deben recuperar las localidades de la BD -->
                <label for="localidad-legal">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad-legal"
                    name="localidad-legal">
                    <option selected value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <br>
                <label for="provincia-legal">Provincia:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia-legal"
                    name="provincia-legal" required disabled><br>

                <label for="telefono-legal">Teléfono:</label><br>
                <input type="number" class="form-control" placeholder="ingrese su teléfono"
                    aria-describedby="basic-addon1" id="telefono-legal" name="telefono-legal" required><br>
                <!-- <label for="fax-legal">Fax:</label><br>
            <input type="text" class="form-control" placeholder="ingrese su fax" aria-describedby="basic-addon1" id="fax-legal" name="fax-legal" required><br> -->


                <!-- <label for="observaciones">Observaciones:</label><br>
                        <textarea id="observaciones" name="observaciones" rows="10" cols="101" placeholder="ingrese las observaciones que considere necesarias"></textarea> -->


            </div>
            <div class="col-sm">
                <label for="dpto-legal">Dpto:</label><br>
                <input type="text" class="form-control" placeholder="Dpto" aria-describedby="basic-addon1"
                    id="dpto-legal" name="dpto-legal"><br>

                <label for="puerta-legal">Puerta:</label><br>
                <input type="number" class="form-control" placeholder="Puerta" aria-describedby="basic-addon1"
                    id="puerta-legal" name="puerta-legal"><br>

                <label for="oficina-legal">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Oficina:" aria-describedby="basic-addon1"
                    id="oficina-legal" name="oficina-legal"><br>

                <label for="manzana-legal">Manzana:</label><br>
                <input type="text" class="form-control" placeholder="Manzana:" aria-describedby="basic-addon1"
                    id="manzana-legal" name="manzana-legal"><br>

                <label for="barrio-legal">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Barrio:" aria-describedby="basic-addon1"
                    id="barrio-legal" name="barrio-legal"><br>



                <label for="pais-legal">Pais:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="pais-legal"
                    name="pais-legal" required disabled><br>

                <label for="cp-legal">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp-legal" name="cp-legal"
                    required disabled><br>

                <label for="email-legal">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ingrese su correo electrónico"
                    aria-describedby="basic-addon1" id="email-legal" name="email-legal" required><br>


            </div>
        </div>

    </div>
    <label for="representante-legal">Representante:</label><br>
    <input type="text" class="form-control" placeholder="ingrese el nombre del representante legal"
        aria-describedby="basic-addon1" id="representante-legal" name="representante-legal" required><br>

    <label for="dni-legal">Dni:</label><br>
    <input type="number" class="form-control" placeholder="ingrese el dni del representante legal"
        aria-describedby="basic-addon1" id="dni-legal" name="dni-legal" required><br>


    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
</fieldset>
