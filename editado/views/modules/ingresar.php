
<h1>INGRESAR</h1>

	<form method="post">
		<input type="" name="numTutor" placeholder="Numero de empleado" required>
		
		<input type="text" placeholder="Nombre de usuario" name="maestroIngreso" required>

		<input type="password" placeholder="Contraseña" name="passwordIngreso" required>

		<input type="submit" value="Enviar" name="usuarioIngreso">

	</form>

<?php

$ingreso = new MaestrosController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";
	
	}

}

?>