<?php
//$_SESSION['validarIngresoAdmin'] = "ok";

require_once "../../../../models/conexion.php";
require_once "../../../../controllers/administrador.controller.php";
require_once "../../../../models/administrador.models.php";

$respuesta = ControlladorAdministrador::ctrCambiarEstatus($_POST["estatus"], $_POST["clave"]);

//echo'<pre>'; print_r($respuesta); echo '</pre>';
//echo'<pre>'; print_r($_POST["estatus"]); echo '</pre>';
//echo'<pre>'; print_r($_POST["clave"]); echo '</pre>';

 if($respuesta == 'exito'){
    echo 'ok';
 }
?>