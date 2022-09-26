@extends('layouts')

@section('content2')
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <nav>
        <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <li class="nav-item">
                <a class=" nav-link @if (empty($tab)) {{ 'active' }} @endif" id="datos-generales-tab"
                    data-toggle="tab" href="#datos-generales">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="miembros-tab" data-toggle="tab" href="#miembros">Miembros</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="direccion-firma-tab" data-toggle="tab" href="#direccionFirma">Dirección y Firma</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="apoderado-tab" data-toggle="tab" href="#apoderado">Apoderado</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="domicilioReal-tab" data-toggle="tab" href="#domicilioReal">Domicilio Real</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioLegal-tab" data-toggle="tab" href="#domicilioLegal">Domicilio Legal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioFiscal-tab" data-toggle="tab" href="#domicilioFiscal">Domicilio fiscal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'actividad') {{ 'active' }} @endif" id="actividad-tab"
                    data-toggle="tab" href="#actividad">Actividad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'firma') {{ 'active' }} @endif" id="firma-tab"
                    data-toggle="tab" href="#firma">Firma</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'referencia bancaria') {{ 'active' }} @endif" id="referencia-bancaria-tab"
                    data-toggle="tab" href="#referencia-bancaria">Referencia Bancaria</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'pago') {{ 'active' }} @endif" id="pagos-tab"
                    data-toggle="tab" href="#pagos">Pagos</a>
            </li>
        </ul>

        <br>

    </nav>

    <small class="small" id="small-razon_social"></small>
    <small class="small" id="small-nombre_fantasia"></small>
    <small class="small" id="small-cuit4"></small>
    <small class="small" id="small-cuit2"></small>

    <form id="edit_form" action="{{ url('editarProveedor/' . $proveedor->id_proveedor) }}" method="POST">
        @csrf

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade  @if (empty($tab)) {{ 'show active' }} @endif" id="datos-generales"
                role="tabpanel" aria-labelledby="nav-datos-generales-tab">
                @include('editarRegistro.datosGenerales',['mode'=>'edit'])
            </div>
            <div class="tab-pane fade" id="miembros" role="tabpanel" aria-labelledby="nav-miembros-tab">
                @include('editarRegistro.persona',['tipo_persona'=>'miembro', 'mode'=>'edit'])
            </div>
            <div class="tab-pane fade" id="direccionFirma" role="tabpanel" aria-labelledby="nav-direccion-firma-tab">
                @include('editarRegistro.persona',['tipo_persona'=>'direccion_firma', 'mode'=>'edit'])
            </div>
            <div class="tab-pane fade" id="apoderado" role="tabpanel" aria-labelledby="nav-apoderado-tab">
                @include('editarRegistro.persona',['tipo_persona'=>'apoderado', 'mode'=>'edit'])
            </div>
            <div class="tab-pane fade" id="domicilioReal" role="tabpanel" aria-labelledby="nav-domicilioReal-tab">
                @include('editarRegistro.domicilio',['tipo_domicilio'=>'real', 'mode'=>'edit'])
            </div>
            <div class="tab-pane fade" id="domicilioLegal" role="tabpanel" aria-labelledby="nav-domicilioLegal-tab">
            @include('editarRegistro.domicilio',['tipo_domicilio'=>'legal', 'mode'=>'edit'])

            </div>
            <div class="tab-pane fade" id="domicilioFiscal" role="tabpanel"
                aria-labelledby="nav-domicilioFiscal.blade-tab">
                @include('editarRegistro.domicilio',['tipo_domicilio'=>'fiscal', 'mode'=>'edit'])
            </div>
            <div class="tab-pane fade @if ($tab == 'actividad') {{ 'show active' }} @endif " id="actividad"
                role="tabpanel" aria-labelledby="nav-actividad-tab">
                @include('editarRegistro.actividad',['mode'=>'edit'])
            </div>
            <div class="tab-pane fade @if ($tab == 'firma') {{ 'show active' }} @endif " id="firma"
                role="tabpanel" aria-labelledby="nav-firma-tab">
                @include('editarRegistro.firmas',['mode'=>'edit'])
            </div>
            <div class="tab-pane fade @if ($tab == 'referencia bancaria') {{ 'show active' }} @endif " id="referencia-bancaria"
                role="tabpanel" aria-labelledby="nav-referencia-bancaria-tab">
                @include('editarRegistro.referenciasBancarias',['mode'=>'edit'])
            </div>
            <div class="tab-pane fade  @if ($tab == 'pago') {{ 'show active' }} @endif" id="pagos"
                role="tabpanel" aria-labelledby="nav-pagos-tab">
                @include('editarRegistro.pagos',['mode'=>'edit'])
            </div>

        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group">
                <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>
               
            </div>
        </div>

    </form>

    @include('edicionesModales.editarpagos')
    @include('edicionesModales.pagos')
    @include('edicionesModales.editarActividades')
    @include('edicionesModales.actividades')
    @include('personas.modal-create-edit', ['tipo_persona'=>'x', 'mode'=>'create'])
    @include('personas.modal-edit-edit', ['tipo_persona'=>'x', 'mode'=>'edit'])
    @include('modales.modalBaja')
    @yield('datos')

