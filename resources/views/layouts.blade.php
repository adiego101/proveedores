@extends('adminlte::page')
@section('css')
    
    <link href="{{asset('assets/select2-4.0.13/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/select2-bootstrap-theme-master/dist/select2-bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="{{asset('assets/jquery-ui-1.13.1.custom/jquery-ui.css')}}">
    <style>
        #dni_legal.ui-autocomplete-loading.is-invalid { 
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
        $(document).ready(function()
        {
            $('.js-example-basic-single').select2({
                theme: "bootstrap",    width: 'resolve' // need to override the changed default
            });

            $('#razon_social').keyup(validar_razon_social);

            $('#nombre_fantasia').keyup(validar_nombre_fantasia);

            $('#cuit').keyup(validar_cuit);

            $('#dni_legal').keyup(validarDni);

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

