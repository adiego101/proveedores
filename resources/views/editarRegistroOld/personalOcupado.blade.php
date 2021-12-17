<fieldset>
    <h1>Personal Ocupado</h1>
    <br>
    <label for="empleados_nomina">Empleados en Nomina (Form 931):</label><br>
    <input type="number" class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="empleados_nomina"
        name="empleados_nomina"><br>

    <label for="puestos_trabajo_Sta_Cruz">Puestos de trabajo en la Provincia de Santa Cruz:</label><br>
    <input type="number" class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
        id="puestos_trabajo_Sta_Cruz" name="puestos_trabajo_Sta_Cruz"><br>

    <div class="container">
        <div class="row">
            <div class="col-sm">

                <label for="cant_administrativos">Cantidad de Administrativos:</label><br>
                <input type="number" class="form-control" aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                    id="cant_administrativos" name="cant_administrativos"><br>

                <label for="cant_operarios">Cantidad de Operarios:</label><br>
                <input type="number" class="form-control" aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                    id="cant_operarios" name="cant_operarios"><br>

                <label for="cant_personal_vta">Cantidad Personal de venta:</label><br>
                <input type="number" class="form-control" aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                    id="cant_personal_vta" name="cant_personal_vta"><br>
            </div>
            <div class="col-sm">
                <label for="periodo_contr_administrativos">Periodo Contratacion:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                    id="periodo_contr_administrativos" name="periodo_contr_administrativos"
                    placeholder="Administrativos"><br>

                <label for="periodo_contr_operarios">Periodo Contratacion:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                    id="periodo_contr_operarios" name="periodo_contr_operarios" placeholder="Operarios"><br>

                <label for="periodo_contr_pventas">Periodo Contratacion:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1"
                    value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
                    id="periodo_contr_pventas" name="periodo_contr_pventas" placeholder="Personal Venta"><br>
            </div>
        </div>
    </div>

    <label for="cant_empleados_domicilio_sta_cruz">Cantidad de empleados con domicilio en Santa Cruz:</label><br>
    <input type="number" class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}"
        id="cant_empleados_domicilio_sta_cruz" name="cant_empleados_domicilio_sta_cruz"><br>

    <label for="masa_salarial_bruta">Masa Salarial Bruta:</label><br>
    <input type="number" class="form-control" aria-describedby="basic-addon1"
        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" id="masa_salarial_bruta"
        name="masa_salarial_bruta"><br>

        <div class="row navbuttons pt-5">
            <div class="col-6 col-sm-auto" id="btnPrevious">
                <a class="btn btn-primary btnPrevious">Previous</a>
            </div>
            <div class="col-6 col-sm-auto" id="btnNext">
                <a class="btn btn-primary btnNext">Next</a>
            </div>
        </div>
</fieldset>
