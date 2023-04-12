@extends('layouts')

@push('head')
    <title>Proveedores vigentes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content2')
<h2 class="h2 text-center font-weight-bold ">Proveedores vigentes</h2>
<hr>

<div class="table container-fluid overflow-auto" id="tabla">
    <table id="tabla_vigentes" style="width:100%" class="table table-hover yajra-vigentes">
        <thead class="bg-info" >
            <tr>
                <th align="center">Nombre de fantasía</th>
                <th align="center">Razón Social</th>
                <th align="center">CUIT</th>
                <th align="center">Tipo disp</th>
                <th align="center">Fin vigencia</th>
            </tr>
        </thead>
    </table>
</div>


@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(function () {

    var table = $('.yajra-vigentes').DataTable({
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
        ajax: "{{ route('listado.proveedoresVigentes') }}",
        columns: [
            {data: 'nombre_fantasia',

            },
            {data: 'razon_social',

            },
           {data: 'cuit',

            },
            {data: 'disposicion_tipo',

            },
            {data: 'fecha',

        },
        ]
    });

  });
</script>
@endpush
