<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->razon_social) ? $proveedor->razon_social : '' }}" maxlength="50" autofocus required><br>

    <label for="nombre_fantasia">Nombre de fantasía: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" maxlength="50" required><br>

    <label for="cuit">CUIT: <sup>*</sup></label><br>
    <input type="text" class="form-control" onkeypress="return valideKey(event);"
        placeholder="Ingrese el número de cuit de la empresa (sin guiones medios)" aria-describedby="basic-addon1" id="cuit" name="cuit"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->cuit) ? $proveedor->cuit : '' }}" maxlength="11" required>
    <small class="small" id="small-cuit"></small>
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


        $('#cuit').keyup(validarCuit);

        function validarCuit() {

            if (!(/^[0-9]+$/.test($('#cuit').val()))) {
                if($('#cuit').val() != ""){
                mostrarError('#cuit', '#small-cuit', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de CUIT</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#cuit', '#small-cuit');
            return true;
        }



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

    </script>

@endpush
