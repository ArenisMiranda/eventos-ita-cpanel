<?php
include "views/includes/navbar.php";
//3 -> SON externos Y MIXTOS
$datos = ControlladorCursos::ctrTipoCursos('3');

$respuesta = ControlladorCursos::ctrAltaCursosPersonasGeneral();


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
                                      title: 'Se ha registrado satisfactoriamente, revisa tu correo o el SPAM para descargar el pase.',
                                      showConfirmButton: false,
                                      timer: 5000
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
                                    </script>
                                  ";
         break;

     case "registrado":
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
                                      title: 'Ya esta registrado.',
                                      showConfirmButton: false,
                                      timer: 1500
                                    }) 
                                    </script>
                                  ";
         break;
 }

?>

<main>

    <div class="container">
        <div class="row text-center">
            <p>Es necesario comentarte si te registras a uno de ellos tengas la certeza de tomarlo as?? como de concluirlo, esto es para no quitarle el espacio a alguien que si pueda hacerlo.</p>
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
                            <div class="content" style="font-size: 14px;">
                                <h6 class="text-center">
                                    <strong>
                                        <?php echo $value["nombre_curso"]; ?>
                                    </strong>
                                </h6>
                                <p>FECHA: <?php echo formatoFechas($value["fecha_inicio"]); ?></p>
                                <p><?php echo "HORA: " . $value["hora_inicio"] . " a " . $value["hora_fin"] . " hrs"  ?></p>

                                <?php if ($value["asientos_disponibles"] == 0) : ?>

                                    <p>CUPO LLENO</p>

                                <?php else : ?>
                                    <p>LUGARES DISPONIBLES: <b><?php echo $value["asientos_disponibles"]; ?></b></p>
                                    <div class="col text-center mt-2">
                                        <a class="btn-a" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="<?php echo $value['nombre_curso'] . "/" .  $value['clave'] ?>">SI QUIERO REGISTRARME</a>
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
<div class="modal fade" id="exampleModal3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <input type="text" class="form-control" id="inputNombre" placeholder="Ej. Arenis Miranda" name="nombreCompletoExterno" required>
                        </div>
                        <div class="col-12">
                            <label for="inputCorreo" class="form-label">Correo:</label>
                            <input type="email" class="form-control" id="inputCorreo" placeholder="Ej. l17320000@acapulco.tecnm.mx" name="correoExterno" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputSexo" class="form-label">G??nero:</label>
                            <select id="inputSexo" class="form-select" name="sexoExterno" required>
                                <option disabled hidden selected value="">Seleccione una opcion</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMENINO">FEMENINO</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="inputCurp" class="form-label">RFC:</label>
                            <input type="text" class="form-control" id="inputCurp" placeholder="" name="rfc" minlength="13" maxlength="13" required>
                        </div>
                        <input type="hidden" name="idCurso" id="idCurso" value="">
                        <div class="modal-footer">
                            <button  type="submit" class="btn btn-success" name="registrarseACursoExterno">Registrarse</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



   
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
        var exampleModal = document.getElementById('exampleModal3')

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