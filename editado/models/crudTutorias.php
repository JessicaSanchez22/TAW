<?php
#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.
require_once "conexion.php";

//heredar la clase conexion de conexion.php para poder utilizar "Conexion" del archivo conexion.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del models/conexion.php:
class CrudTutorias extends Conexion{

	#REGISTRO DE USUARIOS
	#-------------------------------------
	public function registroTutoriaModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (alumno, tutor, fecha, hora, tipo, resumen) VALUES (:alumno, :tutor, :fecha, :hora, :tipo, :resumen)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":alumno", $datosModel["alumno"], PDO::PARAM_STR);
		$stmt->bindParam(":tutor", $datosModel["tutor"], PDO::PARAM_STR);
		$stmt->bindParam(":resumen", $datosModel["resumen"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	#VISTA USUARIOS
	#-------------------------------------

	public function vistaTutoriaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, alumno, tutor, fecha, hora, tipo, resumen FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#EDITAR USUARIO
	#-------------------------------------

	public function editarTutoriaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, alumno, tutor, fecha, hora, tipo, resumen FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#ACTUALIZAR USUARIO
	#-------------------------------------

	public function actualizarTutoriaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET alumno = :alumno, tutor = :tutor, fecha = :fecha, hora =:hora, tipo= :tipo, resumen = :resumen WHERE id = :id");

		$stmt->bindParam(":alumno", $datosModel["alumnoEditar"], PDO::PARAM_STR);
		$stmt->bindParam(":tutor", $datosModel["tutorEditar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosModel["fechaEditar"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datosModel["horaEditar"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel["tipoEditar"], PDO::PARAM_STR);
		$stmt->bindParam(":resumen", $datosModel["resumenEditar"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	#BORRAR ALUMNO
	#------------------------------------
	public function borrarTutoriaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			header("location:index.php?action=tutorias");
			return "success";
		}

		else{

			return "error";

		}

		$stmt->close();

	}

}

?>