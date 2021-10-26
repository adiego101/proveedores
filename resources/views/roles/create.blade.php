@extends('layouts')


@section('content2')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Crear nuevo Rol</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}">Regresar</a>
        </div>
    </div>
</div>

{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Ingrese un nuevo rol','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permisos:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Crear Rol</button>
    </div>
</div>
{!! Form::close() !!}


@endsection