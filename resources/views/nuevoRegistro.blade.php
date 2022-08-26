@extends('layouts')

@section('content2')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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

    <small class="small" id="small-razon_social"></small>
    <small class="small" id="small-nombre_fantasia"></small>
    <small class="small" id="small-cuit4"></small>
    <small class="small" id="small-cuit2"></small>
    <small class="small" id="small-dni_legal"></small>

    <form  id="regiration_form" action="{{ route('crear_registro') }}"  method="POST">
        @csrf
        @include('editarRegistro.datosGenerales',['mode'=>'create'])
        @include('editarRegistro.domicilio',['tipo_domicilio'=>'real', 'mode'=>'create'])
        @include('editarRegistro.domicilio',['tipo_domicilio'=>'legal', 'mode'=>'create'])
        @include('editarRegistro.domicilio',['tipo_domicilio'=>'fiscal', 'mode'=>'create'])
        @include('altaRegistro.actividad',['mode'=>'create'])
        @include('altaRegistro.pagos',['mode'=>'create'])

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group">
                <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>
            </div>
        </div>


    </form>
    @yield('datos')

    <!--Incluimos el modal para validar los campos -->

    @include('modales.validarFormularioAlta')

@endsection


@push('js')

<script type="text/javascript">

    $(document).ready(function() 
    {
        if ($('#provincia_real_create').val()!='')
            recargarListaDomicilio($('#provincia_real_create').val(), $("#localidad_real_create"));
        if ($('#provincia_legal_create').val()!='')
            recargarListaDomicilio($('#provincia_legal_create').val(), $('#localidad_legal_create'));
        if ($('#provincia_fiscal_create').val()!='')
            recargarListaDomicilio($('#provincia_fiscal_create').val(), $('#localidad_fiscal_create'));
        if ($('#provincia_habilitacion').val()!='')
            recargarListaHabilitacion();
        
        $("#regiration_form").on('submit',function(){
            event.preventDefault();

            if(validarDni())
                this.submit();
        });

    });

    function recargarListaDomicilio(provincia_selected, select_localidad){
        $.ajax({
            type:"GET",
            url:"{{url('localidades')}}/"+provincia_selected,
            success:function(r){
                select_localidad.html(r);
            }
        });
    }

    function recargarListaHabilitacion(){
        $.ajax({
        type:"GET",
                url:"{{url('localidades')}}/"+$('#provincia_habilitacion').val(),

        success:function(r){
            $('#localidad_habilitacion').html(r);
        }
        });
    }

    </script>
    <script type="text/javascript">

        var cant_filas_actividad = document.getElementById("body_table_actividad").rows.length;

        if(cant_filas_actividad == 0)
            $("#body_table_actividad").append(
                '<tr id="row_actividad" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                '</tr>');

    </script>

@endpush


@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

        input:invalid:required {

            border: 1px dashed red;
        }

        input:hover:invalid:required {

            background-color: rgb(255, 76, 76);
        }

    </style>

@endpush
