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

