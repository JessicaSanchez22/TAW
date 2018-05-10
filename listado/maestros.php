<?php
include_once('utilitiesMaestros.php');

$total_users = count($user_access);
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
    <a href="#" class="button" name="agregarMaestros" onclick="document.getElementById('ocultoMaestros').style.display='block', document.getElementById('listadoMaestros').style.display='none'">Agregar maestros</a> 
    <a href="#" class="button" name="listadoAlumnos" onclick="document.getElementById('listadoMaestros').style.display='block', document.getElementById('ocultoMaestros').style.display='none'">Listado de maestros</a> 
   
    </form>
</div>
<div class="row" id="listadoMaestros" style="display: block;">
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
                  <tr>
                  	<th width="250">ID</th>
                    <th width="200">No. de empleado</th>
                    <th width="250">Nombre</th>
                    <th width="250">Correo</th>
                    <th width="250">Carrera</th>
                    <th width="250">Telefono</th>
                    <th width="250">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $user_access as $id => $user ){ ?>
                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $user['noempleado'] ?></td>
                    <td><?php echo $user['nombre'] ?></td>
                    <td><?php echo $user['carrera'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['telefono'] ?></td>
                    <td><a href="./keyMaestros.php?id=<?php echo $id; ?>" class="button radius tiny secondary">Ver detalles</a></td>
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

 <div class="row" id="ocultoMaestros" style="display: none">
      <form method="post" name="formulario">
      No. de empleado: <input type="text" name="noempleado" id="noempleado">
      <br />
      Nombre del maestro:<input type="text" name="nombre" id="nombre">
      <br />
      Carrera: <input type="text" name="carrera" id="carrera">
      <br />
      Email: <input type="text" name="email" id="email">
      <br />
      Telefono: <input type="text" name="telefono" id="telefono">
      <br />
      <input type="submit" value="GUARDAR DATOS">
      <input type="reset">
    </form>
  </div>

	
<?php
	//SI EL BOTON PRESIONADO ES ALUMNO SE GUARDA EN alumnos.txt
		$noempleado="";
		if (!empty($_REQUEST['noempleado'])){
		$matricula=$_REQUEST['noempleado'];
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

		$archivo = "maestros.txt";//creamos un archivo llamado 'alumnos' en este archivo se guardarán todos los registros de los alumnos que se hayan ingresado

		$file=fopen($archivo,"a");
    	fwrite($file,$noempleado." ".$nombre." ".$carrera." ".$email." ".$telefono."\n");

		fclose($file);
?>
   	</div>
    <?php require_once('footer.php'); ?>
</body>
</html>
