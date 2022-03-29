<!-- Modal -->
<div id="modal_producto" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Editar Producto</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <label for="modal_producto_elaborado">Producto elaborado:</label><br>
                    <input list="productos" name="modal_producto_elaborado" id="modal_producto_elaborado"  class="form-control" placeholder="Ingrese o seleccione el producto que produce"/>
                    <datalist id="productos">
                        @forelse($productos as $producto)
                            <option value="{{$producto->producto_elaborado}}">
                        @empty
                            <option value=" ">
                        @endforelse
                    </datalist>
                    <br>

                    <label for="modal_rnpa">RNPA:</label><br>
                    <input type="text" class="form-control" aria-describedby="basic-addon1" id="modal_rnpa" name="modal_rnpa" placeholder="Ingrese el RNPA" maxlength="8"><br>

                    <label for="modal_unidad_producida">Unidad producida:</label><br>
                    <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="modal_unidad_producida"
                    name="modal_unidad_producida" placeholder="Ingrese la cantidad de unidades producidas" maxlength="9"><br>

                    <label for="modal_produccion_total">Capacidad de producción total:</label><br>
                    <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="modal_produccion_total" name="modal_produccion_total" placeholder="Ingrese la producción total" maxlength="9"><br>

                    <div class="modal-footer">
                        <input id="numero_fila_producto" name="numero_fila_producto" type="hidden">
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
    var id_fila = $("#numero_fila_producto").val();

    //Recuperamos los valores de los campos del modal
    var modal_producto_elaborado = $("#modal_producto_elaborado").val();
    var modal_rnpa = $("#modal_rnpa").val();
    var modal_unidad_producida = $("#modal_unidad_producida").val();
    var modal_produccion_total = $("#modal_produccion_total").val();

    //Obtenemos los campos obligatorios para aplicarles estilos css
    let modal_producto_elaborado_css = document.getElementById("modal_producto_elaborado");
    let modal_unidad_producida_css = document.getElementById("modal_unidad_producida");


    //Si los campos obligatorios NO estan vacios, permite enviar los nuevos valores a la tabla
    if(modal_producto_elaborado.length != 0 && modal_unidad_producida.length != 0){

        //Ocultamos el modal
        $('#modal_producto').modal('hide');

        //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
        $('#producto_elaborado'+id_fila).val(modal_producto_elaborado);
        $('#rnpa'+id_fila).val(modal_rnpa);
        $('#unidad_producida'+id_fila).val(modal_unidad_producida);
        $('#produccion_total'+id_fila).val(modal_produccion_total);

        //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
        $('#producto_elaborado_text'+id_fila).text(modal_producto_elaborado);
        $('#rnpa_text'+id_fila).text(modal_rnpa);
        $('#unidad_producida_text'+id_fila).text(modal_unidad_producida);
        $('#produccion_total_text'+id_fila).text(modal_produccion_total);

        modal_producto_elaborado_css.style.border = '1px solid #DFDFDF';
        modal_unidad_producida_css.style.border = '1px solid #DFDFDF';

        Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Producto Modificado',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

        })

    }else{
        //Si alguno de los campos obligatorios esta vacio, detenemos el envio de los datos.
        event.preventDefault();

        if(modal_producto_elaborado.length == 0){

            modal_producto_elaborado_css.style.border = '2px dashed red';
        }


        if(modal_unidad_producida.length == 0){

            modal_unidad_producida_css.style.border = '2px dashed red';
        }

    }

});



$(document).on("click", ".btn_cancel_modal", function(event) {

    //Obtenemos los campos obligatorios para aplicarles estilos css
    let modal_producto_elaborado_css = document.getElementById("modal_producto_elaborado");
    let modal_unidad_producida_css = document.getElementById("modal_unidad_producida");

    modal_producto_elaborado_css.style.border = '1px solid #DFDFDF';
    modal_unidad_producida_css.style.border = '1px solid #DFDFDF';

});

</script>

@endpush
