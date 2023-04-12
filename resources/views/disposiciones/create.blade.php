@extends('layouts')

@section('content2')
<h1 align="center">NuevaDisposicion </h1>
<hr>
<form action="{{ route('disposiciones.crear',['id_proveedor'=> $id]) }}"  method="POST">
    @include('disposiciones.disposicion')
    <hr>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

        <div class="btn-group">
            <button type="submit" name="finalizar" class="btn finalizar btn-success"> {{ 'Finalizar' }} </button>
        </div>
    </div>
</form>
@endsection
@push('js')
@endpush
