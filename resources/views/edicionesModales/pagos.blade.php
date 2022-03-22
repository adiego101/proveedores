


  <form id="addform">
@csrf
      <!-- Modal -->
        <div id="nuevoPago" class="modal fade" tabindex="-1"  aria-labelledby="modalNuevoPago" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                      <h5 class="modal-title" id="modalNuevoPago">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>

                <h1>Pagos</h1>

                <label for="fecha">Fecha:</label><br>
                <input @if ( $mode == "show") readonly @endif type="date" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago"
                aria-describedby="basic-addon1" id="fecha" value="{{ isset($pago->fecha) ? date('Y-m-d',strtotime($pago->fecha)) : '' }}" name="fecha" required><br>

                <label for="importe">Importe:</label><br>
                <input @if ( $mode == "show") readonly @endif type="text" class="form-control" onkeypress="return valideKey(event);" placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1" value="{{ isset($pago->importe) ? $pago->importe : '' }}" id="importe" name="importe" maxlength="9" required><br>

                <label for="observaciones">Observaciones:</label><br>
                <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese las observaciones del pago" aria-describedby="basic-addon1" id="observaciones" value="{{ isset($pago->observaciones) ? $pago->observaciones : '' }}" name="observaciones" maxlength="50"><br>

            </fieldset>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit"   class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
</div>
</form>
@push('js')
<script>

$(function () {console.log("{{url('crearPagos/'.$id)}}")});


        $(document).ready(  function()
            {
                $('#addform').on('submit', function(e)
                {
                    e.preventDefault();

                    $.ajax({
                        type: "post",
                        url: "{{url('crearPagos/'.$id)}}",
                        data: $('#addform').serialize(),
                        success: function (response) {
                            console.log(response)
                            $('#nuevoPago').modal('hide')
                            alert("Pago Guardado");
                            $('.yajra-pagos').DataTable().ajax.reload();

                        },
                        error: function(error){
                            console.log(error)
                            alert("ERROR!! Pago no guardado")
                        }
                    });
                }
                );
            }
        );


    </script>
@endpush





