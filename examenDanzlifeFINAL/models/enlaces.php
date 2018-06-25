<?php 
class Paginas{
	
	public static function enlacesPaginasModel($link){

		if($link == "inicio" || $link == "lugares" || $link == "ingresar"){

			$module =  "views/modules/".$link.".php";
		
		}else{

			$module =  "views/modules/404.html";

		}
		return $module;

	}

}

?>