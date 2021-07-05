@extends('adminlte::page')
@section('css')

@endsection
@section('js')
@endsection

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