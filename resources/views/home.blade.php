@extends('adminlte::page')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card">
            
                <div class="card-header">{{ __('¡Bienvenido!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Registro Único de Proveedores de Actividades Económicas de la provincia de Santa Cruz.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
