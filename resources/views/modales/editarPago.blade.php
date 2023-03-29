<!-- Modal -->
<div id="modal_pago" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar Pago</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm">
                        <label for="modal_fecha">Fecha:</label><br />
                        <input type="date" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago" aria-describedby="basic-addon1" id="modal_fecha"/><br />

                        <label for="modal_importe">Importe:</label><br />
                        <input type="text" class="form-control" onkeypress="return valideKey(event);" placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1" id="modal_importe" maxlength="9"/>
                        <small class="small" id="small-importe-pago-modal"></small>
                        <br />

                        <label for="modal_nro_comprobante_asip">Nro de comprobante ASIP:</label><br />
                        <input type="text" class="form-control" onkeypress="return valideKey(event);" placeholder="Ingrese el Nro de comprobante ASIP" aria-describedby="basic-addon1" id="modal_nro_comprobante_asip" />
                        <small class="small" id="small-modal_nro_comprobante_asip"></small>
                        <br>

                        <label for="modal_observaciones">Observaciones:</label><br />
                        <input type="text" class="form-control" placeholder="Ingrese las observaciones del pago" aria-describedby="basic-addon1" id="modal_observaciones" maxlength="50"/><br />
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="numero_fila_pago" name="numero_fila_pago" type="hidden">
                    <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                    <button type="button" class="btn btn-outline-danger btn_cancel_modal" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

    <script type="text/javascript">


        $('#modal_importe').keyup(validarImportePagoModal);

        function validarImportePagoModal() {

            if (!(/^[0-9]+$/.test($('#modal_importe').val()))) {
                if($('#modal_importe').val() != ""){

                mostrarError('#modal_importe', '#small-importe-pago-modal', '<div class="alert alert-danger mt-3 pt-1">El <strong>importe del pago</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#modal_importe', '#small-importe-pago-modal');
            return true;
        }



        //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

        $(document).on("click", ".btn_edit_modal", function(event) {

            //Obtenemos el numero de la fila que queremos modificar
            var id_filapago = $("#numero_fila_pago").val();

            //Recuperamos los valores de los campos del modal
            var modal_fecha = $("#modal_fecha").val();
            var modal_importe = $("#modal_importe").val();
            var modal_tipo_pago = $("#modal_tipo_pago").val();
            var modal_observaciones = $("#modal_observaciones").val();

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let modal_fecha_css = document.getElementById("modal_fecha");
            let modal_importe_css = document.getElementById("modal_importe");

            //Si los campos obligatorios NO estan vacios, permite enviar los nuevos valores a la tabla
            if(modal_fecha.length != 0 && modal_importe.length != 0){

                //Ocultamos el modal
                $('#modal_pago').modal('hide');

                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                $('#fecha_pago' + id_filapago).val(modal_fecha);
                $('#importe_pago' + id_filapago).val(modal_importe);
                $('#tipo_pago' + id_filapago).val(modal_tipo_pago);
                $('#observaciones_pago' + id_filapago).val(modal_observaciones);

                //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                var modal_fecha_clasica_pago = modal_fecha.split('-').reverse().join('/');
                $('#fecha_pago_text' + id_filapago).text(modal_fecha_clasica_pago);
                $('#importe_pago_text' + id_filapago).text(modal_importe);
                $('#tipo_pago_text' + id_filapago).text(modal_tipo_pago);
                $('#observaciones_pago_text' + id_filapago).text(modal_observaciones);

                modal_fecha_css.style.border = '1px solid #DFDFDF';
                modal_importe_css.style.border = '1px solid #DFDFDF';

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pago Modificado',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

            }else{

                //Si alguno de los campos obligatorios esta vacio, detenemos el envio de los datos.
                event.preventDefault();

                if(modal_fecha.length == 0){

                    modal_fecha_css.style.border = '2px dashed red';
                }

                if(modal_importe.length == 0){

                    modal_importe_css.style.border = '2px dashed red';
                }

            }

        });



        $(document).on("click", ".btn_cancel_modal", function(event) {

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let modal_fecha_css = document.getElementById("modal_fecha");
            let modal_importe_css = document.getElementById("modal_importe");

            modal_fecha_css.style.border = '1px solid #DFDFDF';
            modal_importe_css.style.border = '1px solid #DFDFDF';

        });

    </script>

@endpush
