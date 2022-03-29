<fieldset>
    
    <h1>Personal Ocupado</h1>
    <br>
    <label for="empleados_nomina">Empleados en Nómina (F-931):</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="empleados_nomina" name="empleados_nomina" placeholder="Ingrese la cantidad de empleados en nómina" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->empleados_nomina) ? $proveedor->empleados_nomina : '' }}" maxlength="9"><br>

    <label for="puestos_trabajo_Sta_Cruz">Puestos de trabajo en la Provincia de Santa Cruz:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="puestos_trabajo_Sta_Cruz" name="puestos_trabajo_Sta_Cruz" placeholder="Ingrese la cantidad de puestos de trabajo en la Provincia de Santa Cruz" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->puestos_trabajo_Sta_Cruz) ? $proveedor->puestos_trabajo_Sta_Cruz : '' }}" maxlength="9"><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">

                <label for="cant_administrativos">Cantidad de Administrativos:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cant_administrativos" name="cant_administrativos" placeholder="Ingrese la cantidad total de administrativos" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->cant_administrativos) ? $proveedor->cant_administrativos : '' }}" maxlength="5"><br>

                <label for="cant_operarios">Cantidad de Operarios:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cant_operarios" name="cant_operarios" placeholder="Ingrese la cantidad total de operarios" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->cant_operarios) ? $proveedor->cant_operarios : '' }}" maxlength="5"><br>

                <label for="cant_personal_vta">Cantidad de Personal de venta:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cant_personal_vta" name="cant_personal_vta" placeholder="Ingrese la cantidad total de vendedores" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->cant_personal_vta) ? $proveedor->cant_personal_vta : '' }}" maxlength="5"><br>
            </div>
            <div class="col-sm">
                <label for="periodo_contr_administrativos">Periodo de contratación:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="periodo_contr_administrativos" name="periodo_contr_administrativos" placeholder="Ingrese el periodo de contratación" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->periodo_contr_administrativos) ? $proveedor->periodo_contr_administrativos : '' }}" maxlength="20"><br>

                <label for="periodo_contr_operarios">Periodo de contratación:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="periodo_contr_operarios" name="periodo_contr_operarios" placeholder="Ingrese el periodo de contratación" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->periodo_contr_operarios) ? $proveedor->periodo_contr_operarios : '' }}" maxlength="20"><br>

                <label for="periodo_contr_pventas">Periodo de contratación:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="periodo_contr_pventas" name="periodo_contr_pventas" placeholder="Ingrese el periodo de contratación" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->periodo_contr_pventas) ? $proveedor->periodo_contr_pventas : '' }}" maxlength="20"><br>
            </div>
        </div>
    </div>

    <label for="cant_empleados_domicilio_sta_cruz">Cantidad de empleados con domicilio en Santa Cruz:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cant_empleados_domicilio_sta_cruz" name="cant_empleados_domicilio_sta_cruz" placeholder="Ingrese la cantidad de empleados con domicilio en la Provincia de Santa Cruz" @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->cant_empleados_domicilio_sta_cruz) ? $proveedor->cant_empleados_domicilio_sta_cruz : '' }}" maxlength="5"><br>

    <label for="masa_salarial_bruta">Masa salarial bruta total en la Provincia de Santa Cruz:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="masa_salarial_bruta" name="masa_salarial_bruta" placeholder="Ingrese la masa salarial bruta total en la Provincia de Santa Cruz" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->masa_salarial_bruta) ? $proveedor->masa_salarial_bruta : '' }}" maxlength="9"><br>

    <div class="row navbuttons ">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
        </div>
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Siguiente</a>
        </div>
    </div>

</fieldset>
