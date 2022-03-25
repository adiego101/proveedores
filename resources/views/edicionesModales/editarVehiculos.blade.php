<!-- Modal -->
<form id="editformVehiculo">
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
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>

@push('js')

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
                            alert("Vehiculo Guardado");
                            $('.yajra-vehiculos').DataTable().ajax.reload();

                        },
                        error: function(error){
                            console.log(error)
                            alert("ERROR!! Vehiculo no guardado")
                        }
                    });
                }
                );
            }
        );

    </script>

@endpush
