@extends('layouts')


@section('content2')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Crear Nuevo Usuario</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}">Regresar</a>
        </div>
    </div>
</div>





{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Nombre del usuario','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email del usuario','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Contraseña:</strong>
            {!! Form::password('password', array('placeholder' => 'Contraseña del usuario','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirmar Contraseña:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Ingrese nuevamente la contraseña','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            <br/>
            @foreach($roles as $value)
            <label>{{ Form::checkbox('roles[]', $value, false, array('class' => 'name')) }}
                {{ $value }}</label>
            <br/>

            @endforeach

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Crear Usuario</button>
    </div>
</div>
{!! Form::close() !!}


@endsection