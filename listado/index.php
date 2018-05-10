<?php
include_once('utilities.php');

$total_users = count($user_access);

//CABE RECALCAR QUE A VECES, NO SE POR QUE PERO COMO QUE NO RECONOCE LOS DATOS
//PERO ESO SE ARREGLA RECARGANDO LA PAGINA :)
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formularios y listas PHP</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    <?php require_once('header.php'); ?>
    <div class="row">
    <h2>MANEJO DE ARCHIVOS Y ARRAYS CON PHP</h2>
    <!--uso de los dos botones que nos llevaran a las diferentes funciones segun sea el caso que escojamos-->
    	<a href="alumnos.php" class="button"> VER ALUMNOS</a>
    	<a href="maestros.php" class="button"> VER MAESTROS</a>
    <?php require_once('footer.php'); ?>
</div>
</body>
</html>
