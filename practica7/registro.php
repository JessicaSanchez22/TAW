<?php
	include_once 'conexion.php'; //Incluimos el archivo de la conexión

	$username = $_POST['username']; //Sacamos el nombre de usuario en una variable
	$password = $_POST['password']; //Y en otra variable sacamos la contraseña

	$sql = "INSERT INTO usuarios(id,username,password) VALUES (null,'$username', '$password');";
	/*Después agregamos estas variables a nuestra base de datos para registrar así
	al nuevo usuario*/
	$pdo->query($sql); //Ejecutamos el query

	//Lanzamos un alert que le indique al usuario que la acción se realizó con éxito!
	echo "<script language='javascript'>";
	echo "alert('Usuario agregado con éxito!');";
	echo "window.location.href='index.php'";
	echo "</script>"; 
?>