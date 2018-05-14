<?php 
	include 'config.php'; //Se importa el archivo de las configuraciones y conexiones
	$id = filter_input(INPUT_POST, 'id'); //Se obtiene el id

	if ($id === null || $id === false) {
		header('Location: index.php');
		exit();
	}

	$nombre = filter_input(INPUT_POST, 'nombre'); //Se obtiene el nombre que remplazará al nombre en la tabla
	$posicion = filter_input(INPUT_POST, 'posicion');//Y así se obtienen cada uno de los demas
	$carrera = filter_input(INPUT_POST, 'carrera');//datos que reemplazaran a los anteriores
	$email = filter_input(INPUT_POST, 'email');//con los nuevos valores

	if ($nombre != '' && $posicion != ''&& $carrera != '' && $email != '') { /*Si los campos no están vacíos 
		o alguno de ellos no está vacío, entonces se agregan*/
		$sql="UPDATE basquetbolistas SET nombre = '$nombre', posicion = '$posicion', carrera = '$carrera', email = '$email' WHERE id = '$id';"; //Se actualizan los datos de la tabla a través del sql
		$pdo->query($sql); //Y se ejecuta el sql

	}
	/*Por otro lado, tenemos el script que nos permite
	lanzar el alert que le indica al usuario que el registro
	se actualizó.*/
	echo "<script language='javascript'>";
	echo "alert('¡El registro se editó con éxito!');";
	echo "window.location.href='index.php'";
	echo "</script>";
 ?>