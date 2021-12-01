<fieldset>

    <h1>Datos del domicilio real</h1><br>
  
    <div class="container">
        <div class="row">
            <div class="col-sm field_wrapper">
                <label for="calle_real">Calle:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_real" name="calle_real"><br>

                <label for="dpto_real">Departamento:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_real" name="dpto_real"><br>

                <label for="lote_real">Lote:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_real" name="lote_real"><br>

                <label for="entreCalles_real">Entre Calles:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_real" name="entreCalles_real"><br>

                <label for="monoblock_real">Monoblock:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_real" name="monoblock_real"><br>

                <!--En este caso, se deben recuperar las localidades de la BD -->
                <label for="localidad_real">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_real" name="localidad_real">
                    <option selected value="M">Localidad 1</option>
                    <option value="F">Localidad 2</option>
                </select>
                <br>

                <label for="provincia_real">Provincia:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia_real"
                    name="provincia_real"  disabled><br>

                <label for="email_real">Correo electrónico:</label><br>
                <input type="email" class="form-control" placeholder="ejemplo@dominio.com"
                    aria-describedby="basic-addon1" id="email_real" name="email_real" ><br>

                <label for="telefono_real">Teléfono:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" >
                       
            </div>
            <div class="col-sm">
             
                <label for="numero_real">Número:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_real" name="numero_real"><br>

                <label for="puerta_real">Puerta:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta_real" name="puerta_real"><br>

                <label for="manzana_real">Manzana:</label><br>
                <input type="number" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_real" name="manzana_real"><br>

                <label for="oficina_real">Oficina:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_real" name="oficina_real"><br>

                <label for="barrio_real">Barrio:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_real" name="barrio_real"><br>

                <label for="pais_real">Pais:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="pais_real"
                    name="pais_real"  disabled><br>

                <label for="cp_real">Código Postal:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp_real" name="cp_real" disabled><br>

                <label for="web_real">Página web:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese la página web"
                    aria-describedby="basic-addon1" id="web_real" name="web_real" ><br>
                    <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_button" title="Agregue un nuevo teléfono"><input type="button" value="Agregar Teléfono" class="btn btn-success"></a>
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
            var maxField = 3; //Cantidad máxima de campos (teléfonos) a agregar
            var addButton = $('.add_button');
            var wrapper = $('.field_wrapper');

            //Nuevo campo html (agregar un nuevo teléfono)
            var fieldHTML = '<div>'+
                                '<br>'+
                                '<label for="telefono_real">Teléfono:</label><br>' +
                                '<input type="number" class="form-control" aria-describedby="basic-addon1" placeholder="Ingrese el número de teléfono" id="telefono_real" name="telefono_real[]">' + 
                                '<a href="javascript:void(0);" class="remove_button" title="Elimine el teléfono"><input type="button" value="Eliminar"></a>'+
                                '<br>'+
                            '</div>';


            var x = 1; //Contador inicial, comienza en 1
            $(addButton).click(function() {
                if (x < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
                    x++; //Incrementa el contador en 1
                    $(wrapper).append(fieldHTML); // Agrega un nuevo campo html (teléfono)
                }
            });
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remueve un campo html (teléfono)
                x--; //Decrementa el contador en 1
            });
        });
    </script>
</fieldset>
