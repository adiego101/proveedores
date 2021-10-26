@extends('layouts')


@section('content2')
<div class="row ">
        <div class="col">
            <h2>Administración de usuarios</h2>
        </div>
        <div class="col">
            <a class="btn btn-success float-right" title="Crear nuevo usuario" href="{{ route('users.create') }}"> Crear Usuario </a>
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
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">&nbsp</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
        <a class="btn btn-primary" href="{{ route('users.show',$user->id) }}">Ver</a>
        <a class="btn btn-warning" href="{{ route('users.edit',$user->id) }}">Editar</a>

        <!-- Botón que abre el Modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{ $user->id }}">Eliminar</button>
     
        @include('users.modalUsers')
    </td>
  </tr>
 @endforeach
</table>
</div>

{!! $data->render() !!}


@endsection