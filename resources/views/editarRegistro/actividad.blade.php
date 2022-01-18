<fieldset>
<div class="row">
        <h1>Actividad</h1>
</div>

<br/>
    <label for="facturacion_anual_alcanzada">Facturación anual alcanzada:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el monto de la facturación anual alcanzada" aria-describedby="basic-addon1" id="facturacion_anual_alcanzada"
    name="facturacion_anual_alcanzada"
     @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->facturacion_anual_alcanzada) ? $proveedor->facturacion_anual_alcanzada : '' }}"><br>


        <div>

            <table style="width:100%" class="yajra-actividades table table-hover  table-striped table-condensed">
                <thead>
                    <tr>
                        <th>id_actividad_economica</th>
                        <th>id_tipo_actividad</th>
                        {{--<th>Correo electrónico</th>
                            <th>Teléfono</th>--}}
                            <th>Acciones</th>
                      <!--  <th>Username</th>
                        <th>Phone</th>
                        <th>DOB</th> -->
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
    <input type="text" class="form-control" placeholder="Ingrese el número de RNE" aria-describedby="basic-addon1" id="rne" name="rne"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->rne) ? $proveedor->rne : '' }}"><br>

        <div>

            <table style="width:100%" class="yajra-productos table table-hover  table-striped table-condensed">
                <thead>
                    <tr>
                        <th>producto_elaborado</th>
                        <th>rnpa</th>

                        <th>Producida_unidad</th>

                        <th>capacidad_produccion_total</th>

                        {{--<th>Correo electrónico</th>
                            <th>Teléfono</th>--}}
                            <th>Acciones</th>
                      <!--  <th>Username</th>
                        <th>Phone</th>
                        <th>DOB</th> -->
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
        <a class="btn btn-primary btnPrevious">Anterior</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>
    <!--Incluimos el modal para mostrar mensaje de aviso -->

    @include('modales.avisoActividad')

    <!--Incluimos el modal para editar un producto -->

    @include('modales.editarProducto')

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
        ajax: "{{ url('productos/'.$id) }}",
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
        ajax: "{{ url('actividades/'.$id) }}",
        columns: [
            {data: 'id_actividad_economica', name: 'id_actividad_economica'},
            {data: 'id_tipo_actividad', name: 'id_tipo_actividad'},
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
