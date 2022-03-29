<!-- Modal -->
<form id="addformSucursal">
    @csrf
    <div class="modal fade" id="nuevaSucursal" tabindex="-1" role="dialog" aria-labelledby="modalNuevaSucursal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modalNuevaSucursal">Nueva Sucursal </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('sucursales.form')
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


    //Damos de alta una nueva sede en la BD.

    $(document).ready(  function()
        {
            $('#addformSucursal').on('submit', function(e)
            {
                e.preventDefault();
                $("button").prop("disabled", true);


                $.ajax({
                    type: "post",
                    url: "{{url('crearSucursales/'.$id)}}",
                    data: $('#addformSucursal').serialize(),
                    success: function (response) {
                        //console.log(response)
                        $('#nuevaSucursal').modal('hide')
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
