<?php
session_start();
include "views/includes/header.php"
?>

<main>
    <?php
    if (isset($_GET["pagina"])) {
        if ( //menu alumno
            $_GET["pagina"] == "registroCurso" ||
            $_GET["pagina"] == "registroCursoAlumno" ||
            $_GET["pagina"] == "registroCursoDocente" ||
            $_GET["pagina"] == "xx"
        ) {
            include "views/components/cursos/" . $_GET["pagina"] . ".php";
            
        } else if ( //menu administrador
            $_GET["pagina"] == "loginAdministrador" ||
            $_GET["pagina"] == "menuAdministrador" ||
            $_GET["pagina"] == "salirAdministrador" ||
            $_GET["pagina"] == "altaCursos" ||
            $_GET["pagina"] == "listaCursos"
        ) {
            include "views/components/administrador/" . $_GET["pagina"] . ".php";

        }else if ($_GET["pagina"] == "inicio") {
            include "views/includes/" . $_GET["pagina"] . ".php";

        }
        else {

            include "views/includes/error.php";
        }
    } else {
        include "views/includes/inicio.php";
    }
    ?>
</main>


<?php
include "views/includes/footer.php";
?>