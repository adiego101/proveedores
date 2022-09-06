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
            });
            $(".previous").click(function() {
                current_step = $(this).parent();
                next_step = $(this).parent().prev();
                next_step.show();
                current_step.hide();
                setProgressBar(--current);
                $(window).scrollTop(0);
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

    </script>



    <style>
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }

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
    <small class="small" id="small-dni_legal"></small>

    <form  id="regiration_form" action="{{ route('crear_registro') }}"  method="POST">
        @csrf
        @include('editarRegistro.datosGenerales',['mode'=>'create'])
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

        $('#dni_legal').keyup(validarDni);

        $("#apellido_persona").keyup(validarExisteDatosRepresentante);

            $("#nombre_persona").keyup(validarExisteDatosRepresentante);

            $("#dni_legal").keyup(validarExisteDatosRepresentante);

            $( "#dni_legal" ).autocomplete({
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
                    $("#apellido_persona").val(ui.item.apellido_persona);
                    $("#nombre_persona").val(ui.item.nombre_persona);
                    ocultarError('#dni_legal', '#small-dni');
                    ocultarError('#dni_legal', '#small-dni-legal');
                    ocultarError('#apellido_persona', '#small-apellido');
                    ocultarError('#apellido_persona', '#small-apellido-legal');
                    ocultarError('#nombre_persona', '#small-nombre');
                    ocultarError('#nombre_persona', '#small-nombre-legal');
                }
            } );

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
        
        $("#regiration_form").on('submit',function(){
            event.preventDefault();

            if(validarDni())
                this.submit();
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

        function validarDni()
        {
        if($('#dni_legal').val() != "")
        {
            if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test($('#dni_legal').val()))) 
            {
                mostrarError('#dni_legal', '#small-dni', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI</strong> tiene un formato incorrecto.</div>');
                //mostrarError('#dni_legal', '#small-dni2', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI</strong> tiene un formato incorrecto.</div>');
                return false;
            }  
            else
            {
                ocultarError('#dni_legal', '#small-dni');
                //ocultarError('#dni_legal', '#small-dni2');

                return true;
            }
        }
        else
            return true;
        }

        function validarExisteDatosRepresentante()
        {
            if($('#apellido_persona').val()=='')
            {
            mostrarError('#apellido_persona', '#small-apellido', '<div class="alert alert-danger mt-3 pt-1">El APELLIDO del representante <strong>no</strong> puede quedar vacío.</div>');
            mostrarError('#apellido_persona', '#small-apellido-legal', '<div class="alert alert-danger mt-3 pt-1">El APELLIDO del representante <strong>no</strong> puede quedar vacío.</div>');
            if($("#dni_legal").val()=='')
            {
                mostrarError('#dni_legal', '#small-dni', '<div class="alert alert-danger mt-3 pt-1">El DNI del representante <strong>no</strong> puede quedar vacío.</div>');
                mostrarError('#dni_legal', '#small-dni-legal', '<div class="alert alert-danger mt-3 pt-1">El DNI del representante <strong>no</strong> puede quedar vacío.</div>');
                if($("#nombre_persona").val()=='')
                {
                ocultarError('#dni_legal', '#small-dni');
                ocultarError('#dni_legal', '#small-dni-legal');
                ocultarError('#apellido_persona', '#small-apellido');
                ocultarError('#apellido_persona', '#small-apellido-legal');
                ocultarError('#nombre_persona', '#small-nombre');
                ocultarError('#nombre_persona', '#small-nombre-legal');
                return true;
                }
                else
                {
                ocultarError('#nombre_persona', '#small-nombre');
                ocultarError('#nombre_persona', '#small-nombre-legal');
                return true;
                }
            }
            else
            {
                
                ocultarError('#dni_legal', '#small-dni');
                ocultarError('#dni_legal', '#small-dni-legal');
                validarDni();
                if($("#nombre_persona").val()=='')
                {
                mostrarError('#nombre_persona', '#small-nombre', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
                mostrarError('#nombre_persona', '#small-nombre-legal', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
                return false;
                }
                else
                {
                ocultarError('#nombre_persona', '#small-nombre');
                ocultarError('#nombre_persona', '#small-nombre-legal');
                return true;
                }
            }
            }
            else
            {
            ocultarError('#apellido_persona', '#small-apellido');
            ocultarError('#apellido_persona', '#small-apellido-legal');
            if($("#dni_legal").val()=='')
            {
                mostrarError('#dni_legal', '#small-dni', '<div class="alert alert-danger mt-3 pt-1">El DNI del representante <strong>no</strong> puede quedar vacío.</div>');
                mostrarError('#dni_legal', '#small-dni-legal', '<div class="alert alert-danger mt-3 pt-1">El DNI del representante <strong>no</strong> puede quedar vacío.</div>');
                if($("#nombre_persona").val()=='')
                {
                mostrarError('#nombre_persona', '#small-nombre', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
                mostrarError('#nombre_persona', '#small-nombre-legal', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
                return false;
                }
                else
                {
                ocultarError('#nombre_persona', '#small-nombre');
                ocultarError('#nombre_persona', '#small-nombre-legal');
                return true;
                }
            }
            else
            {
                ocultarError('#dni_legal', '#small-dni');
                ocultarError('#dni_legal', '#small-dni-legal');
                validarDni();
                if($("#nombre_persona").val()=='')
                {
                mostrarError('#nombre_persona', '#small-nombre', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
                mostrarError('#nombre_persona', '#small-nombre-legal', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
                return false;
                }
                else
                {
                ocultarError('#nombre_persona', '#small-nombre');
                ocultarError('#nombre_persona', '#small-nombre-legal');
                return true;
                }
            }
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
