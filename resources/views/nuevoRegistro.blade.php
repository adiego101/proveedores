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
    <small class="small" id="small-facturacion"></small>
    <small class="small" id="small-masa"></small>

    <form  id="regiration_form" action="{{ route('crear_registro') }}"  method="POST">
        @csrf
        @include('altaRegistro.datosGenerales')

        @include('altaRegistro.domicilio',['tipo_domicilio'=>'real'])
        @include('altaRegistro.domicilio',['tipo_domicilio'=>'legal'])
        @include('altaRegistro.domicilio',['tipo_domicilio'=>'fiscal'])
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" integrity="sha512-CbQfNVBSMAYmnzP3IC+mZZmYMP2HUnVkV4+PwuhpiMUmITtSpS7Prr3fNncV1RBOnWxzz4pYQ5EAGG4ck46Oig==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    function valideKey(evt){

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) { // espacio.
          return true;
        } else if(code>=48 && code<=57) { // es un numero.
          return true;
        } else{ // otras teclas
        //console.log("no es un numero");
          return false;
        }
    }
</script>

<script>

$('input[type="checkbox"]').on('change', function(){
    this.value = this.checked ? 1 : 0;
     //console.log(this.value);
 }).change();
</script>


<!--Validacion de campos del formulario -->

<script type="text/javascript">



   /* let formulario = document.getElementById("regiration_form");

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

    }, false);*/


    let formulario = document.getElementById("regiration_form");

    formulario.addEventListener("submit", function(event){

        //Detenemos el envio del formulario
        event.preventDefault();

        if(validardni_legal()){
                if(validarMasa()){
                    if(validarFacturacion()){
                        this.submit();

                    }
                }
            }

        }, false);
</script>


<script type="text/javascript">

function validarMasa() {

    var numero_masa = $('#masa_salarial_bruta').val();

var cadena_masa = numero_masa.toString();

const regex_masa = /^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/;
const only_number_masa = regex_masa.test(cadena_masa);

if (only_number_masa == true){
    return true;
}
else{
    return false;
}
}
function validarFacturacion() {

    var numero_facturacion = $('#facturacion_anual_alcanzada').val();

var cadena_facturacion = numero_facturacion.toString();

const regex_facturacion = /^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/;
const only_number_facturacion = regex_facturacion.test(cadena_facturacion);

if (only_number_facturacion == true){
    return true;
}
else{
    return false;
}
}

$("#masa_salarial_bruta").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "change" : function(){

           var numero_masa = $('#masa_salarial_bruta').val();

           var cadena_masa = numero_masa.toString();

           const regex_masa = /^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/;
           const only_number_masa = regex_masa.test(cadena_masa);

           if (only_number_masa == false){

               mostrarError('#masa_salarial_bruta', '#small-masa', '<div class="alert alert-danger mt-3 pt-1">El campo <strong>masa salarial bruta</strong> contiene datos <strong>incorrectos</strong>.</div>');

           } else {

               ocultarError('#masa_salarial_bruta', '#small-masa');
           }

       },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }

});

$("#facturacion_anual_alcanzada").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "change" : function(){

            var numero_facturacion = $('#facturacion_anual_alcanzada').val();

            var cadena_facturacion = numero_facturacion.toString();

            const regex_facturacion = /^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/;
            const only_number_facturacion = regex_facturacion.test(cadena_facturacion);

            if (only_number_facturacion == false){

                mostrarError('#facturacion_anual_alcanzada', '#small-facturacion', '<div class="alert alert-danger mt-3 pt-1">El campo <strong>facturacion anual alcanzada</strong> contiene datos <strong>incorrectos</strong>.</div>');

            } else {

                ocultarError('#facturacion_anual_alcanzada', '#small-facturacion');
            }

        },
    "keyup": function (event) {
        ocultarError('#facturacion_anual_alcanzada', '#small-facturacion');
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }

});



        /*Al cargar el formulario verificamos si las tablas estan vacias, mostramos un mensaje de aviso*/
        window.onload = function() {



            $("#masa_salarial_bruta").val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
        $("#facturacion_anual_alcanzada").val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });


            validar_razon_social();

            validar_nombre_fantasia();

            validar_cuit();

            $('.js-example-basic-single').select2({
            theme: "bootstrap",    width: 'resolve' // need to override the changed default
});
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


            var cant_filas_palabra_clave = document.getElementById("body_table_palabra_clave").rows.length;

            if(cant_filas_palabra_clave == 0){

                $("#body_table_palabra_clave").append(
                '<tr id="row_palabra_clave" class="alert alert-light" role="alert">'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                '</tr>'
                );
            }


            var cant_filas_pago = document.getElementById("body_table_pago").rows.length;

            if(cant_filas_pago == 0){

                $("#body_table_pago").append(
                '<tr id="row_pago" class="alert alert-light" role="alert">'+
                    '<td></td>'+
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
