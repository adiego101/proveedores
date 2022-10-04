<div class="row">
    <div class="col-sm">
        <label for="tipo_disposicion">Tipo de disposición: <sup>*</sup></label><br>
        <select required id="tipo_disposicion" class="form-control" aria-label="Tipo disposicion">
            <option value="">Seleccione un tipo de disposicion</option>
            <option value="inscripcion">INSCRIPCION</option>
            <option value="renovacion">RENOVACION</option>
            <option value="actualizacion">ACTUALIZACION</option>
        </select>
    </div>
    <div class="col-sm">
        <label for="nro_expte_gde">Nro Expediente GDE: <sup>*</sup></label><br>
        <input type="text" class="form-control" placeholder="Ingrese el número de expediente de GDE" aria-describedby="basic-addon1" id="nro_expte_gde" name="nro_expte_gde"
            @if ( $mode == "show") readonly @endif value="" maxlength="50" autofocus required>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm">
    <label for="fecha_inicio_disposicion">Fecha inicio de vigencia: <sup>*</sup></label><br>
    <input type="date" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="fecha_inicio_disposicion" name="fecha_inicio_disposicion"
        @if ( $mode == "show") readonly @endif value="" autofocus required>
    </div>
    <div class="col-sm">
    <label for="fecha_fin_disposicion">Fecha fin de vigencia: <sup>*</sup></label><br>
    <input type="date" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="fecha_fin_disposicion" name="fecha_fin_disposicion"
        @if ( $mode == "show") readonly @endif value="" autofocus required>
    </div>
</div>
<br>
<label for="observaciones_disposicion">Observaciones:</label><br>
<textarea id="observaciones_disposicion"   @if ( $mode == "show") readonly @endif name="observaciones_disposicion" class="form-control" placeholder="Ingrese las observaciones que considere necesarias" maxlength="200"></textarea>
