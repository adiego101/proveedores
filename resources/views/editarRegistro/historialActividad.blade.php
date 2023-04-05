<fieldset>
<h1>Historial de actividades</h1>

        <div>
            <table style="width:100%" class="yajra-historialActividades table table-hover  table-striped table-condensed">
                <thead>
                    <tr>
                        <th>N° Disp.</th>
                        <th>Cod. Act.</th>
                        <th>Tipo de Act.</th>
                        <th>Actividad</th>
                        <th>Agrupamiento</th>
                        <th>Inicio vigencia</th>
                        <th>Fin vigencia</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    <br />

    <div class="row navbuttons ">
            <div class="col-6 col-sm-auto" id="btnPrevious">
                <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
            </div>
            <div class="col-6 col-sm-auto" id="btnNext">
                <a class="btn btn-primary btnNext">Siguiente</a>
            </div>
    </div>
 
@push('js')

<script type="text/javascript">

  $(function () {
    var table = $('.yajra-historialActividades').DataTable({
    order: [[ 5, "desc" ]],
 
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
        ajax: "{{ url('historialActividades/'.$id.'/'.$mode) }}",
       
        columns: [
            {data: 'nro_disposicion', name: 'nro_disposicion'},
            {data: 'cod_actividad', name: 'cod_actividad'},
            {data: 'desc_tipo_actividad', name: 'desc_tipo_actividad'},
            {data: 'desc_actividad', name: 'desc_actividad'},
            {data: 'agrupamiento', name: 'agrupamiento'},
            {data: 'fecha_ini_vigencia', name: 'fecha_ini_vigencia'},
            {data: 'fecha_fin_vigencia', name: 'fecha_fin_vigencia'},
        ]
    });

  });

</script>

@endpush

</fieldset>
