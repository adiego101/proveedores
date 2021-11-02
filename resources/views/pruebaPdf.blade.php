<?php 

use Carbon\Carbon; 

$date = Carbon::now()->format("d/m/Y H:i:s");
?>

<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #D3FAFF;
            color: black;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #D3FAFF;
            color: black;
            text-align: center;
            line-height: 35px;
        }

        .img-left{
            float: left;
            display: block;
            margin-left: 10px;
            margin-right: auto;
            margin-bottom: auto;
            margin-top: 10px;  
            width: 180;
            height: 30;  
        }

        .img-right{
            float: right;
            display: block;
            margin-right: 10px;
            margin-bottom: auto;
            margin-top: 10px;
            width: 30;
            height: 30;  
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
            margin-right: 50px;
            margin-bottom: auto;
            margin-top: 10px; 
          
        }

        .center {
            text-align: center;
        }

        article{
  
            margin: 30px;
        }

        span{
            font-size: 20px;
            font-weight: bold;

        }
        

       /* .page_break { page-break-before: always; } */

    </style>
</head>
<body>
<header>
    <img src="../public/JEFATURA.png" class="img-left">
    <img src="../public/logo_santacruz.png" class="img-right">
    <div class="center">Registro Único Provincial  <br> de Actividades Económicas</div>
    
</header>

<main>
    <h1><u>Inscripción Rupae Nº</u></h1>

    <section>
        <div style="width: 50%; float:left">
            <label for="calle">Razón Social:</label><br>
            <label for="calle">Nombre de Fantasía:</label><br>
            <br>
            <span>Datos del Domicilio Real:</span><br>
                <br>
                <label for="calle">Domicilio Real:</label><br>
                <label for="calle">Localidad:</label><br>
                <label for="calle">Provincia:</label><br>
                <label for="calle">Teléfono:</label><br>
                <label for="calle">Correo electrónico:</label><br>
                <br>
                <br>
                <br>
                <hr>
                <label for="calle">Tipo de sociedad:</label><br>

                <label for="calle">Situación IVA:</label><br>
                <label for="calle">Nro Ingresos brutos:</label><br>
                <label for="calle">Tipo contribuyente:</label><br>
                <br>
                
                <label for="calle">Nro habilitación municipal:</label><br>
               
                <label for="calle">Nro de Inscripción personas jurídicas:</label><br>
                
                <label for="calle">Registro público de comercio:</label><br>
               
                <label for="calle">Inspección general de justicia:</label><br>
                
                <label for="calle">Act principal:</label><br>
                <label for="calle">Act secundaria:</label><br>
                
                <hr>

                <label for="calle">Porcentaje facturación:</label><br>
                <label for="calle">Porcentaje gasto:</label><br>
                <label for="calle">Porcentaje mano de obra:</label><br>

                <label for="calle">Indice:</label><br>

                <br>
                <br>
                <br>
                <label for="">Rio Gallegos</label>
                <?php echo $date; ?>
        </div>
        <div style="width: 50%; float:right">
            <label for="calle">Fecha de Inscripción:</label><br>
            <label for="numero">Cuit:</label><br>
            <br>
            <span>Datos del Domicilio Legal:</span><br>
                <br>
                <label for="calle">Domicilio Legal:</label><br>
                <label for="calle">Localidad:</label><br>
                <label for="calle">Provincia:</label><br>
                <label for="calle">Teléfono:</label><br>
                <label for="calle">Correo electrónico:</label><br>
                <label for="calle">Representante legal:</label><br>
                <label for="calle">DNI:</label><br>
                <br>
                <hr>
                <br>
                <label for="calle">Retención:</label><br>
                <label for="calle">Juridicción:</label><br>
                <br>
                <br>
                <label for="calle">Localidad habilitación:</label><br>
                <label for="calle">Provincia inscrip personas jurídicas:</label><br>
                <label for="calle">Provincia registro público:</label><br>
                <label for="calle">Provincia inspección justicia:</label><br>
                <br>
                <br>
                <hr>
                <label for="calle">Antiguedad en provincia:</label><br>
                <label for="calle">Domicilio fiscal en la provincia:</label><br>
                <label for="calle">Valor agregado:</label><br>
               
                <label for="calle">Proveedor:</label><br>

        </div>
       
    </section>


   
</main>
<!--<div class="page_break"></div>-->
<footer>
    <div>
        Dirección Provincial de Comercio - Avellaneda Nº 801 - Teléfono (02966) 422748 - Interno 6259 <br> 
        Río Gallegos - PROVINCIA DE SANTA CRUZ
    </div>
</footer>
</body>
</html>