<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>
<h1>Tutorias</h1>
	<table border="1">
		
		<thead>
			
			<tr>
				<th>Id</th>
				<th>Alumno</th>
				<th>Tutor</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Tipo</th>
				<th>Resumen</th>
				<th>¿Editar?</th>
				<th>¿Borrar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php

			$mostrarAlumnos = new TutoriasController();
			$mostrarAlumnos->vistaTutoriaController();
			$mostrarAlumnos -> borrarTutoriaController();
			?>

		</tbody>

	</table>

</form>
<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambioT"){

		echo "Cambio Exitoso";
	
	}

}