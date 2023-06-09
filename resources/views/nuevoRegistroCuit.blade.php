@extends('layouts')

@section('content2')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<h1>Nuevo Registro</h1>

<br>

<div class="alert alert-info" role="alert">
    Ingrese el número de CUIT del registro que desea agregar.<br>En el caso de que el CUIT no exista, podrá completar el formulario de alta con los datos correspondientes.<br>En el caso de que el CUIT ya exista será redirigido a un formulario para editar o cargar nuevamente los datos.
</div>

<br>

<form id="crear_registro_cuit" action="{{ route('crear_registro_cuit') }}"  method="POST">
@csrf
<div class="container">
    <div class="row">

            <div class="col-sm">

                <label for="cuit">CUIT: <sup>*</sup></label><br>
                <input type="text" class="form-control" placeholder="Ingrese el número de cuit" aria-describedby="basic-addon1" id="cuit" name="cuit" maxlength="13" pattern="^([0-9]{2})-([0-9]{8})-([0-9]{1})$" required>
                <small class="small" id="small-cuit"></small>
                <br>
            </div>

    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="btn-group">
            <button type="submit" name="Siguiente" class="btn btn-primary"> {{ 'Siguiente' }} </button>
        </div>
    </div>
</div>

</form>

@endsection





@push('css')

    <style>
        input:invalid:required {

            border: 1px dashed red;
        }

        input:hover:invalid:required {

            background-color: rgb(255, 76, 76);
        }
    </style>

@endpush

