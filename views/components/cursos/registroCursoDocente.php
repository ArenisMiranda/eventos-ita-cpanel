<?php
include "views/includes/navbar.php";
//1 -> SON ALUMNOS Y MIXTOS
$datos = ControlladorCursos::ctrTipoCursos('2')
?>

<main>
    <div class="container">
        <div class="row text-center">
            <p>Es necesario comentarte si te registras a uno de ellos tengas la certeza de tomarlo así como de concluirlo, esto es para no quitarle el espacio a alguien que si pueda hacerlo.</p>
        </div>
        <div class="row">
        <?php foreach ($datos as $visita => $value) : ?>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="card-a">
                    <div class="face face1">
                        <div class="content">
                            <div class="icon">
                                <img src=" <?php echo $value["banner"]; ?>" alt="<?php echo $value["nombre_curso"]; ?>" class="img-a" />
                            </div>
                        </div>
                    </div>
                    <div class="face face2">
                        <div class="content">
                            <h6 class="text-center">
                                <strong>
                                <?php echo $value["nombre_curso"]; ?>
                                </strong>
                            </h6>
                            <p>FECHA: <?php echo formatoFechas($value["fecha_inicio"]); ?></p>
                            <p><?php echo "HORA: ". $value["hora_inicio"] . " a ". $value["hora_fin"] . " hrs"  ?></p>
                           
                            <?php if ($value["asientos_disponibles"] == 0): ?>
                                    
                                    <p>CUPO LLENO</p>

                                    <?php else: ?>
                                    <p>LUGARES DISPONIBLES: <b><?php echo $value["asientos_disponibles"]; ?></b></p>
                                    <div class="col text-center mt-2">
                                    <a class="btn-a" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="<?php echo $value['nombre_curso'] . "/" .  $value['clave'] ?>">REGISTRARSE</a>
                                    </div>

                                    <?php endif ?>
                           
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>    

        
        </div>

</main>


<!-- Modal -->
<div class="modal fade" id="exampleModal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-5 py-5">
                    <form class="row g-3" action="" method="POST">
                        <div class="col-md-12">
                            <label for="inputNombre" class="form-label">Nombre completo:</label>
                            <input type="text" class="form-control" id="inputNombre" placeholder="Ej. Rodolfo Mena Rojas" name="nombreCompletoDocente" required>
                        </div>
                        <div class="col-12">
                            <label for="inputCorreo" class="form-label">Correo personal:</label>
                            <input type="email" class="form-control" id="inputCorreo" placeholder="Ej. l17320000@acapulco.tecnm.mx" name="correoDocente" required>
                        </div>
                        <div class="col-md-6">
                             <label for="inputSexo" class="form-label">Género:</label>
                             <select id="inputSexo" class="form-select" name="sexoDocente" required>
                            <option disabled hidden selected value="">Seleccione una opcion</option>
                                    <option value="MASCULINO">MASCULINO</option>
                                    <option value="FEMENINO">FEMENINO</option>
                                </select>
                        </div>
                        <div class="col-6">
                            <label for="inputCedula" class="form-label">RFC:</label>
                            <input type="text" class="form-control" id="inputCedula" placeholder="" name="rfc" minlength="13" maxlength="13" required>
                        </div>
                        <input type="hidden" name="idCurso" id="idCurso" value=""> 
                        <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar y regresar</button>
                    <input type="submit" class="btn btn-primary" name="registrarseACursoDocente" value="Registrarse en el curso">
                    </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>   



    <?php
    $respuesta = ControlladorCursos::ctrAltaCursosPersonas();
    echo '<script> 
                                         if(window.history.replaceState){
                                             window.history.replaceState(null, null, window.location.href);
                                         }
                                     </script>';
    echo $respuesta;

    ?>



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

?>




<script>


              

    var exampleModal = document.getElementById('exampleModal1')

    exampleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var recipient = button.getAttribute('data-bs-whatever')
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = document.getElementById('idCurso')

        var id = `${recipient.split("/")[1]}`
        var nombreCurso = `${recipient.split("/")[0]}`

        modalTitle.textContent = 'Inscripcion para el curso de: ' + nombreCurso
        modalBodyInput.value = id;
    })
</script>