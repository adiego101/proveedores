<!-- Modal -->
  <form id="addformSeguro">
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
          <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

</form>

@push('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

<script type="text/javascript">

    function valideKey(evt){

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) { // espacio.
          return true;
        } else if(code>=48 && code<=57) { // es un numero.
          return true;
        } else{ // otras teclas
        console.log("no es un numero");
          return false;
        }
    }
    
</script>

<script>

$(function () {console.log("{{url('crearSeguros/'.$id)}}")});


        $(document).ready(  function()
            {
                $('#addformSeguro').on('submit', function(e)
                {
                    e.preventDefault();

                    $.ajax({
                        type: "post",
                        url: "{{url('crearSeguros/'.$id)}}",
                        data: $('#addformSeguro').serialize(),
                        success: function (response) {
                            console.log(response)
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
                        },
                        error: function(error){
                            console.log(error)
                            alert("ERROR!! Seguro no guardado")
                        }
                    });
                }
                );
            }
        );

</script>

@endpush
