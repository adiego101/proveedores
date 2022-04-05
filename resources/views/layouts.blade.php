@extends('adminlte::page')
@section('css')


@endsection
@section('js')



<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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

@endsection

@push('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('content_header')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-9 ">
            <div class="card">
                @include('includes.messages')
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

