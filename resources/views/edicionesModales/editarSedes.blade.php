<!-- Modal -->
<form id="editformSede">
    @csrf
  <div class="modal fade" id="editarSede" tabindex="-1" role="dialog" aria-labelledby="modalEditarSede" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalEditarSede">Editar Sede</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <fieldset>

                <label for="Domicilios">Domicilio:</label><br />
                <input type="text" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="Domicilios" name="Domicilios" maxlength="50" required/><br />

                <div class="row">
                        <div class="col-sm">
                            <label for="provincia_sedes">Provincia:</label><br>
                            <select  @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="provincia_sedes" name="provincia_sedes" required>
                            <option value="">Seleccione una provincia</option>
                            @forelse($provincias as $provincia)
                                @if (isset($provinciaid))
                                    @if ($provincia->id_provincia == $provinciaid)
                                        <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                                    @else
                                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                                    @endif
                                @else
                                    <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                                @endif
                            @empty
                                <option value=" "></option>
                            @endforelse
                            </select>
                            <br>
                        </div>

                        <div class="col-sm">
                            <label for="Localidades">Localidad:</label><br>
                            <select  @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="Localidades" name="Localidades" required>
                            <option value="">Seleccione una localidad</option>
                            @forelse($localidades as $localidad)
                                <option value="{{$localidad->id_localidad}}">{{$localidad->nombre_localidad}}</option>
                            @empty
                                <option value=" "></option>
                            @endforelse
                            </select>
                            <br>

                        </div>
                        <input type="hidden" id="id_proveedor_sede" name="id_proveedor_sede">
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

<script type="text/javascript">

window.onload = function(){
    recargarLista();
        };

    $(document).ready(function(){

        $('#provincia_sedes').change(function(){
            recargarListaSeguro();
        });
    })
</script>

<script type="text/javascript">

    function recargarLista(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/')}}/{{isset($sede->Localidad) ? $sede->Localidad : ''}}",
            success:function(r){
                $('#Localidades').html(r);
            }
        });
    }

    function recargarListaSeguro(){
            $.ajax({
                type:"GET",
                url:"{{url('localidades/')}}/"+$('#provincia_sedes').val(),
                success:function(r){
                    $('#Localidades').html(r);
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


//Modificamos los datos de una sede en la BD.
        $(document).ready(  function()
            {
                $('#editformSede').on('submit', function(e)
                {
                    e.preventDefault();
                    console.log($('#id_proveedor_sede').val());
                    
                    var id_proveedor = $('#id_proveedor_sede').val();
                    console.log("{{url('guardarSedes/')}}/"+id_proveedor);
                    $.ajax({
                        type: "post",
                        url: "{{url('guardarSedes/')}}/"+id_proveedor,
                        data: $('#editformSede').serialize(),
                        success: function (response) {
                            console.log(response)
                            $('#editarSede').modal('hide')
                            alert("Sede Modificada");
                            $('.yajra-sedes').DataTable().ajax.reload();

                        },
                        error: function(error){
                            console.log(error)
                            alert("ERROR!! Sede no modificada")
                        }
                    });
                }
                );
            }
        );


    </script>
@endpush
