@if ($mode != 'show')
<form id="editarp">
    @endif
    @csrf
    <!-- Modal -->
    <div id="editarPago" class="modal fade" tabindex="-1" aria-labelledby="modalEditarPago" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modalEditarPago">Pago</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>

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
                            name="importeeditar" maxlength="9" required>
                            <small class="small" id="small-importe2"></small>

                            <br>

                            <label for="tipo_pago_editar">Tipo de pago:</label><br>
                            <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="tipo_pago_editar" name="tipo_pago_editar">
                            <option selected value="Inscripcion">Inscripción</option>
                            <option value="Renovacion">Renovación</option>
                            <option value="Otros">Otros</option>
                            </select>

                            <br>

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

        $('#importe2').keyup(validarImporte2);

        function validarImporte2() {

            if (!(/^[0-9]+$/.test($('#importe2').val()))) {
                if($('#importe2').val() != ""){
                mostrarError('#importe2', '#small-importe2', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de IMPORTE2</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#importe2', '#small-importe2');
            return true;
        }



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
                $("button").prop("disabled", true);
                let id_registro = $("#editar_pago").val();

                $.ajax({
                    type: "post",
                    url: "{{ url('guardarPagos/') }}/" + id_registro,
                    data: $('#editarp').serialize(),
                    success: function(response) {

                        $('#editarPago').modal('hide')

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Pago Modificado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);

                        $('.yajra-pagos').DataTable().ajax.reload();

                    },
                    error: function(error) {
                        //console.log(error)
                        $("button").prop("disabled", false);
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
                console.log(response);
                document.getElementById("fechaeditar").valueAsDate = fecha;
                $('#importeeditar').val(response[0].importe);
                $('#tipo_pago_editar').val(response[0].tipo_pago);
                $('#observacionespagoeditar').val(response[0].observaciones);
                $('#editar_pago').val(response[0].id_pagos);
                $('#ver_pago').val(response[0].id_pagos);

                $('.yajra-pagos').DataTable().ajax.reload();

            }
        }
    </script>

@endpush
