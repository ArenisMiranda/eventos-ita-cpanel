<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '/home4/conveni2/public_html/eventos3/views/libs/libreria/PHPmailer/src/PHPMailer.php';
require '/home4/conveni2/public_html/eventos3/views/libs/libreria/PHPmailer/src/SMTP.php';
require '/home4/conveni2/public_html/eventos3/views/libs/libreria/PHPmailer/src/Exception.php';

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
                $semestre = mb_strtoupper( $_POST["semestre"], 'utf-8' );
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
                                // $imprimir = "<script>window.open('views/components/cursos/registropdf/confirmacion.php?folio=$claveCurso&persona=$identificacion', '_blank')</script>";
                                $cuerpo = 
                                'HOLA, BUEN DÍA '.$nombreCompleto.'. <br>
                                Te informamos que tu registro fue un ÉXITO, corrobora la información que proporcionaste: <br>
                                    Carrera: '.$carrera.'<br>
                                    Semestre: '.$semestre.' <br>
                                    Correo: '.$correo.'<br>
                                DESCARGA E IMPRIME TU PASE DE REGISTRO DEL EVENTO/CONFERENCIA QUE TE REGISTRASTE en la siguiente liga --> <a href="http://mx64.prueba.site/~conveni2/eventos3/views/components/cursos/registropdf/confirmacion.php?folio='.$claveCurso.'&persona='.$identificacion.'" target="_blank">PASE DE REGISTRO</a>, DEBERÁS PRESENTARLO, DE LO CONTRARIO NO PODRÁS ACCESAR AL EVENTO.';
                                
                              
                            
                            
                            $mail = new PHPMailer(true);
                            
                            try {
                                
                                $mail->isSMTP();
                                $mail->Host = 'smtp.office365.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'victormtzma@outlook.com';
                                $mail->Password = 'martinez_13';
                                $mail->SMTPSecure = 'tls';
                                $mail->Port = 587;
                            
                                $mail->setFrom('victormtzma@outlook.com', 'DEPARTAMENTO DE GESTIÓN TECNOLOGIA Y VINCULACIÓN');
                                $mail->addAddress($correo);
                                // $mail->addCC();  ->> si se quiere enviar una copia
                            
                                $mail->isHTML(true);
                                $mail->Subject = 'Eventos y Conferencias';
                                $mail->Body = $cuerpo;
                                $mail->CharSet = 'UTF-8';
                                $mail->send();
                            } catch (Exception $e) {
                                echo $e;
                            }
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
                                // $imprimir = "<script>window.open('views/components/cursos/registropdf/confirmacion.php?folio=$claveCurso&persona=$identificacion', '_blank')</script>";
                                $cuerpo = 
                                'HOLA, BUEN DÍA '.$nombreCompleto.'. <br>
                                Te informamos que tu registro fue un ÉXITO, corrobora la información que proporcionaste: <br>
                                    Correo: '.$correo.'<br>
                                    RFC: '.$identificacion.' <br>
                                DESCARGA E IMPRIME TU PASE DE REGISTRO DEL EVENTO/CONFERENCIA QUE TE REGISTRASTE en la siguiente liga --> <a href="http://mx64.prueba.site/~conveni2/eventos3/views/components/cursos/registropdf/confirmacion.php?folio='.$claveCurso.'&persona='.$identificacion.'" target="_blank">PASE DE REGISTRO</a>, DEBERÁS PRESENTARLO, DE LO CONTRARIO NO PODRÁS ACCESAR AL EVENTO.';
                                
                              
                            
                            
                            $mail = new PHPMailer(true);
                            
                            try {
                                
                                $mail->isSMTP();
                                $mail->Host = 'smtp.office365.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'victormtzma@outlook.com';
                                $mail->Password = 'martinez_13';
                                $mail->SMTPSecure = 'tls';
                                $mail->Port = 587;
                            
                                $mail->setFrom('victormtzma@outlook.com', 'DEPARTAMENTO DE GESTIÓN TECNOLOGIA Y VINCULACIÓN');
                                $mail->addAddress($correo);
                                // $mail->addCC();  ->> si se quiere enviar una copia
                            
                                $mail->isHTML(true);
                                $mail->Subject = 'Eventos y Conferencias';
                                $mail->Body = $cuerpo;
                                $mail->CharSet = 'UTF-8';
                                $mail->send();
                            } catch (Exception $e) {
                                echo $e;
                            }
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
                                // $imprimir = header ("Location: views/components/cursos/registropdf/confirmacion.php?folio=$claveCurso&persona=$identificacion");
                                // return $imprimir;
                                $cuerpo = 
                                'HOLA, BUEN DÍA '.$nombreCompleto.'. <br>
                                Te informamos que tu registro fue un ÉXITO, corrobora la información que proporcionaste: <br>
                                    Correo: '.$correo.'<br>
                                    RFC: '.$identificacion.' <br>
                                DESCARGA E IMPRIME TU PASE DE REGISTRO DEL EVENTO/CONFERENCIA QUE TE REGISTRASTE en la siguiente liga --> <a href="http://mx64.prueba.site/~conveni2/eventos3/views/components/cursos/registropdf/confirmacion.php?folio='.$claveCurso.'&persona='.$identificacion.'" target="_blank">PASE DE REGISTRO</a>, DEBERÁS PRESENTARLO, DE LO CONTRARIO NO PODRÁS ACCESAR AL EVENTO.';
                                
                              
                            
                            
                            $mail = new PHPMailer(true);
                            
                            try {
                                
                                $mail->isSMTP();
                                $mail->Host = 'smtp.office365.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'victormtzma@outlook.com';
                                $mail->Password = 'martinez_13';
                                $mail->SMTPSecure = 'tls';
                                $mail->Port = 587;
                            
                                $mail->setFrom('victormtzma@outlook.com', 'DEPARTAMENTO DE GESTIÓN TECNOLOGIA Y VINCULACIÓN');
                                $mail->addAddress($correo);
                                // $mail->addCC();  ->> si se quiere enviar una copia
                            
                                $mail->isHTML(true);
                                $mail->Subject = 'Eventos y Conferencias';
                                $mail->Body = $cuerpo;
                                $mail->CharSet = 'UTF-8';
                                $mail->send();
                            } catch (Exception $e) {
                                echo $e;
                            }
                                return $respuesta;
                      
            } else {
                return "1"; //rellenar todos los campos
            }

        }
        

    }
    static public function ctrPdfRegistro($clave, $id)
    {

        $respuesta = ModeloCursos::mdlRegistroPdf($clave, $id);
        return $respuesta;
    }

}
