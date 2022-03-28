@if ($mode != 'show')
<form id="editara">
    @endif
    @csrf
  <!-- Modal -->
  <div class="modal fade" id="editarActividad" tabindex="-1" role="dialog" aria-labelledby="modalNuevaActividad" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalNuevaActividad">Editar Actividad</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <fieldset>

                    <div class="row">
                        <div class="col-sm">
                            <label for="tipo_actividad1">Tipo de Actividad:</label><br>
                                <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="tipo_actividad1" name="tipo_actividad1">
                                    @forelse($tipos_actividades as $tipo_actividad)
                                        <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                                    @empty
                                        <option value=" "></option>
                                    @endforelse
                                </select>
                            <br />
                        </div>

                        <div class="col-sm">
                            <label for="actividad_11">Actividad:</label><br>
                                <select class="form-control"  @if ( $mode == "show") disabled @endif aria-describedby="basic-addon1" id="actividad_11" name="actividad_11">
                                    <option value="">Seleccione una Actividad</option>

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
            <input type="hidden" id="editar_actividad1">
            <input type="hidden" id="ver_actividad1">
            @if ($mode != 'show') <button type="submit" class="btn btn_editar_actividad btn-success">Guardar</button> @endif
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  @if ($mode != 'show')
</form>
@endif

@push('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <script>
        $(document).on("click", ".btn_editar_actividad", function() {

            //Obtenemos el numero de la fila que queremos modificar
            let id = $("#editar_actividad").val();


        });

        $(document).on("click", ".btn_ver_actividad", function() {

            //Obtenemos el numero de la fila que queremos modificar
            let id = $("#ver_actividad").val();
        });


        $(document).ready(function() {
            $('#editara').on('submit', function(e) {
                e.preventDefault();
                let id_registro = $("#editar_actividad1").val();
                console.log("{{ url('guardarActividades/') }}/" + id_registro);

                $.ajax({
                    type: "post",
                    url: "{{ url('guardarActividades/') }}/" + id_registro,
                    data: $('#editara').serialize(),
                    success: function(response) {
                        console.log(response)
                        $('#editarActividad').modal('hide')
                  
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Actividad Modificada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })

                        $('.yajra-actividades').DataTable().ajax.reload();

                    },
                    error: function(error) {
                        console.log(error)
                        alert("ERROR!! Actividad no guardado")
                    }
                });
            });
        });
        function verActividad(id_registro) {

            $.ajax({
                url: "{{ url('verActividades/') }}/" + id_registro,
                success: function(response) {


                    abrirModalverActividad(response);
                }
            });

            function abrirModalverActividad(response) {
                $('#editarActividad').modal('show');
                console.log(response);
                console.log(response['id_actividad_economica']);

                console.log(response['id_tipo_actividad']);


                $('#tipo_actividad1').val(response['desc_tipo_actividad']);
                $('#actividad_11').val(response['desc_actividad']);

                $('#editar_actividad1').val(response['id_actividad_proveedor']);
                $('#ver_actividad1').val(response['id_actividad_proveedor']);

                $('.yajra-actividades').DataTable().ajax.reload();

                console.log(response);

            }
        }
    </script>
@endpush
