<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social" maxlength="50" autofocus required value="{{old('razon_social')}}">
    <br>

    <label for="nombre_fantasia">Nombre de fantasía: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia" maxlength="50" required value="{{old('nombre_fantasia')}}">
    <br>

    <label for="cuit">CUIT: <sup>*</sup></label><br>
    <input type="text" value="{{ isset($cuit) ? $cuit : '' }}" class="form-control" placeholder="Ingrese el número de cuit" aria-describedby="basic-addon1" id="cuit" name="cuit" maxlength="13" pattern="^([0-9]{2})-([0-9]{8})-([0-9]{1})$" required>
    <br>

    <label for="observaciones">Observaciones:</label><br>
    <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Ingrese las observaciones que considere necesarias" maxlength="200" value="{{old('observaciones')}}"></textarea>
    <br>

    <hr>

    <h1>Representante Legal</h1><br>


    <label for="apellido_persona">Apellido:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el apellido del representante legal" aria-describedby="basic-addon1" id="apellido_persona" name="apellido_persona" maxlength="50" value="{{old('apellido_persona')}}"><br>

    <label for="nombre_persona">Nombre:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre completo del representante legal" aria-describedby="basic-addon1" id="nombre_persona" name="nombre_persona" maxlength="50" value="{{old('nombre_persona')}}"><br>

    <label for="dni_legal">DNI:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el dni del representante legal" aria-describedby="basic-addon1" id="dni_legal" name="dni_legal" maxlength="10" value="{{old('dni_legal')}}" pattern="^(\d{2}\.{1}\d{3}\.\d{3})|(\d{1}\.{1}\d{3}\.\d{3})$">
    <small class="small" id="small-dni_legal2"></small>
    <br>
    <br>
    <input type="button" id="next_datos" name="next" class="next btn btn-info" value="Siguiente"/>

</fieldset>


@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $("#next_datos").click(function(){
            if($("#razon_social").val()=='')
                mostrarError('#razon_social', '#small-razon-social-head', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');
            else
                ocultarError('#razon_social', '#small-razon-social-head');
            if($("#nombre_fantasia").val()=='')
                mostrarError('#nombre_fantasia', '#small-nombre-fantasia-head', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');
            else
                ocultarError('#nombre_fantasia', '#small-nombre-fantasia-head');
        });
    })
//DESCOMENTAR UNA VEZ QUE SE DESCARGUEN LAS LIBRERIAS LOCALMENTE EN EL SERVIDOR.
//Esta funcion habilita o deshabilita el boton siguiente segun el completado de los campos obligatorios
/*
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
*/

/*Ademas se debe agregar el siguiente atributo a los inputs:

    -Razon social
    -Nombre de fantasia
    -CUIT

    onkeyup="validaInputDatos()"
*/

</script>

@endpush
