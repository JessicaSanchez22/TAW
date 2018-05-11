<?
include 'dbdetails.php';

$id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

	if ($id === null || $id === false) {
		header('Location: index.php');
		exit();
	}

	$db = connect();
	$stmt = $db->prepare('SELECT * FROM usuarios WHERE id = :id');
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

	if(!$usuario){
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
</head> 
<body>
  <?php require_once('header.php'); ?>
  <form action="editar.php" method="POST">
			<input name="id"  type="hidden" value="<?=$usuarios['id']?>">
			<table>
				<tbody>
					<tr>
						<td><label>Usuario:</label></td>
						<td><input name="usuario" type="text" value="<?=$usuarios['usuario']?>" required="required"></td>
					</tr>
					<tr>
						<td><label>Password:</label></td>
						<td><input  name="password" type="text" value="<?=$usuarios['password']?>" required="required"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>