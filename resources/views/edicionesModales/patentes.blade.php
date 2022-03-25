

<!-- Button trigger modal -->


  <!-- Modal -->
  <form id="addformpatente">
    @csrf
  <div class="modal fade" id="nuevaPatente" tabindex="-1" role="dialog" aria-labelledby="modalNuevaPatente" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNuevaPatente">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>

                <h1>Vehículo</h1>

                <br/>

                    <div class="row">
                        <div class="col-sm">
                            <label for="marca">Marca:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->marca) ? $patente->marca : '' }}" class="form-control" placeholder="Ingrese la marca del vehículo" aria-describedby="basic-addon1" id="marca" name="marca" maxlength="40" required/><br />

                            <label for="dominio">Dominio:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->dominio) ? $patente->dominio : '' }}" class="form-control" placeholder="Ingrese el dominio del vehículo" aria-describedby="basic-addon1" id="dominio" name="dominio" maxlength="7" required/><br />
                        </div>

                        <div class="col-sm">
                            <label for="modelo">Modelo:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->modelo) ? $patente->modelo : '' }}" class="form-control" placeholder="Ingrese el modelo del vehículo" aria-describedby="basic-addon1" id="modelo" name="modelo" maxlength="40" required/><br />

                            <label for="inscripto_en">Inscripto en:</label><br />
                            <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($patente->inscripto_en) ? $patente->inscripto_en : '' }}" class="form-control" placeholder="Ingrese donde se encuentra inscripto el vehículo" aria-describedby="basic-addon1" id="inscripto_en" name="inscripto_en" maxlength="20" required/><br />

                        </div>
                    </div>

                </fieldset>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@push('js')
<script>

$(function () {console.log("{{url('crearPatentes/'.$id)}}")});


        $(document).ready(  function()
            {
                $('#addformpatente').on('submit', function(e)
                {
                    e.preventDefault();

                    $.ajax({
                        type: "post",
                        url: "{{url('crearPatentes/'.$id)}}",
                        data: $('#addformpatente').serialize(),
                        success: function (response) {
                            console.log(response)
                            $('#nuevaPatente').modal('hide')
                            alert("Patente Guardado");
                            $('.yajra-patentes').DataTable().ajax.reload();

                        },
                        error: function(error){
                            console.log(error)
                            alert("ERROR!! Patente no guardada")
                        }
                    });
                }
                );
            }
        );


    </script>
@endpush
