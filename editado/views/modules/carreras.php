<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>
<h1>Carreras</h1>
	<table border="1">
		
		<thead>
			
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>¿Editar?</th>
				<th>¿Borrar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php

			$mostrarCarreras = new CarrerasController();
			$mostrarCarreras->vistaCarreraController();
			$mostrarCarreras->borrarCarreraController();
			?>

		</tbody>

	</table>

</form>
<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambioC"){

		echo "Cambio Exitoso";
	
	}

}