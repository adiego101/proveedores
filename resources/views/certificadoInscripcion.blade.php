<?php

//Recuperamos la fecha de inscripcion desde la BD
//La fecha original tiene el formato YYYY-mm-dd H:i:s
$fechaOriginalInscripcion = htmlspecialchars($data['fecha_inscripcion']);

//Cambiamos el formato por dd/mm/YYYY H:i:s
$timestamp = strtotime($fechaOriginalInscripcion);
$fechaInscripcionFormat = date("d/m/Y", $timestamp);

//Tomamos la fecha de inscripcion y le aumentamos un año (para el campo valido hasta)
$anioSiguiente = strtotime($fechaOriginalInscripcion.'+1 year');
$fechaValidoHasta = date("d/m/Y", $anioSiguiente);
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

        header {
            position: fixed;
            top: 0.5cm;
            left: 1.5cm;
            right: -2cm;
            height: 2cm;
            color: black;
            text-align: center;
            line-height: 18px;
            display: flex;
            align-content: space-between;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 3cm;
            right: -1.5cm;
            height: 2cm;
            color: black;
            text-align: center;
            line-height: 18px;
            font-size: small;
        }

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

    </style>
</head>

<body>
    <main>
        <section>
            <header>
                <img src="../public/Santa_Cruz.png" class="img-left">

                <img src="../public/logo_minpro.png" class="img-right">

                <div class="center">
                    Registro Único Provincial  <br> de Actividades Económicas
                </div>
            </header>

            <br>
            <br>
            <br>
            <br>

            <span><u>Certificado de Inscripción</u></span>
            <label for="" class="txt-right">Cuit Nº: {{isset($data['cuit']) ? $data['cuit'] : ''}}</label><br><br>
            <label for="">Nombre del establecimiento: {{isset($data['nombre_fantasia']) ? $data['nombre_fantasia'] : ''}}</label><br><br>
            <label for="">Nombre del propietario o razón social: {{isset($data['razon_social']) ? $data['razon_social'] : ''}}</label><br><br>
            <label for="">Actividad principal: {{isset($data['cod_actividad_principal']) ? $data['cod_actividad_principal'] : ''}} - {{isset($data['actividad_principal']) ? $data['actividad_principal'] : ''}}</label><br><br>
            <label for="">Actividad secundaria: {{isset($data['actividad_secundaria']) ? $data['actividad_secundaria'] : ''}}</label><br><br>
            <label for="">Calle o ruta: {{isset($data['calle_ruta']) ? $data['calle_ruta'] : ''}}</label><br><br>
            <label for="">Teléfono:{{isset($data['cod_tel_real']) ? $data['cod_tel_real'] : ''}} - {{isset($data['telefono']) ? $data['telefono'] : ''}}</label>
            <label for="" class="txt-right">Localidad / Paraje: {{isset($data['localidad']) ? $data['localidad'] : ''}}</label><br><br>
            <label for="">Fecha de Inscripción: {{$fechaInscripcionFormat}}</label>
            <label for="" class="txt-right"><b>Válido hasta:</b> {{$fechaValidoHasta}}</label>

            <br>
            <br>
            <br>
            <br>

            <label for="">{{isset($data['tipo_proveedor']) ? $data['tipo_proveedor'] : ''}}</label>

            <label for="" class="txt-right">_________________________ <br>Firma</label>

           
            <footer>
                <hr>
                Dirección Provincial de Comercio - Avellaneda Nº 801 - Teléfono (02966) 422748 - Interno 6259 <br>
                Río Gallegos - PROVINCIA DE SANTA CRUZ
            </footer>
        </section>
    </main>

    <script type="text/php">

        if (isset($pdf)) {
           $font = $fontMetrics->getFont("Arial", "bold");
           $pdf->page_text(550, 800, "{PAGE_NUM}/{PAGE_COUNT}", $font, 12, array(0, 0, 0));
        }
   </script>

</body>
</html>
