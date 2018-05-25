<?php
class MaestrosController{

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
	public function registroMaestroController(){

		if(isset($_POST["registrarMaestro"])){
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
			$datosController = array( "noempleado"=>$_POST["noempleado"],
									  "carrera"=>$_POST["carreraMaestro"], 
									  "nombre"=>$_POST["nombreMaestro"],
								      "password"=>$_POST["passwordMaestro"],
								      "email"=>$_POST["emailMaestro"]);

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "maestros":
			$respuesta = CrudMaestros::registroMaestrosModel($datosController, "maestros");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=maestros");

			}

			else{

				header("location:index.php");
			}

		}

	}



	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array( "nombre"=>$_POST["maestroIngreso"], 
								      "password"=>$_POST["passwordIngreso"]);

			$respuesta = CrudMaestros::ingresoUsuarioModel($datosController, "maestros");
			//Valiación de la respuesta del modelo para ver si es un usuario correcto.
			if($respuesta["nombre"] == $_POST["maestroIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

				session_start();

				$_SESSION["validar"] = true;

				header("location:index.php?action=okM");

			}

			else{

				header("location:index.php?action=fallo");

			}

		}	

	}

	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaMaestrosController(){

		$respuesta = CrudMaestros::vistaMaestrosModel("maestros");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["no_empleado"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["carrera"].'</td>
				<td>'.$item["email"].'</td>
				<td>'.$item["password"].'</td>
				<td><a href="index.php?action=editarMaestro&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=maestros&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarMaestroController(){

		$datosController = $_GET["id"];
		$respuesta = CrudMaestros::editarMaestroModel($datosController, "maestros");

		echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["no_empleado"].'" name="noempleadoEditar" required>

			 <input type="text" value="'.$respuesta["nombre"].'" name="nombreEditar" required>

			 <input type="text" value="'.$respuesta["carrera"].'" name="carreraEditar" required>

			 <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

			 <input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>

			 <input type="submit" value="Actualizar" name="maestroEditar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarMaestroController(){

		if(isset($_POST["maestroEditar"])){

			$datosController = array( 
							          "nombre"=>$_POST["nombreEditar"],
							          "carrera"=>$_POST["carreraEditar"],
				                      "password"=>$_POST["passwordEditar"],
				                      "email"=>$_POST["emailEditar"]);
			
			$respuesta = CrudMaestros::actualizarMaestroModel($datosController, "maestros");

			if($respuesta == "success"){

				header("location:index.php?action=cambioM");

			}

			else{

				echo "error";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarMaestroController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = CrudMaestros::borrarMaestroModel($datosController, "maestros");

			if($respuesta == "sxss"){

				header("location:index.php?action=maestros");
			
			}

		}

	}

}






////
?>