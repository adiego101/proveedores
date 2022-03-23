@if ($mode != 'show')
<form id="editarp">
    @endif
    @csrf
    <!-- Modal -->
    <div id="editarPago" class="modal fade" tabindex="-1" aria-labelledby="modalEditarPago" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarPago">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>

                        <h1>Pagos</h1>

                        <label for="fechaeditar">Fecha:</label><br>
                        <input @if ($mode == 'show') readonly @endif type="date" class="form-control"
                            placeholder="Ingrese la fecha en la que se realizó el pago" aria-describedby="basic-addon1"
                            id="fechaeditar"
                            value="{{ isset($pago->fechaeditar) ? date('Y-m-d', strtotime($pago->fechaeditar)) : '' }}"
                            name="fechaeditar" required><br>

                        <label for="importeeditar">Importe:</label><br>
                        <input @if ($mode == 'show') readonly @endif type="text" class="form-control"
                            onkeypress="return valideKey(event);" placeholder="Ingrese el importe pagado"
                            aria-describedby="basic-addon1"
                            value="{{ isset($pago->importeeditar) ? $pago->importeeditar : '' }}" id="importeeditar"
                            name="importeeditar" maxlength="9" required><br>

                        <label for="observacionespagoeditar">Observaciones:</label><br>
                        <input @if ($mode == 'show') readonly @endif type="text" class="form-control"
                            placeholder="Ingrese las observaciones del pago" aria-describedby="basic-addon1"
                            id="observacionespagoeditar"
                            value="{{ isset($pago->observaciones) ? $pago->observaciones : '' }}"
                            name="observacionespagoeditar" maxlength="50"><br>

                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="editar_pago">
                    <input type="hidden" id="ver_pago">


                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if ($mode != 'show') <button type="submit" class="btn btn_editar_pago btn-primary">Save changes</button> @endif
                </div>
            </div>
        </div>
    </div>
    @if ($mode != 'show')

</form>
@endif
@push('js')
    <script>
        $(document).on("click", ".btn_editar_pago", function() {

            //Obtenemos el numero de la fila que queremos modificar
            let id = $("#editar_pago").val();


        });

        $(document).on("click", ".btn_ver_pago", function() {

            //Obtenemos el numero de la fila que queremos modificar
            let id = $("#ver_pago").val();
        });


        @if ($mode != 'show')
        $(document).ready(function() {
            $('#editarp').on('submit', function(e) {
                e.preventDefault();
                let id_registro = $("#editar_pago").val();
                console.log("{{ url('guardarPagos/') }}/" + id_registro);

                $.ajax({
                    type: "post",
                    url: "{{ url('guardarPagos/') }}/" + id_registro,
                    data: $('#editarp').serialize(),
                    success: function(response) {
                        console.log(response)
                        $('#editarPago').modal('hide')
                        alert("Pago Guardado");
                        $('.yajra-pagos').DataTable().ajax.reload();

                    },
                    error: function(error) {
                        console.log(error)
                        alert("ERROR!! Pago no guardado")
                    }
                });
            });
        });
        @endif
        function verPago(id_registro) {

            $.ajax({
                url: "{{ url('verPagos/') }}/" + id_registro,
                success: function(response) {


                    abrirModalverPago(response);
                }
            });

            function abrirModalverPago(response) {
                $('#editarPago').modal('show');
                ms = Date.parse(response[0].fecha);
                fecha = new Date(ms);


                document.getElementById("fechaeditar").valueAsDate = fecha;
                $('#importeeditar').val(response[0].importe);

                console.log(response[0].observaciones);
                $('#observacionespagoeditar').val(response[0].observaciones);
                $('#editar_pago').val(response[0].id_pagos);
                $('#ver_pago').val(response[0].id_pagos);

                $('.yajra-pagos').DataTable().ajax.reload();

                console.log(response);

            }
        }
    </script>
@endpush
