<?php

if (!isset($_SESSION['validarIngresoAdmin'])) {
    echo '<script> 
                     window.location = "loginAdministrador"
                 </script>';
    return;
} else {
    if ($_SESSION['validarIngresoAdmin'] != "ok") {
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

<main>
    <h1>Registro de curso</h1>

    <div class="container-fluid px-5">
        <div class="container-fluid p-5">
            <form class="row g-3" action="" method="POST" enctype="multipart/form-data">

                <h2>Datos del curso</h2>
                <!-- <input type="hidden" name="idCurso" value="<?php //echo $_SESSION['idDocente']; 
                                                                ?>"> -->
                <div class="col-6">
                    <label for="inputNombrCurso" class="form-label">Nombre del evento:</label>
                    <input type="text" class="form-control" id="inputNombrCurso" name="nombreCurso" required>
                </div>
                <div class="col-6">
                    <label for="inputInstructor" class="form-label">Nombre del instructor: </label>
                    <input type="text" class="form-control" id="inputInstructor" name="instructor" required>
                </div>
                <div class="col-3">
                    <label class="form-label" for="inputFechaInicio">Fecha de inicio del curso:</label>
                    <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputFechaInicio" name="fechaInicio" type="date" value="" min="2022-01-01" required />
                </div>
                <div class="col-3">
                    <label class="form-label" for="inputFechaFin">Fecha de fin del curso:</label>
                    <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputFechaFin" name="fechaFin" type="date" value="" min="2022-01-01" required />
                </div>
                <div class="col-3">
                    <label class="form-label" for="inputHoraInicio">Hora de inicio del curso:</label>
                    <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputHoraInicio" name="horaInicio" type="time" value="" required />
                </div>
                <div class="col-3">
                    <label class="form-label" for="inputHoraFin">Hora de fin del curso:</label>
                    <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputHoraFin" name="horaFin" type="time" value="" required />
                </div>
                <div class="col-1">
                    <label class="form-label" for="inputDuracion">Duracion:</label>
                    <input type="number" class="form-control" id="inputDuracion" name="duracion" placeholder="20" required>
                </div>
                <div class="col-md-3">
                    <label for="inputDirigido" class="form-label"> ¿Pará quién se imparte el curso?:</label>
                    <select id="inputDirigido" class="form-select" name="tipoCurso" required>
                        <option disabled hidden selected value="">Seleccione una opcion</option>
                        <option value="ALUMNOS"> Alumnos</option>
                        <option value="DOCENTES"> Docentes </option>
                        <option value="EXTERNOS"> Personas externas</option>
                        <option value="MIXTO"> Mixto</option>
                    </select>
                </div>
                <div class="col-3">
                    <label class="form-label" for="inputCapacidad">Capacidad:</label>
                    <input type="number" class="form-control" id="inputCapacidad" name="capacidad" min="10" max="400" maxlength="2" placeholder="20" required>
                </div>
                <div class="col-5">
                    <label for="formFile" class="form-label">Imagen / Banner.</label>
                    <input class="form-control" type="file" id="formFile" name="banner">
                </div>
                <?php


                $result = ControlladorAdministrador::ctrFormCursos();


                switch ($result) {

                    case "exito":
                        echo '<script> 
                if(window.history.replaceState){
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>';
                        echo "
                        <script> 
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'El curso se registro satisfactoriamente.',
                            showConfirmButton: false,
                            timer: 1500
                          }) </script>
                        ";
                        break;

                    case "error":
                        echo '<script> 
                if(window.history.replaceState){
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>';
                        echo "
            <script> 
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Ha ocurrido un error.',
                showConfirmButton: false,
                timer: 1500
              }) </script>
            ";
                        break;

                    case "1":
                        echo '<script> 
                if(window.history.replaceState){
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>';

                        echo "
                        <script> 
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error al ingresar datos.',
                            showConfirmButton: false,
                            timer: 1500
                          }) </script>
                        ";
                        break;
                    case "2":
                        echo '<script> 
                    if(window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>';
                        echo "
                        <script> 
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'La imagen es muy pesada, debe ser menor a 500kb',
                            showConfirmButton: false,
                            timer: 1500
                          }) </script>
                        ";
                        break;
                    case "3":
                        echo '<script> 
                        if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>';
                        echo "
                        <script> 
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error al subir la imagen.',
                            showConfirmButton: false,
                            timer: 1500
                          }) </script>
                        ";
                        break;
                    case "4":
                        echo '<script> 
                    if(window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>';

                        echo "
                        <script> 
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'El archivo debe ser formato jpg o jpeg.',
                            showConfirmButton: false,
                            timer: 1500
                          }) </script>
                        ";
                        break;
                    case "5":
                        echo '<script> 
                        if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>';

                        echo "
                        <script> 
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: ' El archivo que ha seleccionado no es una imagen.',
                            showConfirmButton: false,
                            timer: 1500
                          }) </script>
                        ";
                        break;
                }


                ?>
                <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                    <a class="btn btn-danger" href="menuAdministrador" role="button">Cancelar y regresar</a>
                    <input type="submit" class="btn btn-primary btn-block" name="registrarCursos" value="Dar de alta el curso">
                </div>
            </form>
        </div>

</main>