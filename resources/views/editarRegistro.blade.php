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
    <small class="small" id="small-dni-legal"></small>
    <small class="small" id="small-apellido-legal"></small>
    <small class="small" id="small-nombre-legal"></small>

    <form id="edit_form" action="{{ url('editarProveedor/' . $proveedor->id_proveedor) }}" method="POST">
        @csrf

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade  @if (empty($tab)) {{ 'show active' }} @endif" id="datos-generales"
                role="tabpanel" aria-labelledby="nav-datos-generales-tab">
                @include('editarRegistro.datosGenerales',['mode'=>'edit'])
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

    @yield('datos')

@endsection

@push('js')
    <script>
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
            $("#dni_legal").val(function (index, value ) {
                return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
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
            if ($('#provincia_habilitacion').val()!='')
                recargarListaHabilitacion();

            $("#edit_form").on('submit',function(e){
                console.log("detecta evento finalizar edicion");
                e.preventDefault();

                if(validarDni())
                    this.submit();
            });
            $('.btnNext').click(function() {
                $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
            });

            $('.btnPrevious').click(function() {
                $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
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
            console.log("entra en esta funcion de recarga de localidades");
            $.ajax({
                type:"GET",
                url:"{{url('localidades')}}/"+provincia_selected,
                success:function(r){
                    select_localidad.html(r);
                }
            }).done(function(){
                let proveedor = @json($proveedor);
                if(proveedor.domicilio_real!=null && proveedor.domicilio_real.localidad!=null)
                    if ($('#provincia_real_edit').val()!='')
                        $("#localidad_real_edit option[value='"+proveedor.domicilio_real.localidad.id_localidad+"']").attr("selected", true);
                if(proveedor.domicilio_legal!=null && proveedor.domicilio_legal.localidad!=null)
                    if ($('#provincia_legal_edit').val()!='')
                        $("#localidad_legal_edit option[value='"+proveedor.domicilio_legal.localidad.id_localidad+"']").attr("selected", true);
                if(proveedor.domicilio_fiscal!=null && proveedor.domicilio_fiscal.localidad!=null)
                    if ($('#provincia_fiscal_edit').val()!='')
                        $("#localidad_fiscal_edit option[value='"+proveedor.domicilio_fiscal.localidad.id_localidad+"']").attr("selected", true);
            });
        }

        function recargarListaHabilitacion(){
            $.ajax({
            type:"GET",
                    url:"{{url('localidades')}}/"+$('#provincia_habilitacion').val(),

            success:function(r){
                $('#localidad_habilitacion').html(r);
            }
            }).done(function(){
            let localidad_habilitacion = @json($proveedor->localidad_habilitacion);
            if($("#provincia_habilitacion").val()!='' && localidad_habilitacion != null)
                $("#localidad_habilitacion option[value='"+localidad_habilitacion+"']").attr("selected", true);
            });
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
