<!-- Modal -->
<form id="editformSucursal">
    @csrf
    <div class="modal fade" id="editarSucursal" tabindex="-1" role="dialog" aria-labelledby="modalEditarSucursal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarSucursal">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="respuesta">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('js')

<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia').change(function(){
			recargarListaSucursal();
		});
	})
    window.onload = function(){

        {{isset($sucursal->id_localidad) ? 'recargarListaSucursal2();' : ''}}

        };
</script>


<script type="text/javascript">
	function recargarListaSucursal(){
		$.ajax({
			type:"GET",
			url:"{{url('localidades/')}}/"+$('#provincia').val(),
			success:function(r){
				$('#id_localidad').html(r);
			}
		});
	}
    function recargarListaSucursal2(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/')}}/{{isset($sucursal->id_localidad) ? $sucursal->id_localidad : ''}}",
            success:function(r){
                $('#id_localidad').html(r);
            }
        });
    }
</script>

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
    //Damos de alta una nueva sede en la BD.
    $(function () {
        console.log($('#id_sucursal').val());
        console.log("{{url('guardarSucursales/')}}"+$('#id_sucursal').val())
    });

    $(document).ready(  function()
        {

            $('#editformSucursal').on('submit', function(e)
            {
                let id_sucursal = $("#editar_sucursal").val();

                console.log($("#editar_sucursal").val());


                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{url('guardarSucursales/')}}/"+id_sucursal,
                    data: $('#editformSucursal').serialize(),
                    success: function (response) {
                        console.log(response);
                        $('#editarSucursal').modal('hide');
                        alert("Sucursal Guardada");
                        $('.yajra-sucursal').DataTable().ajax.reload();

                    },
                    error: function(error){
                        console.log(error)
                        alert("ERROR!! Sucursal no guardada")
                    }
                });
            }
            );
        }
    );
</script>
@endpush


