<!-- Modal -->
<div id="modal_banco" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar Banco</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm">
                        <label for="modal_nombre_banco">Banco con el que opera:</label><br>
                            <select class="js-example-basic-single" aria-describedby="basic-addon1" id="modal_nombre_banco" name="modal_nombre_banco">
                                @forelse($bancos as $banco)
                                <option value="{{$banco->nombre_banco}}">{{$banco->nombre_banco}}</option> 
                                @empty
                                    <option value=" "></option>
                                @endforelse
                            </select>
                        <br />

                        <label for="modal_tipo_cuenta">Tipo de cuenta:</label><br>
                        <input type="text" class="form-control" placeholder="Ingrese el tipo de cuenta" aria-describedby="basic-addon1" id="modal_tipo_cuenta" name="modal_tipo_cuenta" maxlength="50">
                        <br>
                    </div>

                    <div class="col-sm">
                        <label for="modal_sucursal">Sucursal:</label><br>
                        <select class="js-example-basic-single" aria-describedby="basic-addon1" id="modal_sucursal" name="modal_sucursal">
                        {{-- @forelse($sucursales as $sucursal)
                            <!-- <option value="{{$sucursal->desc_sucursal}}">{{$sucursal->desc_sucursal}}</option> 
                            @empty
                                <option value=" "></option>
                            @endforelse --> --}}
                        </select>
                        <br />

                        <label for="modal_nro_cuenta">Nº de cuenta:</label><br>
                        <input type="text" class="form-control" placeholder="Ingrese el Nº de cuenta" aria-describedby="basic-addon1" id="modal_nro_cuenta" name="modal_nro_cuenta" maxlength="50">
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="numero_fila_banco" name="numero_fila_banco" type="hidden">
                    <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                    <button type="button" class="btn btn-outline-danger btn_cancel_modal" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

    <script type="text/javascript">

        //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

        $(document).on("click", ".btn_edit_modal", function(event) {

            //Obtenemos el numero de la fila que queremos modificar
            var id_fila_banco = $("#numero_fila_banco").val();

            //Recuperamos los valores de los campos del modal
            let modal_nombre_banco = $("#modal_nombre_banco").val();
            let modal_sucursal = $("#modal_sucursal").val();
            let modal_tipo_cuenta = $("#modal_tipo_cuenta").val();
            let modal_nro_cuenta = $("#modal_nro_cuenta").val();

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let modal_tipo_cuenta_css = document.getElementById("modal_tipo_cuenta");
            let modal_nro_cuenta_css = document.getElementById("modal_nro_cuenta");

            //Si los campos obligatorios NO estan vacios, permite enviar los nuevos valores a la tabla
            if(modal_tipo_cuenta.length != 0 && modal_nro_cuenta.length != 0){

                //Ocultamos el modal
                $('#modal_banco').modal('hide');

                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                $('#nombre_banco' + id_fila_banco).val(modal_nombre_banco);
                $('#sucursal' + id_fila_banco).val(modal_sucursal);
                $('#tipo_cuenta' + id_fila_banco).val(modal_tipo_cuenta);
                $('#nro_cuenta' + id_fila_banco).val(modal_nro_cuenta);

                //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                $('#nombre_banco_text' + id_fila_banco).text(modal_nombre_banco);
                $('#sucursal_text' + id_fila_banco).text(modal_sucursal);
                $('#tipo_cuenta_text' + id_fila_banco).text(modal_tipo_cuenta);
                $('#nro_cuenta_text' + id_fila_banco).text(modal_nro_cuenta);

                modal_tipo_cuenta_css.style.border = '1px solid #DFDFDF';
                modal_nro_cuenta_css.style.border = '1px solid #DFDFDF';

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Banco Modificado',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

            }else{

                //Si alguno de los campos obligatorios esta vacio, detenemos el envio de los datos.
                event.preventDefault();

                if(modal_tipo_cuenta.length == 0){

                    modal_tipo_cuenta_css.style.border = '2px dashed red';
                }

                if(modal_nro_cuenta.length == 0){

                    modal_nro_cuenta_css.style.border = '2px dashed red';
                }

            }

        });



        $(document).on("click", ".btn_cancel_modal", function(event) {

            //Obtenemos los campos obligatorios para aplicarles estilos css
            let modal_tipo_cuenta_css = document.getElementById("modal_tipo_cuenta");
            let modal_nro_cuenta_css = document.getElementById("modal_nro_cuenta");

            modal_tipo_cuenta_css.style.border = '1px solid #DFDFDF';
            modal_nro_cuenta_css.style.border = '1px solid #DFDFDF';

        });

    </script>

@endpush
