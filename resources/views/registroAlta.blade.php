<?php

use Carbon\Carbon;

//Fecha actual, en la que se genera el documento
$date = Carbon::now()->format("d/m/Y H:i:s");

//Recuperamos la fecha de inscripcion desde la BD
//La fecha original tiene el formato YYYY-mm-dd H:i:s
$fechaOriginalInscripcion = $data['fecha_inscripcion'];

//Cambiamos el formato por dd/mm/YYYY H:i:s
$timestamp = strtotime($fechaOriginalInscripcion); 
$fechaInscripcionFormat = date("d/m/Y H:i:s", $timestamp);
?>

<html>

    <head>
        <style>

            @page {
                margin: 0cm 0cm;
                font-family: Arial;
            }

            body {
                margin: 1.5cm 2cm 2cm;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
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
                color: black;
                text-align: center;
                line-height: 35px;
                font-size: small;
            }

            .img-left{
                float: left;
                display: block;
                margin-left: 10px;
                margin-right: auto;
                margin-bottom: auto;
                margin-top: 10px;
                width: 150;
                height: 35;
            }

            .img-right{
                float: right;
                display: block;
                margin-right: -10px;
                margin-bottom: auto;
                margin-top: 5px;
                width: 150;
                height: 40;
            }

            .center {
                text-align: center;
                font-size: small;
                width: 30%;
                margin-left: 170px;
                margin-right: auto;
                margin-bottom: auto;
                margin-top: 10px;
            }

            .titulo{
                font-size: 20px;
                font-weight: bold;

            }

            table{
                table-layout: fixed;
                width: 650px;
            }

            tr, td {
                width: 200px;
                word-wrap: break-word;
            }

            /* .page_break { page-break-before: always; } */

        </style>
    </head>

    <body>
        <header>
            <img src="../public/Santa_Cruz.png" class="img-left">
            <img src="../public/logo_minpro.png" class="img-right">
            <div class="center"> Registro Único Provincial   de Actividades Económicas</div>
        </header>

        <main>

            <table>
                <tr>
                    <td colspan="2">
                        <h1><u>Inscripción Rupae Nº 
                                {{isset($data['proveedor']['nro_rupae_proveedor']) && strlen($data['proveedor']['nro_rupae_proveedor'])<5 ? substr(str_repeat(0, 5).$data['proveedor']['nro_rupae_proveedor'], - 5) : ''}}
                                {{isset($data['proveedor']['nro_rupae_proveedor']) && strlen($data['proveedor']['nro_rupae_proveedor'])>=5 ? $data['proveedor']['nro_rupae_proveedor']: ''}}
                            </u>
                        </h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Razón Social: {{isset($data['proveedor']['razon_social']) ? $data['proveedor']['razon_social'] : ''}}</label><br>
                        <label for="">Nombre de Fantasía: {{isset($data['proveedor']['nombre_fantasia']) ? $data['proveedor']['nombre_fantasia'] : ''}}</label><br>
                        <br>
                    </td>
                    <td>
                        <label for="calle">Fecha de Inscripción: {{$fechaInscripcionFormat}}</label><br>
                        <label for="numero">Cuit: {{isset($data['proveedor']['cuit']) ? $data['proveedor']['cuit'] : ''}}</label><br>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td><span class="titulo">Datos del Domicilio Real:</span><br></td>
                    <td><span class="titulo">Datos del Domicilio Legal:</span><br></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Domicilio Real: {{isset($data['calle_ruta_real']) ? $data['calle_ruta_real'] : ''}}</label><br>
                        <label for="">Localidad: {{isset($data['localidad_real']) ? $data['localidad_real'] : ''}}</label><br>
                        <label for="">Provincia: {{isset($data['provincia_real']) ? $data['provincia_real'] : ''}}</label><br>
                        <label for="">Teléfono:  {{isset($data['telefono_real']) ? $data['telefono_real'] : ''}}</label><br>
                        <label for="">Correo electrónico: {{isset($data['email_real']) ? $data['email_real'] : ''}}</label><br>
                
                    </td>
                    <td>
                        <br>
                        <label for="">Domicilio Legal: {{isset($data['calle_ruta_legal']) ? $data['calle_ruta_legal'] : ''}}</label><br>
                        <label for="">Localidad: {{isset($data['localidad_legal']) ? $data['localidad_legal'] : ''}}</label><br>
                        <label for="">Provincia: {{isset($data['provincia_legal']) ? $data['provincia_legal'] : ''}}</label><br>
                        <label for="">Teléfono: {{isset($data['telefono_legal']) ? $data['telefono_legal'] : ''}}</label><br>
                        <label for="">Correo electrónico: {{isset($data['email_legal']) ? $data['email_legal'] : ''}}</label><br>
                        <label for="">Representante legal: {{isset($data['representante_legal']['apellido_persona']) ? $data['representante_legal']['apellido_persona'] : '' }} {{ isset($data['representante_legal']['nombre_persona']) ? $data['representante_legal']['nombre_persona'] : '' }} </label><br>
                        <label for="">DNI: {{ isset($data['representante_legal']['dni_persona']) ? $data['representante_legal']['dni_persona'] : '' }} </label><br>

                    </td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Tipo de sociedad: {{isset($data['proveedor']['tipo_de_sociedad']) ? $data['proveedor']['tipo_de_sociedad'] : ''}}</label><br>
                        <label for="">Situación IVA: {{isset($data['proveedor']['situacion_iva']) ? $data['proveedor']['situacion_iva'] : ''}}</label><br>
                        <label for="">Nro Ingresos brutos {{isset($data['proveedor']['nro_ingresos_brutos']) ? $data['proveedor']['nro_ingresos_brutos'] : ''}}</label><br>
                        <label for="">Tipo contribuyente: {{isset($data['proveedor']['tipo_contribuyente']) ? $data['proveedor']['tipo_contribuyente'] : ''}}</label><br>
                    </td>
                    <td>
                        <label for="">Retención: {{ $data['proveedor']['retencion'] ? "Si" : "No" }} </label><br>
                        <label for="">Juridicción: {{isset($data['proveedor']['jurisdiccion']) ? $data['proveedor']['jurisdiccion'] : ''}}</label><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Nro habilitación municipal: {{isset($data['proveedor']['nro_habilitacion_municipal']) ? $data['proveedor']['nro_habilitacion_municipal'] : ''}}</label><br>
                        <label for="">Nro de Inscripción personas jurídicas: {{isset($data['proveedor']['nro_inscripcion_personas_juridicas']) ? $data['proveedor']['nro_inscripcion_personas_juridicas'] : ''}}</label><br>
                        <label for="">Registro público de comercio: {{isset($data['proveedor']['registro_publico_de_comercio']) ? $data['proveedor']['registro_publico_de_comercio'] : ''}}</label><br>
                        <label for="">Inspección general de justicia: {{isset($data['proveedor']['inspeccion_gral_justicia']) ? $data['proveedor']['inspeccion_gral_justicia'] : ''}}</label><br>
                        <label for="">Act principal: {{isset($data['actividad_principal']) ? $data['actividad_principal'] : ''}}</label><br>
                        <label for="">Act secundaria: {{isset($data['actividad_secundaria']) ? $data['actividad_secundaria'] : ''}}</label><br>
                    </td>
                    <td>
                        <label for="">Localidad habilitación {{isset($data['proveedor']['localidad_habilitacion']) ? $data['proveedor']['localidad_habilitacion'] : ''}}</label><br>
                        <label for="">Provincia inscrip personas jurídicas: {{isset($data['proveedor']['provincia_inscrip_personas_jur']) ? $data['proveedor']['provincia_inscrip_personas_jur'] : ''}}</label><br>
                        <label for="">Provincia registro público: {{isset($data['proveedor']['provincia_registro_publico']) ? $data['proveedor']['provincia_registro_publico'] : ''}}</label><br>
                        <label for="">Provincia inspección justicia: {{isset($data['proveedor']['provincia_inspeccion_justicia']) ? $data['proveedor']['provincia_inspeccion_justicia'] : ''}}</label><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td>
                        <label for="">Porcentaje facturación: {{isset($data['proveedor']['porc_facturacion']) ? $data['proveedor']['porc_facturacion'] : ''}}</label><br>
                        <label for="">Porcentaje gasto: {{isset($data['proveedor']['porc_gasto']) ? $data['proveedor']['porc_gasto'] : ''}}</label><br>
                        <label for="">Porcentaje mano de obra: {{isset($data['proveedor']['porc_mo']) ? $data['proveedor']['porc_mo'] : ''}}</label><br>
                        <label for="">Indice: {{"FALTA DEFINIR CAMPO"}}</label><br>
                    </td>
                    <td>
                        <label for="">Antiguedad en provincia: {{isset($data['proveedor']['antiguedad']) ? $data['proveedor']['antiguedad'] : ''}}</label><br>
                        <label for="">Domicilio fiscal en la provincia: {{isset($data['proveedor']['dom_fiscal']) ? $data['proveedor']['dom_fiscal'] : ''}}</label><br>
                        <label for="">Valor agregado:  {{$data['proveedor']['valor_agregado'] ? "Si" : "No" }} </label><br>
                        <label for="">Proveedor: {{"FALTA DEFINIR CAMPO"}} </label><br>
                    </td>
                </tr>
            </table>
            
            <br>
            <br>
            <br>

            <label for="">Rio Gallegos, </label>
            {{$date}}

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
