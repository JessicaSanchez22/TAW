<?php
	require_once("conexion.php");

	class Crud extends Conexion
    {

        public static function obtenerIdModel($table, $nombre)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre = :nombre");
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function registrarComprobanteModel($table, $datos)
        {

            $idGrupo = self::obtenerIdModel("grupos", $datos["grupo"]);
            $idAlumna=self::obtenerIdModel("alumnas", $datos["alumna"]);

            $statement = Conexion::conectar()->prepare("INSERT INTO $table (id_grupo, id_alumna, nombre_mama, fecha_pago, fecha_envio, folio_autorizacion, ruta_imagen) 
                VALUES (:idGrupo,:idAlumna,:nombreMama,:fechaPago,:fechaEnvio, :folio, :ruta)");
            $statement->bindParam(":idGrupo", $idGrupo["id"], PDO::PARAM_INT);
            $statement->bindParam(":idAlumna", $idAlumna["id"], PDO::PARAM_INT);
            $statement->bindParam(":nombreMama", $datos["mama"], PDO::PARAM_STR);
            $statement->bindParam(":fechaPago", $datos["fecha_pago"], PDO::PARAM_STR);
            $statement->bindParam(":fechaEnvio", $datos["fecha_envio"], PDO::PARAM_STR);
            $statement->bindParam(":folio", $datos["folio_autorizacion"], PDO::PARAM_INT);
            $statement->bindParam(":ruta", $datos["ruta_imagen"], PDO::PARAM_STR);
            
            
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function obtenerNombreModel($table, $id)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

         public static function vistaModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function filtroAlumnasModel($grupo){
            $idGrupo=self::obtenerIdModel("grupos", $grupo);
            $statement = Conexion::conectar()->prepare("SELECT * FROM alumnas WHERE id_grupo=:idGrupo");
            $statement->bindParam(":idGrupo", $idGrupo["id"], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function loginModel($table, $datos)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE usuario = :us AND password = :pass");
            $statement->bindParam(":us", $datos["usuario"], PDO::PARAM_STR);
            $statement->bindParam(":pass", $datos["password"], PDO::PARAM_STR);
            $statement->execute();
            #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
            return $statement->fetch();
            //$statement->close();
        }

        public static function ultimoId($tabla){
            $statement=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC LIMIT 1");
            $statement->execute();

            return $statement->fetch();
        }
    }
?>