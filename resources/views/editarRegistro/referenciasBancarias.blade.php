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
                    <th>Nombre Banco</th>
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

            $(document).on('click', '.edit_banco', function(event){
                console.log("detecta evento click en edit_banco");
                var id_proveedor=$(this).data('id-proveedor');
                var id_banco=$(this).data('id-banco');
                console.log("id_proveedor"+id_proveedor);
                let url = '{{ url("proveedor/:id_proveedor/banco/:id_banco/editar") }}';
                url = url.replace(':id_proveedor', id_proveedor);
                url = url.replace(':id_banco', id_banco);
                console.log(url);
                $('#update_banco').data('id-proveedor',id_proveedor);
                $('#update_banco').data('id-banco',id_banco);

                $.ajax({
                    url: url,
                    success: function(response) {
                        abrirModalverBanco(response);
                    }
                });
            });

            $("#update_banco").click(function(){
                let nombre_banco = $("#nombre_banco_edit").val();
                let localidad_sucursal = $("#localidad_sucursal_edit").val();
                let tipo_cuenta = $("#tipo_cuenta_edit").val();
                let nro_cuenta = $("#nro_cuenta_edit").val();
                console.log("nombre_banco="+nombre_banco+" localidad="+localidad_sucursal+" tipo cuenta="+tipo_cuenta+" nro_cuenta="+nro_cuenta);
                if(nombre_banco!='' && localidad_sucursal!='' && tipo_cuenta!='' && nro_cuenta!='')
                {
                    var id_proveedor=$(this).data('id-proveedor');
                    var id_banco=$(this).data('id-banco');
                    console.log("id_proveedor"+id_proveedor);
                    let url = '{{ url("proveedor/:id_proveedor/banco/:id_banco/actualizar") }}';
                    url = url.replace(':id_proveedor', id_proveedor);
                    url = url.replace(':id_banco', id_banco);
                    console.log("url"+url);
                    $("button").prop("disabled", true);
                    $.ajax({
                        type: "post",
                        url: url,
                        data:
                            {   nombre_banco:nombre_banco,
                                localidad_sucursal:localidad_sucursal,
                                tipo_cuenta:tipo_cuenta,
                                nro_cuenta:nro_cuenta
                            },
                        success: function(response) {
                            if(response['error'])
                            {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: response['error'],
                                    showConfirmButton: false,
                                    timer: 2500,
                                    toast: true
                                    });
                                $("button").prop("disabled", false);
                            }
                            else
                            {
                                $('#edit_banco').modal('hide');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Referencia bancaria guardada',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    toast: true

                                    });
                                $('.yajra-bancos').DataTable().ajax.reload();
                                $("button").prop("disabled", false);
                            }
                        },
                        error: function(error) {
                            //console.log(error)
                            $("button").prop("disabled", false);
                            alert("ERROR!! Referencia bancaria no guardada");
                        }
                    });
                }
                else
                {
                    event.preventDefault();
                    if(nombre_banco=='')
                        mostrarError($("#nombre_banco_edit"), '#small-banco-edit', '<p style="color:red;">El NOMBRE DEL BANCO DE REFERENCIA <strong>no</strong> puede quedar vacío.</p>');
                    if(localidad_sucursal=='')
                        mostrarError($("#localidad_sucursal_edit"), '#small-localidad-sucursal-edit', '<p style="color:red;">La LOCALIDAD DE LA SUCURSAL <strong>no</strong> puede quedar vacía.</p>');
                    if(tipo_cuenta=='')
                        mostrarError($("#tipo_cuenta_edit"), '#small-tipo-cuenta-edit', '<p style="color:red;">El TIPO DE CUENTA <strong>no</strong> puede quedar vacío.</p>');
                    if(nro_cuenta=='')
                        mostrarError($("#nro_cuenta_edit"), '#small-nro-cuenta-edit', '<p style="color:red;">El NRO DE CUENTA <strong>no</strong> puede quedar vacío.</p>');
                }
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
