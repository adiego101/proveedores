<fieldset>

    <h1>Datos del domicilio fiscal</h1><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_fiscal">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_fiscal" name="calle_fiscal"><br>

                <label for="dpto_fiscal">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_fiscal" name="dpto_fiscal"><br>

                <label for="lote_fiscal">Lote:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_fiscal" name="lote_fiscal"><br>

                <label for="entreCalles_fiscal">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_fiscal" name="entreCalles_fiscal"><br>

                <label for="monoblock_fiscal">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_fiscal" name="monoblock_fiscal"><br>

                <!--En este caso, se deben recuperar los paises de la BD -->
                <label for="pais_fiscal">Pais:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="pais_fiscal" name="pais_fiscal">
                    @foreach($paises as $pais)
                    <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @endforeach
                </select>
                <br>

                <!--En este caso, se deben recuperar las localidades de la BD -->
                <label for="localidad_fiscal">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_fiscal" name="localidad_fiscal">
                    @foreach($localidades as $localidad)
                    <option selected value="{{$localidad->nombre_localidad}}">{{$localidad->nombre_localidad}}</option>
                    @endforeach
                </select>
                <br>

                <label for="web_fiscal">Página web:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la página web"
                    aria-describedby="basic-addon1" id="web_fiscal" name="web_fiscal" ><br>

                <label for="email_fiscal">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_fiscal" name="email_fiscal[]" ><br>
                <div class="field_email_fiscal">

                </div>
                <label for="telefono_fiscal">Teléfono:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_fiscal" name="telefono_fiscal[]" >
                <div class="field_telefono_fiscal">

                </div>
            </div>
            <div class="col-sm">

                <label for="numero_fiscal">Número:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_fiscal" name="numero_fiscal"><br>

                <label for="puerta_fiscal">Puerta:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_fiscal" name="puerta_fiscal"><br>

                <label for="manzana_fiscal">Manzana:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_fiscal" name="manzana_fiscal"><br>

                <label for="oficina_fiscal">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_fiscal" name="oficina_fiscal"><br>

                <label for="barrio_fiscal">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_fiscal" name="barrio_fiscal"><br>

                <!--En este caso, se deben recuperar las provincias de la BD -->
                <label for="provincia_fiscal">Provincia:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="provincia_fiscal" name="provincia_fiscal">
                    @foreach($provincias as $provincia)
                    <option selected value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @endforeach
                </select>
                <br>

                <label for="cp_fiscal">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp_fiscal" name="cp_fiscal" placeholder="Ingrese el código postal"><br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_email_fiscal" title="Agregue un nuevo correo"><input type="button" value="Agregar Correo" class="btn btn-success"></a>
                </div>
                <br>
                <br>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_fiscal" title="Agregue un nuevo teléfono"><input type="button" value="Agregar Teléfono" class="btn btn-success"></a>
                </div>
            </div>
        </div>

    </div>
    <br>
        <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
        <input type="button" name="next" class="next btn btn-info" value="Siguiente" />



        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
        var addTelefono_fiscal = $('.add_telefono_fiscal');
        var wrapper_telefono_fiscal = $('.field_telefono_fiscal');


        //Nuevo campo html (agregar un nuevo teléfono)
        var fieldHTML_telefono_fiscal = '<div>'+
                                 '<br>'+
                                    '<label for="telefono_fiscal">Teléfono:</label><br>'+
                                    '<input type="number" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_fiscal" name="telefono_fiscal[]" >'+
                                    '<a href="javascript:void(0);" class="remove_telefono_fiscal" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                 '<br>'+
                                '</div>';


        var x = 1; //Contador inicial, comienza en 1
        $(addTelefono_fiscal).click(function() {
            if (x < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                x++; //Incrementa el contador en 1
                $(wrapper_telefono_fiscal).append(fieldHTML_telefono_fiscal); // Agrega un nuevo campo html (telefono)
            }
        });
        $(wrapper_telefono_fiscal).on('click', '.remove_telefono_fiscal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (telefono)
            x--; //Decrementa el contador en 1
        });



        var addEmail_fiscal = $('.add_email_fiscal');
        var wrapper_email_fiscal = $('.field_email_fiscal');

        //Nuevo campo html (agregar un nuevo correo)
        var fieldHTML_email_fiscal = '<div>'+
                                    '<label for="email_fiscal">Correo electrónico:</label><br>'+
                                    '<input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_fiscal" name="email_fiscal[]" >'+
                                    '<a href="javascript:void(0);" class="remove_email_fiscal" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                    '<br>'+
                                    '<br>'+
                                '</div>';



        var i = 1; //Contador inicial, comienza en 1
        $(addEmail_fiscal).click(function() {
            if (i < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                i++; //Incrementa el contador en 1
                $(wrapper_email_fiscal).append(fieldHTML_email_fiscal); // Agrega un nuevo campo html (correo)
            }
        });
        $(wrapper_email_fiscal).on('click', '.remove_email_fiscal', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remueve un campo html (correo)
            i--; //Decrementa el contador en 1
        });
    });
</script>
</fieldset>
