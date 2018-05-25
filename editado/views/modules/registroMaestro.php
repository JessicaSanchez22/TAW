<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>REGISTRO DE MAESTRO</h1>

<form method="post">

	<input type="" placeholder="Numero de empleado" name="noempleado" required>

	<input type="" placeholder="Carrera" name="carreraMaestro">
	
	<input type="text" placeholder="Nombre de usuario" name="nombreMaestro" required>

	<input type="password" placeholder="Contraseña" name="passwordMaestro" required>

	<input type="email" placeholder="Email" name="emailMaestro" required>

	<input type="submit" value="Enviar" name="registrarMaestro">

</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new MaestrosController();
//se invoca la función registroUsuarioController de la clase MvcController:
$registro -> registroMaestroController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
