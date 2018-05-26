<?php
class CarrerasController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}


	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroCarreraController(){

		if(isset($_POST["registrarCarrera"])){
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
			$datosController =  array('nombre' => $_POST["nombreCarrera"]);

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "maestros":
			$respuesta = CrudCarreras::registroCarreraModel($datosController, "carreras");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=carreras");

			}

			else{

				header("location:index.php");
			}

		}

	}

	#VISTA DE CARRERAS
	#------------------------------------

	public function vistaCarreraController(){

		$respuesta = CrudCarreras::vistaCarreraModel("carreras");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["nombre"].'</td>
				<td><a href="index.php?action=editarCarrera&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=carrera&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarCarreraController(){

		$datosController = $_GET["id"];
		$respuesta = CrudCarreras::editarCarreraModel($datosController, "carreras");

		echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["nombre"].'" name="nombreEditar" required>

			 <input type="submit" value="Actualizar" name="carreraEditar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarCarreraController(){

		if(isset($_POST["carreraEditar"])){

			$datosController = array( "id"=>$_POST["idEditar"],
							          "nombre"=>$_POST["nombreEditar"]);
			
			$respuesta = CrudCarreras::actualizarCarreraModel($datosController, "carreras");

			if($respuesta == "success"){

				header("location:index.php?action=cambioC");

			}

			else{

				echo "error";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarCarreraController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = CrudCarreras::borrarCarreraModel($datosController, "carreras");

			if($respuesta == "sxss"){

				header("location:index.php?action=carreras");
			
			}

		}

	}

}
////
?>