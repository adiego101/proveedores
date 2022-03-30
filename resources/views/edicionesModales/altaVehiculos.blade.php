<!-- Modal -->
@if ($mode != 'show')

  <form id="addformVehiculo">
      @endif
    @csrf
  <div class="modal fade" id="nuevoVehiculo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoVehiculo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalNuevoVehiculo">Nuevo Vehículo</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>
                    <div class="row">
                        <div class="col-sm">
                            <label for="marca">Marca:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="marca" name="marca" maxlength="20" required/><br />

                            <label for="dominio">Dominio:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="dominio" name="dominio" maxlength="7" required/><br />
                        </div>

                        <div class="col-sm">
                            <label for="modelo">Modelo:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modelo" name="modelo" maxlength="20" required/><br />

                            <label for="inscripto_en">Inscripto en:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="inscripto_en" name="inscripto_en" maxlength="20" required/><br />

                        </div>
                    </div>
                </fieldset>
        </div>
        <div class="modal-footer">
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

        $(document).ready(  function()
            {
                $('#addformVehiculo').on('submit', function(e)
                {
                   e.preventDefault();
                $("button").prop("disabled", true);

                    $.ajax({
                        type: "post",
                        url: "{{url('crearPatentes/'.$id)}}",
                        data: $('#addformVehiculo').serialize(),
                        success: function (response) {

                            $('#nuevoVehiculo').modal('hide')
                            $('.yajra-vehiculos').DataTable().ajax.reload();
                            $('#marca').val('');
                            $('#dominio').val('');
                            $('#modelo').val('');
                            $('#inscripto_en').val('');

                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Vehículo Guardado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);

                        },
                        error: function(error){
                            //console.log(error)
                        $("button").prop("disabled", false);
                            alert("ERROR!! Vehiculo no guardado")
                        }
                    });
                }
                );
            }
        );

    </script>

@endpush
