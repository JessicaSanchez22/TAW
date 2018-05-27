<?php
class TutoriasController{

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
	public function registroTutoriaController(){

		if(isset($_POST["registrarTutoria"])){
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
			$datosController = array( "alumno"=>$_POST["alumno"],
									  "tutor"=>$_POST["tutor"], 
									  "fecha"=>$_POST["fecha"],
								      "hora"=>$_POST["hora"],
								      "tipo"=>$_POST["tipo"],
								      "resumen"=>$_POST["resumen"]);

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "maestros":
			$respuesta = CrudTutorias::registroTutoriaModel($datosController, "tutorias");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=tutorias");

			}

			else{

				header("location:index.php");
			}

		}

	}


	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaTutoriaController(){

		$respuesta = CrudTutorias::vistaTutoriaModel("tutorias");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["alumno"].'</td>
				<td>'.$item["tutor"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>'.$item["hora"].'</td>
				<td>'.$item["tipo"].'</td>
				<td>'.$item["resumen"].'</td>
				<td><a href="index.php?action=editarTutoria&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=tutorias&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarTutoriaController(){
		$datosController = $_GET["id"];
		$respuesta = CrudTutorias::editarTutoriaModel($datosController, "tutorias");

		echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["alumno"].'" name="alumnoEditar" required>

			 <input type="text" value="'.$respuesta["tutor"].'" name="tutorEditar" required>

			 <input type="text" value="'.$respuesta["fecha"].'" name="fechaEditar" required>

			 <input type="text" value="'.$respuesta["hora"].'" name="horaEditar" required>

			 <input type="text" value="'.$respuesta["tipo"].'" name="tipoEditar" required>

			 <input type="text" value="'.$respuesta["resumen"].'" name="resumenEditar" required>

			 <input type="submit" value="Actualizar" name="tutoriaEditar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarTutoriaController(){

		if(isset($_POST["tutoriaEditar"])){

			$datosController = array( "id"=>$_POST["idEditar"],
							          "alumno"=>$_POST["alumnoEditar"],
				                      "tutor"=>$_POST["tutorEditar"],
				                  	  "fecha"=>$_POST["fechaEditar"],
							          "hora"=>$_POST["horaEditar"],
				                      "tipo"=>$_POST["tipoEditar"],
				                      "resumen"=>$_POST["resumenEditar"]);
			
			$respuesta = CrudTutorias::actualizarTutoriaModel($datosController, "tutorias");

			if($respuesta == "success"){

				header("location:index.php?action=cambioT");

			}

			else{

				echo "error";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarTutoriaController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta =CrudTutorias::borrarTutoriaModel($datosController, "tutorias");

			if($respuesta == "sxss"){

				header("location:index.php?action=tutorias");
			
			}

		}

	}

}
////
?>