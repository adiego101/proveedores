<!-- Modal -->
<div id="modal_denominaciones" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar Denominación</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm">
                    <label for="modal_denominacion">Denominación:</label><br>
                    <input type="text" class="form-control" placeholder="Ingrese la denominación" aria-describedby="basic-addon1" id="modal_denominacion" name="modal_denominacion" maxlength="50">
                    <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="numero_fila_denominacion" name="numero_fila_denominacion" type="hidden">
                    <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                    <button type="button" class="btn btn-outline-danger btn_cancel_modal" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

    <script type="text/javascript">

        //Modificamos el valor actual, por el nuevo valor ingresado en el modal

        $(document).on("click", ".btn_edit_modal", function(event) {

            //Obtenemos el numero de la fila que queremos modificar
            var id_fila_denominacion = $("#numero_fila_denominacion").val();

            //Recuperamos el valor del campo del modal
            var modal_denominacion = $("#modal_denominacion").val();

            //Obtenemos el campo obligatorio para aplicarle estilos css
            let modal_denominacion_css = document.getElementById("modal_denominacion");

            //Si el campo obligatorio NO esta vacio, permite enviar el nuevo valore a la tabla
            if(modal_denominacion.length != 0){

                //Ocultamos el modal
                $('#modal_denominaciones').modal('hide');

                //Enviamos el valor recuperado anteriormente del modal, al input de la tabla
                $('#denominacion' + id_fila_denominacion).val(modal_denominacion);

                //Enviamos el valor recuperado anteriormente del modal, al texto visible de la tabla
             
                $('#denominacion_text' + id_fila_denominacion).text(modal_denominacion);
            
                modal_denominacion_css.style.border = '1px solid #DFDFDF';

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Denominación Modificada',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

            }else{

                //Si el campo obligatorio esta vacio, detenemos el envio del dato.
                event.preventDefault();

                if(modal_denominacion.length == 0){

                    modal_denominacion_css.style.border = '2px dashed red';
                }

            }

        });



        $(document).on("click", ".btn_cancel_modal", function(event) {

            //Obtenemos el campo obligatorio para aplicarle estilos css
            let modal_denominacion_css = document.getElementById("modal_denominacion");

            modal_denominacion_css.style.border = '1px solid #DFDFDF';

        });

    </script>

@endpush
