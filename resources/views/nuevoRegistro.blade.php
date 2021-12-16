@extends('layouts')

@section('content2')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var current = 1,
                current_step, next_step, steps;
            steps = $("fieldset").length;
            $(".next").click(function() {
                current_step = $(this).parent();
                next_step = $(this).parent().next();
                next_step.show();
                current_step.hide();
                setProgressBar(++current);
                $(window).scrollTop(0);
            });
            $(".previous").click(function() {
                current_step = $(this).parent();
                next_step = $(this).parent().prev();
                next_step.show();
                current_step.hide();
                setProgressBar(--current);
                $(window).scrollTop(0);
            });
            setProgressBar(current);
            // Change progress bar action
            function setProgressBar(curStep) {
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                    .css("width", percent + "%")
                    .html(percent + "%");
            }
        });

    </script>



    <style>
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }

    </style>


    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <br>
    <div class="alert alert-info" role="alert">
        Complete los campos que se presentan continuación
        y presione el botón <b>Siguiente</b>, para continuar la carga de datos.
    </div>

    <form id="regiration_form" action="{{ route('crear_registro') }}"  method="POST">
        @csrf
        @include('altaRegistro.actividad')
        @include('altaRegistro.valorAgregado')
        @include('altaRegistro.personalOcupado')
        @include('altaRegistro.patenteSeguro')
        @include('altaRegistro.otrosDatos')

        @include('altaRegistro.datosGenerales')
        @include('altaRegistro.domicilioReal')
        @include('altaRegistro.domicilioLegal')
        @include('altaRegistro.sucursales')
        @include('altaRegistro.pagos')
        @include('altaRegistro.infoImpositiva')
        @include('altaRegistro.Impuestosingresosbrutos')
        @include('altaRegistro.domicilioFiscal')

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="btn-group">
                        <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>

                    </div> </div>


    </form>
    @yield('datos')

@endsection

@push('js')

<script type="text/javascript">
    function valideKey(evt){

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) { // espacio.
          return true;
        } else if(code>=48 && code<=57) { // es un numero.
          return true;
        } else{ // otras teclas
        console.log("no es un numero");
          return false;
        }
    }
    </script>

<script>

$('input[type="checkbox"]').on('change', function(){
    this.value = this.checked ? 1 : 0;
     console.log(this.value);
 }).change();
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