@endsection

@push('js')
    <script>
        $(document).ready(function() 
        {

            $('#razon_social').keyup(validar_razon_social);

            $('#nombre_fantasia').keyup(validar_nombre_fantasia);

            $('#cuit').keyup(validar_cuit);

            $( ".dni" ).autocomplete({
                source: function( request, response ) {
                    $.ajax( {
                    url: "{{url('responsable/')}}/"+request.term,
                    dataType: "json",
                    success: function( data ) {
                        response( data );
                    }
                    } );
                },
                minLength: 2,
                select: function( event, ui ) {
                    if($(this).data('mode')=='create')
                    {
                        $("#apellido_x_create").val(ui.item.apellido_persona);
                        $("#nombre_x_create").val(ui.item.nombre_persona);
                        $("#cargo_x_create").val('');
                        $("#dni_x_create").css('border','1px solid #DFDFDF');
                        $("#apellido_x_create").css('border','1px solid #DFDFDF');
                        $("#nombre_x_create").css('border','1px solid #DFDFDF');
                        ocultarError('#dni_x_create', '#small-dni-x-create');
                        ocultarError('#apellido_x_create', '#small-apellido-x-create');
                        ocultarError('#nombre_x_create', '#small-nombre-x-create');
                    }
                    else
                    {
                        $("#apellido_x_edit").val(ui.item.apellido_persona);
                        $("#nombre_x_edit").val(ui.item.nombre_persona);
                        $("#cargo_x_edit").val('');
                        $("#dni_x_edit").css('border','1px solid #DFDFDF');
                        $("#apellido_x_edit").css('border','1px solid #DFDFDF');
                        $("#nombre_x_edit").css('border','1px solid #DFDFDF');
                        ocultarError('#dni_x_edit', '#small-dni-x-edit');
                        ocultarError('#apellido_x_edit', '#small-apellido-x-edit');
                        ocultarError('#nombre_x_edit', '#small-nombre-x-edit');
                    }
                }
            } );

            

            $('#cuit').keyup(function() 
            {
                if (!(/^([0-9]{2})-([0-9]{8})-([0-9]{1})$/g.test($('#cuit').val()))) 
                {
                    mostrarError('#cuit', '#small-cuit-mal-formato', '<div class="alert alert-danger mt-3 pt-1">El CUIT debe respetar el siguiente formato: <strong>xx-xxxxxxx-x</strong></div>');
                    //mostrarError('#cuit', '#small-cuit2', '<div class="alert alert-danger mt-3 pt-1">El CUIT debe respetar el siguiente formato: <strong>xx-xxxxxxx-x</strong></div>');
                    if($('#cuit').val() == "")
                    {
                        mostrarError('#cuit', '#small-cuit-vacio', '<div class="alert alert-danger mt-3 pt-1">El CUIT <strong>no</strong> puede quedar vacío.</div>');
                        //mostrarError('#cuit', '#small-cuit4', '<div class="alert alert-danger mt-3 pt-1">El CUIT <strong>no</strong> puede quedar vacío.</div>');
                        return false;
                    }
                }
                else
                {
                    ocultarError('#cuit', '#small-cuit-mal-formato');
                    //ocultarError('#cuit', '#small-cuit2');
                    ocultarError('#cuit', '#small-cuit-vacio');
                    //ocultarError('#cuit', '#small-cuit4');
                    return true;
                }
            });

            $("#cuit").val(function (index, value ) {
                return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{1})$/, '$1-$2')
                            .replace(/^([0-9]{2})/, '$1-')
            });

            if ($('#provincia_real_edit').val()!='')
                recargarListaDomicilio($('#provincia_real_edit').val(), $("#localidad_real_edit"));
            if ($('#provincia_legal_edit').val()!='')
                recargarListaDomicilio($('#provincia_legal_edit').val(), $('#localidad_legal_edit'));
            if ($('#provincia_fiscal_edit').val()!='')
                recargarListaDomicilio($('#provincia_fiscal_edit').val(), $('#localidad_fiscal_edit'));
                
            $('.btnNext').click(function() {
                $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
            });

            $('.btnPrevious').click(function() {
                $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
            });

            $('#store_persona').click(function(event){
                console.log("detecta evento store");
                var tipo_persona=$(this).data('tipo-persona');
                if(validarExisteDatosPersonaModal(tipo_persona, 'create', $("#dni_x_create"), $("#apellido_x_create"), $("#nombre_x_create"), $("#cargo_x_create")))
                {
                    console.log("pasa validacion con tipo_persona ="+tipo_persona);
                    var dni_persona = $("#dni_x_create").val();
                    var apellido_persona = $("#apellido_x_create").val();
                    var nombre_persona = $("#nombre_x_create").val();
                    var cargo_persona = $("#cargo_x_create").val();
                    var datos;
                    if(tipo_persona!='direccion_firma')
                    {
                        if(dni_persona!='' && apellido_persona!='' && nombre_persona!='')
                            datos={ dni: dni_persona, 
                                    apellido: apellido_persona,
                                    nombre: nombre_persona,
                                    tipo_persona: tipo_persona};
                        else
                        {
                            //Si alguno de los campos obligatorios esta vacio, detenemos el envio de los datos.
                            if(apellido_persona == '')
                                $("#apellido_x_create").css('border','2px dashed red');
                            if(nombre_persona == '')
                                $("#nombre_x_create").css('border','2px dashed red');
                            if(dni_persona == '')
                                $("#dni_x_create").css('border','2px dashed red');
                            return true;
                        }
                    }
                    else
                    {
                        if(dni_persona!='' && apellido_persona!='' && nombre_persona!='' && cargo_persona!='')
                            datos={ dni: dni_persona, 
                                    apellido: apellido_persona,
                                    nombre: nombre_persona,
                                    tipo_persona: tipo_persona,
                                    cargo: cargo_persona};
                        else
                        {
                            //Si alguno de los campos obligatorios esta vacio, detenemos el envio de los datos.
                            if(apellido_persona == '')
                                $("#apellido_x_create").css('border','2px dashed red');
                            if(nombre_persona == '')
                                $("#nombre_x_create").css('border','2px dashed red');
                            if(dni_persona == '')
                                $("#dni_x_create").css('border','2px dashed red');
                            if(cargo_persona == '')
                                $("#cargo_x_create").css('border','2px dashed red');
                            return true;
                        }
                    }
                    $("button").prop("disabled", true);
                    $.ajax({
                        type: "post",
                        url: "{{ url('crearPersona/' . $id) }}",
                        data: datos,
                        success: function(response) {

                            $('#add_persona').modal('hide');

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Persona Guardada',
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true

                                });
                            switch(tipo_persona)
                            {
                                case('miembro'):
                                    $('.yajra-personas-miembro').DataTable().ajax.reload();
                                break;
                                case('direccion_firma'):
                                    $('.yajra-personas-direccion_firma').DataTable().ajax.reload();
                                break;
                                case('apoderado'):
                                    $('.yajra-personas-apoderado').DataTable().ajax.reload();
                                break;
                            }
                            $("button").prop("disabled", false);
                        },
                        error: function(error) {
                            //console.log(error)
                            $("button").prop("disabled", false);
                            alert("ERROR!! Actividad no guardada");
                        }
                    });
                }
                else
                {
                    console.log("no pasa validacion");
                    event.preventDefault();
                }
            });

            $('#update_persona').click(function(event){
                var tipo_persona=$(this).data('tipo-persona');
                if(validarExisteDatosPersonaModal(tipo_persona, 'edit', $("#dni_x_edit"), $("#apellido_x_edit"), $("#nombre_x_edit"), $("#cargo_x_edit")))
                {
                    var dni_persona = $("#dni_x_edit").val();
                    var apellido_persona = $("#apellido_x_edit").val();
                    var nombre_persona = $("#nombre_x_edit").val();
                    var cargo_persona = $("#cargo_x_edit").val();
                    var datos;
                    if(tipo_persona!='direccion_firma')
                    {
                        if(dni_persona!='' && apellido_persona!='' && nombre_persona!='')
                            datos={ dni: dni_persona, 
                                    apellido: apellido_persona,
                                    nombre: nombre_persona,
                                    tipo_persona: tipo_persona};
                    }
                    else
                    {
                        if(dni_persona!='' && apellido_persona!='' && nombre_persona!='' && cargo_persona !='')
                            datos={ dni: dni_persona, 
                                    apellido: apellido_persona,
                                    nombre: nombre_persona,
                                    tipo_persona: tipo_persona,
                                    cargo: cargo_persona};
                    }
                    var id_proveedor=$(this).data('id-proveedor');
                    var id_persona=$(this).data('id-persona');
                    console.log("id_proveedor"+id_proveedor);
                    let url = '{{ url("proveedor/:id_proveedor/:tipo_persona/:id_persona/actualizar") }}';
                    url = url.replace(':id_proveedor', id_proveedor);
                    url = url.replace(':tipo_persona', tipo_persona);
                    url = url.replace(':id_persona', id_persona);
                    console.log("url"+url);
                    $("button").prop("disabled", true);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: datos,
                        success: function(response) {

                            $('#edit_persona').modal('hide');

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Persona Guardada',
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true

                                });
                            switch(tipo_persona)
                            {
                                case('miembro'):
                                    $('.yajra-personas-miembro').DataTable().ajax.reload();
                                break;
                                case('direccion_firma'):
                                    $('.yajra-personas-direccion_firma').DataTable().ajax.reload();
                                break;
                                case('apoderado'):
                                    $('.yajra-personas-apoderado').DataTable().ajax.reload();
                                break;
                            }
                            $("button").prop("disabled", false);
                        },
                        error: function(error) {
                            //console.log(error)
                            $("button").prop("disabled", false);
                            alert("ERROR!! Actividad no guardada");
                        }
                    });
                }
                else
                    event.preventDefault();
            });

            $(document).on('click', '.edit_persona', function(event){
                //event.stopImmediatePropagation();
                console.log("detecta evento click en edit_persona");
                var id_proveedor=$(this).data('id-proveedor');
                var tipo_persona=$(this).data('tipo-persona');
                var id_persona=$(this).data('id-persona');
                console.log("id_proveedor"+id_proveedor);
                let url = '{{ url("proveedor/:id_proveedor/:tipo_persona/:id_persona/editar") }}';
                url = url.replace(':id_proveedor', id_proveedor);
                url = url.replace(':tipo_persona', tipo_persona);
                url = url.replace(':id_persona', id_persona);
                console.log(url);
                $('#update_persona').data('id-proveedor',id_proveedor);
                $('#update_persona').data('tipo-persona',tipo_persona);
                $('#update_persona').data('id-persona',id_persona);
                if(tipo_persona=='direccion_firma')
                    tipo_persona='miembro de los órganos de dirección y administración de firma';
                $('#edit_persona').find('.modal-title').text('Editar ' + tipo_persona);
                
                $.ajax({
                    url: url,
                    success: function(response) {
                        abrirModalverPersona(response);
                    }
                });
                
            });

            $(document).on("click", "#btn_baja", function() {
                let tipo_baja = $("#btn_baja").data('tipo-baja');
                switch(tipo_baja)
                {
                    case 'persona':
                        //Obtenemos el numero de la fila que queremos modificar
                        var id_proveedor=   $("#btn_baja").data('id-proveedor');
                        let tipo_persona = $("#btn_baja").data('tipo-persona');
                        let id_persona = $("#btn_baja").data('id-persona');
                        let url = '{{ url("proveedor/:id_proveedor/:tipo_persona/:id_persona/eliminar") }}';
                        url = url.replace(':id_proveedor', id_proveedor);
                        url = url.replace(':tipo_persona', tipo_persona);
                        url = url.replace(':id_persona', id_persona);

                        $.ajax({
                            type: "POST",
                            url: url,
                            success: function() {
                                $('.yajra-personas-'+tipo_persona).DataTable().ajax.reload();
                                switch(tipo_persona)
                                {
                                    case 'miembro':
                                        tipo_persona='Miembro';   
                                    break;
                                    case 'direccion_firma':
                                        tipo_persona='Miembro de los órganos de dirección y adminitración de firma';   
                                    break;
                                    case 'apoderado':
                                        tipo_persona='Apoderado';   
                                    break;
                                }
                                Swal.fire({
                                            position: 'top-end',
                                            icon: 'info',
                                            title: tipo_persona+' dada de baja',
                                            showConfirmButton: false,
                                            timer: 1500,
                                            toast: true

                                            })
                            }
                        });   
                }
                

                //Ocultamos el modal
                $('#modalBaja').modal('hide');

                });

            $('#add_persona').on('show.bs.modal', function (event) {
                //event.stopImmediatePropagation();
                var button = $(event.relatedTarget); // Button that triggered the modal
                var tipo_persona = button.data('tipo-persona'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                
                if(tipo_persona=='direccion_firma')
                {   
                    modal.find('.modal-title').text('Nuevo miembro de los órganos de dirección y administración de firma');
                    $("#div_cargo_x_create").show();
                }
                else
                {
                    modal.find('.modal-title').text('Nuevo '+tipo_persona);
                    $("#div_cargo_x_create").hide();
                }
                $('#store_persona').data('tipo-persona',tipo_persona);
                //modal.find('.modal-body input').val(tipo_persona);
            });

            $('#modalBaja').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var tipo_baja = button.data('tipo-baja');
                switch(tipo_baja)
                {
                    case 'persona':
                        var tipo_persona = button.data('tipo-persona'); // Extract info from data-* attributes
                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                        var modal = $(this);
                        if(tipo_persona == 'direccion_firma')
                            modal.find('.modal-body').html(   '<p>¿Está seguro que desea dar de baja a este miembro de los órganos de dirección y administración de firma?</p>'+
                                                                '<p>Esta operación <b>NO</b> podrá deshacerse.</p>');
                        else
                            modal.find('.modal-body').html(   '<p>¿Está seguro que desea dar de baja a este '+tipo_persona+'?</p>'+
                                                                '<p>Esta operación <b>NO</b> podrá deshacerse.</p>');
                        $("#btn_baja").data('tipo-baja','persona');
                        $("#btn_baja").data('id-proveedor',button.data('id-proveedor'));
                        $("#btn_baja").data('tipo-persona',tipo_persona);
                        $("#btn_baja").data('id-persona', button.data('id-persona'));
                    break;
                }
                
            });

            $(document).on("click", ".btn_cancel_modal", function(event) {

                //Obtenemos los campos obligatorios para aplicarles estilos css
                borrarDatosModal();
            });

            $('#add_persona').on('hidden.bs.modal', function (event) {
                //Obtenemos los campos obligatorios para aplicarles estilos css
                borrarDatosModal();
            });
            
            $('#edit_persona').on('hidden.bs.modal', function (event) {
                //Obtenemos los campos obligatorios para aplicarles estilos css
                borrarDatosModal();
            });
            

        });

        function borrarDatosModal(){
            $("#apellido_x_create").css('border','1px solid #DFDFDF');
            $("#nombre_x_create").css('border','1px solid #DFDFDF');
            $("#dni_x_create").css('border','1px solid #DFDFDF');
            $("#cargo_x_create").css('border','1px solid #DFDFDF');
            ocultarError('#dni_x_create', '#small-dni-x-create');
            ocultarError('#apellido_x_create', '#small-apellido-x-create');
            ocultarError('#nombre_x_create', '#small-nombre-x-create');
            ocultarError('#cargo_x_create', '#small-cargo-x-create');
            $("#apellido_x_create").val('');
            $("#nombre_x_create").val('');
            $("#dni_x_create").val('');
            $("#cargo_x_create").val('');

            $("#apellido_x_edit").css('border','1px solid #DFDFDF');
            $("#nombre_x_edit").css('border','1px solid #DFDFDF');
            $("#dni_x_edit").css('border','1px solid #DFDFDF');
            $("#cargo_x_edit").css('border','1px solid #DFDFDF');
            ocultarError('#dni_x_edit', '#small-dni-x-edit');
            ocultarError('#apellido_x_edit', '#small-apellido-x-edit');
            ocultarError('#nombre_x_edit', '#small-nombre-x-edit');
            ocultarError('#cargo_x_edit', '#small-cargo-x-edit');
            $("#apellido_x_edit").val('');
            $("#nombre_x_edit").val('');
            $("#dni_x_edit").val('');
            $("#cargo_x_edit").val('');

            $("#div_cargo_x_create").hide();
            $("#div_cargo_x_edit").hide();
        }

        function abrirModalverPersona(response) {
            $('#edit_persona').modal('show');
            console.log("dni"+response['dni_persona']);
            $('#dni_x_edit').val(response['dni_persona'].replace(/\D/g, "")
                                                        .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                                                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, "."));
            $('#apellido_x_edit').val(response['apellido_persona']);

            $('#nombre_x_edit').val(response['nombre_persona']);
            if(response['pivot']['rol_persona_proveedor'])
            {
                $('#cargo_x_edit').val(response['pivot']['rol_persona_proveedor']);
                $('#div_cargo_x_edit').show();
            }
            
        }   
        
    </script>
        
@endpush

@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

    </style>

    <style>
        input:invalid:required {

            border: 1px dashed red;
        }

        input:hover:invalid:required {

            background-color: rgb(255, 76, 76);
        }
    </style>

@endpush
