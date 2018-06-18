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
                            <h3 class="card-title" style="display: inline-block;">Registrar categoría</h3>
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
                              <label for='apellido'>Descripcion</label>
                              <input type='text' name='descripcion' class='form-control' id='exampleInputEmail1' placeholder='descripcion'>
                          </div>
                          <?php

            $regis= new ProductosController();
            $regis -> registrarCategoriaController();

            ?>
                          
                      </div>
                          <button type='submit' class='btn btn-primary' name='registrarCategoria'>Registrar  categoria</button>
                  </form>
                  
            

                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>




