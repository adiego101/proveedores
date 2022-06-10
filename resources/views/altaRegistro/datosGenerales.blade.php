<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social" maxlength="50" autofocus required value="{{old('razon_social')}}">
    <small class="small" id="small-razon_social2"></small>
    <br>

    <label for="nombre_fantasia">Nombre de fantasía: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia" maxlength="50" required value="{{old('nombre_fantasia')}}">
    <small class="small" id="small-nombre_fantasia2"></small>
    <br>

    <label for="cuit">CUIT: <sup>*</sup></label><br>
    <input type="text" value="{{ isset($cuit) ? $cuit : '' }}" class="form-control" placeholder="Ingrese el número de cuit" aria-describedby="basic-addon1" id="cuit" name="cuit" maxlength="13" pattern="^([0-9]{2})-([0-9]{8})-([0-9]{1})$" required>
    <small class="small" id="small-cuit3"></small>
    <small class="small" id="small-cuit1"></small>
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

/*
    $("#document").ready(function(){

       

        if($("#razon_social").val()!='' && $("#nombre_fantasia").val() && $("#cuit").val())
            $("#next_datos").removeAttr("disabled");
        else
            $("#next_datos").attr("disabled", "disabled");
    });
*/


    $('#dni_legal').keyup(validardni_legal);

    function validardni_legal() {

        if (!(/^(\d{2}\.{1}\d{3}\.\d{3})|(\d{1}\.{1}\d{3}\.\d{3})$/g.test($('#dni_legal').val()))) {
            if($('#dni_legal').val() != ""){

            mostrarError('#dni_legal', '#small-dni_legal', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI</strong> tiene un formato incorrecto.</div>');
            mostrarError('#dni_legal', '#small-dni_legal2', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI</strong> tiene un formato incorrecto.</div>');

            return false;
            }
        }
        ocultarError('#dni_legal', '#small-dni_legal');
        ocultarError('#dni_legal', '#small-dni_legal2');

        return true;
    }


    $('#razon_social').keyup(validar_razon_social);

    function validar_razon_social() {

            if($('#razon_social').val() == ""){

            mostrarError('#razon_social', '#small-razon_social', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');
            mostrarError('#razon_social', '#small-razon_social2', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');

            return false;
            }
        
        ocultarError('#razon_social', '#small-razon_social');
        ocultarError('#razon_social', '#small-razon_social2');

        return true;
    }



    $('#nombre_fantasia').keyup(validar_nombre_fantasia);

    function validar_nombre_fantasia() {

            if($('#nombre_fantasia').val() == ""){

            mostrarError('#nombre_fantasia', '#small-nombre_fantasia', '<div class="alert alert-danger mt-3 pt-1">El nombre de fantasía <strong>no</strong> puede quedar vacío.</div>');
            mostrarError('#nombre_fantasia', '#small-nombre_fantasia2', '<div class="alert alert-danger mt-3 pt-1">El nombre de fantasía <strong>no</strong> puede quedar vacío.</div>');

            return false;
            }
        
        ocultarError('#nombre_fantasia', '#small-nombre_fantasia');
        ocultarError('#nombre_fantasia', '#small-nombre_fantasia2');

        return true;
    }



    $('#cuit').keyup(validar_cuit);

    function validar_cuit() {

        if (!(/^([0-9]{2})-([0-9]{8})-([0-9]{1})$/g.test($('#cuit').val()))) {

            mostrarError('#cuit', '#small-cuit1', '<div class="alert alert-danger mt-3 pt-1">El CUIT debe respetar el siguiente formato: <strong>xx-xxxxxxx-x</strong></div>');
            mostrarError('#cuit', '#small-cuit2', '<div class="alert alert-danger mt-3 pt-1">El CUIT debe respetar el siguiente formato: <strong>xx-xxxxxxx-x</strong></div>');

            if($('#cuit').val() == ""){

            mostrarError('#cuit', '#small-cuit3', '<div class="alert alert-danger mt-3 pt-1">El CUIT <strong>no</strong> puede quedar vacío.</div>');
            mostrarError('#cuit', '#small-cuit4', '<div class="alert alert-danger mt-3 pt-1">El CUIT <strong>no</strong> puede quedar vacío.</div>');

            return false;
            }
        }
        
        ocultarError('#cuit', '#small-cuit1');
        ocultarError('#cuit', '#small-cuit2');
        ocultarError('#cuit', '#small-cuit3');
        ocultarError('#cuit', '#small-cuit4');

        return true;
    }


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
