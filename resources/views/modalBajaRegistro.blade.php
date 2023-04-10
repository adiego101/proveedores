<!-- Modal -->
<div id="modal_baja" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Dar de baja</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

            <label for="disposiciones">Disposiciones: </label><br>
                <select class="dispos form-control"  name="disposiciones" id="disposiciones" aria-label="Default select example">
                    <option selected>Seleccione una Disposicion</option>
                </select>
                <br>

                <p>¿Está seguro que desea dar de baja la empresa?</p>
                <p>Si desea, puede volver a darla de alta nuevamente.</p>
            </div>
            <div class="modal-footer">

                <input type="hidden" id="id_baja">
                <button type="button" class="btn btn-danger btn_baja_modal">Baja</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


@push('js')

<script type="text/javascript">

    $(document).on("click", ".btn_baja_modal", function() {

        //Obtenemos el numero de la fila que queremos modificar
        let id = $("#id_baja").val();
        let nro_disposicion = $(".dispos").val();
        let datos = {
            nro_disposicion:nro_disposicion,
                    }

        $.ajax({
            type: "POST",
            url: "bajaRegistro/"+id,
            data: datos,
        });

        //se recarga la tabla para que desaparesca la fila dada de baja
        $('.yajra-datatable').DataTable().ajax.reload();
        location.reload();
        //Ocultamos el modal
        $('#modal_baja').modal('hide');

    });


    function disposicionesJson(){
        let id = $("#id_baja").val();


                $.ajax({
                    type: "GET",
                    url: "{{url('proveedor/disposicionesJson/')}}/"+id+"/baja",
                    dataType:"json",
                    success: function(data){
                        $(".dispos").empty();
                        $.each(data,function(key, registro) {
                            $(".dispos").append('<option value='+registro.id_disposicion+'>'+registro.nro_disposicion+'</option>');
                        });
                    },
                    error: function(data) {
                        alert('error');
                    }
                });
            }


</script>

@endpush
