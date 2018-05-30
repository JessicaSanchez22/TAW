<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){

		if($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir" || $enlaces == "productos" || $enlaces == "registroProductos"){

			$module =  "views/modules/".$enlaces.".php";
		
		}

		else if($enlaces == "index"){

			$module =  "views/modules/registro.php";
		
		}

		else if($enlaces == "ok"){
			$module =  "views/modules/registro.php";
		}

		else if($enlaces == "yes"){

			$module =  "views/modules/productos.php";
		
		}


		else if($enlaces == "fallo"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($enlaces == "cambio"){

			$module =  "views/modules/usuarios.php";
		
		}

		else if($enlaces == "productos"){

			$module =  "views/modules/productos.php";
		
		}

		else{

			$module =  "views/modules/registro.php";

		}
		return $module;

	}

}

?>