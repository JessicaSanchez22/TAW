<?php
	require_once("conexion.php");

	class CrudProductos extends Conexion
    {

        public static function registrarProductoModel($table, $datos)
        {

            $idCat = self::obtenerIdCategoriaModel("categoria", $datos["categoria"]);
            $idTienda=self::obtenerIdTienda($datos["id_tienda"]);

            $statement = Conexion::conectar()->prepare("INSERT INTO $table(codigo_producto, nombre, date_added, precio_producto, cantidad_stock, id_categoria, id_tienda) 
                                                        VALUES (:codigo,:nombre,:date_added,:precio,:stock, :categoria, :idTienda)");
            $statement->bindParam(":codigo", $datos["codigo_producto"], PDO::PARAM_STR);
            $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $statement->bindParam(":date_added", $datos["date_added"], PDO::PARAM_STR);
            $statement->bindParam(":precio", $datos["precio_producto"], PDO::PARAM_INT);
            $statement->bindParam(":stock", $datos["cantidad_stock"], PDO::PARAM_INT);
            $statement->bindParam(":categoria", $idCat["id_categoria"], PDO::PARAM_INT);
            if ($_SESSION["superadmin"]==true) {
                $statement->bindParam(":idTienda", $idTienda["id"], PDO::PARAM_INT);
            } else{
                $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
            }

            
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
            if ($_SESSION["superadmin"]) {
                $idTienda=self::obtenerIdTienda($datos["id_tienda"]);
                $statement = Conexion::conectar()->prepare(
                    "INSERT INTO $table(first_name,last_name,usuario,password,user_email,date_added, superadmin, id_tienda) 
                                VALUES (:nombre,:apellido,:usuario,:password,:email,:date_add, :super, :idTienda)");
                $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
                $statement->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
                $statement->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
                $statement->bindParam(":password", $datos["password"], PDO::PARAM_STR);
                $statement->bindParam(":email", $datos["email"], PDO::PARAM_STR);
                $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_STR);
                $statement->bindParam(":super", $datos["superadmin"], PDO::PARAM_INT);
                $statement->bindParam(":idTienda", $idTienda["id"], PDO::PARAM_INT);
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
                $statement->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
                $statement->bindParam(":password", $datos["password"], PDO::PARAM_STR);
                $statement->bindParam(":email", $datos["email"], PDO::PARAM_STR);
                $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_STR);
                $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
                if ($statement->execute()) {
                    return true;
                } else {
                    return false;
                }
            }

        }


        public static function registrarClienteModel($table, $datos)
        {
            $statement = Conexion::conectar()->prepare(
                    "INSERT INTO $table(nombre,apellido,email,direccion,telefono,date_added,id_tienda) 
                                VALUES (:nombre,:apellido,:email,:direccion,:telefono,:date_add,:idTienda)");
            $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $statement->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $statement->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $statement->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $statement->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_STR);
            $statement->bindParam(":idTienda", $datos["id_tienda"], PDO::PARAM_INT);

            if ($statement->execute()) {
                return true;
            } else {
                return false;
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
            $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_STR);
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
            $statement->bindParam(":newStock", $newStock, PDO::PARAM_INT);
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

         public static function vistaClientesModel($idTienda, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_tienda=:idTienda");
            $statement->bindParam(":idTienda", $idTienda, PDO::PARAM_INT);
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

        public static function vistaProductosModel($datos, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_tienda=:idTienda");
            $statement->bindParam(":idTienda", $datos, PDO::PARAM_INT);
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

        public static function obtenerIdClienteModel($table, $nombreCliente)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre = :nombre");
            $stmt->bindParam(":nombre", $nombreCliente, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function obtenerIdUsuarioModel($table, $nombreUsuario)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE usuario = :nombre");
            $stmt->bindParam(":nombre", $nombreUsuario, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function obtenerIdTienda($nombreTienda)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM tienda WHERE nombre = :nombre");
            $stmt->bindParam(":nombre", $nombreTienda, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
            $stmt->close();
        }

        public static function obtenerNombreTiendaModel($table,$idTienda)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $stmt->bindParam(":id", $idTienda, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function editarClienteModel($datos, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $statement->bindParam(":id", $datos, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();
        }

        public static function actualizarClienteModel($datos, $table)
        {
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET nombre = :nombre, apellido = :apellido, direccion = :direccion, email = :email, telefono=:telefono, date_added=:date_added WHERE id = :id");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":date_added", $datos["date"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {

                return "success";

            } else {

                return "error";

            }
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

         public static function borrarClienteModel($id, $tabla)
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
                "INSERT INTO $table(nombre,date_added, estado) 
                                VALUES (:nombre,:date_add, :estado)");
            $statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $statement->bindParam(":date_add", $datos["date"], PDO::PARAM_STR);
            $statement->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
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
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET nombre = :nombre, date_added= :date_added, estado=:estado WHERE id = :id");

            $stmt->bindParam(":date_added", $datos["date_added"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {

                return "success";

            } else {

                return "error";

            }

        }

        public static function borrarVentaModel($id, $tabla)
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
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
            $stmt->bindParam(":usuario", $nombreUsuario, PDO::PARAM_STR);
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

        public static function detalleVentaModel($id, $table)
        {
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_venta=:id");
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
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
            $idCliente=CrudProductos::obtenerIdClienteModel("clientes", $datos["cliente"]);
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(date_added,total_venta,id_tienda, id_cliente) 
                                VALUES (:dateA,:total,:idTienda, :idCliente)");
            $statement->bindParam(":dateA", $datos["date_added"], PDO::PARAM_STR);
            $statement->bindParam(":total", $datos["total_venta"], PDO::PARAM_STR);
            $statement->bindParam(":idTienda", $datos["id_tienda"], PDO::PARAM_INT);
            $statement->bindParam(":idCliente", $idCliente["id"], PDO::PARAM_INT);
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
            $statement= Conexion::conectar()->prepare("SELECT id FROM ventas WHERE id_tienda = :idTienda ORDER BY id DESC LIMIT 1");
            $statement->bindParam(":idTienda", $_SESSION["idTienda"], PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch();

        }

        public static function totalProductos(){
            $statement=Conexion::conectar()->prepare("SELECT count(*) as totalP FROM productos");
            $statement->execute();

            return $statement->fetch();
        }

        public static function totalVentas(){
            $statement=Conexion::conectar()->prepare("SELECT count(*) as totalV FROM ventas");
            $statement->execute();

            return $statement->fetch();
        }

        public static function totalUsuarios(){
            $statement=Conexion::conectar()->prepare("SELECT count(*) as totalU FROM users");
            $statement->execute();

            return $statement->fetch();
        }

    }
?>