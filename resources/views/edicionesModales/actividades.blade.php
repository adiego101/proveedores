@if ($mode != 'show')
<form id="addformActividad">
@endif
    @csrf
  <!-- Modal -->
  <div class="modal fade" id="nuevaActividad"  role="dialog" aria-labelledby="modalNuevaActividad" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalNuevaActividad">Nueva Actividad</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


                <label for="tipo_actividad">Tipo de Actividad:</label><br>
                    <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="tipo_actividad" name="tipo_actividad">
                        @forelse($tipos_actividades as $tipo_actividad)
                            <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                        @empty
                            <option value=" "></option>
                        @endforelse
                    </select>
                <br />

                <label for="actividad_1">Actividad:</label><br>
                <select  class=" js-example-basic-single form-control"  @if ( $mode == "show") disabled @endif  id="actividad_1" name="actividad_1">
                    @forelse($actividades as $actividad)
                        <option value="{{$actividad->desc_actividad}}">{{$actividad->cod_actividad}} - {{$actividad->desc_actividad}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br />
        <br>

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

    <script>

        $(document).ready(function() {
            $('#addformActividad').on('submit', function(e) {
               e.preventDefault();
                $("button").prop("disabled", true);

                $.ajax({
                    type: "post",
                    url: "{{ url('crearActividades/' . $id) }}",
                    data: $('#addformActividad').serialize(),
                    success: function(response) {

                        $('#nuevaActividad').modal('hide')

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Actividad Guardada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);

                        $('.yajra-actividades').DataTable().ajax.reload();

                    },
                    error: function(error) {
                        //console.log(error)
                        $("button").prop("disabled", false);
                        alert("ERROR!! Actividad no guardada")
                    }
                });
            });
        });

    </script>

@endpush
