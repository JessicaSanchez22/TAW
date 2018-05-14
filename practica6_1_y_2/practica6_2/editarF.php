<?php 
/*Este archivo se encarga de editar un registro en la tabla de los futbolistas*/
	include 'config.php';

	$id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

	if ($id === null || $id === false) {
		header('Location: index.php');
		exit();
	}
	$stmt = $pdo->query("SELECT * FROM futbolistas WHERE id = '$id'");/*Seleccionamos el registro que
	lecorresponde al id que seleccionamos para modificar*/
	$futbolista = $stmt->fetch(PDO::FETCH_ASSOC);

	if(!$futbolista){
		header('Location: index.php');
		exit();
	}

 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Practica 06</title>
	<link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
</head>
<body>
	<div>
		<h1>Editar</h1>
		<form action="editar_procesarF.php" method="POST"> <!--Usamos el formulario con metodo post para que así
			el otro archivo pueda usarlo para obtener los datos que ingresó el usuario en el html-->
			<input name="id"  type="hidden" value="<?=$futbolista['id']?>"> <!--A través de la variable futbolista obtnemos todos los datos y los mostramos. 
			Aquí no mostramos el id porque es un campo que no se puede modificar o mas bien que no se debe modificar.-->
			<table>
				<tbody>
					<tr>
						<td><label>Nombre:</label></td> <!--Cada uno de los campos se ponen disponibles para editar-->
						<td><input name="nombre" type="text" value="<?=$futbolista['nombre']?>" required="required"></td>
					</tr>
					<tr>
						<td><label>Posicion:</label></td>
						<td><input name="posicion" type="text" value="<?=$futbolista['posicion']?>" required="required"></td>
					</tr>
					<tr>
						<td><label>Carrera:</label></td>
						<td><input name="carrera" type="text" value="<?=$futbolista['carrera']?>" required="required"></td>
					</tr>
					<tr>
						<td><label>Email:</label></td>
						<td><input name="email" type="text" value="<?=$futbolista['email']?>" required="required"></td>
					</tr>
					<tr>
						<td></td> <!--El botón de guardar actualiza los datos y el de cancelar canela la accin que estamos por ejecutar-->
						<td><input id="btnEditar" name="editar" class="button" value="Guardar" type="submit">
						<a href="index.php" class="button" style="text-decoration: none; color: white;" type="submit">Cancelar</a></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>