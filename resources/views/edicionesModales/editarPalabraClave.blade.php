<!-- Modal -->
@if ($mode != 'show')

  <form id="editformPalabrasclaves">
      @endif
    @csrf
  <div class="modal fade" id="editarPalabraClave" tabindex="-1" role="dialog" aria-labelledby="modalEditarPalabraClave" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalEditarPalabraClave">Palabra</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>
         
                <label for="palabras_claves">Palabra clave:</label><br>
                <input @if ($mode == 'show') readonly @endif type="text" class="form-control" aria-describedby="basic-addon1" id="palabras_claves" name="palabras_claves" placeholder="Ingrese una palabra clave" maxlength="40">
    
            <br>
            </fieldset>

        </div>
        <div class="modal-footer">
            <input type="hidden" id="id_palabra_clave">

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

        //Modificamos los datos de una palabra clave en la BD.
        $(document).ready(  function()
            {
                $('#editformPalabrasclaves').on('submit', function(e)
                {
                    e.preventDefault();
                    $("button").prop("disabled", true);

                    var id_palabra = $('#id_palabra_clave').val();

                    $.ajax({
                        type: "post",
                        url: "{{url('guardarPalabrasClave/')}}/"+id_palabra,
                        data: $('#editformPalabrasclaves').serialize(),
                        success: function (response) {

                            $('#editarPalabraClave').modal('hide')

                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Palabra clave Modificada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);

                            $('.yajra-palabras-claves').DataTable().ajax.reload();

                        },
                        error: function(error){
                            //console.log(error)
                        $("button").prop("disabled", false);
                            alert("ERROR!! Palabra clave no modificada")
                        }
                    });
                }
                );
            }
        );

    </script>

@endpush
