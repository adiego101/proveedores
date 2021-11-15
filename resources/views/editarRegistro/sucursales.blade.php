<fieldset>

    <div class="row">
        <div class="col-sm">
            <h1>Sucursales</h1>
        </div>
        <div class="col-sm">
            <a href="javascript:void(0);" class="add_button" title="Agregue una nueva sucursal"><input type="button"
                    value="Agregar sucursal"></a>
        </div>
    </div>

    <br>

    <div class="field_wrapper">
        <div>
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

                </div>

            </div>

            <label for="localidad">Localidad:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Localidad"
                value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="localidad"
                name="Localidades[]"><br>

            <label for="nro_tel">Telefono:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" placeholder="Número de teléfono"
                value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="nro_tel"
                name="Telefonos-sucursales[]"><br>

            <label for="email">Correo electrónico:</label><br>
            <input type="email" class="form-control" aria-describedby="basic-addon1" placeholder="ejemplo@dominio.com"
                value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="email"
                name="Correos-electronicos[]"><br>

        </div>
    </div>


    <br>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />

    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Cantidad maxima de campos (sucursales) a agregar
            var addButton = $('.add_button');
            var wrapper = $('.field_wrapper');

            //Nuevo campo html (agregar una nueva sucursal)
            var fieldHTML = '<div>' +
                '<hr>' +
                '<div class="row">' +
                '<div class="col-sm">' +

                '<label for="calle">Calle:</label><br>' +
                '<input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="calle" name="calles[]"><br>' +

                '<label for="numero">Numero:</label><br>' +
                '<input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="numero" name="numeros[]"><br>' +

                '<label for="lote">Lote:</label><br>' +
                '<input type="text" class="form-control" placeholder="Lote" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="lote" name="lotes[]"><br>' +

                '<label for="entre_calles">Entre Calle:</label><br>' +
                '<input type="text" class="form-control" placeholder="Entre Calles" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="entre_calles" name="entreCalles[]"><br>' +

                '<label for="monoblock">Monoblock:</label><br>' +
                '<input type="text" class="form-control" placeholder="Monoblock" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="monoblock" name="monoblocks[]"><br>' +

                '</div>' +

                '<div class="col-sm">' +

                '<label for="dpto">Departamento:</label><br>' +
                '<input type="text" class="form-control" placeholder="Departamento" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="dpto" name="dptos[]"><br>' +

                '<label for="puerta">Puerta:</label><br>' +
                '<input type="text" class="form-control" placeholder="Puerta" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="puerta" name="puertas[]"><br>' +

                '<label for="oficina">Oficina:</label><br>' +
                '<input type="text" class="form-control" placeholder="Oficina" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="oficina" name="oficinas[]"><br>' +

                '<label for="manzana">Manzana:</label><br>' +
                '<input type="text" class="form-control" placeholder="Manzana" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="manzana" name="manzanas[]"><br>' +

                '<label for="barrio">Barrio:</label><br>' +
                '<input type="text" class="form-control" placeholder="Barrio" aria-describedby="basic-addon1" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="barrio" name="barrios[]"><br>' +

                '</div>' +

                '</div>' +

                '<label for="localidad">Localidad:</label><br>' +
                '<input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Localidad" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="localidad" name="Localidades[]"><br>' +

                '<label for="nro_tel">Telefono:</label><br>' +
                '<input type="number" class="form-control" aria-describedby="basic-addon1" placeholder="Número de teléfono" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="nro_tel" name="Telefonos-sucursales[]"><br>' +

                '<label for="email">Correo electrónico:</label><br>' +
                '<input type="email" class="form-control" aria-describedby="basic-addon1" placeholder="ejemplo@dominio.com" value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="email" name="Correos-electronicos[]"><br>' +

                '<a href="javascript:void(0);" class="remove_button" title="Elimine la sucursal"><input type="button" value="Eliminar sucursal"></a>' +

                '</div>';


            var x = 1; //Contador inicial, comienza en 1
            $(addButton).click(function() {
                if (x <
                    maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                    x++; //Incrementa el contador en 1
                    $(wrapper).append(fieldHTML); // Agrega un nuevo campo html (sucursal)
                }
            });
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remueve un campo html (sucursal)
                x--; //Decrementa el contador en 1
            });
        });
    </script>

</fieldset>
