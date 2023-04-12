<fieldset>
<h1>Actividades</h1>
@if ($mode == "edit")
<br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevaActividad">
    Agregar Nueva Actividad
  </button><br>
<hr>
@endif
        <div>

            <table style="width:100%" class="yajra-actividades table table-hover  table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Actividad Económica</th>
                        <th>Agrupamiento</th>
                        <th>Tipo Actividad</th>
                        <th>Fin vigencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    <br />

    @include('modales.modalBajaActividad')
    @if($mode=='create')
        <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
        <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
    @else
        <div class="row navbuttons ">
            <div class="col-6 col-sm-auto" id="btnPrevious">
                <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
            </div>
            <div class="col-6 col-sm-auto" id="btnNext">
                <a class="btn btn-primary btnNext">Siguiente</a>
            </div>
        </div>
    @endif

    <!--Incluimos el modal para validar una actividad -->

    @include('modales.validarActividad')

@push('js')

<script type="text/javascript">


  $(function () {

    var table = $('.yajra-productos').DataTable({
    order: [[ 4, "desc" ]],

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
        ajax: "{{ url('productos/'.$id.'/'.$mode) }}",
        columns: [
            {data: 'producto_elaborado', name: 'producto_elaborado'},
            {data: 'rnpa', name: 'rnpa'},
            {data: 'Producida_unidad', name: 'Producida_unidad'},
            {data: 'capacidad_produccion_total', name: 'capacidad_produccion_total'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

  });

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
            {data: 'agrupamiento', name: 'agrupamiento'},
            {data: 'desc_tipo_actividad', name: 'desc_tipo_actividad'},
            {data: 'fecha_fin_vigencia', name: 'fecha_fin_vigencia'},
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
