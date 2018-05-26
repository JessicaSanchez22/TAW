<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}
?>

<h1>REGISTRO DE ALUMNOS</h1>

<form method="post">

	<input type="" placeholder="Matricula" name="matricula" required>

	<input type="" placeholder="Carrera" name="carreraAlumno">
	
	<input type="text" placeholder="Nombre del alumno" name="nombreAlumno" required>

	<input type="text" placeholder="Tutor" name="tutorAlumno" required>

	<input type="submit" value="Enviar" name="registrarAlumno">

</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new AlumnosController();
//se invoca la función registroUsuarioController de la clase MvcController:
$registro -> registroAlumnoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
