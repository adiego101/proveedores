<fieldset>
    <h1>Pagos</h1>

    <label for="fecha">Fecha:</label><br>
    <input type="date" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago"
        aria-describedby="basic-addon1" id="fecha" value=""{{ isset($pago->fecha) ? $pago->fecha : '' }} name="fecha"><br>

    <label for="importe">Importe:</label><br>
    <input type="number" class="form-control" onkeypress="return valideKey(event);"
        placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1" value=""{{ isset($pago->importe) ? $pago->importe : '' }} id="importe" name="importe"><br>

    <label for="observaciones">Observaciones:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese las observaciones del pago"
        aria-describedby="basic-addon1" id="observaciones" value=""{{ isset($pago->observaciones) ? $pago->observaciones : '' }} name="observaciones"><br>

</fieldset>
