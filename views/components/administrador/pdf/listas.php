<?php

use Sabberworm\CSS\Value\Value;

 require_once "../../../../models/conexion.php";
 require_once "../../../../controllers/administrador.controller.php";
 require_once "../../../../models/administrador.models.php";
ob_start();

 $clave = $_POST["clave-pdf"];

 $datos_principales = ControlladorAdministrador::ctrListasPdf($clave);
 $personas = ControlladorAdministrador::ctrListasPdf2($clave);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta charset="UTF-8">
    <title>LISTAS</title>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }


        .texto {
            font-size: 12px;
            padding-left: 5px;
        }

        .tb {
            border: 1px solid;
            border-collapse: collapse;
        }

        .tb-td {
            border: 1px solid;
            border-collapse: collapse;
        }

        .contenedor {
    
            margin: 0 60px 0 60px;
            display: block;
        }

        .encabezado {
    
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 16px;

            /* display: block;
            margin-left: 55%;
            height: 7em;
            font-size: 12px; */
        }

        .cuerpo {

            font-size: 11px;
        }

        .tb2 {
            /* border: 1px solid black; */
            width: 100%;
            border-collapse: collapse; 
        }

        .titulo {
            text-align: center;
        }

        .encargado {
            font-size: 10px;
        }

        .tb3 {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .tb-footer {
            width: 100%;
            /* border-collapse: collapse;
            font-size: 10px; */
            font-size: 10px;
            text-align: center;
        }

        .derecha {
            text-align: right;
        }

        .tb4 {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            /* font-size: 8px; */
        }

        .img-sep {
            width: 290px;
        }

        .img-logo {
            width: 120px;
        }
        .img-logoita {
            width: 100px;
        }

        .header {
            width: 100%;
            border-collapse: collapse;
        }

        .move-derecha {
            display: block;
            margin-left: 57px;
            /* margin-left: 50%; */
        }
        .frase {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 10px;
        }

        .tec {
            display: block;
            margin-left: 50%;
            height: 2em;
            font-size: 11px;
            text-align: right;
        }

        .img-footer {
            width: 30px;
        }
    </style>
</head>

<body>


    <div class="contenedor">
        <table class="header">
            <tr>
                <td><img class="img-logoita" src="img/logoita.png" alt=""></td>    
                <td><img class="img-logo" src="img/tecnm.png" alt=""></td>
                <td><img class="img-sep move-derecha" src="img/sep.jpeg" alt=""></td>
            </tr>
        </table>

        <div class="tec">
            <p><span style="font-size: 13px;">Instituto Tecnológico de Acapulco </span><br>Departamento de Gestión Tecnológica y Vinculación</p>
        </div>
        <table class="frase">
            <tr>
                <td>"2020, Año de Leona Vicario, Benemérita Madre de la Patria"</td>
            </tr>
        </table> 
        
        <div class="encabezado">
            <p> <strong> LISTA DE ASISTENTES </strong> </p>
            <p> Nombre del curso/conferencia:  <?php echo $datos_principales['nombre_curso']; ?>  </p>
        </div>

        <div class="cuerpo">
            <p><strong>Instructor: <?php echo $datos_principales['instructor']; ?></strong></p>
            <p><strong>Fecha y Hora de inicio: <?php echo formatoFechas($datos_principales['fecha_inicio'])."  ".$datos_principales['hora_inicio']; ?></strong></p>
            <p><strong>Fecha y Hora de terminación:  <?php echo formatoFechas($datos_principales['fecha_fin'])."  ".$datos_principales['hora_fin']; ?></strong></p>
            <p> <strong> Número de asistentes: <?php $asistentes = $datos_principales['capacidad'] - $datos_principales['asientos_disponibles']; echo $asistentes ?> </strong> </p>
            
             <div>
                <table class="tb2" border="1">
                    <tr>
                        <td class="titulo">
                            <strong>No.</strong>
                        </td>
                        <td class="titulo">
                            Nombre Completo
                        </td>
                        <td class="titulo">
                            Identificación
                        </td>
                        <td class="titulo">
                            Número de Identificación
                        </td>
                        <td class="titulo">
                            Licenciatura 
                        </td>
                        <td class="titulo">
                            Semestre
                        </td>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($personas as $persona => $value) : ?>
                        
                    <tr>
                    <td class="titulo">
                            <strong> <?php echo $i ?> </strong>
                        </td>
                        <td class="">
                            <p>
                              <?php echo $value["nombre_completo"] ?> </p>
                        </td>
                        <td class="">
                            <p>
                              <?php echo $value["tipo_persona"] ?> </p>
                        </td>
                        <td class="">
                            <p>
                              <?php echo $value["numero_identificacion"] ?> </p>
                        </td>
                        <td class="">
                            <p>
                              <?php echo $value["carrera"] ?> </p>
                        </td>
                        <td class="">
                            <p>
                              <?php if($value["semestre"] == "0") {
                                  echo 'NO APLICA';}
                                  else{
                                      echo $value["semestre"]; }
                                   ?> </p>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach ?>
                </table>
            </div>
    <br>
    <table class="tb-footer">
        <tr>
            <td>
                <img class="img-footer" src="img/logo1-f.png" alt="">
            </td>
            <td>
                <img class="img-footer" src="img/logo2-f.png" alt="">
            </td>
            <td>
                <img class="img-footer" src="img/logo3-f.png" alt="">
            </td>
            <td>
                <p>Av. Instituto Tecnológico s/n Crucero del Cayaco C.P. 39905 <br>
                    E-mail de contacto: vin_acapulco.tecnm@tecnm.mx <br>
                    Teléfonos: (744) 4429010 al 19 ext. 120 y 142 <br>
                    <b><u>www.it-acapulco.edu.mx</u></b>
                </p>
            </td>
            <td>
                <img class="img-footer" src="img/logo4-f.jpg" alt="">
            </td>
            <td>
                <img class="img-footer" src="img/logo5-f.png" alt="">
            </td>
            <td>
                <img class="img-footer" src="img/logo6-f.png" alt="">
            </td>
        </tr>
    </table>

</body>

</html>


<?php
function formatoFechas($fecha)
{

    $dia = date("d", strtotime($fecha));
    $mes = date("m", strtotime($fecha));
    $anio = date("Y", strtotime($fecha));
    $mes2 = "";

    switch ($mes) {
        case '01':
            $mes2 = "ENE";
            break;
        case '02':
            $mes2 = "FEB";
            break;
        case '03':
            $mes2 = "MAR";
            break;
        case '04':
            $mes2 = "ABR";
            break;
        case '05':
            $mes2 = "MAY";
            break;
        case '06':
            $mes2 = "JUN";
            break;
        case '07':
            $mes2 = "JUL";
            break;
        case '08':
            $mes2 = "AGO";
            break;
        case '09':
            $mes2 = "SEP";
            break;
        case '10':
            $mes2 = "OCT";
            break;
        case '11':
            $mes2 = "NOV";
            break;
        case '12':
            $mes2 = "DIC";
            break;
    }

    $fechaFormateada = $dia . "/" . $mes2 . "/" . $anio;


    return $fechaFormateada;
}

require_once "../../../libs/libreria/dompdf/autoload.inc.php";

use Dompdf\Dompdf;


$dompdf = new Dompdf();

$html = ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'portrait');
$dompdf->setPaper("letter");

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('LISTAS.pdf', ['Attachment' => false]);
?>