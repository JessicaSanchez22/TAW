<?php 
/*Este archivo es el formulario que nos permite actualizar un registro de nuestra tabla.*/
	include 'config.php';//incluimos las configuraciones y conexiones

	$id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

	if ($id === null || $id === false) {
		header('Location: index.php');
		exit();
	}
	$stmt = $pdo->query("SELECT * FROM basquetbolistas WHERE id = '$id'");//Tremos todo lo que corresponde 
	//al registro de la tabla
	$bas = $stmt->fetch(PDO::FETCH_ASSOC); //Hacemos un fethc assoc y leemos cada uno de los campos

	if(!$bas){
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
		<form action="editar_procesarB.php" method="POST">
			<input name="id"  type="hidden" value="<?=$bas['id']?>">
			<table>
				<tbody>
					<tr>
						<td><label>Nombre:</label></td><!--En cada una de estas cajas de texto mostramos lo que corresponde
						según el campo del registro, mostramos el nombre.-->
						<td><input name="nombre" type="text" value="<?=$bas['nombre']?>" required="required"></td>
					</tr>
					<tr>
						<td><label>Posicion:</label></td><!--Mostramos la posicion en la que juega la persona-->
						<td><input name="posicion" type="text" value="<?=$bas['posicion']?>" required="required"></td>
					</tr>
					<tr>
						<td><label>Carrera:</label></td><!--La carrera en la que está inscrito-->
						<td><input name="carrera" type="text" value="<?=$bas['carrera']?>" required="required"></td>
					</tr>
					<tr>
						<td><label>Email:</label></td><!--Y el email con el que cuenta-->
						<td><input name="email" type="text" value="<?=$bas['email']?>" required="required"></td>
					</tr>
					<tr>
						<td></td><!--Por ultimo tenemos los botones que se encargan de guardar(actualiza) y de cancelar,
						respectivamente-->
						<td><input id="btnEditar" name="editar" class="button" value="Guardar" type="submit">
							<a href="index.php" class="button" style="text-decoration: none; color: white;" type="submit">Cancelar</a></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>