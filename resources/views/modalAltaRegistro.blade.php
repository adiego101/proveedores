<!-- Modal -->
<div id="modal_alta" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Dar de alta</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea dar de alta nuevamente a la empresa?</p>
            </div>
            <div class="modal-footer">

                <input type="hidden" id="id_alta">
                <button type="button" class="btn btn-primary btn_alta_modal">Alta</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


@push('js')


<script type="text/javascript">
    //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

    $(document).on("click", ".btn_alta_modal", function() {

        //Obtenemos el numero de la fila que queremos modificar
        let id = $("#id_alta").val();

        $.ajax({
            type: "GET",
            url: "altaRegistro/"+id,
        });

        //se recarga la tabla para que desaparesca la fila dada de baja
        $('.yajra-datatable').DataTable().ajax.reload();
        location.reload();
        //Ocultamos el modal
        $('#modal_alta').modal('hide');

    });
</script>
@endpush
