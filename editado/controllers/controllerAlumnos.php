<?php
class AlumnosController{

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
	public function registroAlumnoController(){

		if(isset($_POST["registrarAlumno"])){
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
			$datosController = array( "matricula"=>$_POST["matricula"],
									  "carrera"=>$_POST["carreraAlumno"], 
									  "nombre"=>$_POST["nombreAlumno"],
								      "tutor"=>$_POST["tutorAlumno"]);

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "maestros":
			$respuesta = CrudAlumnos::registroAlumnosModel($datosController, "alumnos");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=alumnos");

			}

			else{

				header("location:index.php");
			}

		}

	}



	

	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaAlumnosController(){

		$respuesta = CrudAlumnos::vistaAlumnosModel("alumnos");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["matricula"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["carrera"].'</td>
				<td>'.$item["tutor"].'</td>
				<td><a href="index.php?action=editarAlumno&id='.$item["matricula"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=alumnos&idBorrar='.$item["matricula"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarAlumnoController(){

		$datosController = $_GET["id"];
		$respuesta = CrudAlumnos::editarAlumnoModel($datosController, "alumnos");

		echo'<input type="hidden" value="'.$respuesta["matricula"].'" name="matriculaEditar">

			 <input type="text" value="'.$respuesta["nombre"].'" name="nombreEditar" required>

			 <input type="text" value="'.$respuesta["carrera"].'" name="carreraEditar" required>

			 <input type="text" value="'.$respuesta["tutor"].'" name="tutorEditar" required>

			 <input type="submit" value="Actualizar" name="alumnoEditar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarAlumnoController(){

		if(isset($_POST["alumnoEditar"])){

			$datosController = array( "matricula"=>$_POST["matriculaEditar"],
							          "nombre"=>$_POST["nombreEditar"],
				                      "carrera"=>$_POST["carreraEditar"],
				                      "tutor"=>$_POST["tutorEditar"]);
			
			$respuesta = CrudAlumnos::actualizarAlumnoModel($datosController, "alumnos");

			if($respuesta == "success"){

				header("location:index.php?action=cambioA");

			}

			else{

				echo "error";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarAlumnoController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta =CrudAlumnos::borrarAlumnoModel($datosController, "alumnos");

			if($respuesta == "sxss"){

				header("location:index.php?action=alumnos");
			
			}

		}

	}

}






////
?>