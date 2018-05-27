<?php
//Esta es la clase de la conexión, nos permite contectarnos a la base de datos
//Solo necesitamos una sola conexión, no se realiza este archivo varias veces.
class Conexion{
	//Tenemos la funcion que nos conecta
	public function conectar(){
		//La variable link hace la conexión a través de los parámetros que se le dan
		//al PDO los cuales son nuestro host, el nombre de nuestra base de datos, nuestra contraseña y nuestro usuario.
		$link = new PDO("mysql:host=localhost;dbname=control_Tutorias","root","");
		//Esta función retorna la conexión
		return $link;
	}

}
?>
