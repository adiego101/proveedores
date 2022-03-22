<fieldset>
<div class="row">
        <h1>Actividad</h1>
</div>
<h1>actividades</h1>

<br/>
    <label for="facturacion_anual_alcanzada">Facturación anual alcanzada:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control limpiar" placeholder="Ingrese el monto de la facturación anual alcanzada" aria-describedby="basic-addon1" id="facturacion_anual_alcanzada"
    name="facturacion_anual_alcanzada" maxlength="9"
     @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->facturacion_anual_alcanzada) ? $proveedor->facturacion_anual_alcanzada : '' }}"><br>
@if ($mode == "edit")

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevaActividad">
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
                        <th>Tipo Actividad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    <br />

    @include('modales.modalBajaActividad')


    <hr>

    <label for="rne">Registro Nacional de Establecimientos (RNE) N°:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control limpiar" placeholder="Ingrese el número de RNE" aria-describedby="basic-addon1" id="rne" name="rne"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->rne) ? $proveedor->rne : '' }}" maxlength="8"><br>
@if ($mode == "edit")

<h1>Productos</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoProducto">
    Agregar Nuevo Producto
  </button><br>
<hr>
@endif
        <div>

            <table style="width:100%" class="yajra-productos table table-hover  table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>RNPA</th>
                        <th>Unidades producidas</th>
                        <th>Capacidad producción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        @include('modales.modalBajaProducto')

    <br />
<div class="row navbuttons ">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>

    <!--Incluimos el modal para validar una actividad -->

    @include('modales.validarActividad')

    <!--Incluimos el modal para editar un producto -->

    @include('modales.editarProducto')

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

  $(function () {

    console.log({{$id}});

    var table = $('.yajra-productos').DataTable({
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
            //{data: 'cuit', name: 'cuit'},
            //{data: 'en_la_provincia_de', name: 'en_la_provincia_de'},
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

    console.log({{$id}});

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

            //{data: 'en_la_provincia_de', name: 'en_la_provincia_de'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

  });

    //Funciones a implementar

    function verRegistro() {

        return  alert("Retornar vista para visualizar un registro!");
    }


    function bajaActividad(id_registro) {

        //Desplegamos el modal
        $('#modalBajaActividad').modal('show');
        $('#baja_actividad').val(id_registro);
    }


    function bajaProducto(id_registro) {

        //Desplegamos el modal
        $('#modal_baja_producto').modal('show');
        $('#baja_producto').val(id_registro);
    }

</script>

@endpush

</fieldset>
