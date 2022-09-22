@extends('adminlte::page')
@section('css')
    
    <link href="{{asset('assets/select2-4.0.13/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/select2-bootstrap-theme-master/dist/select2-bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="{{asset('assets/jquery-ui-1.13.1.custom/jquery-ui.css')}}">
    <style>
        .dni.ui-autocomplete-loading{ 
            background:url("{{asset('assets/jquery-ui-1.13.1.custom/images/ui-anim_basic_16x16.gif')}}");
            background-repeat:no-repeat;
            background-position:center;
            background-position-x:95%;
        }
    </style>

@endsection
@push('js')
    
    <script src="{{asset('assets/select2-4.0.13/dist/js/select2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('assets/jquery-ui-1.13.1.custom/jquery-ui.js')}}"></script>


    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

@endpush

@push('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />

@endpush

@section('content_header')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-9 ">
            <div class="card">
                @include('includes.messages')
                @include('includes.warnings')
                @include('includes.form-error')

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    @yield('content2')

                </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function applyInputMask(dni, mask) {
        let content = '';
        let maxChars = numberCharactersPattern(mask);
        
        dni.keydown(function(e) {
            e.preventDefault();
            if (isNumeric(e.key) && content.length < maxChars) {
            content += e.key;
            }
            if(e.keyCode == 8) {
            if(content.length > 0) {
                content = content.substr(0, content.length - 1);
            }
            }
            dni.val(maskIt('00.000.000', content));
        });
    }

    function isNumeric(char) {
        return !isNaN(char - parseInt(char));
    }

    function maskIt(pattern, value) {
        let position = 0;
        let currentChar = 0;
        let masked = '';
        while(position < pattern.length && currentChar < value.length) {
            if(pattern[position] === '0') {
            masked += value[currentChar];
            currentChar++;
            } else {
            masked += pattern[position];
            }
            position++;
        }
        return masked;
    }

    function numberCharactersPattern(pattern) {
        let numberChars = 0;
        for(let i = 0; i < pattern.length; i++) {
            if(pattern[i] === '0') {
            numberChars ++;
            }
        }
        return numberChars;
    }

    function validarExisteDatosPersonaModal(tipo_persona, mode, dni, apellido, nombre, cargo)
    {   
        if(apellido.val()=='')
        {
            mostrarError(apellido, '#small-apellido-x-'+mode, '<p style="color:red;">El APELLIDO de la persona <strong>no</strong> puede quedar vacío.</p>');
            if(dni.val()=='')
            {
                mostrarError(dni, '#small-dni-x-'+mode, '<p style="color:red;">El DNI de la persona <strong>no</strong> puede quedar vacío.</p>');
                if(nombre.val()=='')
                {
                    mostrarError(nombre, '#small-nombre-x-'+mode, '<p style="color:red;">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</p>');
                    if(tipo_persona=='direccion_firma')
                    {
                        if(cargo.val()=='')
                        {
                            mostrarError(cargo, '#small-cargo-x-'+mode, '<p style="color:red;">El CARGO de la persona <strong>no</strong> puede quedar vacío.</p>');
                            return false;
                        }
                        else
                            return false;
                    }
                    else
                        return true;
                }
                else
                {
                    ocultarError(nombre, '#small-nombre-x-'+mode);
                    return false;
                }
            }
            else
            {
                if(validarDniModal(mode, dni))
                {
                    if(nombre.val()=='')
                    {
                        mostrarError(nombre, '#small-nombre-x-'+mode, '<p style="color:red;">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</p>');
                        if(tipo_persona=='direccion_firma')
                        {
                            if(cargo.val()=='')
                            {
                                mostrarError(cargo, '#small-cargo-x-'+mode, '<p style="color:red;">El CARGO de la persona <strong>no</strong> puede quedar vacío.</p>');
                                return false;
                            }
                            else
                                return false;
                        }
                        else
                            return true;
                    }
                    else
                        {
                            ocultarError(nombre, '#small-nombre-x-'+mode);
                            return false;
                        }
                }
                else
                    return false;
            }
        }
        else
        {
            if(dni.val()=='')
            {
                mostrarError(dni, '#small-dni-x-'+mode, '<p style="color:red;">El DNI de la persona <strong>no</strong> puede quedar vacío.</p>');
                if(nombre.val()=='')
                {
                    mostrarError(nombre, '#small-nombre-x-'+mode, '<p style="color:red;">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</p>');
                    if(tipo_persona=='direccion_firma')
                    {
                        if(cargo.val()=='')
                        {
                            mostrarError(cargo, '#small-cargo-x-'+mode, '<p style="color:red;">El CARGO de la persona <strong>no</strong> puede quedar vacío.</p>');
                            return false;
                        }
                        else
                        {
                            ocultarError(cargo, '#small-cargo-x-'+mode);
                            return false;
                        }
                    }
                    else
                        return true;
                }
                else
                {
                    ocultarError(cargo, '#small-nombre-x-'+mode);
                    return false;
                }
            }
            else
            {
                if(validarDniModal(mode, dni))
                {
                    console.log("pasa por ak?");
                    if(nombre.val()=='')
                        {
                            mostrarError(nombre, '#small-nombre-x-'+mode, '<p style="color:red;">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</p>');
                            if(cargo.val()=='')
                            {
                                mostrarError(cargo, '#small-cargo-x-'+mode, '<p style="color:red;">El CARGO de la persona <strong>no</strong> puede quedar vacío.</p>');
                                return false;
                            }
                            else
                            {
                                ocultarError(cargo, '#small-cargo-x-'+mode);
                                return false;
                            }
                        }
                    else
                    {
                        if(tipo_persona=='direccion_firma')
                        {
                            if(cargo.val()=='')
                            {
                                mostrarError(cargo, '#small-cargo-x-'+mode, '<p style="color:red;">El CARGO de la persona <strong>no</strong> puede quedar vacío.</p>');
                                return false;
                            }
                            else
                                return true;
                        }
                        else
                            return true;
                    }
                }
                else
                    return false;
            }
        }
    }

    function validarDniModal(mode, dni)
        {
            if(mode=='create')
            {
                if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                {
                    mostrarError('#dni_x_create', '#small-dni-x-create', '<p style="color:red;">El <strong>número de DNI de la persona </strong> tiene un formato incorrecto. Ingrese DNI con puntos.</p>');
                    return false;
                }  
                else
                {
                    ocultarError('#dni_x_create', '#small-dni-x-create');

                    return true;
                }
            }
            else
                if(mode=='edit')
                {
                    if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                    {
                        mostrarError('#dni_x_edit', '#small-dni-x-edit', '<p style="color:red;">El <strong>número de DNI de la persona </strong> tiene un formato incorrecto. Ingrese DNI con puntos.</p>');
                        return false;
                    }  
                    else
                    {
                        ocultarError('#dni_x_edit', '#small-dni-x-edit');

                        return true;
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
</script>
@endpush

