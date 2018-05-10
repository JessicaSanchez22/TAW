<!DOCTYPE html>
<html>
<head>
	<title>Numeros</title>
</head>
<body>
	numero: 
	<?php 
	$numeros= array(1,2,3,4);
	$arrlen=count($numeros);
	for ($i=0; $i < $arrlen; $i++) { 
		if ($numeros[$i]==4) {
			echo $numeros[$i];
		}
	}
?>
</body>
</html>