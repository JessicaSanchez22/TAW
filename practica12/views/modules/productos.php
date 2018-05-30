<?php
session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>PRODUCTOS</h1>

	<table border="1">
		
		<thead>
			
			<tr>
				<th>Id</th>
				<th>Producto</th>
				<th>Descripcion</th>
				<th>Precio_compra</th>
				<th>Precio_venta</th>
				<th>Precio_producto</th>
			</tr>
		</thead>
		<tbody>
			
			<?php

			$vistaProductos = new ProductosController();
			$vistaProductos -> vistaProductoController("productos");

			?>

		</tbody>

	</table>

<?php

	$vistaP = new ProductosController();
	$vistaP -> vistaProductoController();
	$vistaP -> borrarProductoController();


if(isset($_GET["action"])){

	if($_GET["action"] == "yes"){

		echo "Registro Exitoso";
	
	}

}



?>
