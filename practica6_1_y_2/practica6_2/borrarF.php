<?php 
/*Archivo que se encarga de borrar un registro de la tabla de 
basquetbolistas, en este caso no necesitamos una pagina html para ello,
solo necesitamos que el usuario presione el botón que llevará acabo las
acciones de este archivo*/
	include 'config.php'; //importamos el archivo de las configuraciones

	$id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); //obtenemos el id del registro que se desea eliminar

	if ($id === null || $id === false) {
		header('Location: index.php');
		exit();
	}

	$pdo->query("DELETE FROM futbolistas WHERE id = '$id'"); //Borramos el registro condicionando que sea el que tiene ese id
	header('Location: index.php'); //Redireccionamos al usuario a la página principal

 ?>