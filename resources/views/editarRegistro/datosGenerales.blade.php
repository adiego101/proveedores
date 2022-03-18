<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->razon_social) ? $proveedor->razon_social : '' }}" maxlength="50" autofocus><br>

    <label for="nombre_fantasia">Nombre de fantasía:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" maxlength="50"><br>

    <label for="cuit">Cuit:</label><br>
    <input type="text" class="form-control" onkeypress="return valideKey(event);"
        placeholder="Ingrese el número de cuit de la empresa (sin guiones medios)" aria-describedby="basic-addon1" id="cuit" name="cuit"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->cuit) ? $proveedor->cuit : '' }}" maxlength="11"><br>
    <hr>
    <!--FALTA VALIDAR -->
    <br>
    <h1>Representante Legal</h1><br>


    <label for="apellido_persona">Apellido:</label><br>
    <input type="text" @if ( $mode == "show") readonly @endif value="{{ isset($persona->apellido_persona) ? $persona->apellido_persona : '' }}" class="form-control" placeholder="Ingrese el apellido del representante legal" aria-describedby="basic-addon1" id="apellido_persona" name="apellido_persona" maxlength="50"><br>

    <label for="nombre_persona">Nombre:</label><br>
    <input type="text" @if ( $mode == "show") readonly @endif class="form-control" value="{{ isset($persona->nombre_persona) ? $persona->nombre_persona : '' }}" placeholder="Ingrese el nombre completo del representante legal" aria-describedby="basic-addon1" id="nombre_persona" name="nombre_persona" maxlength="50"><br>

    <!--FALTA VALIDAR -->
    <label for="dni_legal">DNI:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el dni del representante legal" @if ( $mode == "show") readonly @endif
value="{{ isset($persona->dni_persona) ? $persona->dni_persona : '' }}" aria-describedby="basic-addon1" id="dni_legal" name="dni_legal" maxlength="8">
    <br>

    <label for="observaciones">Observaciones:</label><br>
    <textarea id="observaciones"   @if ( $mode == "show") readonly @endif name="observaciones" class="form-control" placeholder="Ingrese las observaciones que considere necesarias" maxlength="200">{{ isset($proveedor->observaciones) ? $proveedor->observaciones : '' }}</textarea>
    <br>
    <br>

    <div class="row navbuttons">
        <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>

</fieldset>
