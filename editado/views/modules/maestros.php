<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>Maestros</h1>
	<table border="1">
		
		<thead>
			
			<tr>
				<th>Id</th>
				<th>Numero de empleado</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Email</th>
				<th>Password</th>
				<th>¿Editar?</th>
				<th>¿Borrar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php

			$mostrarMaestros = new MaestrosController();
			$mostrarMaestros->vistaMaestrosController();
			$mostrarMaestros->borrarMaestroController();
			?>

		</tbody>

	</table>
	

</form>

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambioM"){

		echo "Cambio Exitoso";
	
	}

}
?>