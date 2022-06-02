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
    include "views/components/administrador/navbarAdministrador.php";
    $datos = ControlladorAdministrador::ctrListaCursos();
    ?>
</nav>

<main>
    <h1 class="text-center mt-3 mb-"> LISTA DE EVENTOS</h1>

    <div class="container-fluid px-1 text-center">
        <div class="table-responsive">
            <table class="table align-middle table-bordered border-dark">
                <thead class="text-center align-middle">
                    <tr class="text-center align-middle table-responsive-sm">
                        <th class="text-center align-middle">Clave</th>
                        <th class="text-center align-middle">Curso</th>
                        <th class="text-center align-middle">Instructor</th>
                        <th class="text-center align-middle">Fecha de inicio y fin</th>
                        <th class="text-center align-middle">Hora de inicio y fin</th>
                        <th class="text-center align-middle">Duracion</th>
                        <th class="text-center align-middle">Tipo de curso</th>
                        <th class="text-center align-middle">Capacidad</th>
                        <!-- <th class="text-center align-middle">Disponibles</th> -->
                        <th class="text-center align-middle">Personas Inscritas</th>
                        <th class="text-center align-middle">Flyer</th>
                        <th class="text-center align-middle">Estatus</th>
                        <th class="text-center align-middle">Acciones </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $visita => $value) : ?>

                        <tr>
                            <th><?php echo "TECNM/" . $value["clave"]; ?></th>
                            <td><?php echo $value["nombre_curso"]; ?></td>
                            <td><?php echo $value["instructor"]; ?></td>
                            <td><?php echo "Inicia el: " . formatoFechas($value["fecha_inicio"]);
                                echo '<br>';
                                echo "Finaliza el: " . formatoFechas($value["fecha_fin"]); ?></td>
                            <td><?php echo "Inicia a las: " . $value["hora_inicio"];
                                echo '<br>';
                                echo "Finaliza a las: " . $value["hora_fin"]; ?></td>
                            <td><?php echo $value["duracion"] . " hrs"; ?></td>
                            <td><?php echo $value["tipo_curso"]; ?></td>
                            <td><?php echo $value["capacidad"]; ?></td>
                            <td><?php echo $value["capacidad"]-  $value["asientos_disponibles"]; ?></td>
                            <td> <img class="img-tabla" src="<?php echo $value["banner"]?>" alt="flyer" width="50%" height="50%"> </td>
                            <td><?php
                                $estatus = $value["estatus"];
                                $resultado = $estatus == 0 ? 'ACTIVO' : 'CERRADO';
                                echo $resultado; ?></td>

                            <td>
                                <div class="btn-group d-grid gap-2 d-md-flex justify-content-md-between">
                                    <?php
                                    if ($value["estatus"] == 0) { ?>
                                        <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar estatus a CERRADO" onclick="cambiarEstatus(<?php echo $value['estatus']; ?> , <?php echo $value['clave']; ?>)"><i class="bi bi-check-circle-fill"></i></button>

                                    <?php } else { ?>
                                        <button class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar estatus a ACTIVO" onclick="cambiarEstatus(<?php echo $value['estatus']; ?> , <?php echo $value['clave']; ?>)"><i class="bi bi-x-circle-fill"></i></button>
                                    <?php  }
                                    ?>
                                    <!-- <button class="btn btn-secondary" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#exampleModallista" title="Modificar datos" data-bs-whatever="<?php echo $value['nombre_curso'] . "/" .  $value['clave'] ?>"><i class="bi bi-pencil-fill"></i></button> -->
                                
                                    
                                    <a href="eliminar.php" class="btn btn-danger"  title="eliminar"> <i class="bi bi-trash-fill"></i> </a>
                                                             

                                    <form action="views/components/administrador/pdf/listas.php" method="post" target="_blank">

                                    
                                        <input type="hidden" name="clave-pdf" value="<?php echo $value["clave"]; ?>">

                                        <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar listas"><i class="bi bi-download"></i></button>

                                    </form>

                                </div>
                            </td>
                        </tr>
                        <input type="hidden" name="estatus" id="estatus" value="<?php echo $value["estatus"]; ?>">
                        <input type="hidden" name="clave" id="clave" value="<?php echo $value["clave"]; ?>">
                        <!-- <div class="modal fade" id="exampleModallista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      <div class="modal-body">
      <div class="container-fluid px-5 py-5">
                    <form class="row g-3" action="" method="POST">
                    <div class="col-6">
                    <label for="inputNombrCurso" class="form-label">Nombre del evento:</label>
                    <input type="text" class="form-control" id="inputNombrCurso" value="<?php echo $value["nombre_curso"]; ?>" name="nombreCursoEdit" required>
                </div>
                <div class="col-6">
                    <label for="inputInstructor" class="form-label">Nombre del instructor: </label>
                    <input type="text" class="form-control" id="inputInstructor" name="instructorEdit" value="<?php echo $value["instructor"]; ?>" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="inputFechaInicio">Fecha de inicio del curso:</label>
                    <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputFechaInicio" name="fechaInicioEdit" type="date" value="<?php echo $value["fecha_incio"]; ?>" min="2022-01-01" required />
                </div>
                <div class="col-6">
                    <label class="form-label" for="inputFechaFin">Fecha de fin del curso:</label>
                    <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputFechaFin" name="fechaFinEdit" type="date" value="<?php echo $value["fecha_fin"]; ?>" min="2022-01-01" required />
                </div>
                <div class="col-6">
                    <label class="form-label" for="inputHoraInicio">Hora de inicio del curso:</label>
                    <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputHoraInicio" name="horaInicioEdit" type="time" value="<?php echo $value["hora_inicio"]; ?>" required />
                </div>
                <div class="col-6">
                    <label class="form-label" for="inputHoraFin">Hora de fin del curso:</label>
                    <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputHoraFin" name="horaFinEdit" type="time" value="<?php echo $value["hora_fin"]; ?>" required />
                </div>
                <div class="col-4">
                    <label class="form-label" for="inputDuracion">Duracion:</label>
                    <input type="number" class="form-control" id="inputDuracion" name="duracionEdit" placeholder="20" value="<?php echo $value["duracion"]; ?>" required>
                </div>
                <div class="col-md-8">
                    <label for="inputDirigido" class="form-label"> ¿Pará quién se imparte el curso?:</label>
                    <select id="inputDirigido" class="form-select" name="tipoCursoEdit" required>
                        <option disabled hidden selected value="<?php echo $value["tipo_curso"]; ?>"> <?php echo $value["tipo_curso"]; ?></option>
                        <option value="ALUMNOS"> Alumnos</option>
                        <option value="DOCENTES"> Docentes </option>
                        <option value="EXTERNOS"> Personas externas</option>
                        <option value="MIXTO"> Mixto</option>
                    </select>
                </div>
                        <input type="hidden" name="idCurso" id="idCurso" value=""> 
                        <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar y regresar</button>
                    <input type="submit" class="btn btn-primary" name="editarCurso" value="Modificar datos del curso">
                    </div>
                    </form>
                </div>
      </div>
      </div>
  </div>
