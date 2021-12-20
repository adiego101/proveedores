<?php

use Carbon\Carbon;

$date = Carbon::now()->format("d/m/Y");
?>

<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 1cm 2cm 1cm;
        }

  /*      header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #D3FAFF;
            color: black;
            text-align: center;
            line-height: 30px;
        }*/

    /*    footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #D3FAFF;
            color: black;
            text-align: center;
            line-height: 35px;
        }*/

        .img-left{
            float: left;
            display: block;
            margin-left: 10px;
            margin-right: auto;
            margin-bottom: auto;
            margin-top: -8px;
            width: 150;
            height: 35;
        }

        .img-right{
            float: right;
            display: block;
            margin-right: -10px;
            margin-bottom: auto;
            margin-top: -13px;
            width: 150;
            height: 40;
        }

        .txt-left{
            float: left;
            display: block;
            margin-left: -50px;
            margin-right: auto;
            margin-bottom: auto;
            margin-top: 10px;

        }

        .txt-right{
            float: right;
            display: block;
            margin-right: 80px;
            margin-bottom: auto;
            margin-top: 10px;

        }

        .center {
            text-align: center;
            font-size: small;
            width: 30%;
            margin-left: 170px;
            margin-right: auto;
            margin-bottom: auto;
            margin-top: 0px;

        }

        article{

            margin: 30px;
        }

        span{
            font-size: 20px;
            font-weight: bold;

        }


       /* .page_break { page-break-before: always; } {{$data['titulo']}} */

    </style>
</head>

<body>

    <main>

        <section>

            <img src="../public/Santa_Cruz.png" class="img-left">

            <img src="../public/logo_minpro.png" class="img-right">

            <div class="center">
                 Registro Único Provincial  <br> de Actividades Económicas
            </div>

    <br>
    <br>
            <span><u>Certificado de Inscripción</u></span>
            <label for="" class="txt-right">Cuit Nº: {{$data['cuit']}}</label><br><br>
            <label for="">Nombre del establecimiento: {{$data['nombre_fantasia']}}</label><br><br>
            <label for="">Nombre del propietario o razón social: {{$data['razon_social']}}</label><br><br>
            <label for="">Actividad principal: {{$data['actividad_principal']}}</label><br><br>
            <label for="">Actividad secundaria: {{$data['actividad_secundaria']}}</label><br><br>
            <label for="">Calle o ruta: {{$data['calle_ruta']}}</label><br><br>
            <label for="">Teléfono: {{$data['telefono']}}</label>
            <label for="" class="txt-right">Localidad / Paraje: {{$data['localidad']}}</label><br><br>
            <label for="">Fecha de Inscripción: {{$data['fecha_inscripcion']}}</label>
            <label for="" class="txt-right"><b>Válido hasta:</b>  <?php echo $date; ?></label>


            <br>
            <br>
            <label for="" class="txt-right">__________________</label>
            <br>
            <br>

            <div style="text-align: center; font-size: small;">
            <hr>
            Dirección Provincial de Comercio - Avellaneda Nº 801 - Teléfono (02966) 422748 - Interno 6259 <br>
            Río Gallegos - PROVINCIA DE SANTA CRUZ
            </div>
        </section>
        <br>
        <p>-------------------------------------------------------------------------------------------------------------------------</p>

        <section>

            <img src="../public/Santa_Cruz.png" class="img-left">
            <img src="../public/logo_minpro.png" class="img-right">
            <div class="center">Registro Único Provincial  <br> de Actividades Económicas</div>
            <br>
            <br>
            <span><u>Certificado de Inscripción</u></span>
            <label for="" class="txt-right">Cuit Nº: {{$data['cuit']}}</label><br><br>
            <label for="">Nombre del establecimiento: {{$data['nombre_fantasia']}}</label><br><br>
            <label for="">Nombre del propietario o razón social: {{$data['razon_social']}}</label><br><br>
            <label for="">Actividad principal: {{$data['actividad_principal']}}</label><br><br>
            <label for="">Actividad secundaria: {{$data['actividad_secundaria']}}</label><br><br>
            <label for="">Calle o ruta: {{$data['calle_ruta']}}</label><br><br>
            <label for="">Teléfono: {{$data['telefono']}}</label>
            <label for="" class="txt-right">Localidad / Paraje: {{$data['localidad']}}</label><br><br>
            <label for="">Fecha de Inscripción: {{$data['fecha_inscripcion']}}</label>
            <label for="" class="txt-right"><b>Válido hasta:</b>  <?php echo $date; ?></label>

            <br>
            <br>
            <label for="" class="txt-right">__________________</label>
            <br>
            <br>

            <div style="text-align: center; font-size: small;">
            <hr>
            Dirección Provincial de Comercio - Avellaneda Nº 801 - Teléfono (02966) 422748 - Interno 6259 <br>
            Río Gallegos - PROVINCIA DE SANTA CRUZ
            </div>

        </section>

    </main>
    <!--<div class="page_break"></div>-->
</body>
</html>
