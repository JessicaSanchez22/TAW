<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}
?>

<h1>REGISTRO DE TUTORIA</h1>
<form method="post">
	<!--<select id="Alumno" style="width: 15%;" class="form-control" onchange="location='index.php?action='+this.value">
	    <?php
	    	/*$respuesta = CrudAlumnos::vistaAlumnosModel("alumnos");

		    foreach($respuesta as $row => $item){
			echo '<option value="alumnos&id='.$item["id"].'">'.$item.'</option>';*/
		?>
	</select>-->

	<input type="" placeholder="Alumno" name="alumno">

	<input type="" placeholder="Tutor" name="tutor">
	
	<input type="date" placeholder="Fecha" name="fecha" required>

	<input type="" placeholder="Hora" name="hora" required>

	<input type="text" placeholder="Tipo" name="tipo" required>

	<input type="text" placeholder="Resumen" name="resumen" required>

	<input type="submit" value="Enviar" name="registrarTutoria">

</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new TutoriasController();
//se invoca la función registroUsuarioController de la clase MvcController:
$registro -> registroTutoriaController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>