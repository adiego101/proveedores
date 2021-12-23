<fieldset>
<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->
<h2 class="mb-4">Gestionar Sucursales:</h2>
<div>

    <table style="width:100%" class="yajra-datatable table table-hover  table-striped table-condensed">
        <thead>
            <tr>
                <th>Nombre sucursal</th>
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

    <!--Incluimos el modal para dar de baja un registro -->
    <!-- Falta incluir el modal -->
@include('modales.modalBajaSucursal')
    <br/>

    <div class="row navbuttons pt-5">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-primary btnPrevious">Anterior</a>
        </div>
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Siguiente</a>
        </div>
    </div>

    <!--Incluimos el modal para editar los campos -->

    {{--@include('modales.editarSucursal')--}}



</fieldset>


@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(function () {

    console.log({{$id}});

    var table = $('.yajra-datatable').DataTable({
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
        ajax: "{{ url('sucursales/'.$id) }}",
        columns: [
            {data: 'nombre_sucursal', name: 'nombre_sucursal'},
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

    //Funciones a implementar

    function verRegistro() {

        return  alert("Retornar vista para visualizar un registro!");
    }


    function bajaSucursal(id_sucursal) {

         //Desplegamos el modal
         $('#modalBajaSucursal').modal('show');
         $('#baja').val(id_sucursal);
    }
</script>


@endpush
