<!-- Modal -->
<div id="modal_eliminar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Eliminar</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar la empresa de la Base de datos?</p>
                <p>Esta operación <b>NO</b> podrá deshacerse y <b>NO</b> se podrá recuperar la empresa.</p>
            </div>
            <div class="modal-footer">

                <input type="hidden" id="id_eliminar">
                <button type="button" class="btn btn-danger btn_eliminar_registro">Eliminar</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@push('js')

<script type="text/javascript">

    $(document).on("click", ".btn_eliminar_registro", function() {

        //Obtenemos el numero de la fila que queremos modificar
        let id = $("#id_eliminar").val();

        $.ajax({
            type: "GET",
            url: "{{url('eliminarRegistro/')}}/"+id,
            success: function() {
                
                //se recarga la tabla para que desaparesca la fila dada de baja
                $('.yajra-datatable').DataTable().ajax.reload();
        //location.reload();

                 Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Sede eliminada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
        }
        });

        //Ocultamos el modal
        $('#modal_eliminar').modal('hide');

    });

</script>

@endpush
