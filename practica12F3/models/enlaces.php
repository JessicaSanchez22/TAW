<?php 

class Paginas{
	
	public static function enlacesPaginasModel($link){

		if($link == "ingresar" || $link == "inventario" || $link == "editar" || $link == "salir" || $link == "dashboard"
            || $link == "usuarios" || $link == "categorias" || $link == "editarUsuario" || $link=="registroCategoria"
            || $link=="registro" || $link=="editarProducto" || $link=="editarCategoria" || $link=="borrarCategoria"
            || $link=="registroUsuario" || $link=="borrarProducto" || $link=="borrarUsuario" ||$link=="agregarStock"
            || $link=="tiendas" || $link=="registrarTienda" || $link=="editarTienda" || $link=="borrarTienda"
            || $link=="ventas"|| $link=="vender"){

			$module =  "views/modules/".$link.".php";
		
		}

		else if($link == "index"){

			$module =  "views/modules/registro.php";
		
		}

		else if($link == "ok"){

			$module =  "views/modules/registro.php";
		
		}

		else if($link == "fallo"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($link == "cambioU"){ //Hubo un cabio en los usuarios

			$module =  "views/modules/usuarios.php";
		
		}

		else if($link == "cambioP"){ //Hubo un cambio en los productos

			$module =  "views/modules/inventario.php";
		
		}

		else if($link == "cambioC"){ //Hubo un cambio en as categorias

			$module =  "views/modules/categorias.php";
		
		}

		else{

			$module =  "views/modules/404.html";

		}
		return $module;

	}

}

?>