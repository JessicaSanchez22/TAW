<?php
include 'conexion.php'; /*importamos el archivo que tiene 
	la conexión a la base de datos y las configuraciones que
	necesitamos para poder hacer registros.*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ventas</title>
	<!--Se necesita internet para ver los archivos-->
	<link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
</head>
<body>
	<h1>Inserte una nueva venta</h1>
	<!--Por el metodo post pasamos los datos de este formulario
		al archivo que se llama ventapro.php que nos procesa 
		una venta que acabamos de realizar-->
	<form action="ventapro.php" method="post" >
		<div class="row column" style="width: 50%;">
		<div class="callout success">
			<label>Id de la venta:</label><br>
			<!--Solicitamos el id de la venta -->
			<input name="idVenta" type="text" required="required">
			<label>Id del producto:</label><br>
			<!--Solicitamos el producto que se vendió-->
			<input name="idProducto" type="text"  required="required">
			<label>Cantidad vendida:</label><br>
			<!--Solicitamos la cantidad vendida-->
			<input name="cantidad" type="text"  required="required">
			<label>Precio de la venta:</label><br>
			<!--Solicitamos el precio total de la venta-->
			<input name="precioCantidad" type="text"  required="required">
			<!--Aquí tenemos los botones de agregar y cancelar-->
			<input type="submit" name="Submit" value="Agregar venta" class="button">
			<a href="index.php" style="color: white;" class="button">Cancelar</a>
		</div>
		</div>
	</form>
</body>
</html>