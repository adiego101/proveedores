<!-- Modal -->
<div id="modal_baja_patente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Dar de baja</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea dar de baja el Vehículo?</p>
                <p>Esta operación <b>NO</b> podrá deshacerse.</p>
            </div>
            <div class="modal-footer">

                <input type="hidden" id="baja_patente">
                <button type="button" class="btn btn-danger btn_baja_patente">Baja</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@push('js')

<script type="text/javascript">

    $(document).on("click", ".btn_baja_patente", function() {

        //Obtenemos el numero de la fila que queremos modificar
        let id = $("#baja_patente").val();


        $.ajax({
            type: "POST",
            url: "{{url('bajaPatentes/')}}/"+id,
            success: function() {
                 $('.yajra-vehiculos').DataTable().ajax.reload();

                 Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Vehículo dado de baja',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
        }
        });

        //Ocultamos el modal
        $('#modal_baja_patente').modal('hide');

    });

</script>

@endpush
