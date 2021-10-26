@extends('layouts')


@section('content2')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Editar Usuario</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}">Regresar</a>
        </div>
    </div>
</div>

{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', $user->name, array('placeholder' => 'Nombre del usuario','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', $user->email, array('placeholder' => 'Email del usuario','class' => 'form-control')) !!}
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
                <label>{{ Form::checkbox('roles[]', $value, in_array($value, $userRole) ? true : false, array('class' => 'name')) }}
                {{ $value}}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Editar Usuario</button>
    </div>
</div>
{!! Form::close() !!}


@endsection