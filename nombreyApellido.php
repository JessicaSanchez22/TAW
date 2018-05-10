<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	Nombre completo: <br\>
	<?php
		$nombre1=array('nombre'=>'Mario' , 'apellido'=>'Rodriguez');
		$nombre2=array('nombre'=>'Guadalupe');

		echo $nombre2['nombre']. ' ' . $nombre1['apellido']; 
	?>

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
