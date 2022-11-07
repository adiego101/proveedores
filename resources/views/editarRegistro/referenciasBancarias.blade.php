<fieldset>
    <h1>Referencias Bancarias</h1><br>

    @if ($mode == 'edit')
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevoBanco">
            Agregar Nuevo Banco
        </button>

        <br>
        <br>

    @endif

    <div>

        <table style="width:100%" class="yajra-bancos table table-hover  table-striped table-condensed">
            <thead>
                <tr>
                    <th>Bancos con los que opera</th>
                    <th>Sucursal</th>
                    <th>Tipo cuenta</th>
                    <th>Nº cuenta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
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

    <!-- Incluimos el modal para dar de baja un banco -->
    {{-- @include('modales.bajaReferenciaBancaria') --}}

</fieldset>

@push('js')

    <script type="text/javascript">
    /*
        $(function() {

            var table = $('.yajra-bancos').DataTable({
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
                ajax: "{{ url('referenciasBancarias/' . $id . '/' . $mode) }}",
                columns: [
                    {
                        data: 'bancos',
                        name: 'bancos'
                    },
                    {
                        data: 'sucursales',
                        name: 'sucursales'
                    },
                    {
                        data: 'tipos_cuentas',
                        name: 'tipos_cuentas'
                    },
                    {
                        data: 'nros_cuentas',
                        name: 'nros_cuentas'
                    },
                    {
                        data: 'action',
                        name: 'action',

                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });


        function bajaReferenciaBancaria(id_registro) {

            //Desplegamos el modal
            $('#modal_baja_referencia_bancaria').modal('show');
            $('#baja_referencia_bancaria').val(id_registro);
        }

    */
    </script>
    
@endpush
