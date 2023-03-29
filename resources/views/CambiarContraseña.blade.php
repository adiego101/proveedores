@extends('layouts')

@section('content2')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
        <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Cambiar Contraseña</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('home') }}">Regresar</a>
            </div>
        </div>
    </div>

    {!! Form::model(auth()->user(), ['method' => 'PATCH','route' => ['changePassword']]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Contraseña Actual:</strong>
                {!! Form::password('password', ['placeholder' => 'Ingrese su contraseña actual', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nueva Contraseña:</strong>
                {!! Form::password('new-password', ['placeholder' => 'Ingrese su nueva contraseña', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirmar Contraseña:</strong>
                {!! Form::password('confirm-password', ['placeholder' => 'Ingrese nuevamente la contraseña', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Cambiar Contraseña</button>
    </div>
    </div>
    {!! Form::close() !!}

@endsection
