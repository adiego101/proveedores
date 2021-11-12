<fieldset>
    <h1>Pagos</h1>
    <br>
    <label for="tipo_proveedor">Tipo de Proovedor:</label><br>
    <div class="container">
        <!-- CAMBIO FORMA DE UTILIZAR CHECKBOX
        <div class="row">
            <div class="col-sm">
                <input type="checkbox" id="prov_estado"  value="0"   name="prov_estado">
                <label for="prov_estado">Proveedor del Estado</label><br>
                <input type="checkbox" id="prov_minero"  value="0"   name="prov_minero">
                <label for="prov_minero">Proveedor Minero</label><br>

            </div>
            <div class="col-sm">
                <input type="checkbox" id="prov_petrolero"  value="0"   name="prov_petrolero">
                <label for="prov_petrolero">Proveedor Petrolero</label><br>
                <input type="checkbox" id="prov_provincial"  value="0"   name="prov_provincial">
                <label for="prov_provincial">Proveedor Provincial</label><br>
            </div>
        </div>
        -->
        <div class="form-check">
            <div class="row">
                <div class="col col-md-6">
                    <input class="form-check-input tipo_proveedor" type="checkbox" name="tipo_proveedor[]" value="PROVEEDOR DEL ESTADO">PROVEEDOR DEL ESTADO<br>
                    <input class="form-check-input tipo_proveedor" type="checkbox" name="tipo_proveedor[]" value="PROVEEDOR MINERO">PROVEEDOR MINERO<br>
                    <input class="form-check-input tipo_proveedor" type="checkbox" name="tipo_proveedor[]" value="PROVEEDOR PETROLERO">PROVEEDOR PETROLERO<br>
                    <input class="form-check-input tipo_proveedor" type="checkbox" name="tipo_proveedor[]" value="PRODUCTOR PROVINCIAL">PRODUCTOR PROVINCIAL<br>
                </div>
            </div>
        </div>
    <br>
    <!-- CAMBIO Registro de Pagos de inscripción y renovación: POR UN TITULO EN LUGAR DE UN CAMPO DE TEXTO
    <label for="registro-pagos-inscripccion">Registro de Pagos de inscripción y renovación:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="registro-pagos-inscripccion"
        name="registro-pagos-inscripccion" required><br>
    <hr>
    -->
    <h5>Registro de Pagos de inscripción y renovación:</h5><br>

    <label for="fecha-pago">Fecha:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago" aria-describedby="basic-addon1" id="fecha-pago" name="fecha-pago"
        required><br>

    <label for="importe-pago">Importe:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1" id="importe-pago" name="importe-pago"
        required><br>

    <label for="observaciones-pago">Observaciones:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese las observaciones del pago" aria-describedby="basic-addon1" id="observaciones-pago" name="observaciones-pago"
        required><br>

    <h5>Completar solo si desea Registrar Baja del registro:</h5><br>

    <label for="fecha_baja">Fecha de baja:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="fecha_baja" name="fecha_baja"
        ><br>

    <label for="motivo_baja">Motivo de Baja:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="motivo_baja" name="motivo_baja"
        ><br>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />

    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
    <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>


</fieldset>
