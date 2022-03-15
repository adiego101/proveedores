<!-- Modal -->
<div id="modalAltaInscripcion" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Nueva inscripción</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p> El proveedor ya se encuentra inscripto, 
                    al guardar los cambios realizados se invalidan 
                    los certificados emitidos con anterioridad
                    generando una nueva inscripción.
                </p>
                <p> <b> * Una nueva inscripción implica un nuevo cálculo de índice 
                        que aplica la formula vigente. </b></p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="alta_registro_nro_rupae">Aceptar</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


@push('js')


<script type="text/javascript">

    $(document).on("click", "#alta_registro_nro_rupae", function() {
        $.ajax({
            type: "POST",
            data: $('#edit_form').serialize(),
            url: "{{url('/crear_registro')}}"
        });
    });
</script>
@endpush
