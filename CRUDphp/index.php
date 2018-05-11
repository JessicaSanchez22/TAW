<?php
include 'dbdetails.php';
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
  <form method="POST">
    <div class="">
      <a href="create.php" class="button">Insertar nuevo usuario</a>
            <div class="row">
                <h3>Listado</h3>
            </div>
            <div class="large-9 columns">
              <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="250">Id</th>
                      <th width="250">Usuario</th>
                      <th width="250">Password</th>
                      <th width="250">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM usuarios ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['usuario'] . '</td>';
                            echo '<td>'. $row['password'] . '</td>';?>
                            <td><a href="read.php?id='.$row['id'].'" class="button radius tiny secondary">Ver detalles</a></td>
                            <td><a href="editar.php?id=<?=$r['id']?>">[EDITAR]</a></td>
                            <td><a style="color:red;" href="borrar.php?id=<?=$r['id']?>">[BORRAR]</a></td>
                            <?php echo '</tr>';

                   }
                   Database::disconnect();
                  ?>

                  </tbody>
            </table>
        </div>
      </section>
    </div>
  </div>
</div>
    <?php require_once('footer.php'); ?>
  </form>
  </body>
  
</html>