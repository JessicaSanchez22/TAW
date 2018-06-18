<?php
if(!$_SESSION["validar"]){
    echo "<script>window.location.href='index.php?action=ingresar'</script>";
    exit();
}

?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="card-title" style="display: inline-block;">Registrar usuario</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
            <form method='post' role='form'>
                      <div class='box-body'>
                          <div class='form-group'>
                            <input type='hidden' value='nombre' name='idEditar'>
                              <label for='nombre'>Nombre</label>
                              <input type='text' name='nombre' class='form-control' id='exampleInputEmail1' placeholder='nombre'>
                          </div>
                          <div class='form-group'>
                              <label for='apellido'>Apellido</label>
                              <input type='text' name='apellido' class='form-control' id='exampleInputEmail1' placeholder='apellido'>
                          </div>
                          <div class='form-group'>
                              <label for='usuario'>Nombre de usuario</label>
                              <input type='text' name='usuario' class='form-control' id='exampleInputEmail1' placeholder='usuario'>
                          </div>

                          <div class='form-group'>
                              <label for='correo'>Correo electronico</label>
                              <input type='text' name='correo' class='form-control' id='exampleInputEmail1' placeholder='correo'>
                          </div>

                          <div class='form-group'>
                              <label for='password'>Password</label>
                              <input type='password' name='password' class='form-control' id='exampleInputEmail1' placeholder='contraseña'>
                          </div>
                          <?php
                          if ($_SESSION["superadmin"]){
                              echo "<div class='form-group'>
                              <label>Superadmin (1 Sí, 0 No)</label>
                              <input type='text' name='superadmin' class='form-control'  placeholder='superadmin'>
                          </div>";
                          }

                          if ($_SESSION["superadmin"]) {
                            echo "<div class='form-group'>
                            <div class='form-group'>
                                <label>Tienda</label>
                                <select name='tienda' class='form-control select2' style='width: 100%;'>";
                                    $tiendas = new ProductosController();
                                    $tiendas -> obtenerTiendasController();
                                    echo "
                                </select>
                            </div>
                        </div>";
                        }
                          $regis= new ProductosController();
                          $regis -> registrarUsuarioController();

                          ?>
                          
                      </div>
                          <button type='submit' class='btn btn-primary' name='registrarUsuario'>Registrar  usuario</button>
                  </form>

            

                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>




