<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>REGISTRO DE CARRERAS</h1>

<form method="post">

	<input type="text" placeholder="Nombre de la Carrera" name="nombreCarrera" required>

	<input type="submit" value="Enviar" name="registrarCarrera">

</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new CarrerasController();
//se invoca la función registroUsuarioController de la clase MvcController:
$registro -> registroCarreraController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
