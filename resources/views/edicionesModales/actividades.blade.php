



  <form id="addformActividad">
    @csrf
  <!-- Modal -->
  <div class="modal fade" id="nuevaActividad" tabindex="-1" role="dialog" aria-labelledby="modalNuevaActividad" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNuevaActividad">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

<fieldset>
    <div class="row">
            <h1>Actividad</h1>
    </div>

    <br/>
        <div class="row">
            <div class="col-sm">
                <label for="tipo_actividad">Tipo de Actividad:</label><br>
                    <select @if ( $mode == "show") disabled @endif
                     class="form-control" aria-describedby="basic-addon1" id="tipo_actividad" name="tipo_actividad">
                        @forelse($tipos_actividades as $tipo_actividad)
                        @if ($mode == "create")
                            <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                        @else

                        @endif
                        @empty
                            <option value=" "></option>
                        @endforelse
                    </select>
                <br />
            </div>

            <div class="col-sm">
                <label for="actividad">Actividad:</label><br>
                <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="actividad_1" name="actividad_1">
                @forelse($actividades as $actividad2)
                @if ($mode == "create")
                <option value="{{$actividad2->desc_actividad}}">{{$actividad2->cod_actividad}} - {{$actividad2->desc_actividad}}</option>
                @endif


                @empty
                    <option value=" "></option>
                @endforelse
                </select>
                <br />
            </div>
        </div>
        <br>
    </fieldset>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

  @push('js')
<script>

$(function () {console.log("{{url('crearActividad/'.$id)}}")});


        $(document).ready(  function()
            {
                $('#addformactividad').on('submit', function(e)
                {
                    e.preventDefault();

                    $.ajax({
                        type: "post",
                        url: "{{url('crearActividades/'.$id)}}",
                        data: $('#addformactividad').serialize(),
                        success: function (response) {
                            console.log(response)
                            $('#nuevaActividad').modal('hide')
                            alert("Actividad Guardada");
                            $('.yajra-actividad').DataTable().ajax.reload();

                        },
                        error: function(error){
                            console.log(error)
                            alert("ERROR!! Actividad no guardado")
                        }
                    });
                }
                );
            }
        );


    </script>
@endpush
