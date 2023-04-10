@extends('layouts')

@push('head')
    <title>Historial de acciones</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content2')

<h2 class="h2 text-center font-weight-bold ">Historial de acciones</h2>

<hr>
<div class="table container-fluid overflow-auto" id="tabla">
        <table id="tabla_listado_logs" style="width:100%" class="table table-hover yajra-datatable">
            <thead class="bg-info" align="center">
                <tr>
                    <th align="center">Usuario</th>
                    <th align="center">Email</th>
                    <th align="center">Descripción</th>
                    <th align="center">Fecha</th>
                </tr>
            </thead>
        </table>
    </div>

@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            $("#tabla_listado_logs").DataTable({
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
                    ajax: "{{ route('listado_acciones') }}",
                    columns: [
                        {
                            data: 'EL_Nombre_Responsable',
                            defaultContent: ''
                        },
                        {
                            data: 'EL_Email_Responsable',
                            defaultContent: ''
                        },
                        {
                            data: 'EL_Evento',
                            defaultContent: ''
                        },
                        {
                            data: 'EL_Evento_Fecha',
                            defaultContent: ''
                        },

                    ]
            });

        });
    </script>

@endsection
