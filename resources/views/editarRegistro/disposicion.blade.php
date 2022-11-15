<fieldset>
<h1>Disposiciones</h1>
@if ($mode == "edit")
<br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_disposicion">
    Agregar Nueva Disposición
  </button><br>
<hr>
@endif
        <div>

            <table style="width:100%" class="yajra-disposiciones table table-hover  table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Número</th>
                        <th>Inicio vigencia</th>
                        <th>Fin vigencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

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

    @include('disposiciones.modal-create-edit',['mode'=>'modal-create'])
    @include('disposiciones.modal-edit-edit',['mode'=>'modal-edit'])
    @include('disposiciones.modal-edit-show',['mode'=>'show'])

@push('js')

<script type="text/javascript">


    $(document).ready(function () {

        var table = $('.yajra-disposiciones').DataTable({
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
            ajax: "{{ url('proveedor/'.$id.'/disposiciones/'.$mode) }}",
            columns: [
                {data: 'disposicion_tipo', name: 'tipo'},
                {data: 'nro_disposicion', name: 'numero'},
                {data: 'fecha_ini_vigencia', name: 'fecha_inicio'},
                {data: 'fecha_fin_vigencia', name: 'fecha_fin'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

        $("#store_disposicion").click(function(){
            let tipo_disposicion = $("#tipo_disposicion_modal-create").val();
            //let nro_expte_gde = $("#nro_expte_gde_modal-create").val();
            let nro_disposicion = $("#nro_disposicion_modal-create").val();
            let fecha_inicio = $("#fecha_inicio_disposicion_modal-create").val();
            let fecha_fin = $("#fecha_fin_disposicion_modal-create").val();
            let observaciones = $("#observaciones_disposicion_modal-create").val();
            if(tipo_disposicion != '' && nro_disposicion != '' && fecha_inicio != '' && fecha_fin != '')
            {
                let datos = {
                                tipo_disposicion:tipo_disposicion,
                                nro_disposicion:nro_disposicion,
                                fecha_inicio:fecha_inicio,
                                fecha_fin:fecha_fin,
                                observaciones:observaciones}
                let url = '{{ url("proveedor/$id/disposicion/guardar") }}';
                $("button").prop("disabled", true);
                $.ajax({
                    type: "post",
                    url: url,
                    data: datos,
                    success: function(response) {

                        $('#add_disposicion').modal('hide');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Disposicion Guardada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            });
                        $('.yajra-disposiciones').DataTable().ajax.reload();
                        $("button").prop("disabled", false);
                    },
                    error: function(error) {
                        //console.log(error)
                        $("button").prop("disabled", false);
                        alert("ERROR!! Disposicion no guardada");
                    }
                });
            }
            else
                event.preventDefault();
        });

        $(document).on('click', '.edit_disposicion', function(event){
            //event.stopImmediatePropagation();
            console.log("detecta evento click en edit_disposicion");
            var id_proveedor=$(this).data('id-proveedor');
            var id_disposicion=$(this).data('id-disposicion');
            console.log("id_proveedor"+id_proveedor);
            let url = '{{ url("proveedor/:id_proveedor/disposicion/:id_disposicion/editar") }}';
            url = url.replace(':id_proveedor', id_proveedor);
            url = url.replace(':id_disposicion', id_disposicion);
            console.log(url);
            $('#update_disposicion').data('id-proveedor',id_proveedor);
            $('#update_disposicion').data('id-disposicion',id_disposicion);

            $.ajax({
                url: url,
                success: function(response) {
                    abrirModalverDisposicion(response);
                }
            });

        });

        $(document).on('click', '.show_disposicion', function(event){
            //event.stopImmediatePropagation();
            console.log("detecta evento click en show_disposicion");
            var id_proveedor=$(this).data('id-proveedor');
            var id_disposicion=$(this).data('id-disposicion');
            console.log("id_proveedor"+id_proveedor);
            let url = '{{ url("proveedor/:id_proveedor/disposicion/:id_disposicion/editar") }}';
            url = url.replace(':id_proveedor', id_proveedor);
            url = url.replace(':id_disposicion', id_disposicion);
            console.log(url);
            $('#update_disposicion').data('id-proveedor',id_proveedor);
            $('#update_disposicion').data('id-disposicion',id_disposicion);

            $.ajax({
                url: url,
                success: function(response) {
                    abrirModalverDisposicion(response);
                }
            });

        });

        $("#update_disposicion").click(function(){
            let tipo_disposicion = $("#tipo_disposicion_modal-edit").val();
            //let nro_expte_gde = $("#nro_expte_gde_modal-edit").val();
            let nro_disposicion = $("#nro_disposicion_modal-edit").val();
            let fecha_inicio = $("#fecha_inicio_disposicion_modal-edit").val();
            let fecha_fin = $("#fecha_fin_disposicion_modal-edit").val();
            let observaciones = $("#observaciones_disposicion_modal-edit").val();
            console.log("datos disposicion tipo_disposicion="+tipo_disposicion+" nro_disposicion="+nro_disposicion+" fecha inicio="+fecha_inicio+" fecha fin="+fecha_fin+" observaciones="+observaciones);
            if(tipo_disposicion!='' /*&& nro_expte_gde!=''*/ && nro_disposicion!='' && fecha_inicio!='' && fecha_fin!='')
            {
                var id_proveedor=$(this).data('id-proveedor');
                var id_disposicion=$(this).data('id-disposicion');
                console.log("id_proveedor"+id_proveedor+" id_disposicion="+id_disposicion);
                let url = '{{ url("proveedor/:id_proveedor/disposicion/:id_disposicion/actualizar") }}';
                url = url.replace(':id_proveedor', id_proveedor);
                url = url.replace(':id_disposicion', id_disposicion);
                console.log("url"+url);
                $("button").prop("disabled", true);
                $.ajax({
                    type: "post",
                    url: url,
                    data:
                        {   tipo_disposicion:tipo_disposicion,
                            //nro_expte_gde:nro_expte_gde,
                            nro_disposicion:nro_disposicion,
                            fecha_inicio:fecha_inicio,
                            fecha_fin:fecha_fin,
                            observaciones:observaciones
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
                            $('#edit_disposicion').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Disposición guardada',
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true

                                });
                            $('.yajra-disposiciones').DataTable().ajax.reload();
                            $("button").prop("disabled", false);
                        }
                    },
                    error: function(error) {
                        //console.log(error)
                        $("button").prop("disabled", false);
                        alert("ERROR!! Diposición no guardada");
                    }
                }).done(function(){console.log("si pasa por ak!!");});
            }
            else
            {
                $('#small-tipo_disposicion_{{$mode}}').empty();
                event.preventDefault();
                if(tipo_disposicion=='')
                {
                    $("#tipo_disposicion_{{$mode}}").css('border','1px solid red');
                    $('#small-tipo-disposicion-modal-edit').append('<p style="color:red;">El TIPO DE DISPOSICIÓN <strong>no</strong> puede quedar vacío.</p>');
                }
                /*if(nro_expte_gde=='')
                    mostrarError($("#nro_expte_gde_modal-edit"), '#small-nro-expte-gde-modal-edit', '<p style="color:red;">El NÚMERO DE EXPEDIENTE DE GDE <strong>no</strong> puede quedar vacía.</p>');*/
                if(nro_disposicion=='')
                    mostrarError($("#nro_disposicion_modal-edit"), '#small-nro-disposicion-modal-edit', '<p style="color:red;">El NÚMERO DE DISPOSICIÓN <strong>no</strong> puede quedar vacío.</p>');
                if(fecha_inicio=='')
                    mostrarError($("#fecha_inicio_disposicion_modal-edit"), '#small-fecha-inicio-modal-edit', '<p style="color:red;">La FECHA DE INICIO DE VIGENCIA <strong>no</strong> puede quedar vacía.</p>');
                if(fecha_fin=='')
                    mostrarError($("#fecha_fin_disposicion_modal-edit"), '#small-fecha-fin-modal-edit', '<p style="color:red;">La FECHA DE FIN DE VIGENCIA <strong>no</strong> puede quedar vacía.</p>');
            }
        });

        $('#add_disposicion').on('hidden.bs.modal', function (event) {
            //Obtenemos los campos obligatorios para aplicarles estilos css
            borrarDatosModalDisposicion();
        });

        $('#edit_disposicion').on('hidden.bs.modal', function (event) {
            //Obtenemos los campos obligatorios para aplicarles estilos css
            borrarDatosModalDisposicion();
        });

        $("#add_disposicion.btn_cancel_modal").click(function(event) {
            borrarDatosModalDisposicion();
        });

        $("#edit_disposicion.btn_cancel_modal").click(function(event) {
            borrarDatosModalDisposicion();
        });
    });

    function abrirModalverDisposicion(response) {
        console.log(response);

        console.log(response['nro_disposicion']);
        $('#{{$mode}}_disposicion').modal('show');
        console.log("tipo_disposicion="+response['disposicion_tipo']);
        $("#tipo_disposicion_modal-{{$mode}}").val(response['disposicion_tipo']);
        //$("#nro_expte_gde_modal-edit").val(response['GDE_Exp']);
        $("#nro_disposicion_modal-{{$mode}}").val(response['nro_disposicion']);
        $("#fecha_inicio_disposicion_modal-{{$mode}}").val(response['fecha_ini_vigencia']);
        $("#fecha_fin_disposicion_modal-{{$mode}}").val(response['fecha_fin_vigencia']);
        $("#observaciones_disposicion_modal-{{$mode}}").val(response['observaciones']);
    }

    function borrarDatosModalDisposicion(response) {
        $("#tipo_disposicion_modal-edit").val();
        $("#tipo_disposicion_modal-edit").css('border','1px solid #ccc');
        $('#small-tipo-disposicion-modal-edit').empty();
        /*$("#nro_expte_gde_modal-edit").val();
        ocultarError($("#nro_expte_gde_modal-edit"),'#small-nro-expte-gde-modal-edit');*/
        $("#nro_disposicion_modal-edit").val();
        ocultarError($("#nro_disposicion_modal-edit"),'#small-nro-disposicion-modal-edit');
        $("#fecha_inicio_disposicion_modal-edit").val();
        ocultarError($("#fecha_inicio_disposicion_modal-edit"),'#small-fecha-inicio-modal-edit');
        $("#fecha_fin_disposicion_modal-edit").val();
        ocultarError($("#fecha_fin_disposicion_modal-edit"),'#small-fecha-fin-modal-edit');
        $("#observaciones_disposicion_modal-edit").val();
    }

    function bajaDisposicion(id_disposicion) {

        //Desplegamos el modal
        $('#modalBajaActividad').modal('show');
        $('#baja_actividad').val(id_registro);
    }

</script>

@endpush

</fieldset>
