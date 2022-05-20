<?php

if(!isset( $_SESSION['validarIngresoAdmin'])){
         echo '<script> 
                     window.location = "loginAdministrador"
                 </script>';
         return;
}else {
    if($_SESSION['validarIngresoAdmin'] != "ok"){
        echo '<script> 
                     window.location = "loginAdministrador"
                </script>';
         return;
    }
}

?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
        include "views/components/administrador/navbarAdministrador.php"
    ?>
</nav>


<h1>
    Hola administrador
</h1>





<main>
    
</main>