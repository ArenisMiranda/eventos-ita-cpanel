<?php

require_once "../../../../models/conexion.php";
require_once "../../../../controllers/cursos.controller.php";
require_once "../../../../models/cursos.models.php";
ob_start();


$clave = $_GET["folio"];
$id_persona = $_GET["persona"];
$datos_principales = ControlladorCursos::ctrPdfRegistro($clave, $id_persona);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta charset="UTF-8">
    <title>PASE DE REGISTRO</title>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }


        .texto {
            font-size: 12px;
            padding-left: 3px;
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
            margin: 0 40px 0 60px;
            display: block;
        }

        .encabezado {

            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 15px;

            /* display: block;
            margin-left: 55%;
            height: 7em;
            font-size: 12px; */
        }

        .cuerpo {

            font-size: 13px;
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
            width: 180px;
        }

        .img-logo {
            width: 100px;
        }

        .img-logoita {
            width: 75px;
        }

        .img-codigo {
            width: 100px;
            margin-left: 68%;
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
            font-size: 10px;
            text-align: right;
        }

        .nocontrol {
            display: block;
            margin-left: 50%;
            height: 0em;
            font-size: 14px;
            text-align: center;
        }

        /* .img-footer {
            width: 30px;
        } */
    </style>
</head>

<body>


    <div class="contenedor">
        <table class="header">
            <tr>
                <td><img class="img-logoita" src="../../administrador/pdf/img/logoita.png" alt=""></td>
                <td><img class="img-logo" src="../../administrador/pdf/img/tecnm.png" alt=""></td>
                <td><img class="img-sep move-derecha" src="../../administrador/pdf/img/sep.jpeg" alt=""></td>
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
            <p> <strong> PASE DE REGISTRO </strong> </p>
        </div>

        <div class="cuerpo">
            <p><strong>NOMBRE: <?php echo $datos_principales['nombre_completo']; ?> </strong></p>
            <p><strong>NO. CONTROL / RFC: <?php echo $datos_principales['numero_identificacion']; ?> </strong></p>
            <p><strong>LICENCIATURA: <?php echo $datos_principales['carrera']; ?> </strong></p>
            <p><strong>SEMESTRE: <?php if($datos_principales["semestre"] == 0) {
                                  echo 'NO APLICA';}
                                  else{
                                      echo $datos_principales["semestre"]; }
                                   ?> </p> </strong></p>
            <p><strong>EVENTO REGISTRADO:  <?php echo $datos_principales['nombre_curso']; ?>  </strong></p>
            <p><strong>FECHA Y HORA DE INICIO:  <?php echo formatoFechas($datos_principales['fecha_inicio']) . "  " . $datos_principales['hora_inicio']; ?> </strong></p>
            
            <div>
                <table class="tb2">
                    <tr>
                        <td>
                            <img class="img-codigo" src="../../administrador/pdf/img/codigo.png" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <p class="nocontrol"> <?php echo $datos_principales['numero_identificacion']; ?> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                         <p>  <hr> </p>
                        </td>
                    </tr>
                </table>

            </div>

            <div class="contenedor">
        <table class="header">
            <tr>
                <td><img class="img-logoita" src="../../administrador/pdf/img/logoita.png" alt=""></td>
                <td><img class="img-logo" src="../../administrador/pdf/img/tecnm.png" alt=""></td>
                <td><img class="img-sep move-derecha" src="../../administrador/pdf/img/sep.jpeg" alt=""></td>
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
            <p> <strong> PASE DE REGISTRO </strong> </p>
        </div>

        <div class="cuerpo">
            <p><strong>NOMBRE: <?php echo $datos_principales['nombre_completo']; ?> </strong></p>
            <p><strong>NO. CONTROL / RFC: <?php echo $datos_principales['numero_identificacion']; ?> </strong></p>
            <p><strong>LICENCIATURA: <?php echo $datos_principales['carrera']; ?> </strong></p>
            <p><strong>SEMESTRE: <?php if($datos_principales["semestre"] == 0) {
                                  echo 'NO APLICA';}
                                  else{
                                      echo $datos_principales["semestre"]; }
                                   ?> </p> </strong></p>
            <p><strong>EVENTO REGISTRADO:  <?php echo $datos_principales['nombre_curso']; ?>  </strong></p>
            <p><strong>FECHA Y HORA DE INICIO:  <?php echo formatoFechas($datos_principales['fecha_inicio']) . "  " . $datos_principales['hora_inicio']; ?> </strong></p>
            
            <div>
                <table class="tb2">
                    <tr>
                        <td>
                            <img class="img-codigo" src="../../administrador/pdf/img/codigo.png" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <p class="nocontrol"> <?php echo $datos_principales['numero_identificacion']; ?> </p>
                        </td>
                    </tr>
                    </div> 


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