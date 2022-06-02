<?php

require_once "conexion.php";

class ModeloAdministrador{

    static public function mdlInicioAdministrador($tabla, $usuario, $password){
        //0 -> false -> usuario activo
        //1 -> true -> usuario inactivo
        try {
            $stmt = Database::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = :usuario and password = :password and estatus = 'ALTA'");
    
             $stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
             $stmt->bindParam(":password", $password, PDO::PARAM_STR);
     
             $stmt->execute();
    
            return  $stmt-> fetch();

        }catch(Exception $e) {
            return "error"; 
        } finally{
            $stmt->closeCursor();
            $stmt = null;
        }
    }

    static public function mdlRegistroCursos($tabla, $datos)
    {


        try {
            $stmt = Database::conectar()->prepare("INSERT INTO $tabla(nombre_curso, instructor, fecha_inicio, fecha_fin, hora_inicio, hora_fin, duracion, tipo_curso, capacidad, asientos_disponibles, banner) VALUES (:nombre_curso, :instructor, :fecha_inicio, :fecha_fin, :hora_inicio, :hora_fin, :duracion, :tipo_curso, :capacidad, :asientos_disponibles, :banner)");

            $stmt->bindParam(":nombre_curso", $datos["nombre_curso"], PDO::PARAM_STR);
            $stmt->bindParam(":instructor", $datos["instructor"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":hora_inicio", $datos["hora_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":hora_fin", $datos["hora_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":duracion", $datos["duracion"], PDO::PARAM_INT);
            $stmt->bindParam(":tipo_curso", $datos["tipo_curso"], PDO::PARAM_STR);
            $stmt->bindParam(":capacidad", $datos["capacidad"], PDO::PARAM_INT);
            $stmt->bindParam(":asientos_disponibles", $datos["asientos_disponibles"], PDO::PARAM_INT);
            $stmt->bindParam(":banner", $datos["banner"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "exito";
            } else {
                //print_r(DB::conectar()->errorInfo());
                return "error";
            }
        } catch (Exception $e) {
            return "error";
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }

    static public function mdlListaCursos($tabla)
    {
        try {

            $stmt = Database::conectar()->prepare("SELECT * FROM $tabla WHERE eliminar = 'NO' ORDER BY clave DESC");
            // $stmt->bindParam(":id_docente", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetchAll();
        } catch (Exception $e) {
            return "error";
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }


    static public function mdlCambiarEstatus($tabla, $estatus, $clave)
    {
        try {

            if($estatus == 0){
                $stmt = Database::conectar()->prepare("UPDATE $tabla SET estatus = 1 WHERE clave = :clave");
                $stmt->bindParam(":clave", $clave, PDO::PARAM_INT);
            }else {
                $stmt = Database::conectar()->prepare("UPDATE $tabla SET estatus = 0 WHERE clave = :clave");
                $stmt->bindParam(":clave", $clave, PDO::PARAM_INT);
            }

            if ($stmt->execute()) {
                return "exito";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            return "error";
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }
    static public function mdlEditarCursos($tabla, $datos, $clave)
    {


        try {
            $stmt = Database::conectar()->prepare("UPDATE $tabla SET nombre_curso=:nombre_curso,instructor=:instructor,fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,hora_inicio=:hora_inicio,hora_fin=:hora_fin,duracion=:duracion,tipo_curso=:tipo_curso WHERE clave=:clave");
            $stmt->bindParam(":clave", $clave, PDO::PARAM_INT);

            $stmt->bindParam(":nombre_curso", $datos["nombre_curso"], PDO::PARAM_STR);
            $stmt->bindParam(":instructor", $datos["instructor"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":hora_inicio", $datos["hora_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":hora_fin", $datos["hora_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":duracion", $datos["duracion"], PDO::PARAM_INT);
            $stmt->bindParam(":tipo_curso", $datos["tipo_curso"], PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return "exito";
            } else {
                //print_r(DB::conectar()->errorInfo());
                return "error";
            }
        } catch (Exception $e) {
            return "error";
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }
    static public function mdlListasPdf($tabla, $clave)
    {
        try {

            
                $stmt = Database::conectar()->prepare("SELECT clave, nombre_curso, instructor, fecha_inicio, hora_inicio, fecha_fin, hora_fin, capacidad, asientos_disponibles  FROM $tabla  WHERE clave = :clave");
                $stmt->bindParam(":clave", $clave, PDO::PARAM_INT);
            

            if ($stmt->execute()) {
                return  $stmt->fetch();
            } else {
                return "error";
            }
        } catch (Exception $e) {
            return "error";
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }
    static public function mdlListasPdf2($tabla, $clave)
    {
        try {

            
                $stmt = Database::conectar()->prepare("SELECT nombre_completo, tipo_persona, numero_identificacion, carrera, semestre FROM $tabla WHERE clave=:clave");
                $stmt->bindParam(":clave", $clave, PDO::PARAM_INT);
            

            if ($stmt->execute()) {
                return  $stmt->fetchAll();
            } else {
                return "error";
            }
        } catch (Exception $e) {
            return "error";
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }

    static public function mdlEliminar($tabla, $clave)
    {


        try {
            $stmt = Database::conectar()->prepare("UPDATE $tabla SET eliminar = 'SI' WHERE clave = :clave");
            $stmt->bindParam(":clave", $clave, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return "exito";
            } else {
                //print_r(DB::conectar()->errorInfo());
                return "error";
            }
        } catch (Exception $e) {
            return "error";
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }
   


}


?>