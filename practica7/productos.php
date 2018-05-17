<?php
include 'conexion.php'; /*importamos el archivo que tiene 
	la conexión a la base de datos y las configuraciones que
	necesitamos para poder hacer registros.*/

	$producto = filter_input(INPUT_POST, 'productname'); //Se recopila el nombre del producto que introdujo el usuario
	$precio = filter_input(INPUT_POST, 'productprice'); //Se recopila su precio
	
	if ($producto != '' && $precio != '' ) {
		$sql = "INSERT INTO productos(producto,precio) VALUES ('$producto','$precio');"; /*SQL que se ejecuta y permite que se inserten los datos que anteriormente
		agregó el usuario a través del formulario.*/
                
		$pdo->query($sql);
	}
	/*Script de javascript que nos permite mostrar un alert que le indique
	al usuario si la acción que realizó fue realizada.*/
	echo "<script language='javascript'>";
	echo "alert('Produto agregado con éxito!');";
	echo "window.location.href='index.php'";
	echo "</script>";  
 ?>