<?php
	require_once("conexion.php");

	class CrudProductos extends Conexion
    {

        public static function registrarProductoModel($table, $datos)
        {

            $idCat = self::obtenerIdCategoriaModel("categoria", $datos["categoria"]);

            $statement = Conexion::conectar()->prepare("INSERT INTO $table(codigo_producto, nombre, date_added, precio_producto, cantidad_stock, id_categoria, id_tienda) 
                                                        VALUES (:codigo,:nombre,:date_added,:precio,:stock, :categoria, :idTienda)");
            $statement->bindParam(":codigo", $datos["codigo_producto"], PDO::PARAM_STR);
            $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $statement->bindParam(":date_added", $datos["date_added"], PDO::PARAM_STR);
            $statement->bindParam(":precio", $datos["precio_producto"], PDO::PARAM_INT);
            $statement->bindParam(":stock", $datos["cantidad_stock"], PDO::PARAM_INT);
            $statement->bindParam(":categoria", $idCat["id_categoria"], PDO::PARAM_INT);
            $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
            if ($statement->execute()) {
                return "success";
            } else {
                return "0";
            }
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
            if ($_SESSION["id"] == 2) {
                $statement = Conexion::conectar()->prepare(
                    "INSERT INTO $table(first_name,last_name,usuario,password,user_email,date_added, superadmin, id_tienda) 
                                VALUES (:nombre,:apellido,:usuario,:password,:email,:date_add, :super, :idTienda)");
                $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
                $statement->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
                $statement->bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
                $statement->bindParam(":password", $datos["password"], PDO::PARAM_INT);
                $statement->bindParam(":email", $datos["email"], PDO::PARAM_INT);
                $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_INT);
                $statement->bindParam(":super", $datos["superadmin"], PDO::PARAM_INT);
                $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
                if ($statement->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $statement = Conexion::conectar()->prepare(
                    "INSERT INTO $table(first_name,last_name,usuario,password,user_email,date_added, id_tienda) 
                                VALUES (:nombre,:apellido,:usuario,:password,:email,:date_add, :idTienda)");
                $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
                $statement->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
                $statement->bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
                $statement->bindParam(":password", $datos["password"], PDO::PARAM_INT);
                $statement->bindParam(":email", $datos["email"], PDO::PARAM_INT);
                $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_INT);
                $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
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
                "INSERT INTO $table(nombre_categoria,descripcion_categoria,date_added, id_tienda) 
                                VALUES (:nombre,:descripcion,:date_add, :idTienda)");
            $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
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
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id AND id_tienda=:idTienda");
            $statement->bindParam(":id", $idP, PDO::PARAM_INT);
            $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

        public static function obtenerProdPorNombre($table, $nombre)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre = :nom");
            $statement->bindParam(":nom", $nombre, PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetch();
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


        public static function vistaUsuariosModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_tienda=:idTienda");
            $statement->bindParam(":idTienda", $_SESSION['idTienda'], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function vistaCategoriasModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_tienda=:idTienda");
            $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function vistaProductosModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_tienda=:idTienda");
            $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
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
            $stmt->bindParam(":nombre", $nombreCategoria, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function obtenerIdUsuarioModel($table, $nombreUsuario)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE usuario = :nombre");
            $stmt->bindParam(":nombre", $nombreUsuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function obtenerNombreTiendaModel($table,$idTienda)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $stmt->bindParam(":id", $idTienda, PDO::PARAM_INT);
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
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE usuario = :usuario");
            $stmt->bindParam(":usuario", $nombreUsuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }


        #####################   VENTAS  ############################################

        public static function vistaVentasModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_tienda=:idTienda");
            $statement->bindParam(":idTienda", $_SESSION['idTienda'], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function obtenerProductoPorCodigo($table, $codigo)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE codigo_producto = :codigo AND id_tienda= :idTienda");
            $statement->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function registrarVentaModel($table, $datos)
        {
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(date_added,total_venta,id_tienda) 
                                VALUES (:dateA,:total,:idTienda)");
            $statement->bindParam(":dateA", $datos["date_added"], PDO::PARAM_INT);
            $statement->bindParam(":total", $datos["total_venta"], PDO::PARAM_STR);
            $statement->bindParam(":idTienda", $datos["id_tienda"], PDO::PARAM_STR);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }

        }

        public static function registrarProductoVModel($table, $datos)
        {
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(id_venta, id_producto,nombre_producto,codigo_producto, cantidad, total) 
                                VALUES (:idV,:idP,:nomP,:codP, :cant, :total)");
            $statement->bindParam(":idV", $datos["id_venta"], PDO::PARAM_INT);
            $statement->bindParam(":idP", $datos["id_producto"], PDO::PARAM_INT);
            $statement->bindParam(":nomP", $datos["nombre_producto"], PDO::PARAM_STR);
            $statement->bindParam(":codP", $datos["codigo_producto"], PDO::PARAM_STR);
            $statement->bindParam(":cant", $datos["cantidad"], PDO::PARAM_INT);
             $statement->bindParam(":total", $datos["total"], PDO::PARAM_INT);
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }

        }

        public static function vistaProdVModel($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_venta = :idVenta");
            $statement->bindParam(":idVenta", $_SESSION["idVenta"], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function sumarTotal($table)
        {
            $statement = Conexion::conectar()->prepare("SELECT sum(total) as total FROM $table WHERE id_venta=:idVenta");
            $statement->bindParam(":idVenta", $_SESSION['idVenta'], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

        public static function obtenerIdVenta(){
            $statement= Conexion::conectar()->prepare("SELECT * FROM ventas WHERE id_tienda = :idTienda ORDER BY id DESC LIMIT 1");
            $statement->bindParam(":id_tienda", $_SESSION["idTienda"], PDO::PARAM_INT);

            return $statement->fetch();

        }

    }
?>