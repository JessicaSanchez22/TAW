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
                              <label for='apellido'>Nombre de usuario</label>
                              <input type='text' name='usuario' class='form-control' id='exampleInputEmail1' placeholder='usuario'>
                          </div>

                          <div class='form-group'>
                              <label for='apellido'>Correo electronico</label>
                              <input type='text' name='correo' class='form-control' id='exampleInputEmail1' placeholder='correo'>
                          </div>

                          <div class='form-group'>
                              <label for='apellido'>Password</label>
                              <input type='password' name='password' class='form-control' id='exampleInputEmail1' placeholder='contraseña'>
                          </div>
                          <?php

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




