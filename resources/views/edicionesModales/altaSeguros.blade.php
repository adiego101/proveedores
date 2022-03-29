<!-- Modal -->
@if ($mode != 'show')

  <form id="addformSeguro">
      @endif
    @csrf
  <div class="modal fade" id="nuevoSeguro" tabindex="-1" role="dialog" aria-labelledby="modalNuevoSeguro" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalNuevoSeguro">Nuevo Seguro</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <fieldset>

            <div class="row">
                <div class="col-sm">
                    <label for="poliza">Póliza:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese la póliza" aria-describedby="basic-addon1" id="poliza" name="poliza" maxlength="20" required/><br />

                    <label for="asegurado">Asegurado:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese el asegurado" aria-describedby="basic-addon1" id="asegurado" name="asegurado" maxlength="40" required/><br />
                </div>

                <div class="col-sm">
                    <label for="agencia">Agencia:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese la agencia" aria-describedby="basic-addon1" id="agencia" name="agencia" maxlength="40" required/><br />

                    <label for="vigencia_hasta">Vigencia hasta:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="date" class="form-control" placeholder="Ingrese la fecha de vigencia" aria-describedby="basic-addon1" id="vigencia_hasta" name="vigencia_hasta" required/><br />
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

<script type="text/javascript">

    function valideKey(evt){

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) { // espacio.
          return true;
        } else if(code>=48 && code<=57) { // es un numero.
          return true;
        } else{ // otras teclas
        //console.log("no es un numero");
          return false;
        }
    }

</script>

<script>

        $(document).ready(  function()
            {
                $('#addformSeguro').on('submit', function(e)
                {
                   e.preventDefault();
                $("button").prop("disabled", true);

                    $.ajax({
                        type: "post",
                        url: "{{url('crearSeguros/'.$id)}}",
                        data: $('#addformSeguro').serialize(),
                        success: function (response) {

                            $('#nuevoSeguro').modal('hide')
                            $('.yajra-seguros').DataTable().ajax.reload();
                            $('#poliza').val('');
                            $('#asegurado').val('');
                            $('#agencia').val('');
                            $('#vigencia_hasta').val('');

                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Seguro Guardado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);
                        },
                        error: function(error){
                            //console.log(error)
                        $("button").prop("disabled", false);
                            alert("ERROR!! Seguro no guardado")
                        }
                    });
                }
                );
            }
        );

</script>

@endpush