</div> -->
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<div class="modal fade" id="exampleModallista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-5 py-5">
                    <form class="row g-3" action="" method="POST">
                        <div class="col-6">
                            <label for="inputNombrCurso" class="form-label">Nombre del evento:</label>
                            <input type="text" class="form-control" id="inputNombrCurso" name="nombreCursoEdit" required>
                        </div>
                        <div class="col-6">
                            <label for="inputInstructor" class="form-label">Nombre del instructor: </label>
                            <input type="text" class="form-control" id="inputInstructor" name="instructorEdit" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="inputFechaInicio">Fecha de inicio del curso:</label>
                            <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputFechaInicio" name="fechaInicioEdit" type="date" value="" min="2022-01-01" required />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="inputFechaFin">Fecha de fin del curso:</label>
                            <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputFechaFin" name="fechaFinEdit" type="date" value="" min="2022-01-01" required />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="inputHoraInicio">Hora de inicio del curso:</label>
                            <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputHoraInicio" name="horaInicioEdit" type="time" value="" required />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="inputHoraFin">Hora de fin del curso:</label>
                            <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputHoraFin" name="horaFinEdit" type="time" value="" required />
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="inputDuracion">Duracion:</label>
                            <input type="number" class="form-control" id="inputDuracion" name="duracionEdit" placeholder="20" required>
                        </div>
                        <div class="col-md-8">
                            <label for="inputDirigido" class="form-label"> ¿Pará quién se imparte el curso?:</label>
                            <select id="inputDirigido" class="form-select" name="tipoCursoEdit" required>
                                <option disabled hidden selected value="">Seleccione una opcion</option>
                                <option value="ALUMNOS"> Alumnos</option>
                                <option value="DOCENTES"> Docentes </option>
                                <option value="EXTERNOS"> Personas externas</option>
                                <option value="MIXTO"> Mixto</option>
                            </select>
                        </div>
                        <input type="hidden" name="idCurso" id="idCurso" value="">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar y regresar</button>
                            <input type="submit" class="btn btn-primary" name="editarCurso" value="Modificar datos del curso">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$respuesta = ControlladorAdministrador::ctrFormEditarCurso();
switch ($respuesta) {

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
                                     title: 'Se ha registrado satisfactoriamente. Favor de revisar su correo.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   });

                                   setTimeout(function(){
                                    window.location.reload();
                                }, 2300);
                                   
                                   </script>
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
                                     title: 'Error al ingresar datos.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   }) 
                                   setTimeout(function(){
                                    window.location.reload();
                                }, 2300);
                                   </script>
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
                                         title: 'Favor de rellenar todos los campos.',
                                         showConfirmButton: false,
                                         timer: 1500
                                       }) 
                                       setTimeout(function(){
                                        window.location.reload();
                                    }, 2300);
                                       </script>
                                     ";
        break;
}


?>

<script type="text/javascript">
    function cambiarEstatus(estatus1, clave1) {
        let estatus = document.getElementById("estatus").value;
        let clave = document.getElementById("clave").value;
        var parametros = {
            "estatus": estatus1,
            "clave": clave1
        };
        $.ajax({
            data: parametros,
            type: 'POST',
            url: 'views/components/administrador/ajax/actualizarEstatusCurso.php',
            success: function(data) {
                // console.log(data)

                if (data == 'ok') {
                    window.location = "listaCursos"
                }

                //document.getElementById("importar").innerHTML = data;
                //$('#tabla_cursos').load('views/components/administrador/listaCursos.php thead')
                //alert(data);
            }
        });
    }
</script>


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
    var exampleModal = document.getElementById('exampleModallista')

    exampleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var recipient = button.getAttribute('data-bs-whatever')
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = document.getElementById('idCurso')

        var id = `${recipient.split("/")[1]}`
        var nombreCurso = `${recipient.split("/")[0]}`

        modalTitle.textContent = 'Modificar datos del curso: ' + nombreCurso
        modalBodyInput.value = id;
    })
</script>