<form id="addformActividad">
    @csrf
  <!-- Modal -->
  <div class="modal fade" id="nuevaActividad" tabindex="-1" role="dialog" aria-labelledby="modalNuevaActividad" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalNuevaActividad">Nueva Actividad</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

<fieldset>

        <div class="row">
            <div class="col-sm">
                <label for="tipo_actividad">Tipo de Actividad:</label><br>
                    <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="tipo_actividad" name="tipo_actividad">
                        @forelse($tipos_actividades as $tipo_actividad)
                            <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                        @empty
                            <option value=" "></option>
                        @endforelse
                    </select>
                <br />
            </div>

            <div class="col-sm">
                <label for="actividad_1">Actividad:</label><br>
                    <select class="form-control"  @if ( $mode == "show") disabled @endif aria-describedby="basic-addon1" id="actividad_1" name="actividad_1">
                        @forelse($actividades as $actividad)
                            <option value="{{$actividad->desc_actividad}}">{{$actividad->cod_actividad}} - {{$actividad->desc_actividad}}</option>
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

    <script>
        $(function() {
            console.log("{{ url('crearActividades/' . $id) }}")
        });
        $(document).ready(function() {
            $('#addformActividad').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: "{{ url('crearActividades/' . $id) }}",
                    data: $('#addformActividad').serialize(),
                    success: function(response) {
                        console.log(response)
                        $('#nuevaActividad').modal('hide')

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Actividad Guardada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })

                        $('.yajra-actividades').DataTable().ajax.reload();

                    },
                    error: function(error) {
                        console.log(error)
                        alert("ERROR!! Actividad no guardada")
                    }
                });
            });
        });

    </script>
    
@endpush
