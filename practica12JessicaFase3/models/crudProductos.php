<?php
	require_once("conexion.php");

	class CrudProductos extends Conexion
    {

        public static function registrarProductoModel($table, $datos)
        {

            $idCat = self::obtenerIdCategoriaModel("categoria", $datos["categoria"]);

            $statement = Conexion::conectar()->prepare("INSERT INTO $table(codigo_producto, nombre, date_added, precio_producto, cantidad_stock, id_categoria) VALUES (:codigo,:nombre,:date_added,:precio,:stock, :categoria)");
            $statement->bindParam(":codigo", $datos["codigo_producto"], PDO::PARAM_STR);
            $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $statement->bindParam(":date_added", $datos["date_added"], PDO::PARAM_STR);
            $statement->bindParam(":precio", $datos["precio_producto"], PDO::PARAM_INT);
            $statement->bindParam(":stock", $datos["cantidad_stock"], PDO::PARAM_INT);
            $statement->bindParam(":categoria", $idCat["id_categoria"], PDO::PARAM_INT);
            if ($statement->execute()) {
                return "success";
            } else {
                return "0";
            }
            //$statement->close();
        }

        public static function editarProductoModel($datos, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $statement->bindParam(":id", $datos, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

        public static function actualizarProductoModel($datos, $table)
        {
            $idC = CrudProductos::obtenerIdCategoriaModel("categoria", $datos["nombre_categoria"]);
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET codigo_producto=:codigo, nombre = :nombre, date_added = :date_added, precio_producto = :precio, cantidad_stock = :stock, id_categoria=:categoria WHERE id = :id");


            $stmt->bindParam(":codigo", $datos["codigo_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":date_added", $datos["date_added"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":precio", $datos["precio_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":stock", $datos["cantidad_stock"], PDO::PARAM_STR);
            $stmt->bindParam(":categoria", $idC["id_categoria"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {

                return "success";

            } else {

                return "error";

            }
        }

        public static function registrarUsuarioModel($table, $datos)
        {
            if ($_SESSION["id"]==2){
                $statement = Conexion::conectar()->prepare(
                    "INSERT INTO $table(first_name,last_name,usuario,password,user_email,date_added, superadmin) 
                                VALUES (:nombre,:apellido,:usuario,:password,:email,:date_add, :super)");
                $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
                $statement->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
                $statement->bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
                $statement->bindParam(":password", $datos["password"], PDO::PARAM_INT);
                $statement->bindParam(":email", $datos["email"], PDO::PARAM_INT);
                $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_INT);
                $statement->bindParam(":super", $datos["superadmin"], PDO::PARAM_INT);
                if ($statement->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $statement = Conexion::conectar()->prepare(
                    "INSERT INTO $table(first_name,last_name,usuario,password,user_email,date_added) 
                                VALUES (:nombre,:apellido,:usuario,:password,:email,:date_add)");
                $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
                $statement->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
                $statement->bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
                $statement->bindParam(":password", $datos["password"], PDO::PARAM_INT);
                $statement->bindParam(":email", $datos["email"], PDO::PARAM_INT);
                $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_INT);
                if ($statement->execute()) {
                    return true;
                } else {
                    return false;
                }
            }

        }

        public static function registrarCategoriaModel($table, $datos)
        {
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(nombre_categoria,descripcion_categoria,date_added) 
                                VALUES (:nombre,:descripcion,:date_add)");
            $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_INT);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function obtenerStockModel($idP)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id = :id");
            $statement->bindParam(":id", $idP, PDO::PARAM_STR);
            $statement->execute();
            #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
            return $statement->fetch();
        }


        public static function agregarStockModel($table, $stock, $idP)
        {
            $nota = "El usuario " . $_SESSION["usuario"] . " ha agregado " . $stock . " al producto con id: " . $idP;
            $date = date("Y-m-d h:i:s");
            $currentStock = self::obtenerStockModel($idP);
            $newStock = (int)$stock + (int)$currentStock["cantidad_stock"];

            $statement = Conexion::conectar()->prepare("UPDATE $table SET cantidad_stock = :newStock WHERE id = :id");
            $statement->bindParam(":id", $idP, PDO::PARAM_STR);
            $statement->bindParam(":newStock", $newStock, PDO::PARAM_STR);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }


        public static function eliminarStockModel($table, $stock, $idP)
        {
            $currentStock = self::obtenerStockModel($idP);
            $newStock = (int)$currentStock["cantidad_stock"] - (int)$stock;
            $statement = Conexion::conectar()->prepare("UPDATE $table SET cantidad_stock = :newStock WHERE id = :id");
            $statement->bindParam(":id", $idP, PDO::PARAM_STR);
            $statement->bindParam(":newStock", $newStock, PDO::PARAM_STR);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function obtenerProductModel($table, $idP)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $statement->bindParam(":id", $idP, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

        public static function loginModel($table, $datos)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE usuario = :user AND password = :pass");
            $statement->bindParam(":user", $datos["usuario"], PDO::PARAM_STR);
            $statement->bindParam(":pass", $datos["password"], PDO::PARAM_STR);
            $statement->execute();
            #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
            return $statement->fetch();
            //$statement->close();
        }

        public static function vistaUsuariosModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function vistaCategoriasModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function vistaProductosModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function editarUsuarioModel($datos, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT id, first_name, last_name, usuario, user_email FROM $table WHERE id = :id");
            $statement->bindParam(":id", $datos, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

        public static function obtenerCategoriaModel($table, $id)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_categoria = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function obtenerIdCategoriaModel($table, $nombreCategoria)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre_categoria = :nombre");
            $stmt->bindParam(":nombre", $nombreCategoria, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function obtenerIdUsuarioModel($table, $nombreUsuario)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE frst_name = :nombre");
            $stmt->bindParam(":nombre", $nombreUsuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function obtenerIdTiendaModel($table, $nombreUsuario)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre = :nombre");
            $stmt->bindParam(":nombre", $nombreUsuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function actualizarUsuarioModel($datos, $table)
        {
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET first_name = :nombre, last_name = :apellido, usuario = :usuario, user_email = :email WHERE id = :id");

            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["user_email"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["first_name"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $datos["last_name"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {

                return "success";

            } else {

                return "error";

            }
        }


        public static function borrarCategoriaModel($id, $tabla)
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_categoria = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        }

        public static function borrarProductoModel($id, $tabla)
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        }

        public static function borrarUsuarioModel($id, $tabla)
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        }

        public static function editarCategoriaModel($datos, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_categoria = :id");
            $statement->bindParam(":id", $datos, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }


        public static function actualizarCategoriaModel($datos, $table)
        {
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET nombre_categoria = :nombre, descripcion_categoria = :descripcion, date_added= :date_added WHERE id_categoria = :id");

            $stmt->bindParam(":date_added", $datos["date_added"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id_categoria"], PDO::PARAM_INT);

            if ($stmt->execute()) {

                return "success";

            } else {

                return "error";

            }
        }


        public static function vistaTiendasModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function registrarTiendaModel($table, $datos)
        {
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(nombre,date_added) 
                                VALUES (:nombre,:date_add)");
            $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_INT);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function editarTiendaModel($datos, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $statement->bindParam(":id", $datos, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }


        public static function actualizarTiendaModel($datos, $table)
        {
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET nombre = :nombre, date_added= :date_added WHERE id = :id");

            $stmt->bindParam(":date_added", $datos["date_added"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {

                return "success";

            } else {

                return "error";

            }

        }

        public static function borrarTiendaModel($id, $tabla)
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        }

        public static function esSuper($nombreUsuario, $table)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE first_name = :nombre");
            $stmt->bindParam(":nombre", $nombreUsuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

    }
?>