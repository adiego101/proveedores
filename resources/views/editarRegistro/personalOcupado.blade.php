<fieldset>

    <h1>Personal Ocupado</h1>
    <br>
    <label for="empleados_nomina">Empleados en Nómina (F-931):</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="empleados_nomina" name="empleados_nomina" placeholder="Ingrese la cantidad de empleados en nómina" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->empleados_nomina) ? $proveedor->empleados_nomina : '' }}" maxlength="6">
    <small class="small" id="small-empleados_nomina"></small>
    <br>

    <label for="puestos_trabajo_sta_cruz">Puestos de trabajo en la Provincia de Santa Cruz:</label><br>
    <input type="text" value="{{ isset($proveedor->puestos_trabajo_sta_cruz) ? $proveedor->puestos_trabajo_sta_cruz : '' }}" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="puestos_trabajo_sta_cruz" name="puestos_trabajo_sta_cruz" placeholder="Ingrese la cantidad de puestos de trabajo en la Provincia de Santa Cruz" @if ( $mode == "show") readonly @endif  maxlength="6">
    <small class="small" id="small-puestos_trabajo_sta_cruz"></small>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-sm">

                <label for="cant_administrativos">Cantidad de Administrativos:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cant_administrativos" name="cant_administrativos" placeholder="Ingrese la cantidad total de administrativos" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->cant_administrativos) ? $proveedor->cant_administrativos : '' }}" maxlength="5">
                <small class="small" id="small-cant_administrativos"></small>
                <br>

                <label for="cant_operarios">Cantidad de Operarios:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cant_operarios" name="cant_operarios" placeholder="Ingrese la cantidad total de operarios" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->cant_operarios) ? $proveedor->cant_operarios : '' }}" maxlength="5">
                <small class="small" id="small-cant_operarios"></small>
                <br>

                <label for="cant_personal_vta">Cantidad de Personal de venta:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="cant_personal_vta" name="cant_personal_vta" placeholder="Ingrese la cantidad total de vendedores" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->cant_personal_vta) ? $proveedor->cant_personal_vta : '' }}" maxlength="5">
                <small class="small" id="small-cant_personal_vta"></small>
                <br>
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
value="{{ isset($proveedor->cant_empleados_domicilio_sta_cruz) ? $proveedor->cant_empleados_domicilio_sta_cruz : '' }}" maxlength="5">
<small class="small" id="small-cant_empleados_domicilio_sta_cruz"></small>
<br>

    <label for="masa_salarial_bruta">Masa salarial bruta total en la Provincia de Santa Cruz:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="masa_salarial_bruta" name="masa_salarial_bruta" placeholder="Ingrese la masa salarial bruta total en la Provincia de Santa Cruz" @if ( $mode == "show") readonly @endif value="{{ isset($proveedor->masa_salarial_bruta) ? $proveedor->masa_salarial_bruta : '' }}" maxlength="9">
    <small class="small" id="small-masa_salarial_bruta"></small>
    <br>

    <div class="row navbuttons ">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
        </div>
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Siguiente</a>
        </div>
    </div>

</fieldset>


@push('js')

<script type="text/javascript">

    $('#empleados_nomina').keyup(validarempleados_nomina);

    function validarempleados_nomina() {

        if (!(/^[0-9]/.test($('#empleados_nomina').val()))) {

            mostrarError('#empleados_nomina', '#small-empleados_nomina', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de Empleados en Nómina</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
        }
        ocultarError('#empleados_nomina', '#small-empleados_nomina');
        return true;
    }


    $('#puestos_trabajo_sta_cruz').keyup(validarpuestos_trabajo_Sta_Cruz);

    function validarpuestos_trabajo_Sta_Cruz() {

        if (!(/^[0-9]/.test($('#puestos_trabajo_sta_cruz').val()))) {

            mostrarError('#puestos_trabajo_sta_cruz', '#small-puestos_trabajo_sta_cruz', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de Puestos de trabajo</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
        }
        ocultarError('#puestos_trabajo_sta_cruz', '#small-puestos_trabajo_sta_cruz');
        return true;
    }


    $('#masa_salarial_bruta').keyup(validarmasa_salarial_bruta);

    function validarmasa_salarial_bruta() {

        if (!(/^[0-9]/.test($('#masa_salarial_bruta').val()))) {

            mostrarError('#masa_salarial_bruta', '#small-masa_salarial_bruta', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de masa salarial</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
        }
        ocultarError('#masa_salarial_bruta', '#small-masa_salarial_bruta');
        return true;
    }


    $('#cant_empleados_domicilio_sta_cruz').keyup(validarcant_empleados_domicilio_sta_cruz);

    function validarcant_empleados_domicilio_sta_cruz() {

        if (!(/^[0-9]/.test($('#cant_empleados_domicilio_sta_cruz').val()))) {

            mostrarError('#cant_empleados_domicilio_sta_cruz', '#small-cant_empleados_domicilio_sta_cruz', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de Cantidad de empleados</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
        }
        ocultarError('#cant_empleados_domicilio_sta_cruz', '#small-cant_empleados_domicilio_sta_cruz');
        return true;
    }


    $('#cant_administrativos').keyup(validarcant_administrativos);

    function validarcant_administrativos() {

        if (!(/^[0-9]/.test($('#cant_administrativos').val()))) {

            mostrarError('#cant_administrativos', '#small-cant_administrativos', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de Cantidad de administrativos</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
        }
        ocultarError('#cant_administrativos', '#small-cant_administrativos');
        return true;
    }


    $('#cant_operarios').keyup(validarcant_operarios);

    function validarcant_operarios() {

        if (!(/^[0-9]/.test($('#cant_operarios').val()))) {

            mostrarError('#cant_operarios', '#small-cant_operarios', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de Cantidad de Operarios</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
        }
        ocultarError('#cant_operarios', '#small-cant_operarios');
        return true;
    }


    $('#cant_personal_vta').keyup(validarcant_personal_vta);

    function validarcant_personal_vta() {

        if (!(/^[0-9]/.test($('#cant_personal_vta').val()))) {

            mostrarError('#cant_personal_vta', '#small-cant_personal_vta', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de Cantidad de Personal de ventas</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
        }
        ocultarError('#cant_personal_vta', '#small-cant_personal_vta');
        return true;
    }

</script>

@endpush
