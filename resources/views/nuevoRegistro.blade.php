@extends('layouts')

@section('content2')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var current = 1,
                current_step, next_step, steps;
            steps = $("fieldset").length;
            $(".next").click(function() {
                current_step = $(this).parent();
                next_step = $(this).parent().next();
                next_step.show();
                current_step.hide();
                setProgressBar(++current);
                $(window).scrollTop(0);
                let tipo_persona = $(this).data('tipo-persona');
                if(tipo_persona)
                    borrarAdvertenciasPersona(tipo_persona);
            });
            $(".previous").click(function() {
                current_step = $(this).parent();
                next_step = $(this).parent().prev();
                next_step.show();
                current_step.hide();
                setProgressBar(--current);
                $(window).scrollTop(0);
                let tipo_persona = $(this).data('tipo-persona');
                if(tipo_persona)
                    borrarAdvertenciasPersona(tipo_persona);
            });

            setProgressBar(current);
            // Change progress bar action
            function setProgressBar(curStep) {
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                    .css("width", percent + "%")
                    .html(percent + "%");
            }
        });

        function borrarAdvertenciasPersona(tipo_persona)
        {
            if(tipo_persona != 'direccion_firma')
            {
                if($('#dni_'+tipo_persona+'_create').val()=='' && $('#apellido_'+tipo_persona+'_create').val()=='' && $('#nombre_'+tipo_persona+'_create').val()=='')
                {    
                    ocultarError('#dni_'+tipo_persona+'_create', '#small-dni-'+tipo_persona+'-head');
                    ocultarError('#apellido_'+tipo_persona+'_create', '#small-apellido-'+tipo_persona+'-head');
                    ocultarError('#nombre_'+tipo_persona+'_create', '#small-nombre-'+tipo_persona+'-head');
                }
            }
            else
            {
                if($('#dni_'+tipo_persona+'_create').val()=='' && $('#apellido_'+tipo_persona+'_create').val()=='' && $('#nombre_'+tipo_persona+'_create').val()=='' && $('#cargo_'+tipo_persona+'_create').val()=='')
                {    
                    ocultarError('#dni_'+tipo_persona+'_create', '#small-dni-'+tipo_persona+'-head');
                    ocultarError('#apellido_'+tipo_persona+'_create', '#small-apellido-'+tipo_persona+'-head');
                    ocultarError('#nombre_'+tipo_persona+'_create', '#small-nombre-'+tipo_persona+'-head');
                    ocultarError('#cargo_'+tipo_persona+'_create', '#small-cargo-'+tipo_persona+'-head');
                }
            }
        }

    </script>



    <style>
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }

        $form-validation-states: (
            "valid": (
                "color": $form-feedback-valid-color,
                "icon": $form-feedback-icon-valid
            ),
            "invalid": (
                "color": $form-feedback-invalid-color,
                "icon": $form-feedback-icon-invalid
            )
        );

    </style>


    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <br>
    <div class="alert alert-info" role="alert">
        Complete los campos que se presentan continuación
        y presione el botón <b>Siguiente</b>, para continuar la carga de datos.
    </div>

    <small class="small" id="small-razon_social"></small>
    <small class="small" id="small-nombre_fantasia"></small>
    <small class="small" id="small-cuit4"></small>
    <small class="small" id="small-cuit2"></small>
    <small class="small" id="small-dni-miembro-head"></small>
    <small class="small" id="small-apellido-miembro-head"></small>
    <small class="small" id="small-nombre-miembro-head"></small>
    <small class="small" id="small-dni-direccion_firma-head"></small>
    <small class="small" id="small-apellido-direccion_firma-head"></small>
    <small class="small" id="small-nombre-direccion_firma-head"></small>
    <small class="small" id="small-cargo-direccion_firma-head"></small>
    <small class="small" id="small-dni-apoderado-head"></small>
    <small class="small" id="small-apellido-apoderado-head"></small>
    <small class="small" id="small-nombre-apoderado-head"></small>

    <form  id="regiration_form" action="{{ route('crear_registro') }}"  method="POST">
        @csrf
        @include('editarRegistro.datosGenerales',['mode'=>'create'])
        @include('altaRegistro.persona',['tipo_persona'=>'miembro', 'mode'=>'create'])
        @include('altaRegistro.persona',['tipo_persona'=>'direccion_firma', 'mode'=>'create'])
        @include('altaRegistro.persona',['tipo_persona'=>'apoderado', 'mode'=>'create'])
        @include('editarRegistro.domicilio',['tipo_domicilio'=>'real', 'mode'=>'create'])
        @include('editarRegistro.domicilio',['tipo_domicilio'=>'legal', 'mode'=>'create'])
        @include('editarRegistro.domicilio',['tipo_domicilio'=>'fiscal', 'mode'=>'create'])
        @include('altaRegistro.actividad',['mode'=>'create'])
        @include('altaRegistro.firmas',['mode'=>'create'])
        @include('altaRegistro.referenciasBancarias',['mode'=>'create'])
        @include('altaRegistro.pagos',['mode'=>'create'])

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group">
                <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>
            </div>
        </div>


    </form>
    @yield('datos')
    
    @include('personas.modal-edit-create',['tipo_persona'=>'x', 'mode'=>'edit'])

    <!--Incluimos el modal para validar los campos -->

    @include('modales.validarFormularioAlta')

