@extends('layouts')

@section('content2')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <form id="baja_form" action="{{url('dar_baja')}}"  method="POST">
        @csrf

       <input type="number" class="form-control" aria-describedby="basic-addon1" id="id" name="id">
       <button type="submit" name="dar-baja" class="btn btn-danger"> {{ 'Dar de baja Registro' }} </button>

    </form>
    @yield('datos')

@endsection

@push('js')
    <script>
        $('input[type="checkbox"]').on('change', function() {
            this.value = this.checked ? 1 : 0;
            console.log(this.value);
        }).change();

        $('.btnNext').click(function() {
    $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
})

$('.btnPrevious').click(function() {
    $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
})
    </script>


@endpush

@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

    </style>
@endpush
