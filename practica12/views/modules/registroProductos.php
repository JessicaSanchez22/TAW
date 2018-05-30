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

$registroP = new ProductosController();
$registroP -> registroProductoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "yes"){

		echo "Registro Exitoso";
	
	}

}