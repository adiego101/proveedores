<!-- Modal -->
@if ($mode != 'show')

<form id="editformSucursal">
    @endif
    @csrf
    <div class="modal fade" id="editarSucursal" tabindex="-1" role="dialog" aria-labelledby="modalEditarSucursal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($mode != 'show')
                    <h1 class="modal-title" id="modalEditarSucursal">Editar Sucursal</h1>
                    @else
                    <h1 class="modal-title" id="modalEditarSucursal">Sucursal</h1>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="respuesta">

                    </div>
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
        //console.log("no es un numero");
          return false;
        }
    }

</script>

<script>

    $(document).ready(  function()
        {

            $('#editformSucursal').on('submit', function(e)
            {
                let id_sucursal = $("#editar_sucursal").val();

                $("button").prop("disabled", true);

                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{url('guardarSucursales/')}}/"+id_sucursal,
                    data: $('#editformSucursal').serialize(),
                    success: function (response) {

                        $('#editarSucursal').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Sucursal Guardada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);

                        $('.yajra-sucursal').DataTable().ajax.reload();

                    },
                    error: function(error){
                        //console.log(error)
                        $("button").prop("disabled", false);
                        alert("ERROR!! Sucursal no guardada")
                    }
                });
            }
            );
        }
    );

</script>

@endpush
