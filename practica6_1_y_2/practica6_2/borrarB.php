<?php 
/*Archivo que se encarga de borrar un registro de la tabla de 
basquetbolistas, en este caso no necesitamos una pagina html para ello,
solo necesitamos que el usuario presione el botón que llevará acabo las
acciones de este archivo*/
	include 'config.php'; //incluimos el archivo de la configuración 

	$id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); //Traemos el id del registro que vamos a borrar

	if ($id === null || $id === false) { //Si el id está vacío por alguna razon, no se hace nada.
		header('Location: index.php');
		exit();
	}

	$pdo->query("DELETE FROM basquetbolistas WHERE id = '$id'");//Se ejecuta la acción de borrar
	//el registro que se desea eliminar.
	header('Location: index.php'); //Regresamos a la página principal, después de borrar.

 ?>