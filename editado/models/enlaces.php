<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){

		if($enlaces == "ingresar" || $enlaces == "registro" || $enlaces == "editarMaestro" || $enlaces == "salir" || $enlaces=="registroMaestro" || $enlaces=="alumnos" || $enlaces=="registroAlumno"
			|| $enlaces == "editarAlumno" || $enlaces=="maestros"){

			$module =  "views/modules/".$enlaces.".php";
		
		}

		else if($enlaces == "okM"){
			echo "<h2>Bienvenido profesor!!</h2>";
			echo "<h3>Seleccione del menú de la barra de arriba a donde desea ir</h3>";
			$module = "views/modules/registroMaestro.php";
		
		}

		else if($enlaces == "index"){

			$module =  "views/modules/registroMaestro.php";
		
		}

		else if($enlaces == "ok"){

			$module =  "views/modules/registroMaestro.php";
		
		}

		else if($enlaces == "fallo"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($enlaces == "cambio"){

			$module =  "views/modules/usuarios.php";
		
		}

		else if($enlaces == "cambioA"){

			$module =  "views/modules/alumnos.php";
		
		}

		else if($enlaces == "cambioM"){

			$module =  "views/modules/maestros.php";
		
		}

		else{

			$module =  "views/modules/registro.php";

		}
		
		return $module;

	}

}

?>