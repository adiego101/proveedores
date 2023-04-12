@if ($mode != 'show')

<form id="addform">
    @endif
    @csrf
    <!-- Modal -->
    <div id="nuevaReferenciaBancaria" class="modal fade" tabindex="-1" aria-labelledby="modalNuevaReferenciaBancaria" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modalNuevaReferenciaBancaria">Nuevo Banco</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>

                        <div class="row">
                            <div class="col-sm">
                                <label for="nombre_banco">Banco con el que opera:</label><br>
                                <select class="js-example-basic-single" aria-describedby="basic-addon1" id="nombre_banco" name="nombre_banco">
                                    @forelse($bancos as $banco)
                                    <option value="{{$banco->nombre_banco}}">{{$banco->nombre_banco}}</option> 
                                    @empty
                                    <option value=" "></option>
                                    @endforelse
                                </select>
                                <br />

                                <label for="tipo_cuenta">Tipo de cuenta:</label><br>
                                <input type="text" class="form-control" placeholder="Ingrese el tipo de cuenta" aria-describedby="basic-addon1" value="{{ isset($banco->tipo_cuenta) ? $banco->tipo_cuenta : '' }}" id="tipo_cuenta" name="tipo_cuenta" maxlength="50">
                                <br>
                            </div>

                            <div class="col-sm">
                                <label for="sucursal">Sucursal:</label><br>
                                <select class="js-example-basic-single" aria-describedby="basic-addon1" id="sucursal" name="sucursal">
                                {{-- @forelse($sucursales as $sucursal)
                                <!-- <option value="{{$sucursal->desc_sucursal}}">{{$sucursal->desc_sucursal}}</option> 
                                @empty
                                <option value=" "></option>
                                @endforelse --> --}}
                                </select>
                                <br />

                                <label for="nro_cuenta">Nº de cuenta:</label><br>
                                <input type="text" class="form-control" placeholder="Ingrese el Nº de cuenta" aria-describedby="basic-addon1" value="{{ isset($banco->nro_cuenta) ? $banco->nro_cuenta : '' }}" id="nro_cuenta" name="nro_cuenta" maxlength="50">
                                <br>
                            </div>
                        </div>

                        <br>

                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ver_referencia_bancaria">

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
                    url: "{{ url('crearReferenciasBancarias/' . $id) }}",
                    data: $('#addform').serialize(),
                    success: function(response) {

                        $('#nuevaReferenciaBancaria').modal('hide')
                        $('.yajra-bancos').DataTable().ajax.reload();
                        $('#referenciaBancaria').val('');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Banco Guardado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);
                    },
                    error: function(error) {
                        //console.log(error)
                        $("button").prop("disabled", false);

                        alert("ERROR!! Referencia bancaria no guardada");
                    }
                });
            });
        });
    */
    </script>

@endpush
