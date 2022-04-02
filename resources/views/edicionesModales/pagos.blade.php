@if ($mode != 'show')

<form id="addform">
    @endif
    @csrf
    <!-- Modal -->
    <div id="nuevoPago" class="modal fade" tabindex="-1" aria-labelledby="modalNuevoPago" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modalNuevoPago">Nuevo Pago</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>

                        <label for="fecha">Fecha:</label><br>
                        <input @if ($mode == 'show') readonly @endif type="date" class="form-control"
                            placeholder="Ingrese la fecha en la que se realizó el pago" aria-describedby="basic-addon1"
                            id="fecha" value="{{ isset($pago->fecha) ? date('Y-m-d', strtotime($pago->fecha)) : '' }}"
                            name="fecha" required><br>

                        <label for="importe">Importe:</label><br>
                        <input @if ($mode == 'show') readonly @endif type="text" class="form-control"
                            onkeypress="return valideKey(event);" placeholder="Ingrese el importe pagado"
                            aria-describedby="basic-addon1" value="{{ isset($pago->importe) ? $pago->importe : '' }}"
                            id="importe" name="importe" maxlength="9" required><br>

                        <label for="observacionespago">Observaciones:</label><br>
                        <input @if ($mode == 'show') readonly @endif type="text" class="form-control"
                            placeholder="Ingrese las observaciones del pago" aria-describedby="basic-addon1"
                            id="observacionespago" value="{{ isset($pago->observaciones) ? $pago->observaciones : '' }}"
                            name="observacionespago" maxlength="50"><br>

                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ver_pago">

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

        $(document).ready(function() {
            $('#addform').on('submit', function(e) {

               e.preventDefault();
                $("button").prop("disabled", true);

                $.ajax({
                    type: "post",
                    url: "{{ url('crearPagos/' . $id) }}",
                    data: $('#addform').serialize(),
                    success: function(response) {

                        $('#nuevoPago').modal('hide')
                        $('.yajra-pagos').DataTable().ajax.reload();
                        $('#fecha').val('');
                        $('#importe').val('');
                        $('#observacionespago').val('');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Pago Guardado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);
                    },
                    error: function(error) {
                        //console.log(error)
                        $("button").prop("disabled", false);

                        alert("ERROR!! Pago no guardado")
                    }
                });
            });
        });

    </script>

@endpush
