<?php 
	include 'config.php'; /*importamos el archivo que tiene 
	la conexión a la base de datos y las configuraciones que
	necesitamos para poder hacer registros.*/

	$nombre = filter_input(INPUT_POST, 'nombre'); //Se recopila el nombre que introdujo el usuario
	$posicion = filter_input(INPUT_POST, 'posicion'); //Se recopila la posicion
	$carrera = filter_input(INPUT_POST, 'carrera'); //La carrera
	$email = filter_input(INPUT_POST, 'email'); //Y el email a través del metodo post.
	
	if ($nombre != '' && $posicion != '' && $carrera != '' && $email != '') {
		$sql = "INSERT INTO futbolistas( nombre, posicion, carrera, email) VALUES ('$nombre','$posicion', '$carrera', '$email');"; /*SQL que se ejecuta y permite que se inserten los datos que anteriormente
		agregó el usuario a través del formulario.*/
                
		$pdo->query($sql);
	}
	/*Script de javascript que nos permite mostrar un alert que le indique
	al usuario si la acción que realizó fue realizada.*/
	echo "<script language='javascript'>";
	echo "alert('Futbolista agregado con éxito!');";
	echo "window.location.href='index.php'";
	echo "</script>";  
 ?>