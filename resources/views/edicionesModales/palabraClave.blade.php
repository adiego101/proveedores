<!-- Modal -->
@if ($mode != 'show')

  <form id="addformpalabrasclaves">
      @endif
    @csrf
  <div class="modal fade" id="nuevaPalabraClave" tabindex="-1" role="dialog" aria-labelledby="modalNuevaPalabraClave" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalNuevaPalabraClave">Nueva Palabra</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>
         
                <label for="palabra_clave">Palabra clave:</label><br>
                <input type="text" class="form-control" aria-describedby="basic-addon1" id="palabra_clave" name="palabra_clave" placeholder="Ingrese una palabra clave" maxlength="40">
    
            <br>
            </fieldset>

        </div>
        <div class="modal-footer">
            <input type="hidden" id="ver_palabra_clave">

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
                $('#addformpalabrasclaves').on('submit', function(e)
                {
                   e.preventDefault();
                    $("button").prop("disabled", true);

                    $.ajax({
                        type: "post",
                        url: "{{url('crearPalabrasClave/'.$id)}}",
                        data: $('#addformpalabrasclaves').serialize(),
                        success: function (response) {

                            $('#nuevaPalabraClave').modal('hide')
                            $('.yajra-palabras-claves').DataTable().ajax.reload();
                            $('#palabra_clave').val('');

                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Palabra clave Guardada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);
                        },
                        error: function(error){
                            //console.log(error)
                        $("button").prop("disabled", false);
                            alert("ERROR!! Palabra clave no guardada")
                        }
                    });
                }
                );
            }
        );

    </script>

@endpush
