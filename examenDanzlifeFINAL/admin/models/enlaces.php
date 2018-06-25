<?php 
class Paginas{
	
	public static function enlacesPaginasModel($link){

		if($link == "lugares" || $link == "ingresar" || $link=="salir"
		|| $link=="grupos" || $link=="registrarGrupo" || $link=="alumnas" || $link=="registrarAlumna"
		|| $link=="editarAlumna" || $link=="editarGrupo" ||$link=="verImagen"){

			$module =  "views/modules/".$link.".php";

		}else if ($link=="index") {
			$module =  "views/modules/ingresar.php";
		}else{

			$module =  "views/modules/404.html";

		}
		return $module;

	}

}

?>