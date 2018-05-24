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

			$vistaProductos = new ControllerProductos();
			$vistaProductos -> vistaProductosController("productos");

			?>

		</tbody>

	</table>

<center>
	<br><br>
<h1>REGISTRO DE PRODUCTOS</h1>
<br><br>
<form method="post">
	<input type="text" placeholder="Producto" name="productoRegistro" required>
	<input type="text" placeholder="Descripcion" name="descripcionRegistro" required>
	<input type="" placeholder="Precio Compra" name="precio_compraRegistro" required>
	<input type="" placeholder="Precio Venta" name="precio_ventaRegistro" required>
	<input type="" placeholder="Precio Producto" name="precio_productoRegistro" required>
	<input type="submit" value="Enviar" name="registroProductos">

</form>

</center>

<?php

$registroP = new ControllerProductos();
$registroP -> registrarProductosController();

if(isset($_GET["action"])){

	if($_GET["action"] == "yes"){

		echo "Registro Exitoso";
	
	}

}



?>
