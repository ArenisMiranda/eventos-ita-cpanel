<?php

require_once "conexion.php";

class ModeloCursos
{

    static public function mdlTipoCursos($tabla, $tipo)
    {
        try {

            if ($tipo == '1') {
                $stmt = Database::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_curso in ('ALUMNOS', 'MIXTO') and estatus = 'ALTA'  ORDER BY clave DESC");
                $stmt->execute();
                return  $stmt->fetchAll();
                $stmt->closeCursor();
                $stmt = null;
            } else if ($tipo == '2') {
                $stmt = Database::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_curso in ('DOCENTES', 'MIXTO') and estatus = 'ALTA'  ORDER BY clave DESC");
                $stmt->execute();
                return  $stmt->fetchAll();
                $stmt->closeCursor();
                $stmt = null;
            } else {
                $stmt = Database::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_curso in ('EXTERNOS', 'MIXTO') and estatus = 'ALTA'  ORDER BY clave DESC");
                $stmt->execute();
                return  $stmt->fetchAll();
                $stmt->closeCursor();
                $stmt = null;
            }
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlRegistroACursosAlumnos($tabla, $datos)
    {

        try {

            $stmt = Database::conectar()->prepare("SELECT numero_identificacion FROM $tabla WHERE numero_identificacion = :numero_identificacion and clave = :clave and tipo_identificacion = 'NOCONTROL' and estatus= 'ALTA' ");

            $stmt->bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);
            $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

            $stmt->execute();


            if ($stmt->fetch()) {

                return "holi";
            } else {
                $stmt = Database::conectar()->prepare("INSERT INTO $tabla(tipo_persona, nombre_completo, correo, tipo_identificacion, numero_identificacion, carrera, semestre, sexo, clave) VALUES (:tipo_persona, :nombre_completo, :correo, :tipo_identificacion, :numero_identificacion, :carrera, :semestre, :sexo, :clave)");
                $stmt->bindParam(":tipo_persona", $datos["tipo_persona"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_completo", $datos["nombre_completo"], PDO::PARAM_STR);
                $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
                $stmt->bindParam(":tipo_identificacion", $datos["tipo_identificacion"], PDO::PARAM_STR);
                $stmt->bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);
                $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
                $stmt->bindParam(":semestre", $datos["semestre"], PDO::PARAM_INT);
                $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
                $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $stmt = Database::conectar()->prepare("UPDATE cursos SET asientos_disponibles = asientos_disponibles - 1 WHERE clave = :clave");
                    $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        return "exito";
                    } else {
                        return "error";
                    }
                } else {
                    return "error";
                }
            }
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlRegistroACursosDocentes($tabla, $datos)
    {

        try {
            $stmt = Database::conectar()->prepare("SELECT numero_identificacion FROM $tabla WHERE numero_identificacion = :numero_identificacion and clave = :clave and tipo_identificacion = 'RFC' and estatus= 'ALTA' ");

            $stmt->bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);
            $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

            $stmt->execute();


            if ($stmt->fetch()) {

                return "holi";
            } else {
                $stmt = Database::conectar()->prepare("INSERT INTO $tabla(tipo_persona, nombre_completo, correo, tipo_identificacion, numero_identificacion, sexo, clave) VALUES (:tipo_persona, :nombre_completo, :correo, :tipo_identificacion, :numero_identificacion, :sexo, :clave)");
                $stmt->bindParam(":tipo_persona", $datos["tipo_persona"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_completo", $datos["nombre_completo"], PDO::PARAM_STR);
                $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
                $stmt->bindParam(":tipo_identificacion", $datos["tipo_identificacion"], PDO::PARAM_STR);
                $stmt->bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);
                $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
                $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $stmt = Database::conectar()->prepare("UPDATE cursos SET asientos_disponibles = asientos_disponibles - 1 WHERE clave = :clave");
                    $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        return "exito";
                    } else {
                        return "error";
                    }
                } else {
                    return "error";
                }
            }
        } catch (Exception $e) {
            return "error";
        }
    }


    static public function mdlRegistroACursosExternos($tabla, $datos)
    {
        
        try {
            $stmt = Database::conectar()->prepare("SELECT numero_identificacion FROM $tabla WHERE numero_identificacion = :numero_identificacion and clave = :clave and tipo_identificacion = 'RFC' and estatus= 'ALTA' ");

            $stmt->bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);
            $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

            $stmt->execute();


            if ($stmt->fetch()) {

                return "holi";
            } else {
                $stmt = Database::conectar()->prepare("INSERT INTO $tabla(tipo_persona, nombre_completo, correo, tipo_identificacion, numero_identificacion, sexo, clave) VALUES (:tipo_persona, :nombre_completo, :correo, :tipo_identificacion, :numero_identificacion, :sexo, :clave)");
                $stmt->bindParam(":tipo_persona", $datos["tipo_persona"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_completo", $datos["nombre_completo"], PDO::PARAM_STR);
                $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
                $stmt->bindParam(":tipo_identificacion", $datos["tipo_identificacion"], PDO::PARAM_STR);
                $stmt->bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);
                $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
                $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $stmt = Database::conectar()->prepare("UPDATE cursos SET asientos_disponibles = asientos_disponibles - 1 WHERE clave = :clave");
                    $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        return "exito";
                    } else {
                        return "error";
                    }
                } else {
                    return "error";
                }
            }
        } catch (Exception $e) {
            return "error";
        }
    }
    static public function mdlRegistroPdf($clave, $id)
    {
        try {


            // $stmt = Database::conectar()->prepare("SELECT * FROM cursos WHERE clave = :clave");
            $stmt = Database::conectar()->prepare("SELECT personas_registradas_cursos.nombre_completo, personas_registradas_cursos.numero_identificacion, personas_registradas_cursos.carrera, personas_registradas_cursos.semestre, cursos.nombre_curso, cursos.fecha_inicio, cursos.hora_inicio FROM personas_registradas_cursos, cursos WHERE personas_registradas_cursos.clave = cursos.clave AND personas_registradas_cursos.clave = :clave AND personas_registradas_cursos.numero_identificacion = :id");
            $stmt->bindParam(":clave", $clave, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);


            $stmt->execute();
            return  $stmt->fetch();
            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }
}
