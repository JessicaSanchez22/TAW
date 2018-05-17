	<?php 
	include 'conexion.php';
	 $idVenta = filter_input(INPUT_POST, 'idVenta'); //Se recopila el nombre que introdujo el usuario
	$idProducto = filter_input(INPUT_POST, 'idProducto');
	$cantidad = filter_input(INPUT_POST, 'cantidad');
	$precioCantidad = filter_input(INPUT_POST, 'precioCantidad'); //Se recopila la posicion
	
	if ($idVenta != '' && $idProducto != '' &&$cantidad != '' && $precioCantidad != '' ) {
		$sql = "INSERT INTO detalle_venta(idVenta,idProducto,cantidad,precioCantidad) VALUES ('$idVenta','$idProducto', '$cantidad', '$precioCantidad');"; /*SQL que se ejecuta y permite que se inserten los datos que anteriormente
		agregó el usuario a través del formulario.*/
                
		$pdo->query($sql);
	}
	/*Script de javascript que nos permite mostrar un alert que le indique
	al usuario si la acción que realizó fue realizada.*/
	echo "<script language='javascript'>";
	echo "alert('Venta agregado con éxito!');";
	echo "window.location.href='index.php'";
	echo "</script>";  
 ?>
