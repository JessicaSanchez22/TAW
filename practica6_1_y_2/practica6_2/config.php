<?php
/*En este archivo se encuentran las configuraciones que se hacen
para podernos conectar a la base de datos y a las tablas que tiene la base
de datos para así poder manipuar los registros*/
$dsn = 'mysql:dbname=deportes;host=localhost'; /*Pasamos el nombre de la base de datos
y el host que en este caso sería localhost. Si no funciona con localhost tambien podemos
usar nuestra dirección ip local.*/
$user = 'root'; //Ponemos el usuario de la base de datos
$password = '';//y la contraseña que utilizamos para entrar

try{ //Ejecutamos la conexión 
	$pdo = new PDO(	$dsn, 
					$user, 
					$password
					);

}catch( PDOException $e ){ //Y si no se puede conectar esto nos lanzará un error.
	echo 'Error al conectarnos: ' . $e->getMessage();
}