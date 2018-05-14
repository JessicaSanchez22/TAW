<?php
  require_once('connection.php');
  $sql = 'SELECT * FROM user';
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $results = $statement->fetchAll();

  //Contador del total de usuarios que existen
  $sql='SELECT count(*) as totalUsuarios FROM user;';
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $results = $statement->fetchAll();
  $totalUsuarios= $results[0]['totalUsuarios'];

  //Cuenta todos los usuarios que están logeados (accesos).
  $sql='SELECT count(*) as totalLog FROM user_log;';
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $results = $statement->fetchAll();
  $totalLog= $results[0]['totalLog'];

  //Cuenta la cantidad de status que existen.
  $sql='SELECT count(*) as totalStatus FROM status;';
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $results = $statement->fetchAll();
  $totalStatus= $results[0]['totalStatus'];

  //Calcula los usuarios inactivos.
  $sql='SELECT count(*) as totalInac FROM user WHERE status_id=2';
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $results = $statement->fetchAll();
  $totalInac= $results[0]['totalInac'];

   //Cuenta la cantidad de tipos de usuario que existen.
  $sql='SELECT count(*) as totalTypes FROM user_type;';
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $results = $statement->fetchAll();
  $totalTypes= $results[0]['totalTypes'];

   //Calcula los usuarios activos.
  $sql='SELECT count(*) as totalAc FROM user WHERE status_id=1';
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $results = $statement->fetchAll();
  $totalAc= $results[0]['totalAc'];


?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>PHP & SQL</title>
<link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
</head>
<body>
 
<div class="top-bar">
<div class="top-bar-left">
<ul class="menu">
<li class="menu-text">Curso PHP & SQL</li>
</ul>
</div>
</div>
 
<div class="row column text-center">
<h2>Contando datos</h2>
<hr>
</div>
<div class="row column">
<div class="callout success">
<h3>Totales</h3>
<table width="100%">
  <thead>
    <tr>
      <th>Usuarios</th>
      <th>Tipos</th>
      <th>Status</th>
      <th>Accesos</th>
      <th>Usuarios Activos</th>
      <th>Usuarios Inactivos</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $totalUsuarios; ?></td>
      <td><?php echo $totalTypes; ?></td>
      <td><?php echo $totalStatus; ?></td>
      <td><?php echo $totalLog; ?></td>
      <td><?php echo $totalAc; ?></td>
      <td><?php echo $totalInac; ?></td>
    </tr>
  </tbody>
</table>
</div>
<div>
</div>
</div>
<div class="row column">
<div class="callout success">
  <h5>Tabla usuarios</h5>
   <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="250">Id</th>
                      <th width="250">Email</th>
                      <th width="250">Password</th>
                      <th width="250">Status_id</th>
                      <th width="250">user_type_id</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $sql = 'SELECT * FROM user ORDER BY id ASC';
                   foreach ($pdo->query($sql) as $row) {
                      echo '<tr>';
                      echo '<td>'. $row['id'] . '</td>';
                      echo '<td>'. $row['email'] . '</td>';
                      echo '<td>'. $row['password'] . '</td>';
                      echo '<td>'. $row['status_id'] . '</td>';
                      echo '<td>'. $row['user_type_id'] . '</td>';
                      ?>
                      <?php echo '</tr>';
                   }
                  ?>
                  </tbody>
            </table>
</div>
</div>
</div>
<div class="row column">
<div class="callout success">
<div>
  <h5>Tabla Status</h5>
   <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="250">Id</th>
                      <th width="250">Name</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $sql = 'SELECT * FROM status ORDER BY id ASC';
                   foreach ($pdo->query($sql) as $row) {
                      echo '<tr>';
                      echo '<td>'. $row['id'] . '</td>';
                      echo '<td>'. $row['name'] . '</td>';
                      ?>
                      <?php echo '</tr>';
                   }
                  ?>
                  </tbody>
            </table>
</div>
</div>
</div>
<div class="row column">
<div class="callout success">
<div>
  <h5>Tabla User_Log</h5>
   <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="250">Id</th>
                      <th width="250">date_logged_in</th>
                      <th width="250">user_id</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $sql = 'SELECT * FROM user_log ORDER BY id ASC';
                   foreach ($pdo->query($sql) as $row) {
                      echo '<tr>';
                      echo '<td>'. $row['id'] . '</td>';
                      echo '<td>'. $row['date_logged_in'] . '</td>';
                      echo '<td>'. $row['user_id'] . '</td>';
                      echo '</tr>';
                   }
                  ?>
                  </tbody>
            </table>
</div>
</div>
</div>
<div class="row column">
<div class="callout success">
<div>
  <h5>Tabla User_Type</h5>
   <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="250">Id</th>
                      <th width="250">name</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $sql = 'SELECT * FROM user_type ORDER BY id ASC';
                   foreach ($pdo->query($sql) as $row) {
                      echo '<tr>';
                      echo '<td>'. $row['id'] . '</td>';
                      echo '<td>'. $row['name'] . '</td>';
                      echo '</tr>';
                   }
                  ?>
                  </tbody>
            </table>
</div>
</div>
</div>
<hr>

</div>
<div class="large-3 large-offset-2 columns">
</div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>
      $(document).foundation();
    </script>
</body>
</html>
