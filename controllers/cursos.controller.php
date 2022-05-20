<?php

class ControlladorCursos
{
    static public function ctrTipoCursos($tipo)
    {
        $tabla = "cursos";
        $respuesta = ModeloCursos::mdlTipoCursos($tabla, $tipo);
        return $respuesta;
    }

   

    static public function ctrAltaCursosPersonas()
    {
        if (isset($_POST['registrarseACursoAlumno'])) {

            if (
                !empty($_POST["nombreCompleto"]) && !empty($_POST["correo"]) && !empty($_POST["noControl"])
                && !empty($_POST["carrera"]) && !empty($_POST["semestre"]) && !empty($_POST["idCurso"]) && !empty($_POST["sexo"])
            ) {

                $tabla = "personas_registradas_cursos";
                $tipo_persona = "ALUMNO";
                $tipo_id = "NOCONTROL";
                $nombreCompleto = mb_strtoupper($_POST["nombreCompleto"], 'utf-8');
                $correo = strtolower($_POST["correo"]);
                $identificacion = $_POST["noControl"];
                $carrera = mb_strtoupper($_POST["carrera"], 'utf-8');
                $semestre = $_POST["semestre"];
                $sexo = mb_strtoupper($_POST["sexo"], 'utf-8');
                $claveCurso = $_POST["idCurso"];

                                $datos = array(
                                    "nombre_completo" => $nombreCompleto,
                                    "tipo_persona" => $tipo_persona,
                                    "tipo_identificacion" => $tipo_id,
                                    "correo" => $correo,
                                    "numero_identificacion" => $identificacion,
                                    "carrera" => $carrera,
                                    "semestre" => $semestre,
                                    "sexo" => $sexo,
                                    "clave" => $claveCurso,
                                );
                
                                $respuesta = ModeloCursos::mdlRegistroACursosAlumnos($tabla, $datos);
                
                                return $respuesta;
                      

               
            } else {
                return "1"; //rellenar todos los campos
            }


        }else if(isset($_POST['registrarseACursoDocente'])){

            if (
                !empty($_POST["nombreCompletoDocente"]) && !empty($_POST["correoDocente"]) 
                && !empty($_POST["rfc"]) && !empty($_POST["sexoDocente"])
            ) {

                $tabla = "personas_registradas_cursos";
                $tipo_persona = "DOCENTE";
                $tipo_id = "RFC";

                $nombreCompleto = mb_strtoupper($_POST["nombreCompletoDocente"], 'utf-8');
                $correo = strtolower($_POST["correoDocente"]);
                $identificacion = mb_strtoupper($_POST["rfc"], 'utf-8');
                $sexo = mb_strtoupper($_POST["sexoDocente"], 'utf-8');
                $claveCurso = $_POST["idCurso"];

                                $datos = array(
                                    "nombre_completo" => $nombreCompleto,
                                    "tipo_persona" => $tipo_persona,
                                    "tipo_identificacion" => $tipo_id,
                                    "correo" => $correo,
                                    "numero_identificacion" => $identificacion,
                                    "sexo" => $sexo,
                                    "clave" => $claveCurso,
                                );
                
                                $respuesta = ModeloCursos::mdlRegistroACursosDocentes($tabla, $datos);        
                                return $respuesta;
            } else {
                return "1"; //rellenar todos los campos
            }

        }else if(isset($_POST['registrarseACursoExterno'])){

            if (
                !empty($_POST["nombreCompletoExterno"]) && !empty($_POST["correoExterno"]) 
                && !empty($_POST["rfc"]) && !empty($_POST["sexoExterno"])
            ) {

                $tabla = "personas_registradas_cursos";
                $tipo_persona = "EXTERNO";
                $tipo_id = "RFC";

                $nombreCompleto = mb_strtoupper($_POST["nombreCompletoExterno"], 'utf-8');
                $correo = strtolower($_POST["correoExterno"]);
                $identificacion = mb_strtoupper($_POST["rfc"], 'utf-8');
                $sexo = mb_strtoupper($_POST["sexoExterno"], 'utf-8');
                $claveCurso = $_POST["idCurso"];

                                $datos = array(
                                    "nombre_completo" => $nombreCompleto,
                                    "tipo_persona" => $tipo_persona,
                                    "tipo_identificacion" => $tipo_id,
                                    "correo" => $correo,
                                    "numero_identificacion" => $identificacion,
                                    "sexo" => $sexo,
                                    "clave" => $claveCurso,
                                );
                
                                $respuesta = ModeloCursos::mdlRegistroACursosExternos($tabla, $datos);        
                                return $respuesta;
            } else {
                return "1"; //rellenar todos los campos
            }

        }
        

    }


}
