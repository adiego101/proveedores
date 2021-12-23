<!-- Modal -->
<div id="modal_baja_seguro" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Dar de baja</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea dar de baja el Seguro?</p>
                <p>Esta operación <b>NO</b> podrá deshacerse.</p>
            </div>
            <div class="modal-footer">

                <input type="hidden" id="baja_seguro">
                <button type="button" class="btn btn-danger btn_baja_seguro">Baja</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


@push('js')


<script type="text/javascript">
    //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

    $(document).on("click", ".btn_baja_seguro", function() {

        //Obtenemos el numero de la fila que queremos modificar
        let id = $("#baja_seguro").val();

        $.ajax({
            type: "POST",
            //Si colocamos un numero (id) funciona sin problemas... VER
            url: "{{url('bajaSeguros/')}}/"+id,
            success: function() {
                 // En caso de que se ejecute
                 $('.yajra-seguros').DataTable().ajax.reload();
        }
        });

        //se recarga la tabla para que desaparesca la fila dada de baja
        $('.yajra-seguros').DataTable().ajax.reload();
        //Ocultamos el modal
        $('#modal_baja_seguro').modal('hide');

    });

</script>
@endpush
