<fieldset>

    <h1>Datos del domicilio real</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle-real">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1"
                    id="calle-real" name="calle-real"><br>

                <label for="numero-real">Numero:</label><br>
                <input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1"
                    id="numero-real" name="numero-real"><br>

                <label for="lote-real">Lote:</label><br>
                <input type="text" class="form-control" placeholder="lote:" aria-describedby="basic-addon1"
                    id="lote-real" name="lote-real"><br>

                <label for="entreCalles-real">Entre Calle:</label><br>
                <input type="text" class="form-control" placeholder="Entre Calles:" aria-describedby="basic-addon1"
                    id="entreCalles-real" name="entreCalles-real"><br>

                <label for="monoblock-real">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Monoblock:" aria-describedby="basic-addon1"
                    id="monoblock-real" name="monoblock-real"><br>

                <!--En este caso, se deben recuperar las localidades de la BD -->
                <label for="localidad-real">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad-real" name="localidad-real">
                    <option selected value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <br>
                <label for="provincia-real">Provincia:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia-real"
                    name="provincia-real"  disabled><br>

                <label for="telefono-real">Teléfono:</label><br>
                <input type="number" class="form-control" placeholder="ingrese su teléfono"
                    aria-describedby="basic-addon1" id="telefono-real" name="telefono-real" ><br>

                <label for="email-real">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ingrese su correo electrónico"
                    aria-describedby="basic-addon1" id="email-real" name="email-real" ><br>



            </div>
            <div class="col-sm">
                <label for="dpto-real">Dpto:</label><br>
                <input type="text" class="form-control" placeholder="Dpto" aria-describedby="basic-addon1"
                    id="dpto-real" name="dpto-real"><br>

                <label for="puerta-real">Puerta:</label><br>
                <input type="number" class="form-control" placeholder="Puerta" aria-describedby="basic-addon1"
                    id="puerta-real" name="puerta-real"><br>

                <label for="oficina-real">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Oficina:" aria-describedby="basic-addon1"
                    id="oficina-real" name="oficina-real"><br>

                <label for="manzana-real">Manzana:</label><br>
                <input type="text" class="form-control" placeholder="Manzana:" aria-describedby="basic-addon1"
                    id="manzana-real" name="manzana-real"><br>

                <label for="barrio-real">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Barrio:" aria-describedby="basic-addon1"
                    id="barrio-real" name="barrio-real"><br>



                <label for="pais-real">Pais:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="pais-real"
                    name="pais-real"  disabled><br>

                <label for="cp-real">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp-real" name="cp-real"
                     disabled><br>


                <label for="web-real">Página web:</label><br>
                <input type="text" class="form-control" placeholder="ingrese su página web"
                    aria-describedby="basic-addon1" id="web-real" name="web-real" ><br>


            </div>
        </div>


    </div>

        <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
        <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
</fieldset>
