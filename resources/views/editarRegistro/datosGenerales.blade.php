<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1"
        id="razon_social" name="razon_social"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->razon_social) ? $proveedor->razon_social : '' }}" autofocus><br>

    <label for="nombre_fantasia">Nombre de fantasía:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1"
        id="nombre_fantasia" name="nombre_fantasia"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"><br>

    <label for="cuit">Cuit:</label><br>
    <input type="number" class="form-control" onkeypress="return valideKey(event);"
        placeholder="Ingrese el número de cuit de la empresa" aria-describedby="basic-addon1" id="cuit" name="cuit"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->cuit) ? $proveedor->cuit : '' }}"><br>
    <hr>
    <!--FALTA VALIDAR -->
    <br>

    <label for="representante_legal">Representante:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre del representante legal"
        aria-describedby="basic-addon1" id="representante_legal" @if ( $mode == "show") readonly @endif
value="{{ isset($persona->nombre_persona) ? $persona->nombre_persona : '' }}"  name="representante_legal"><br>

    <!--FALTA VALIDAR -->
    <label for="dni_legal">Dni:</label><br>
    <input type="number" onkeypress="return valideKey(event);" class="form-control"

        placeholder="Ingrese el dni del representante legal" @if ( $mode == "show") readonly @endif
value="{{ isset($persona->dni_persona) ? $persona->dni_persona : '' }}" aria-describedby="basic-addon1" id="dni_legal"
        name="dni_legal">
    <br>
    <label for="observaciones">Observaciones:</label><br>
    <textarea id="observaciones"  name="representante_legal" readonly name="observaciones" class="form-control"
        placeholder="ingrese las observaciones que considere necesarias">{{ isset($proveedor->observaciones) ? $proveedor->observaciones : '' }}</textarea>
    <br>
    <br>

    <div class="row navbuttons">
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Siguiente</a>

    </div>
</fieldset>