@endsection


@push('js')

<script type="text/javascript">

    $(document).ready(function() 
    {
        $('.js-example-basic-single').select2({
            theme: "bootstrap",    width: 'resolve' // need to override the changed default
        });

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
                    let dni_persona=$(this);
                    let tipo_persona = dni_persona.data('tipo-persona');
                    let mode=dni_persona.data('mode');
                    switch(tipo_persona)
                    {
                        case 'miembro':
                            if(mode=='create')
                            {
                                console.log("entra por miembro create");
                                $("#apellido_miembro_create").val(ui.item.apellido_persona);
                                $("#nombre_miembro_create").val(ui.item.nombre_persona);
                                ocultarError('#dni_miembro_create', '#small-dni-miembro-create');
                                ocultarError('#dni_miembro_create', '#small-dni-miembro-head');
                                ocultarError('#apellido_miembro_create', '#small-apellido-miembro-create');
                                ocultarError('#apellido_miembro_create', '#small-apellido-miembro-head');
                                ocultarError('#nombre_miembro_create', '#small-nombre-miembro-create');
                                ocultarError('#nombre_miembro_create', '#small-nombre-miembro-head');
                            }
                            else
                                if(mode=='edit')
                                {
                                    console.log("entra por miembro create");
                                    $("#apellido_miembro_edit").val(ui.item.apellido_persona);
                                    $("#nombre_miembro_edit").val(ui.item.nombre_persona);
                                    ocultarError('#dni_miembro_edit', '#small-dni-miembro-edit');
                                    ocultarError('#dni_miembro_edit', '#small-dni-miembro-head');
                                    ocultarError('#apellido_miembro_edit', '#small-apellido-miembro-edit');
                                    ocultarError('#apellido_miembro_edit', '#small-apellido-miembro-head');
                                    ocultarError('#nombre_miembro_edit', '#small-nombre-miembro-edit');
                                    ocultarError('#nombre_miembro_edit', '#small-nombre-miembro-head');
                                }
                        break;
                        case 'direccion_firma':
                            if(mode=='create')
                            {
                                console.log("entra por direccion firma create");
                                $("#apellido_direccion_firma_create").val(ui.item.apellido_persona);
                                $("#nombre_direccion_firma_create").val(ui.item.nombre_persona);
                                ocultarError('#dni_direccion_firma_create', '#small-dni-direccion_firma-create');
                                ocultarError('#dni_direccion_firma_create', '#small-dni-direccion_firma-head');
                                ocultarError('#apellido_direccion_firma_create', '#small-apellido-direccion_firma-create');
                                ocultarError('#apellido_direccion_firma_create', '#small-apellido-direccion_firma-head');
                                ocultarError('#nombre_direccion_firma_create', '#small-nombre-direccion_firma-create');
                                ocultarError('#nombre_direccion_firma_create', '#small-nombre-direccion_firma-head');
                            }
                            else
                                if(mode=='edit')
                                {
                                    console.log("entra por direccion firma edit");
                                    $("#apellido_direccion_firma_edit").val(ui.item.apellido_persona);
                                    $("#nombre_direccion_firma_edit").val(ui.item.nombre_persona);
                                    ocultarError('#dni-direccion_firma_edit', '#small-dni-direccion_firma-edit');
                                    ocultarError('#dni_direccion_firma_edit', '#small-dni-direccion_firma-head');
                                    ocultarError('#apellido_direccion_firma_edit', '#small-apellido-direccion_firma-edit');
                                    ocultarError('#apellido_direccion_firma_edit', '#small-apellido-direccion_firma-head');
                                    ocultarError('#nombre_direccion_firma_edit', '#small-nombre-direccion_firma-edit');
                                    ocultarError('#nombre_direccion_firma_edit', '#small-nombre-direccion_firma-head');
                                }
                        break;
                        case 'apoderado':
                            if(mode=='create')
                            {
                                console.log("entra por apoderado create");
                                $("#apellido_apoderado_create").val(ui.item.apellido_persona);
                                $("#nombre_apoderado_create").val(ui.item.nombre_persona);
                                ocultarError('#dni_apoderado_create', '#small-dni-apoderado-create');
                                ocultarError('#dni_apoderado_create', '#small-dni-apoderado-head');
                                ocultarError('#apellido_apoderado_create', '#small-apellido-apoderado-create');
                                ocultarError('#apellido_apoderado_create', '#small-apellido-apoderado-head');
                                ocultarError('#nombre_apoderado_create', '#small-nombre-apoderado-create');
                                ocultarError('#nombre_apoderado_create', '#small-nombre-apoderado-head');
                            }
                            else
                                if(mode=='edit')
                                {
                                    console.log("entra por direccion firma edit");
                                    $("#apellido_direccion_firma_edit").val(ui.item.apellido_persona);
                                    $("#nombre_direccion_firma_edit").val(ui.item.nombre_persona);
                                    ocultarError('#dni_apoderado_edit', '#small-dni-apoderado-edit');
                                    ocultarError('#dni_apoderado_edit', '#small-dni-apoderado-head');
                                    ocultarError('#apellido_apoderado_edit', '#small-apellido-apoderado-edit');
                                    ocultarError('#apellido_apoderado_edit', '#small-apellido-apoderado-head');
                                    ocultarError('#nombre_apoderado_edit', '#small-nombre-apoderado-edit');
                                    ocultarError('#nombre_apoderado_edit', '#small-nombre-apoderado-head');
                                }
                        break;
                        case 'x':
                            $("#apellido_x_edit").val(ui.item.apellido_persona);
                            $("#nombre_x_edit").val(ui.item.nombre_persona);
                        break;
                    }
                }
            });

        $('input[type="checkbox"]').on('change', function(){
            this.value = this.checked ? 1 : 0;
            //console.log(this.value);
        }).change();

        $('#razon_social').keyup(function() {
            if($('#razon_social').val() == "")
            {
                mostrarError('#razon_social', '#small-razon_social', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');
                //mostrarError('#razon_social', '#small-razon_social2', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');
                return false;
            }
            else
            {
                ocultarError('#razon_social', '#small-razon_social');
                //ocultarError('#razon_social', '#small-razon_social2');
                return true;
            }
        });

        $('#nombre_fantasia').keyup(function() {
            if($('#nombre_fantasia').val() == "")
            {
                mostrarError('#nombre_fantasia', '#small-nombre_fantasia', '<div class="alert alert-danger mt-3 pt-1">El nombre de fantasía <strong>no</strong> puede quedar vacío.</div>');
                //mostrarError('#nombre_fantasia', '#small-nombre_fantasia2', '<div class="alert alert-danger mt-3 pt-1">El nombre de fantasía <strong>no</strong> puede quedar vacío.</div>');
                return false;
            }
            else
            {
                ocultarError('#nombre_fantasia', '#small-nombre_fantasia');
                //ocultarError('#nombre_fantasia', '#small-nombre_fantasia2');
                return true;
            }
        });

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
        if ($('#provincia_real_create').val()!='')
            recargarListaDomicilio($('#provincia_real_create').val(), $("#localidad_real_create"));
        if ($('#provincia_legal_create').val()!='')
            recargarListaDomicilio($('#provincia_legal_create').val(), $('#localidad_legal_create'));
        if ($('#provincia_fiscal_create').val()!='')
            recargarListaDomicilio($('#provincia_fiscal_create').val(), $('#localidad_fiscal_create'));
        if ($('#provincia_habilitacion').val()!='')
            recargarListaHabilitacion();

        //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

        $(document).on("click", ".btn_edit_modal", function(event) {
            //Obtenemos el numero de la fila que queremos modificar
            var tipo_persona = $(this).data('tipo-persona');
            var id_filapersona = $("#numero_fila_persona").val();

            

            //Si los campos obligatorios NO estan vacios, permite enviar los nuevos valores a la tabla
            if(validarExisteDatosPersonaModal('edit', $("#dni_x_edit"), $("#apellido_x_edit"), $("#nombre_x_edit"), $("#cargo_x_edit")))
            {
                //Recuperamos los valores de los campos del modal
                var apellido_persona = $("#apellido_x_edit").val();
                var nombre_persona = $("#nombre_x_edit").val();
                var dni_persona = $("#dni_x_edit").val();
                var cargo_persona='';
                if(tipo_persona =='direccion_firma')
                    cargo_persona = $('#cargo_x_edit').val();
                if(tipo_persona=='direccion_firma')
                {
                    $('#edit_persona').modal('hide');
                    //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                    
                    $('#nombre_persona_direccion_firma' + id_filapersona).val(nombre_persona);
                    $('#dni_persona_direccion_firma' + id_filapersona).val(dni_persona);
                    $('#cargo_persona_direccion_firma' + id_filapersona).val(cargo_persona);

                    //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                    $('#apellido_persona_text_direccion_firma' + id_filapersona).text(apellido_persona);
                    $('#nombre_persona_text_direccion_firma' + id_filapersona).text(nombre_persona);
                    $('#dni_persona_text_direccion_firma' + id_filapersona).text(dni_persona);
                    $('#cargo_persona_text_direccion_firma' + id_filapersona).text(cargo_persona);

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Persona Modificada',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    });
                }
                else
                {

                    //Ocultamos el modal
                    $('#edit_persona').modal('hide');
                    switch(tipo_persona)
                    {
                        case 'miembro':
                            //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                        
                            $('#apellido_persona_miembro' + id_filapersona).val(apellido_persona);
                            
                            $('#nombre_persona_miembro' + id_filapersona).val(nombre_persona);
                            $('#dni_persona_miembro' + id_filapersona).val(dni_persona);

                            //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                            $('#apellido_persona_text_miembro' + id_filapersona).text(apellido_persona);
                            $('#nombre_persona_text_miembro' + id_filapersona).text(nombre_persona);
                            $('#dni_persona_text_miembro' + id_filapersona).text(dni_persona);

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Persona Modificada',
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true

                            });
                        break;
                        case 'apoderado':
                            //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                        
                            $('#apellido_persona_apoderado' + id_filapersona).val(apellido_persona);
                            
                            $('#nombre_persona_apoderado' + id_filapersona).val(nombre_persona);
                            $('#dni_persona_apoderado' + id_filapersona).val(dni_persona);

                            //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                            $('#apellido_persona_text_apoderado' + id_filapersona).text(apellido_persona);
                            $('#nombre_persona_text_apoderado' + id_filapersona).text(nombre_persona);
                            $('#dni_persona_text_apoderado' + id_filapersona).text(dni_persona);

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Persona Modificada',
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true

                            });
                        break;
                    }
                }
            }
            else
            {
                //Si alguno de los campos obligatorios esta vacio, detenemos el envio de los datos.
                event.preventDefault();
            }
        });



        $(document).on("click", ".btn_cancel_modal", function(event) {
            ocultarError($('#dni_x_edit'), '#small-dni-x-edit');
            ocultarError($('#apellido_x_edit'), '#small-apellido-x-edit');
            ocultarError($('#nombre_x_edit'), '#small-nombre-x-edit');
            ocultarError($('#cargo_x_edit'), '#small-cargo-x-edit');
            $("#div_cargo_x_edit").hide();
        });

        $('#edit_persona').on('hidden.bs.modal', function (event) {
            ocultarError($('#dni_x_edit'), '#small-dni-x-edit');
            ocultarError($('#apellido_x_edit'), '#small-apellido-x-edit');
            ocultarError($('#nombre_x_edit'), '#small-nombre-x-edit');
            ocultarError($('#cargo_x_edit'), '#small-cargo-x-edit');
            $("#div_cargo_x_edit").hide();
        });

    });

    function validar_razon_social() {

        if($('#razon_social').val() == ""){

        mostrarError('#razon_social', '#small-razon_social', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');
        //mostrarError('#razon_social', '#small-razon_social2', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');

        return false;
        }

        ocultarError('#razon_social', '#small-razon_social');
        //ocultarError('#razon_social', '#small-razon_social2');

        return true;
        }


        function validar_nombre_fantasia() {

        if($('#nombre_fantasia').val() == ""){

        mostrarError('#nombre_fantasia', '#small-nombre_fantasia', '<div class="alert alert-danger mt-3 pt-1">El nombre de fantasía <strong>no</strong> puede quedar vacío.</div>');
        //mostrarError('#nombre_fantasia', '#small-nombre_fantasia2', '<div class="alert alert-danger mt-3 pt-1">El nombre de fantasía <strong>no</strong> puede quedar vacío.</div>');

        return false;
        }

        ocultarError('#nombre_fantasia', '#small-nombre_fantasia');
        //ocultarError('#nombre_fantasia', '#small-nombre_fantasia2');

        return true;
        }

        function validar_cuit() {

        if (!(/^([0-9]{2})-([0-9]{8})-([0-9]{1})$/g.test($('#cuit').val()))) {

            mostrarError('#cuit', '#small-cuit', '<div class="alert alert-danger mt-3 pt-1">El CUIT debe respetar el siguiente formato: <strong>xx-xxxxxxx-x</strong></div>');
            //mostrarError('#cuit', '#small-cuit2', '<div class="alert alert-danger mt-3 pt-1">El CUIT debe respetar el siguiente formato: <strong>xx-xxxxxxx-x</strong></div>');

            if($('#cuit').val() == ""){

            mostrarError('#cuit', '#small-cuit', '<div class="alert alert-danger mt-3 pt-1">El CUIT <strong>no</strong> puede quedar vacío.</div>');
            //mostrarError('#cuit', '#small-cuit4', '<div class="alert alert-danger mt-3 pt-1">El CUIT <strong>no</strong> puede quedar vacío.</div>');

            return false;
            }
        }

        ocultarError('#cuit', '#small-cuit');
        /*ocultarError('#cuit', '#small-cuit2');
        ocultarError('#cuit', '#small-cuit3');
        ocultarError('#cuit', '#small-cuit4');*/

        return true;
        }

        function valideKey(evt) {

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if (code == 8) { // espacio.
            return true;
        } else if (code >= 48 && code <= 57) { // es un numero.
            return true;
        } else { // otras teclas
            //console.log("no es un numero");
            return false;
        }
        }

        

        

        function mostrarError(campo, error, msg) {
            $(campo).addClass('is-invalid');
            $(error).html(msg);
            $(error).show();
        }
        function ocultarError(campo, error) {
            $(campo).removeClass('is-invalid');
            $(error).hide();
        }

    function recargarListaDomicilio(provincia_selected, select_localidad){
        $.ajax({
            type:"GET",
            url:"{{url('localidades')}}/"+provincia_selected,
            success:function(r){
                select_localidad.html(r);
            }
        });
    }

    function recargarListaHabilitacion(){
        $.ajax({
        type:"GET",
                url:"{{url('localidades')}}/"+$('#provincia_habilitacion').val(),

        success:function(r){
            $('#localidad_habilitacion').html(r);
        }
        });


    }

    </script>
    <script type="text/javascript">

        var cant_filas_actividad = document.getElementById("body_table_actividad").rows.length;

        if(cant_filas_actividad == 0)
            $("#body_table_actividad").append(
                '<tr id="row_actividad" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                '</tr>');


        var cant_filas_firma = document.getElementById("body_table_denominacion").rows.length;

        if(cant_filas_firma == 0)
            $("#body_table_denominacion").append(
                '<tr id="row_denominacion" class="alert alert-light" role="alert">'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                '</tr>');


        var cant_filas_banco = document.getElementById("body_table_banco").rows.length;

        if(cant_filas_banco == 0)
            $("#body_table_banco").append(
                '<tr id="row_banco" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>');

    </script>

    

@endpush


@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

        input:invalid:required {

            border: 1px dashed red;
        }

        input:hover:invalid:required {

            background-color: rgb(255, 76, 76);
        }

    </style>

@endpush
