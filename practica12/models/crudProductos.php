<?php
require_once "conexion.php";

/**
 */
class CrudProductos extends Conexion{
	#REGISTRO DE PRODUCTOS
	#-------------------------------------
	public function registroProductosModel($datosProducto, $tabla){

		$stamt = Conexion::conectar()->prepare("INSERT INTO $tabla (producto, descripcion, precio_compra, precio_venta, precio_producto) VALUES (:producto,:descripcion,:precio_compra,:precio_venta,:precio_producto)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stamt->bindParam(":producto", $datosProducto["producto"], PDO::PARAM_STR);
		$stamt->bindParam(":descripcion", $datosProducto["descripcion"], PDO::PARAM_STR);
		$stamt->bindParam(":precio_compra", $datosProducto["precio_compra"]);
		$stamt->bindParam(":precio_venta", $datosProducto["precio_venta"]);
		$stamt->bindParam(":precio_producto", $datosProducto["precio_producto"]);


		if($stamt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	public function vistaProductoModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, producto, descripcion, precio_compra, precio_venta, precio_producto FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

}

?>