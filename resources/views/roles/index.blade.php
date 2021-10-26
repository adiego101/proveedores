@extends('layouts')


@section('content2')

<div class="row ">
    <div class="col">
        <h2>Administración de Roles</h2>
    </div>
    <div class="col">
        @can('admin_crear_roles')
        <a class="btn btn-success float-right" title="Crear Nuevo Rol" href="{{ route('roles.create') }}">Crear Rol</a>
        @endcan
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="table-responsive">

<table class="table table-bordered">
  <tr>
     <th>#</th>
     <th>Nombre</th>
     <th width="280px">&nbsp</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('roles.show',$role->id) }}">Ver</a>
            @can('admin_editar_roles')
                <a class="btn btn-warning" href="{{ route('roles.edit',$role->id) }}">Editar</a>
            @endcan

            <!-- Botón que abre el Modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{ $role->id }}">Eliminar</button>

            @include('roles.modalRoles')
        </td>
    </tr>
    @endforeach
</table>
</div>

{!! $roles->render() !!}

@endsection