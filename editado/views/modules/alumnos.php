<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>Alumnos</h1>
	<table border="1">
		
		<thead>
			
			<tr>
				<th>Matricula</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Tutor</th>
				<th>¿Editar?</th>
				<th>¿Borrar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php

			$mostrarAlumnos = new AlumnosController();
			$mostrarAlumnos->vistaAlumnosController();
			$mostrarAlumnos -> borrarAlumnoController();
			?>

		</tbody>

	</table>

</form>
<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambioA"){

		echo "Cambio Exitoso";
	
	}

}