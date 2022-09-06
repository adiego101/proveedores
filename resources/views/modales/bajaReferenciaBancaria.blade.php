<!-- Modal -->
<div id="modal_baja_referencia_bancaria" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Dar de baja</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea dar de baja el banco?</p>
                <p>Esta operación <b>NO</b> podrá deshacerse.</p>
            </div>
            <div class="modal-footer">

                <input type="hidden" id="baja_referencia_bancaria">
                <button type="button" class="btn btn-danger btn_baja_referencia_bancaria">Baja</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@push('js')

<script type="text/javascript">
/*
    $(document).on("click", ".btn_baja_referencia_bancaria", function() {

        //Obtenemos el numero de la fila que queremos modificar
        let id = $("#baja_referencia_bancaria").val();

        $.ajax({
            type: "POST",
            url: "{{url('bajaReferenciaBancaria/')}}/"+id,
            success: function() {
                 $('.yajra-bancos').DataTable().ajax.reload();

                 Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Banco dado de baja',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
        }
        });

        //Ocultamos el modal
        $('#modal_baja_referencia_bancaria').modal('hide');

    });
*/
</script>

@endpush
