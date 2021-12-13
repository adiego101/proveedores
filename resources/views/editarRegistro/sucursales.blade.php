<fieldset>

    <div class="row">
        <h1>Sucursales</h1>
    </div>

    <br>


            <div class="row">
                <div class="col-sm">

                    <label for="calle">Calle:</label><br>
                    <input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="calle"
                        name="calles[]"><br>

                    <label for="numero">Numero:</label><br>
                    <input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                        id="numero" name="numeros[]"><br>

                    <label for="lote">Lote:</label><br>
                    <input type="text" class="form-control" placeholder="Lote" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="lote"
                        name="lotes[]"><br>

                    <label for="entre_calles">Entre Calle:</label><br>
                    <input type="text" class="form-control" placeholder="Entre Calles" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                        id="entre_calles" name="entreCalles[]"><br>

                    <label for="monoblock">Monoblock:</label><br>
                    <input type="text" class="form-control" placeholder="Monoblock" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                        id="monoblock" name="monoblocks[]"><br>

                    <label for="localidad">Localidad:</label><br>
                    <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Localidad"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="localidad"
                        name="Localidades[]"><br>

                    <label for="email">Correo electrónico:</label><br>
                    <input type="email" class="form-control" aria-describedby="basic-addon1" placeholder="ejemplo@dominio.com"
                        id="email"
                        name="Correos-electronicos[]"><br>

                </div>

                <div class="col-sm">

                    <label for="dpto">Departamento:</label><br>
                    <input type="text" class="form-control" placeholder="Departamento" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="dpto"
                        name="dptos[]"><br>

                    <label for="puerta">Puerta:</label><br>
                    <input type="text" class="form-control" placeholder="Puerta" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                        id="puerta" name="puertas[]"><br>

                    <label for="oficina">Oficina:</label><br>
                    <input type="text" class="form-control" placeholder="Oficina" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                        id="oficina" name="oficinas[]"><br>

                    <label for="manzana">Manzana:</label><br>
                    <input type="text" class="form-control" placeholder="Manzana" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                        id="manzana" name="manzanas[]"><br>

                    <label for="barrio">Barrio:</label><br>
                    <input type="text" class="form-control" placeholder="Barrio" aria-describedby="basic-addon1"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                        id="barrio" name="barrios[]"><br>

                    <label for="nro_tel">Telefono:</label><br>
                    <input type="number" class="form-control" aria-describedby="basic-addon1" placeholder="Número de teléfono"
                        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="nro_tel"
                        name="Telefonos-sucursales[]"><br><br>


                        <a id="add_sucursal" class="btn btn-success">Agregar Sucursal</a>
                </div>

            </div>



    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Calle</th>
                    <th>Barrio</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table">

            </tbody>
        </table>

    </div>

    <br>

    <div class="row navbuttons pt-5">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-primary btnPrevious">Previous</a>
        </div>
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Next</a>
        </div>
    </div>



    <script type="text/javascript">
        let calle;
        let barrio;
        let telefono;
        let i = 1; //contador para asignar id al boton que borrara la fila
        $("#add_sucursal").on('click', function(e) {
            calle = $("#calle").val();
            barrio = $("#barrio").val();
            telefono = $("#nro_tel").val();

            $("#body_table").append('<tr id="row' + i + '"><td>' + calle + '</td><td>' + barrio + '</td><td>' + telefono + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Quitar</button></td></tr>');

            i++;

            document.getElementById("calle").value = "";
            document.getElementById("numero").value = "";
            document.getElementById("lote").value = "";
            document.getElementById("entre_calles").value = "";
            document.getElementById("monoblock").value = "";
            document.getElementById("localidad").value = "";
            document.getElementById("email").value = "";
            document.getElementById("dpto").value = "";
            document.getElementById("puerta").value = "";
            document.getElementById("oficina").value = "";
            document.getElementById("manzana").value = "";
            document.getElementById("barrio").value = "";
            document.getElementById("nro_tel").value = "";


            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                //cuando da click obtenemos el id del boton
                $('#row' + button_id + '').remove(); //borra la fila

            });

        });
    </script>

</fieldset>
