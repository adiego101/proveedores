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

    <form id="regiration_form" action="{{ route('crear_registro') }}"  method="POST">
        @csrf
        @include('altaRegistro.datosGenerales')

        @include('altaRegistro.domicilioReal')
        @include('altaRegistro.domicilioLegal')
        @include('altaRegistro.domicilioFiscal')
        @include('altaRegistro.sucursales')
        @include('altaRegistro.infoImpositiva')
        @include('altaRegistro.Impuestosingresosbrutos')
        @include('altaRegistro.actividad')
        @include('altaRegistro.pagos')

        @include('altaRegistro.valorAgregado')
        @include('altaRegistro.personalOcupado')

        @include('altaRegistro.patenteSeguro')
        @include('altaRegistro.otrosDatos')

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


<!--Validacion de campos del formulario -->

<script type="text/javascript">

    let formulario = document.getElementById("regiration_form");

    formulario.addEventListener("submit", function(event){

        //Detenemos el envio del formulario
        event.preventDefault();

        let comodin = true;
        let texto = "Faltan completar los siguientes campos: ";

        //Obtenemos los valores de cada campo
        let razon = document.getElementById('razon_social').value;
        let nombre = document.getElementById('nombre_fantasia').value;
        let cuit = document.getElementById('cuit').value;

        if (razon.length == 0)
        {
            texto = texto + "\n*Razón social (Datos generales)";
            comodin = false;
        }

        if (nombre.length == 0)
        {
            texto = texto + "\n*Nombre de fantasía (Datos generales)";
            comodin = false;
        }

        if (cuit.length == 0)
        {
            texto = texto + "\n*Cuit (Datos generales)";
            comodin = false;
        }

        if (!comodin)
        {
            //Desplegamos el modal
            $('#modal_validar_formulario').modal('show');

            //Enviamos los valores recuperados anteriormente a los inputs del modal
            $('#modal_aviso').text(texto);
        }

        if (comodin)
        {
            this.submit();
        }

    }, false);

</script>


<script type="text/javascript">

        /*Al cargar el formulario verificamos si las tablas estan vacias, mostramos un mensaje de aviso*/
        window.onload = function() {

            var cant_filas_sucursal = document.getElementById("body_table_sucursal").rows.length;

            if(cant_filas_sucursal == 0){

                $("#body_table_sucursal").append(
                        '<tr id="row_sucursal" class="alert alert-light" role="alert">'+
                            '<td></td>'+
                            '<td>No hay registros</td>'+
                            '<td></td>'+
                            '<td></td>'+
                        '</tr>'
                );
            }


            var cant_filas_actividad = document.getElementById("body_table_actividad").rows.length;

            if(cant_filas_actividad == 0){

                $("#body_table_actividad").append(
                        '<tr id="row_actividad" class="alert alert-light" role="alert">'+
                            '<td></td>'+
                            '<td>No hay registros</td>'+
                            '<td></td>'+
                        '</tr>'
                );
            }

            var cant_filas_producto = document.getElementById("body_table_producto").rows.length;

            if(cant_filas_producto == 0){

                $("#body_table_producto").append(
                '<tr id="row_producto" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>'
                );
            }


            var cant_filas_pago = document.getElementById("body_table_pago").rows.length;

            if(cant_filas_pago == 0){

                $("#body_table_pago").append(
                '<tr id="row_pago" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>'
                );
            }


            var cant_filas_vehiculo = document.getElementById("body_table_vehiculo").rows.length;

            if(cant_filas_vehiculo == 0){

                $("#body_table_vehiculo").append(
                '<tr id="row_vehiculo" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>'
                );
            }


            var cant_filas_seguro = document.getElementById("body_table_seguro").rows.length;

            if(cant_filas_seguro == 0){

                $("#body_table_seguro").append(
                '<tr id="row_seguro" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>'
                );
            }


            var cant_filas_sede = document.getElementById("body_table_sede").rows.length;

            if(cant_filas_sede == 0){

                $("#body_table_sede").append(
                '<tr id="row_sede" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>'
                );
            }
        };

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
