<?php
/*Este archivo permite la conexión a la base de datos
sin este archivo no ocurriría ninguna petición
ni registro*/
$dsn = 'mysql:dbname=tienda;host=localhost';
$user = 'root';
$password = '';

try{
	$pdo = new PDO(	$dsn, 
					$user, 
					$password
					); //Se crea el objeto pdo con el que haremos las conexiones

}catch( PDOException $e ){
	echo 'Error al conectarnos: ' . $e->getMessage();
	//si ocurrió algún error, nviamos un mensaje
}
?>
