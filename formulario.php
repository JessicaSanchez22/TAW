<?php
	$nombre = filter_input(INPUT_GET, "nombre"); 
	$email = filter_input(INPUT_GET, "email");
	$website = filter_input(INPUT_GET, "website"); 
	$comentario = filter_input(INPUT_GET, "comentario");
	$sexo = filter_input(INPUT_GET, 'sexo');
	$nameErr = filter_input(INPUT_GET, 'nameErr');
	$emailErr = filter_input(INPUT_GET, 'emailErr');
	$genderErr = filter_input(INPUT_GET, 'genderErr');
	$websiteErr = filter_input(INPUT_GET, 'websiteErr');
?>
<html>
<head>
    <title>Formulario y php</title>
</head>
	
<body>
	<h2>Validación de un form en PHP</h2>
<p><span class="error">Los campos marcados con * son campos requeridos.</span></p>
<form method="post" action="procesar.php">
    Nombre: <input type="text" name="name" value="">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    Correo electrónico: <input type="text" name="email" value="">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Website: <input type="text" name="website" value="">
    <span class="error"><?php echo $websiteErr;?></span>
    <br><br>
    Comentario: <textarea name="comment" rows="5" cols="40"><?php echo $comentario;?></textarea>
    <br><br>
    Sexo:
    <input type="radio" name="gender" <?php if (isset($sexo) && $sexo=="female") echo "checked";?> value="female">Femenino
    <input type="radio" name="gender" <?php if (isset($sexo) && $sexo=="male") echo "checked";?> value="male">Masculino
    <span class="error">* <?php echo $genderErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $nombre;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comentario;
echo "<br>";
echo $sexo;

?>

	<ul>
	    <li><a href="#">Volver al Inicio</a></li>
	</ul>
</body>
</html>