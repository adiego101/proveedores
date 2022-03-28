<!-- Modal -->
@if ($mode != 'show')
<form id="editformVehiculo">
@endif
    @csrf
  <div class="modal fade" id="editarVehiculo" tabindex="-1" role="dialog" aria-labelledby="modalEditarVehiculo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalEditarVehiculo">Editar Vehículo</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>

                    <div class="row">
                        <div class="col-sm">
                            <label for="marcas">Marca:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="marcas" name="marcas" maxlength="40" required/><br />

                            <label for="dominios">Dominio:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="dominios" name="dominios" maxlength="7" required/><br />
                        </div>

                        <div class="col-sm">
                            <label for="modelos">Modelo:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modelos" name="modelos" maxlength="40" required/><br />

                            <label for="inscriptos_en">Inscripto en:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="inscriptos_en" name="inscriptos_en" maxlength="20" required/><br />

                        </div>

                        <input type="hidden" id="id_proveedor_patente" name="id_proveedor_patente">

                    </div>

                </fieldset>

        </div>
        <div class="modal-footer">
            @if ($mode != 'show') <button type="submit" class="btn btn-success">Guardar</button> @endif
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  @if ($mode != 'show')
</form>
@endif
@push('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

<script>

        $(document).ready(  function()
            {
                $('#editformVehiculo').on('submit', function(e)
                {
                    e.preventDefault();
                    console.log($('#id_proveedor_patente').val());

                    var id_proveedor = $('#id_proveedor_patente').val();
                    console.log("{{url('guardarPatentes/')}}/"+id_proveedor);

                    $.ajax({
                        type: "post",
                        url: "{{url('guardarPatentes/')}}/"+id_proveedor,
                        data: $('#editformVehiculo').serialize(),
                        success: function (response) {
                            console.log(response)
                            $('#editarVehiculo').modal('hide')

                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Vehículo Modificado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })

                            $('.yajra-vehiculos').DataTable().ajax.reload();

                        },
                        error: function(error){
                            console.log(error)
                            alert("ERROR!! Vehiculo no modificado")
                        }
                    });
                }
                );
            }
        );

    </script>

@endpush
