<!-- Modal -->
@if ($mode != 'show')
<form id="editformSeguro">
@endif
    @csrf
  <div class="modal fade" id="editarSeguro" tabindex="-1" role="dialog" aria-labelledby="modalEditarSeguro" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalEditarSeguro">Editar Seguro</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <fieldset>

            <div class="row">
                <div class="col-sm">
                    <label for="polizas">Póliza:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese la póliza" aria-describedby="basic-addon1" id="polizas" name="polizas" maxlength="20" required/><br />

                    <label for="asegurados">Asegurado:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese el asegurado" aria-describedby="basic-addon1" id="asegurados" name="asegurados" maxlength="40" required/><br />
                </div>

                <div class="col-sm">
                    <label for="agencias">Agencia:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" class="form-control" placeholder="Ingrese la agencia" aria-describedby="basic-addon1" id="agencias" name="agencias" maxlength="40" required/><br />

                    <label for="vigencias_hasta">Vigencia hasta:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="date" class="form-control" placeholder="Ingrese la fecha de vigencia" aria-describedby="basic-addon1" id="vigencias_hasta" name="vigencias_hasta" required/><br />
                </div>

                <input type="hidden" id="id_proveedor_seguro" name="id_proveedor_seguro">
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

//Modificamos los datos de un seguro en la BD.
$(document).ready(  function()
            {
                $('#editformSeguro').on('submit', function(e)
                {
                    e.preventDefault();

                    var id_proveedor = $('#id_proveedor_seguro').val();
           
                    $.ajax({
                        type: "post",
                        url: "{{url('guardarSeguros/')}}/"+id_proveedor,
                        data: $('#editformSeguro').serialize(),
                        success: function (response) {
                           
                            $('#editarSeguro').modal('hide')
                        
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Seguro Modificado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })

                            $('.yajra-seguros').DataTable().ajax.reload();

                        },
                        error: function(error){
                            console.log(error)
                            alert("ERROR!! Seguro no modificado")
                        }
                    });
                }
                );
            }
        );

</script>

@endpush
