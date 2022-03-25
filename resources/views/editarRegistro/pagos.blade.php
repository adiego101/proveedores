<fieldset>
    <h1>Pagos</h1>
    <br>
    <h4>Tipo de Proveedor:</h4><br>

    <input @if ($mode == 'show') onclick="return false" @endif
        {{ !$proveedores_tipos_proveedores->where('id_tipo_proveedor', '1')->isEmpty() ? 'checked' : '' }}
        type="checkbox" id="prov_estado" value="0" name="prov_estado">
    <label for="prov_estado">Proveedor del Estado</label><br>

    <input @if ($mode == 'show') onclick="return false" @endif
        {{ !$proveedores_tipos_proveedores->where('id_tipo_proveedor', '2')->isEmpty() ? 'checked' : '' }}
        type="checkbox" id="prov_minero" value="0" name="prov_minero">
    <label for="prov_minero">Proveedor Minero</label><br>

    <input @if ($mode == 'show') onclick="return false" @endif
        {{ !$proveedores_tipos_proveedores->where('id_tipo_proveedor', '3')->isEmpty() ? 'checked' : '' }}
        type="checkbox" id="prov_petrolero" value="0" name="prov_petrolero">
    <label for="prov_petrolero">Proveedor Petrolero</label><br>

    <input @if ($mode == 'show') onclick="return false" @endif
        {{ !$proveedores_tipos_proveedores->where('id_tipo_proveedor', '4')->isEmpty() ? 'checked' : '' }}
        type="checkbox" id="prov_provincial" value="0" name="prov_provincial">
    <label for="prov_provincial">Productor Provincial</label><br>

    <br>

    <hr>

    <h4>Registro de Pagos de inscripción y renovación:</h4><br>

    @if ($mode == 'edit')
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevoPago">
            Agregar Nuevo Pago
        </button>


        <br>
        <hr>
    @endif



    <div>

        <table style="width:100%" class="yajra-pagos table table-hover  table-striped table-condensed">
            <thead>
                <tr>
                    <th>fecha</th>
                    <th>importe</th>
                    <th>observaciones</th>
                    {{-- <th>Correo electrónico</th>
                        <th>Teléfono</th> --}}
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



    <div class="row navbuttons ">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
        </div>
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Siguiente</a>
        </div>
    </div>

    <!--Incluimos el modal para editar los campos de un pago-->
    @include('modales.modalBajaPago')

</fieldset>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function() {

            console.log({{ $id }});

            var table = $('.yajra-pagos').DataTable({
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
                ajax: "{{ url('pagos/' . $id . '/' . $mode) }}",
                columns: [{
                        data: 'fecha',

                        render: function(data) {

                            let fecha_sin_hora_pagos = data.split(' ')[0];
                            let fecha_local_pagos = fecha_sin_hora_pagos.split('-').reverse().join(
                                '/');

                            return fecha_local_pagos;
                        }
                    },


                    {
                        data: 'importe',
                        name: 'importe'
                    },
                    {
                        data: 'observaciones',
                        name: 'observaciones'
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


        function bajaPago(id_registro) {

            //Desplegamos el modal
            $('#modal_baja_pago').modal('show');
            $('#baja_pago').val(id_registro);
        }


    </script>
@endpush
