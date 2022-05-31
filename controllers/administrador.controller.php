<?php

class ControlladorAdministrador
{

    public function ctrFormInicioAdministrador()
    {
        if (isset($_POST['ingresarAdmin'])) {

            $tabla = "usuarios";
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $respuesta = ModeloAdministrador::mdlInicioAdministrador($tabla, $usuario, $password);


            if (is_array($respuesta)) {
                if ($respuesta["usuario"] == $usuario && $respuesta["password"] == $password) {

                    $_SESSION['validarIngresoAdmin'] = "ok";

                    echo '<script> 
                     if(window.history.replaceState){
                         window.history.replaceState(null, null, window.location.href);
                     }

                     window.location = "menuAdministrador"

                 </script>';
                }
            } else {
                echo '<script> 
                 if(window.history.replaceState){
                     window.history.replaceState(null, null, window.location.href);
                 }
             </script>';
                echo "<script> Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'El usuario no existe.',
                    showConfirmButton: false,
                    timer: 1500
                  })  </script>";
                //echo '<script> window.location = "views/components/docente/inicio.php" </script>';

            }
        }
    }


    static public function ctrFormCursos()
    {
        if (isset($_POST['registrarCursos'])) {
            //PASAR TODO A MAYUSCULAS
            //ENCRIPTAR EL PASSWORD
            //VERIFICACION DEL PASSWORD

            if (
                !empty($_POST["nombreCurso"]) && !empty($_POST["instructor"]) && !empty($_POST["fechaInicio"])
                && !empty($_POST["fechaFin"]) && !empty($_POST["horaInicio"]) && !empty($_POST["horaFin"])
                && !empty($_POST["duracion"])  && !empty($_POST["tipoCurso"])  && !empty($_POST["capacidad"])
            ) {

                $tabla = "cursos";

                $nombreCurso = mb_strtoupper($_POST["nombreCurso"], 'utf-8');
            
                $instructor = mb_strtoupper($_POST["instructor"], 'utf-8');
                $fechaInicio = $_POST["fechaInicio"];
                $fechaFin = $_POST["fechaFin"];
                $horaInicio = $_POST["horaInicio"];
                $horaFin = $_POST["horaFin"];
                $duracion = $_POST["duracion"];
                $tipoCurso = mb_strtoupper($_POST["tipoCurso"], 'utf-8');
                $capacidad = $_POST["capacidad"];
                $disponible = $_POST["capacidad"];
                $imgtemporal = "public/img/imagen.PNG"; 

                $directorio = "public/img/";
                $nombreImagen = $_FILES['banner']['name'];
                $archivo = $directorio . basename($nombreImagen);
                $tipoImagen = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
               // $validacionImagen = getimagesize($_FILES['banner']['tmp_name']);


            
              

                if (!empty($nombreImagen)) {
                    $sizeImagen = $_FILES['banner']['size'];
                    if ($sizeImagen > 500000) {
                        return "2";
                        // echo "El documento es muy pesado, debe ser menor a 500kb";
                    } else {

                        if ($tipoImagen == 'jpg' ||  $tipoImagen == 'jpeg') {

                            if (move_uploaded_file($_FILES['banner']['tmp_name'], $archivo)) {
                                // echo "Se guardo el archivo";
                                $datos = array(
                                    "nombre_curso" => $nombreCurso,
                                    "instructor" => $instructor,
                                    "fecha_inicio" => $fechaInicio,
                                    "fecha_fin" => $fechaFin,
                                    "hora_inicio" => $horaInicio,
                                    "hora_fin" => $horaFin,
                                    "duracion" => $duracion,
                                    "tipo_curso" => $tipoCurso,
                                    "capacidad" => $capacidad,
                                    "banner" => $archivo,
                                    "asientos_disponibles" => $disponible
                                );
                
                                $respuesta = ModeloAdministrador::mdlRegistroCursos($tabla, $datos);
                
                                return $respuesta;
                            } else {
                                return "3";
                                // echo "error al subir";
                            }
                        } else {
                            return "4";
                            // echo "el archivo debe ser jpg o jpeg";
                        }
                    }
                }else if (empty($nombreImagen)){
                    $datos = array(
                        "nombre_curso" => $nombreCurso,
                        "instructor" => $instructor,
                        "fecha_inicio" => $fechaInicio,
                        "fecha_fin" => $fechaFin,
                        "hora_inicio" => $horaInicio,
                        "hora_fin" => $horaFin,
                        "duracion" => $duracion,
                        "tipo_curso" => $tipoCurso,
                        "capacidad" => $capacidad,
                        "banner" => $imgtemporal,
                        "asientos_disponibles" => $disponible
                    );
    
                    $respuesta = ModeloAdministrador::mdlRegistroCursos($tabla, $datos);
    
                    return $respuesta;
                }
                 else {
                    return "5";
                    // echo "El documento no es una imagen";
                }

            
            } else {
                return "1"; //rellenar todos los campos
            }
        }
    }

    static public function ctrListaCursos()
    {
        $tabla = "cursos";
        $respuesta = ModeloAdministrador::mdlListaCursos($tabla);
        return $respuesta;
    }

    static public function ctrCambiarEstatus($estatus, $clave)
    {
        $tabla = "cursos";
        $respuesta = ModeloAdministrador::mdlCambiarEstatus($tabla, $estatus, $clave);
        return $respuesta;
    }
    static public function ctrFormEditarCurso()
    {
        if (isset($_POST['editarCurso'])) {
            //PASAR TODO A MAYUSCULAS
            //ENCRIPTAR EL PASSWORD
            //VERIFICACION DEL PASSWORD

            if (
                !empty($_POST["nombreCursoEdit"]) && !empty($_POST["instructorEdit"]) && !empty($_POST["fechaInicioEdit"])
                && !empty($_POST["fechaFinEdit"]) && !empty($_POST["horaInicioEdit"]) && !empty($_POST["horaFinEdit"])
                && !empty($_POST["duracionEdit"])  && !empty($_POST["tipoCursoEdit"]) 
            ) {

                $tabla = "cursos";
                $clave = $_POST["idCurso"];

                $nombreCurso = mb_strtoupper($_POST["nombreCursoEdit"], 'utf-8');
                $instructor = mb_strtoupper($_POST["instructorEdit"], 'utf-8');
                $fechaInicio = $_POST["fechaInicioEdit"];
                $fechaFin = $_POST["fechaFinEdit"];
                $horaInicio = $_POST["horaInicioEdit"];
                $horaFin = $_POST["horaFinEdit"];
                $duracion = $_POST["duracionEdit"];
                $tipoCurso = mb_strtoupper($_POST["tipoCursoEdit"], 'utf-8');
                          
              
                $datos = array(
                    "nombre_curso" => $nombreCurso,
                    "instructor" => $instructor,
                    "fecha_inicio" => $fechaInicio,
                    "fecha_fin" => $fechaFin,
                    "hora_inicio" => $horaInicio,
                    "hora_fin" => $horaFin,
                    "duracion" => $duracion,
                    "tipo_curso" => $tipoCurso,
                      );

                $respuesta = ModeloAdministrador::mdlEditarCursos($tabla, $datos, $clave);

                return $respuesta;
            } else {
                return "1"; //rellenar todos los campos
            }
        }
    } 
    static public function ctrListasPdf($clave)
    {
        $tabla = "cursos";
        $respuesta = ModeloAdministrador::mdlListasPdf($tabla, $clave);

        return $respuesta;
    }
    static public function ctrListasPdf2($clave)
    {
        $tabla = "personas_registradas_cursos";
        $respuesta = ModeloAdministrador::mdlListasPdf2($tabla, $clave);

        return $respuesta;
    }
}
 
