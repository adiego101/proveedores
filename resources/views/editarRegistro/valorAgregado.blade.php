<fieldset>

    <h1>Valor Agregado</h1><br>

    <h4>Para servicios:</h4><br>

    <input type="checkbox" @if (isset($proveedor->servicio_atencion_cliente) ? $proveedor->servicio_atencion_cliente : '0') checked
    value="1"
@else value="0" @endif
    id="servicio_atencion_cliente" name="servicio_atencion_cliente">
    <label for="servicio_atencion_cliente">Posee servicio de atención al cliente</label><br>

    <input type="checkbox" @if (isset($proveedor->servicio_post_venta) ? $proveedor->servicio_post_venta : '0') checked
    value="1"
@else value="0" @endif
    id="servicio_post_venta" name="servicio_post_venta">
    <label for="servicio_post_venta">Posee servicio post venta</label><br>

    <input type="checkbox" @if (isset($proveedor->servicio_personal_especializado) ? $proveedor->servicio_personal_especializado : '0') checked
    value="1"
@else value="0" @endif id="servicio_personal_especializado" name="servicio_personal_especializado">
    <label for="servicio_personal_especializado">Posee personal especializado en el área</label><br>

    <input type="checkbox" @if (isset($proveedor->servicio_entrega_a_domicilio) ? $proveedor->servicio_entrega_a_domicilio : '0') checked
    value="1"
@else value="0" @endif id="servicio_entrega_a_domicilio" name="servicio_entrega_a_domicilio">
    <label for="servicio_entrega_a_domicilio">Posee servicio de entrega a domicilio o lugar de destino</label><br>

    <input type="checkbox" @if (isset($proveedor->servicio_capacitacion_personal) ? $proveedor->servicio_capacitacion_personal : '0') checked
    value="1"
@else value="0" @endif id="servicio_capacitacion_personal" name="servicio_capacitacion_personal">
    <label for="servicio_capacitacion_personal">Realiza capacitaciones continuas al personal de contacto con el
        cliente</label><br>

    <hr>

    <h4>Para productos:</h4><br>

    <input type="checkbox" @if (isset($proveedor->producto_transformacion_significativa) ? $proveedor->producto_transformacion_significativa : '0') checked
    value="1"
@else value="0" @endif id="producto_transformacion_significativa" name="producto_transformacion_significativa">
    <label for="producto_transformacion_significativa">Posee el producto alguna transformación significativa</label><br>

    <input type="checkbox" @if (isset($proveedor->producto_compra_y_vende_unic) ? $proveedor->producto_compra_y_vende_unic : '0') checked
    value="1"
@else value="0" @endif id="producto_compra_y_vende_unic" name="producto_compra_y_vende_unic">
    <label for="producto_compra_y_vende_unic">Compra y vende productos únicamente</label><br>

    <input type="checkbox" @if (isset($proveedor->producto_post_venta) ? $proveedor->producto_post_venta : '0') checked
    value="1"
@else value="0" @endif id="producto_post_venta" name="producto_post_venta">
    <label for="producto_post_venta">Posee servicio post venta</label><br>

    <input type="checkbox" @if (isset($proveedor->producto_venta_asistida) ? $proveedor->producto_venta_asistida : '0') checked
    value="1"
@else value="0" @endif id="producto_venta_asistida" name="producto_venta_asistida">
    <label for="producto_venta_asistida">Posee venta asistida</label><br>

    <input type="checkbox" @if (isset($proveedor->producto_garantia) ? $proveedor->producto_garantia : '0') checked
    value="1"
@else value="0" @endif
    id="producto_garantia" name="producto_garantia">
    <label for="producto_garantia">Su producto posee garantía</label><br>

    <br>

    <div class="row navbuttons pt-5">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-primary btnPrevious">Previous</a>
        </div>
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Next</a>
        </div>
    </div>

</fieldset>