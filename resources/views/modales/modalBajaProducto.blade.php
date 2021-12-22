<!-- Modal -->
<div id="modal_baja_producto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Dar de baja </h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea dar de baja el Producto?</p>
                <p>Esta operación <b>NO</b> podrá deshacerse.</p>
            </div>
            <div class="modal-footer">

                <input type="hidden" id="baja_producto">
                <button type="button" class="btn btn-danger btn_baja_producto">Baja</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


@push('js')


<script type="text/javascript">
    //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

    $(document).on("click", ".btn_baja_producto", function() {

        //Obtenemos el numero de la fila que queremos modificar
        let id = $("#baja_producto").val();

        $.ajax({
            type: "GET",
            //Si colocamos un numero (id) funciona sin problemas... VER
            url: "bajaProducto/"+id,
        });

        //se recarga la tabla para que desaparesca la fila dada de baja
        $('.yajra-productos').DataTable().ajax.reload();
        location.reload();
        //Ocultamos el modal
        $('#modal_baja_producto').modal('hide');

    });
</script>
@endpush