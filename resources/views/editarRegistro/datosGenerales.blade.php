<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->razon_social) ? $proveedor->razon_social : '' }}" maxlength="50" autofocus required>
<small class="small" id="small-razon_social2"></small>
<br>

    <label for="nombre_fantasia">Nombre de fantasía: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" maxlength="50" required>
<small class="small" id="small-nombre_fantasia2"></small>
<br>

    <label for="cuit">CUIT: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el número de cuit de la empresa (sin guiones medios)" aria-describedby="basic-addon1" id="cuit" name="cuit"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->cuit) ? $proveedor->cuit : '' }}" maxlength="13" pattern="^([0-9]{2})-([0-9]{7}|[0-9]{8})-([0-9]{1})$" required>
    <small class="small" id="small-cuit3"></small>
    <small class="small" id="small-cuit1"></small>
    <br>

    <label for="observaciones">Observaciones:</label><br>
    <textarea id="observaciones"   @if ( $mode == "show") readonly @endif name="observaciones" class="form-control" placeholder="Ingrese las observaciones que considere necesarias" maxlength="200">{{ isset($proveedor->observaciones) ? $proveedor->observaciones : '' }}</textarea>
    <br>
    <hr>
    <br>
    <h1>Representante Legal</h1><br>

    <label for="apellido_persona">Apellido:</label><br>
    <input type="text" @if ( $mode == "show") readonly @endif value="{{ isset($persona->apellido_persona) ? $persona->apellido_persona : '' }}" class="form-control limpiar" placeholder="Ingrese el apellido del representante legal" aria-describedby="basic-addon1" id="apellido_persona" name="apellido_persona" maxlength="50"><br>

    <label for="nombre_persona">Nombre:</label><br>
    <input type="text" @if ( $mode == "show") readonly @endif class="form-control limpiar" value="{{ isset($persona->nombre_persona) ? $persona->nombre_persona : '' }}" placeholder="Ingrese el nombre completo del representante legal" aria-describedby="basic-addon1" id="nombre_persona" name="nombre_persona" maxlength="50"><br>

    <label for="dni_legal">DNI:</label><br>
    <input type="text" class="form-control limpiar" placeholder="Ingrese el dni del representante legal" @if ( $mode == "show") readonly @endif
value="{{ isset($persona->dni_persona) ? $persona->dni_persona : '' }}" aria-describedby="basic-addon1" id="dni_legal" name="dni_legal" maxlength="12">
    <small class="small" id="small-dni2"></small>

    <br>
    <br>

    <div class="row navbuttons">
        <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>

</fieldset>


@push('js')

    <script type="text/javascript">

        $('#dni_legal').keyup(validarDni);

        function validarDni() {

            if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test($('#dni_legal').val()))) {
            if($('#dni_legal').val() != ""){

            mostrarError('#dni_legal', '#small-dni', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI</strong> tiene un formato incorrecto.</div>');
            mostrarError('#dni_legal', '#small-dni2', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI</strong> tiene un formato incorrecto.</div>');

            return false;
            }
        }
        ocultarError('#dni_legal', '#small-dni');
        ocultarError('#dni_legal', '#small-dni2');

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

        if (!(/^([0-9]{2})-([0-9]{7}|[0-9]{8})-([0-9]{1})$/g.test($('#cuit').val()))) {

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

    </script>

@endpush
