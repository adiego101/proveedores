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
        <div class="modal-body ui-front">
           @include('actividades.form',['mode'=>'modal-create'])
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
                        $('.yajra-historialActividades').DataTable().ajax.reload();

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
