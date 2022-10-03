<fieldset>
    <h1>Referencias Bancarias</h1><br>

    @if ($mode == 'edit')
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_banco">
            Agregar Nueva referencia bancaria
        </button>

        <br>
        <br>

    @endif

    <div>

        <table style="width:100%" class="yajra-bancos table table-hover  table-striped table-condensed">
            <thead>
                <tr>
                    <th>Bancos con los que opera</th>
                    <th>Localidad sucursal</th>
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
    @include('bancos.modal-create-edit',['mode'=>'create'])
    @include('bancos.modal-edit-edit',['mode'=>'edit'])
    {{-- @include('modales.bajaReferenciaBancaria') --}}

</fieldset>

@push('js')

    <script type="text/javascript">
        $(document).ready(function() {

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
                        data: 'nombre_banco',
                        name: 'nombre_banco'
                    },
                    {
                        data: 'localidades[0].id_localidad',
                        name: 'id_localidad',
                        visible: false,
                        searchable: false,
                    },
                    {
                        data: 'localidades[0].nombre_localidad',
                        name: 'nombre_localidad'
                    },
                    {
                        data: 'pivot.tipo_cuenta',
                        name: 'tipo_cuenta'
                    },
                    {
                        data: 'pivot.nro_cuenta',
                        name: 'nro_cuenta'
                    },
                    {
                        data: 'action',
                        name: 'action',

                        orderable: true,
                        searchable: true
                    }
                ]
                
            });

        });

        function verBanco(elemento) {
            console.log("**detecta evento click en edit_banco");
            var id_proveedor=elemento.data('id-proveedor');
            var id_banco=elemento.data('id-banco');
            console.log("id_proveedor = "+id_proveedor);
            let url = '{{ url("proveedor/:id_proveedor/banco/:id_banco") }}';
            url = url.replace(':id_proveedor', id_proveedor);
            url = url.replace(':id_banco', id_banco);
            console.log(url);
            $.ajax({
                url: url,
                success: function(response) {
                    abrirModalverBanco(response);
                }
            });
        }

        function abrirModalverBanco(response) {
            $('#edit_banco').modal('show');
            console.log("nombre_banco="+response['nombre_banco']);
            $("#nombre_banco_edit option[value='"+response['nombre_banco']+"']").attr('selected','selected').change();
        } 

        function bajaReferenciaBancaria(id_registro) {

            //Desplegamos el modal
            $('#modal_baja_referencia_bancaria').modal('show');
            $('#baja_referencia_bancaria').val(id_registro);
        }
    </script>
    
@endpush
