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

        public static function registrarGrupoModel($datos){
            $statement = Conexion::conectar()->prepare("INSERT INTO grupos (nombre) VALUES (:nom)");
            $statement->bindParam(":nom", $datos["nombre"], PDO::PARAM_STR);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }  

        public static function registrarAlumnaModel($datos){
            $idGrupo=self::obtenerIdModel("grupos", $datos["grupo"]);
            $statement = Conexion::conectar()->prepare("INSERT INTO alumnas (nombre, edad, nombre_mama, id_grupo) VALUES (:nom, :edad, :nomMama, :idGrupo)");
            $statement->bindParam(":nom", $datos["nombre"], PDO::PARAM_STR);
            $statement->bindParam(":edad", $datos["edad"], PDO::PARAM_STR);
            $statement->bindParam(":nomMama", $datos["nombre_mama"], PDO::PARAM_STR);
            $statement->bindParam(":idGrupo", $idGrupo["id"], PDO::PARAM_INT);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function editarAlumnaModel($datos, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $statement->bindParam(":id", $datos, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

        public static function actualizarAlumnaModel($datos, $table)
        {
            $idG = Crud::obtenerIdModel("grupos", $datos["grupo"]);
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET nombre=:nombre, id_grupo = :idG, nombre_mama=:nomMama, edad=:edad WHERE id = :id");


            $stmt->bindParam(":edad", $datos["edad"], PDO::PARAM_STR);
            $stmt->bindParam(":nomMama", $datos["nombre_mama"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":idG", $idG["id"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {

                return "success";

            } else {

                return "error";

            }
        }

        public static function editarGrupoModel($datos, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $statement->bindParam(":id", $datos, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

        public static function actualizarGrupoModel($datos, $table)
        {
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET nombre=:nombre WHERE id = :id");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {

                return "success";

            } else {

                return "error";

            }
        }

        public static function borrarModel($id, $tabla)
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        }

        public static function ultimoId($tabla){
            $statement=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC LIMIT 1");
            $statement->execute();

            return $statement->fetch();
        }

        public static function verImagenModel($id){
            $statement=Conexion::conectar()->prepare("SELECT * FROM pagos WHERE id = :id");
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

    }
?>