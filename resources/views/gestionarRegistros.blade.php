@extends('layouts')
@push('head')
    <title>Gestionar Registros</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content2')

    <h2 class="mb-4">Gestionar Registros:</h2>

    <div class="table container-fluid overflow-auto" id="tabla">
        <table id="tabla_consulta" style="width:100%" class="table table-hover yajra-datatable">
            <thead class="bg-info" align="center">
                <tr>
                    <th align="center">Nombre de fantasía</th>
                    <th align="center">Razón Social</th>
                    <th align="center">CUIT</th>
                    <!--<th align="center">Dada de baja</th>-->
                    <th align="center">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>

<!--Incluimos el modal para dar de baja un registro -->
@include('modalBajaRegistro')

<!--Incluimos el modal para dar de alta un registro -->
@include('modalAltaRegistro')


@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(function () {

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
        ajax: "{{ route('registros.list') }}",
        columns: [
            {data: 'nombre_fantasia', 
            render: function (data, type, row){
                
                if (row['dado_de_baja'] === 0)
                        return data;
                    else
                        return '<div style="color:red;">'+data+'</div>';
            }
            },
            {data: 'razon_social', 
            render: function (data, type, row){
                
                if (row['dado_de_baja'] === 0)
                        return data;
                    else
                        return '<div style="color:red;">'+data+'</div>';
            }
            },
           {data: 'cuit', 
            render: function (data, type, row){
                
                if (row['dado_de_baja'] === 0)
                        return data;
                    else
                        return '<div style="color:red;">'+data+'</div>';
            }
            },
            /*{data: 'dado_de_baja',
            render: function(data){
                    if (data === 0)
                        return 'No';
                    else
                        return '<div style="background-color:yellow;">Si</div>';
                }
            },*/
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

  });


    function bajaRegistro(id_registro) {

        //Desplegamos el modal
        $('#modal_baja').modal('show');
        $('#id_baja').val(id_registro);
    }

    function altaRegistro(id_registro) {

        //Desplegamos el modal
        $('#modal_alta').modal('show');
        $('#id_alta').val(id_registro);
    }

</script>

@endpush
