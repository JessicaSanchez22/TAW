<?php 
/*Este archivo incluye las configuraciones necesarias para
poder realizar el cambio de alguno o todos los campos de un 
registro previamente almacenado en la tabla de nuestra base de datos*/
	include 'config.php'; // importamos la conexión a la base de datos
	$id = filter_input(INPUT_POST, 'id'); /*obtenemos el id del registro
	al que se le aplicarán los cambios*/

	if ($id === null || $id === false) {
		header('Location: index.php');
		exit();
	}
	/*Empezamos a llenar los campos con cada uno de los valores
	obtenidos del formulario, para así actualizarlos.*/
	$nombre = filter_input(INPUT_POST, 'nombre');
	$posicion = filter_input(INPUT_POST, 'posicion');
	$carrera = filter_input(INPUT_POST, 'carrera');
	$email = filter_input(INPUT_POST, 'email');

	if ($nombre != '' && $posicion != ''&& $carrera != '' && $email != '') { //Se condiciona que no haya campos vacíos.
		$sql="UPDATE futbolistas SET nombre = '$nombre', posicion = '$posicion', carrera = '$carrera', email = '$email' WHERE id = '$id';"; //Se prepara el sql que hace el update a la tabla.
		$pdo->query($sql); //Se ejecuta el update y se actualizan los datos.

	}
	//Script que nos ayuda a avisarle al usuario, por medio de un alert, que sus cambios se guardaron.
	echo "<script language='javascript'>";
	echo "alert('¡El registro se editó con éxito!');";
	echo "window.location.href='index.php'";
	echo "</script>";
 ?>