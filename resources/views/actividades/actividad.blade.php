<fieldset>
    <h1 align="center">Actividades</h1>
    <hr>

@if ($mode == "edit")
<!-- Button trigger modal -->
<button type="button" class="btn float-right btn-success " data-toggle="modal" data-target="#nuevaActividad">
    Agregar Nueva Actividad
  </button><br>

@endif
        <div>

            <table style="width:100%" class="yajra-actividades table table-hover  table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Actividad Económica</th>
                        <th>Tipo Actividad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    <br/>

    @include('modales.modalBajaActividad')
    @include('edicionesModales.editarActividades')
    @include('edicionesModales.actividades')


    <!--Incluimos el modal para validar una actividad -->

    @include('modales.validarActividad')

@push('js')

<script type="text/javascript">
  $(function () {
    var table = $('.yajra-actividades').DataTable({
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
        processing: true,
        serverSide: true,
        ajax: "{{ url('actividades/'.$id.'/'.$mode) }}",
        columns: [
            {data: 'cod_actividad', name: 'cod_actividad'},
            {data: 'desc_actividad', name: 'desc_actividad'},
            {data: 'desc_tipo_actividad', name: 'desc_tipo_actividad'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
  });

    function verRegistro() {

        return  alert("Retornar vista para visualizar un registro!");
    }

    function bajaActividad(id_registro) {

        //Desplegamos el modal
        $('#modalBajaActividad').modal('show');
        $('#baja_actividad').val(id_registro);
    }

</script>
@endpush
</fieldset>
