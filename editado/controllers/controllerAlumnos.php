<?php
//Esta clase permite utilizar todos los métodos
//que hacen posible la conexión entre la vista y el modelo.
class AlumnosController{
	//Función que nos muestra el template principal
	public function pagina(){	
		include "views/template.php";
	}


	#ENLACES
	#-------------------------------------
	//Función que obtiene los enlaces de una página a otra, según se mueva el usuario
	//a través de la aplicación
	public function enlacesPaginasController(){
		//Obtiene el "action" del link que se le pasa en el url
		//y a partir de este llama a la página que se solicitó
		if(isset( $_GET['action'])){
			//Se obtiene el enlace al que desea llegar el usuario
			$enlaces = $_GET['action'];
		}

		else{
			//En caso de que no se obtenga un enlace correcto, se devuelve al
			//usuario al inicio a través de la llamada del idex.
			$enlaces = "index";
		}

		//Se llama a la función del modelo que nos llevará a la página que deseamos llegar
		//Y se incluye la respuesta en la página
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		//Esto nos sirve para poder ver y utilizar el archivo que deseamos.
		include $respuesta;

	}


	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroAlumnoController(){

		if(isset($_POST["registrarAlumno"])){
			//Recibe a traves del método POST el name (html) de alumno, su matricula, su nombre, tutor, etc., se almacenan los datos en una variable de tipo array con sus respectivas propiedades para utilizarla más tarde
			$datosController = array( "matricula"=>$_POST["matricula"],
									  "carrera"=>$_POST["carreraAlumno"], 
									  "nombre"=>$_POST["nombreAlumno"],
								      "tutor"=>$_POST["tutorAlumno"]);

			//Se le dice al modelo models/crudAlumnos.php (CrudAlumnos::registroAlumnosModel),que en la clase "CrudAlumnos", la funcion "registroAlumnosModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "alumnos":
			$respuesta = CrudAlumnos::registroAlumnosModel($datosController, "alumnos");

			//Se muestra la vista, si la respuesta fue exitosa
			if($respuesta == "success"){

				header("location:index.php?action=alumnos");

			}
			//Si la respuesta no fue exitosa, se lleva al inicio
			else{

				header("location:index.php");
			}

		}

	}


	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaAlumnosController(){
		/*Este método permite mostrarle al usuario, los registros contenidos en la base de 
		datos que queremos mostrar, que en este caso es la de alumnos*/

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