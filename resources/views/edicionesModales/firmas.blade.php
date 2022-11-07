@if ($mode != 'show')

<form id="addform">
    @endif
    @csrf
    <!-- Modal -->
    <div id="nuevaDenominacion" class="modal fade" tabindex="-1" aria-labelledby="modalNuevaDenominacion" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modalNuevaDenominacion">Nueva Denominación</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>

                        <label for="denominacion">Denominación:</label><br>
                        <input @if ($mode == 'show') readonly @endif type="text" class="form-control" placeholder="Ingrese la denominación" aria-describedby="basic-addon1" id="denominacion" name="denominacion" maxlength="50" value="{{ isset($firma->dato) ? $firma->dato : '' }}" required>

                        <br>

                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ver_denominacion">

                    @if ($mode != 'show')
                    <button type="submit" class="btn btn-success">Guardar</button>

                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    @else
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>

                    @endif
                         </div>
            </div>
        </div>
    </div>
    @if ($mode != 'show')

</form>
@endif

@push('js')

    <script>
    /*
        $(document).ready(function() {
            $('#addform').on('submit', function(e) {

               e.preventDefault();
                $("button").prop("disabled", true);

                $.ajax({
                    type: "post",
                    url: "{{ url('crearFirmas/' . $id) }}",
                    data: $('#addform').serialize(),
                    success: function(response) {

                        $('#nuevaDenominacion').modal('hide')
                        $('.yajra-denominaciones').DataTable().ajax.reload();
                        $('#denominacion').val('');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Denominación Guardada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);
                    },
                    error: function(error) {
                        //console.log(error)
                        $("button").prop("disabled", false);

                        alert("ERROR!! Denominación no guardada");
                    }
                });
            });
        });
    */
    </script>

@endpush
