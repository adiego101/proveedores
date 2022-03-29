<!-- Modal -->
<div id="modalBajaSucursal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Dar de baja</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea dar de baja la Sucursal?</p>
                <p>Esta operación <b>NO</b> podrá deshacerse.</p>
            </div>
            <div class="modal-footer">

                <input type="hidden" id="baja">
                <button type="button" class="btn btn-danger btn_bajaSucursal">Baja</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@push('js')

<script type="text/javascript">

    $(document).on("click", ".btn_bajaSucursal", function() {

        //Obtenemos el numero de la fila que queremos modificar
        let id = $("#baja").val();

        $.ajax({
            type: "POST",
            url: "{{url('bajaSucursales/')}}/"+id,
            success: function() {

                Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Sucursal dada de baja',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
          
                 $('.yajra-datatable').DataTable().ajax.reload();
        }
        });

        //Ocultamos el modal
        $('#modalBajaSucursal').modal('hide');

    });

</script>

@endpush
