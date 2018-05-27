<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>EDITAR TUTORIA</h1>

<form method="post">
	
	<?php

	$editarTutoria = new TutoriasController();
	$editarTutoria -> editarTutoriaController();
	$editarTutoria -> actualizarTutoriaController();

	?>

</form>



