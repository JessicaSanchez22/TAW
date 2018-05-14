<?php 
//Se importa el archivo que contiene las configuraciones
//de la base de datos.
	include 'config.php';
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>practica6Ejercicio2</title><!--Para ver los estilos necesitamos conexion a internet.-->
 	<link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
 </head>
 <body>
 	<div>
 		<h1>Futbolistas</h1> <!--tenemos el botón de agregar nuevo para que este nos lleve a la paina
 		donde podemos agregar nuevos futbolistas-->
 		<button><a style="text-decoration: none; color:black;" class="button" href="agregarF.html">AGREGAR NUEVO</a></button>
 		<div class="row column">
		<div class="callout success">
 		<table width="100%">
 			<tr><!--Aqupi se empieza a listar la tabla que trajimos de la base de datos-->
 				<th>id</th>
 				<th>Nombre</th>
 				<th>Posicion</th>
 				<th>Carrera</th>
 				<th>Email</th>
 				<th>Acción</th>
 			</tr>
 			<?php 
 			$sql = 'SELECT * FROM futbolistas ORDER BY id ASC'; /*Seleccionamos todo de la tabla futbolistas
 			y lo odenamos por id de manera ascendente y mostramos cada uno de los registros
 			que tenemos en la tabla*/
                foreach ($pdo->query($sql) as $row) { ?>
				<tr> <!--Después en este foreach lo que se hace es que se obtiene cada registro
					y por cada registro va mostrando los campos en forma de tabla-->
					<td style="border: 1px solid black;"><?=$row['id']?></td>
					<td style="border: 1px solid black;"><?=$row['nombre']?></td>
					<td style="border: 1px solid black;"><?=$row['posicion']?></td>
					<td style="border: 1px solid black;"><?=$row['carrera']?></td>
					<td style="border: 1px solid black;"><?=$row['email']?></td>
					<td><a href="editarF.php?id=<?=$row['id']?>">[EDITAR]</a></td>
					<td><a style="color:red;" href="borrarF.php?id=<?=$row['id']?>" onclick="return confirm('¿Seguro que desea eliminar este registro?')">[BORRAR]</a></td>
				</tr>
 			<?php } ?>
 		</table>
 	</div>
 </div>
 	</div>

 	<div>
 		<h1>Basquetbolistas</h1> <!--Ahora pasamos a la seccion de basquetbolistas
 		que es practicamente lo mismo que la de futbolistas-->
 		<button><a style="text-decoration: none; color:black;" class="button" href="agregarB.html">AGREGAR NUEVO</a></button>
 		<div class="row column">
		<div class="callout success">
 		<table width="100%">
 			<tr> <!--Se lleva a cabo el mismo rprocedimiento anterior y se listan cada
 				una de las filas de la tabla que tenemos en nuestra base de datos-->
 				<th>id</th>
 				<th>Nombre</th>
 				<th>Posicion</th>
 				<th>Carrera</th>
 				<th>Email</th>
 				<th>Acción</th>
 			</tr>
 			<?php 
 			$sql = 'SELECT * FROM basquetbolistas ORDER BY id ASC'; /*Seleccionamos todo de la tabla y
 			comenzamos a listar de uno por uno los registros*/
                foreach ($pdo->query($sql) as $row) { ?>
				<tr>
					<td style="border: 1px solid black;"><?=$row['id']?></td>
					<td style="border: 1px solid black;"><?=$row['nombre']?></td>
					<td style="border: 1px solid black;"><?=$row['posicion']?></td>
					<td style="border: 1px solid black;"><?=$row['carrera']?></td>
					<td style="border: 1px solid black;"><?=$row['email']?></td>
					<td><a href="editarB.php?id=<?=$row['id']?>">[EDITAR]</a></td> <!--por medio del boton de editar
					toma el id del registro que se seleccionó y redirecciona a la pagina de editar para que el usuario
					pueda editar el registro que desea.-->
					<td><a style="color:red;" href="borrarB.php?id=<?=$row['id']?>" onclick="return confirm('¿Seguro que desea eliminar este registro?')">[BORRAR]</a></td>
				</tr>
 			<?php } ?>
 		</table>
 	</div>
 </div>
 	</div>

 </body>
 </html>