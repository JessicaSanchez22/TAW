<?php

class ControllerProductos{

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasControllerP(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}


	#REGISTRAR PRODUCTO
	#-----------------------------------
	public function registrarProductosController(){
		if(isset($_POST["registroProductos"])) {
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
			$datosProducto = array("producto"=>$_POST["productoRegistro"], 
								      "descripcion"=>$_POST["descripcionRegistro"],
								      "precio_compra"=>$_POST["precio_compraRegistro"],
								      "precio_venta"=>$_POST["precio_ventaRegistro"],
								  	  "precio_producto"=>$_POST["precio_productoRegistro"]);

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuestaP = CrudProductos::registroProductosModel($datosProducto, "productos");

			//se imprime la respuesta en la vista 
			if($respuestaP=="success"){

				header("location:index.php?action=yes");

			}

			else{

				header("location:productos.php");
			}
		}
	}

	#VISTA PRODUCTOS
	#-----------------------
	public function vistaProductosController(){
		$respuesta = CrudProductos::vistaProductosModel("productos");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["producto"].'</td>
				<td>'.$item["descripcion"].'</td>
				<td>'.$item["precio_compra"].'</td>
				<td>'.$item["precio_venta"].'</td>
				<td>'.$item["precio_producto"].'</td>
			</tr>';

		}

	}

}


?>