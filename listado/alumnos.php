<?php
include_once('utilities.php'); //Se importa el archivo de utilities que nos ayudará a imprimir los registros mas adelante

$total_users = count($user_access); //Se cuenta el numero de usuarios que se tienen
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Alumnos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    <?php require_once('header.php'); ?>
<div class="row">
	<form method="post">
    <!--Aquí se crean los botones que nos llevan a cada una de las partes de nuestro sistema-->
    <a href="#" class="button" name="agregarAlumnos" onclick="document.getElementById('ocultoAlumnos').style.display='block', document.getElementById('listadoAlumnos').style.display='none'">Agregar alumnos</a> 
    <a href="#" class="button" name="listadoAlumnos" onclick="document.getElementById('listadoAlumnos').style.display='block', document.getElementById('ocultoAlumnos').style.display='none'">Listado de alumnos</a> 
   
    </form>
</div>
<div class="row" id="listadoAlumnos" style="display: block;">
      <div class="large-9 columns">
          <p>Listado de alumnos</p>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php if($total_users){ ?>
              <table>
                <thead>
                  <tr> <!--Aquí se van imprimiendo la lista de alumnos que existe-->
                  	<th width="250">ID</th>
                    <th width="200">Matricula</th>
                    <th width="250">Nombre</th>
                    <th width="250">Carrera</th>
                    <th width="250">Email</th>
                    <th width="250">Telefono</th>
                    <th width="250">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $user_access as $id => $user ){ ?>
                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $user['matricula'] ?></td>
                    <td><?php echo $user['nombre'] ?></td>
                    <td><?php echo $user['carrera'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['telefono'] ?></td>
                    <td><a href="./key.php?id=<?php echo $id; ?>" class="button radius tiny secondary">Ver detalles</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="4"><b>Total de registros: </b> <?php echo $total_users; ?></td>
                  </tr>
                </tbody>
              </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>
            </div>
          </section>
        </div>
      </div>
  </div>
  <!--div que nos permite registrar un nuevo alumno-->
    <div class="row" id="ocultoAlumnos" style="display: none">
    	<form method="post" name="formulario">
    		Matricula:<input type="text" name="matricula" id="matricula">
			<br />
			Nombre:<input type="text" name="nombre" id="nombre">
			<br />
			Carrera:<input type="text" name="carrera" id="carrera">
			<br />
			Email: <input type="text" name="email" id="email">
			<br />
			Telefono: <input type="text" name="telefono" id="telefono">
			<br />
			<input type="submit" value="GUARDAR DATOS">
			<input type="reset">

	
<?php
	 //El archivo seleccionado es alumnos.txt ya que estamos en la sección de alumnos
		$matricula="";
		if (!empty($_REQUEST['matricula'])){
		$matricula=$_REQUEST['matricula'];
		}

		$nombre="";
		if (!empty($_REQUEST['nombre'])){
		$nombre=$_REQUEST['nombre'];
		}

		$carrera="";
		if (!empty($_REQUEST['carrera'])){
		$pais=$_REQUEST['carrera'];
		}
		 
		$email="";
		if (!empty($_REQUEST['email'])){
		$email=$_REQUEST['email'];
		}
		 
		$telefono="";
		if (!empty($_REQUEST['telefono'])){
		$telefono=$_REQUEST['telefono'];
		}

		$archivo = "alumnos.txt";//creamos un archivo llamado 'alumnos' en este archivo se guardarán todos los registros de los alumnos que se hayan ingresado

		$file=fopen($archivo,"a"); //Se abre el archivo
    	fwrite($file,$matricula." ".$nombre." ".$carrera." ".$email." ".$telefono."\n"); //Se escribe en el archivo con un salto de linea en cada alumno ingresado

		fclose($file); //Se cierra el archivo
?>
   	</div>
    <?php require_once('footer.php'); ?>
</body>
</html>
