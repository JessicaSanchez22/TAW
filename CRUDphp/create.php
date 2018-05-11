<?php
     
    include 'dbdetails.php';
 
    if (!empty($_POST)) {
        $usuarioError = null;
        $passwordError = null;
         
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
         
        if (empty($usuario)) {
            $usuarioError = 'Please enter Name';
        }
         
        if (empty($password)) {
            $passwordError = 'Please enter Mobile Number';
        }
    }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
</head> 
<body>
  <?php require_once('header.php'); ?>
  <form method="POST" action="create.php">
    <div class="row">Agregar Usuario nuevo</div>
          <div class="large-9 columns">
          <div class="section-container tabs" data-section>
          <section class="section">
                      <label>Usuario</label>
                      <input name="usuario" type="text" required="required">
                    </div>
                    <div class="row">
                        <label>Password</label>
                        <input name="password" type="text" required="required">
                      </div>
                      <input type="submit" name="insert" value="Agregar" type="submit" onclick="insert();">
                          <a class="button" href="index.php">Volver</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>