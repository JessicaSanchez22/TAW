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
                            <h3 class="card-title" style="display: inline-block;">Registrar producto</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  
                    <div class="box-body">
                        <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="nombre">Código</label>
                            <input type="text" name="codigo" class="form-control" placeholder="Ingresa el codigo" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ingresa el nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Precio</label>
                            <input type="text" name="precio" class="form-control" placeholder="Ingresa el precio" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Stock</label>
                            <input type="text" name="stock" class="form-control" placeholder="Ingresa una cantidad de stock" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="categoria" class="form-control select2" style="width: 100%;">
                                    <?php
                                    $categorias = new ProductosController();
                                    $categorias -> obtenerCategoriaController();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div>
                        	<button type='submit' class='btn btn-primary' name="registrarProducto">Registrar producto</button>
                   </form>
                   <?php
                        $registroP= new ProductosController();
                        $registroP -> registrarProductoController();
                    ?>


                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>