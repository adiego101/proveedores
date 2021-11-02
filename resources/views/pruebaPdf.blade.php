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
            <label for="">Razón Social:</label><br>
            <label for="">Nombre de Fantasía:</label><br>
            <br>
            <span>Datos del Domicilio Real:</span><br>
                <br>
                <label for="">Domicilio Real:</label><br>
                <label for="">Localidad:</label><br>
                <label for="">Provincia:</label><br>
                <label for="">Teléfono:</label><br>
                <label for="">Correo electrónico:</label><br>
                <br>
                <br>
                <br>
                <hr>
                <label for="">Tipo de sociedad:</label><br>

                <label for="">Situación IVA:</label><br>
                <label for="">Nro Ingresos brutos:</label><br>
                <label for="">Tipo contribuyente:</label><br>
                <br>
                
                <label for="">Nro habilitación municipal:</label><br>
               
                <label for="">Nro de Inscripción personas jurídicas:</label><br>
                
                <label for="">Registro público de comercio:</label><br>
               
                <label for="">Inspección general de justicia:</label><br>
                
                <label for="">Act principal:</label><br>
                <label for="">Act secundaria:</label><br>
                
                <hr>

                <label for="">Porcentaje facturación:</label><br>
                <label for="">Porcentaje gasto:</label><br>
                <label for="">Porcentaje mano de obra:</label><br>

                <label for="">Indice:</label><br>

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
                <label for="">Domicilio Legal:</label><br>
                <label for="">Localidad:</label><br>
                <label for="">Provincia:</label><br>
                <label for="">Teléfono:</label><br>
                <label for="">Correo electrónico:</label><br>
                <label for="">Representante legal:</label><br>
                <label for="">DNI:</label><br>
                <br>
                <hr>
                <br>
                <label for="">Retención:</label><br>
                <label for="">Juridicción:</label><br>
                <br>
                <br>
                <label for="">Localidad habilitación:</label><br>
                <label for="">Provincia inscrip personas jurídicas:</label><br>
                <label for="">Provincia registro público:</label><br>
                <label for="">Provincia inspección justicia:</label><br>
                <br>
                <br>
                <hr>
                <label for="">Antiguedad en provincia:</label><br>
                <label for="">Domicilio fiscal en la provincia:</label><br>
                <label for="">Valor agregado:</label><br>
               
                <label for="">Proveedor:</label><br>

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
