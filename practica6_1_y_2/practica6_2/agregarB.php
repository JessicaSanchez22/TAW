<?php 
	include 'config.php'; //Se incluye el archivo con la 
	//configuración de la conexión a la base de datos

	$nombre = filter_input(INPUT_POST, 'nombre'); //Se obtienen, por medio del método post
	$posicion = filter_input(INPUT_POST, 'posicion'); //los valores que necesitamos de cada uno de los campos
	$carrera = filter_input(INPUT_POST, 'carrera'); //para después insertarlos en la tabla
	$email = filter_input(INPUT_POST, 'email');
	
	if ($nombre != '' && $posicion != '' && $carrera != '' && $email != '') { //Si los campos no están vacíos entonces
		//se pueden agregar a la tabla, de lo contrario no.
		$sql = "INSERT INTO basquetbolistas( nombre, posicion, carrera, email) VALUES ('$nombre','$posicion', '$carrera', '$email');"; //Se insertan en la tabla el registro conforme a los datos que introdujo el usuario en el formulario.
                
		$pdo->query($sql);
	}
	//En esta parte se envía el alert que indica que el nuevo registro se
	//agregó con éxito en nuestra tabla.
	echo "<script language='javascript'>";
	echo "alert('¡Basquetbolista agregado con éxito!');";
	echo "window.location.href='index.php'";
	echo "</script>";  
 ?>