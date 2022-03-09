<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social" maxlength="50" autofocus required onkeyup="validaInputDatos()"><br>

    <label for="nombre_fantasia">Nombre de fantasía: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia" maxlength="50" required onkeyup="validaInputDatos()"><br>

    <label for="cuit">CUIT: <sup>*</sup></label><br>
    <input type="text" class="form-control" onkeypress="return valideKey(event);" placeholder="Ingrese el número de cuit de la empresa (sin guiones medios)" aria-describedby="basic-addon1" id="cuit" name="cuit" maxlength="11" required onkeyup="validaInputDatos()"><br>

    <hr>

    <label for="representante_legal">Representante Legal:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre completo del representante legal" aria-describedby="basic-addon1" id="representante_legal" name="representante_legal" maxlength="50"><br>

    <label for="dni_legal">DNI:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el dni del representante legal" aria-describedby="basic-addon1" id="dni_legal" name="dni_legal" maxlength="8">
    <br>

    <label for="observaciones">Observaciones:</label><br>
    <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Ingrese las observaciones que considere necesarias" maxlength="200"></textarea>
    <br>

    <input type="button" id="next_datos" name="next" class="next btn btn-info" value="Siguiente" disabled/>

</fieldset>


@push('js')

<script type="text/javascript">

    let boton_siguiente = document.getElementById("next_datos");
    let razon_social_datos = document.getElementById("razon_social");
    let nombre_fantasia_datos = document.getElementById("nombre_fantasia");
    let cuit_datos = document.getElementById("cuit");

    function validaInputDatos() {
         
        if (razon_social_datos.value.trim() !== "" && nombre_fantasia_datos.value.trim() !== "" && cuit_datos.value.trim() !== "") {
     
            boton_siguiente.removeAttribute('disabled');

        } else {

            boton_siguiente.setAttribute('disabled', "true");
            
        }

    }

</script>

@endpush
