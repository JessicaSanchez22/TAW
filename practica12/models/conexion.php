<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=inventario","root","123456");
		return $link;

	}

}
?>
