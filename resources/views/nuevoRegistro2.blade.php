@extends('layouts')

@section('content2')

<nav>
    <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
    <li class="nav-item">
            <a class=" nav-link @if (empty($tab)) {{ 'active' }} @endif" id="disposiciones-tab"
                data-toggle="tab" href="#disposiciones">Disposicion</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="actividades-tab" data-toggle="tab" href="#actividades">Actividad</a>
        </li>
    </ul>

    <br>

</nav>
<form action="{{ route('modificar.Registro',['id'=> $id]) }}"  method="GET">
    @csrf

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade  @if (empty($tab)) {{ 'show active' }} @endif" id="disposiciones"
            role="tabpanel" aria-labelledby="nav-disposiciones-tab">

                @include('disposiciones.disposicion')
            <hr>
        </div>
        <div class="tab-pane fade" id="actividades"
            role="tabpanel" aria-labelledby="nav-actividades-tab">

            @include('actividades.actividad')
            <hr>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group">
                <button type="submit" name="finalizar" class="btn finalizar btn-success"> {{ 'Finalizar' }} </button>
            </div>
        </div>
    </form>
@endsection
@push('js')
<script >
    $(document).ready(function()
        {
            //console.log("{{url('proveedor/disposicionesJson/' . $id)}}");
            disposicionesJson();


        });

        function disposicionesJson(){
                $.ajax({
                    type: "GET",
                    url: "{{url('proveedor/disposicionesJson/' . $id)}}",
                    dataType:"json",
                    success: function(data){
                        $(".dispos").empty();
                        $.each(data,function(key, registro) {
                            $(".dispos").append('<option value='+registro.id_disposicion+'>'+registro.nro_disposicion+'</option>');
                        });
                    },
                    error: function(data) {
                        alert('error');
                    }
                });
            }
</script>
@endpush
