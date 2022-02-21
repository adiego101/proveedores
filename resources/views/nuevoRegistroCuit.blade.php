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

<h2>Cuit del registro a ingresar</h2>

<br>


<form id="crear_registro_cuit" action="{{ route('crear_registro_cuit') }}"  method="POST">
@csrf
<div class="container">
    <div class="row">

            <div class="col-sm">


                <label for="cuit">CUIT:</label><br>
                <input type="text" class="form-control" placeholder="Ingrese CUIT del nuevo registro" aria-describedby="basic-addon1" id="cuit" name="cuit" maxlength="13"  pattern="^[0-9]*(\.?)[0-9]+$" required><br>
            </div>

    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="btn-group">
            <button type="submit" name="Siguiente" class="btn btn-success"> {{ 'Siguiente' }} </button>
        </div>
    </div>
</div>

</form>

@endsection



@push('js')




@endpush

@push('css')
    <style>
        input:invalid:required {

            border: 2px solid red;
        }
    </style>
@endpush

