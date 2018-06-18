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
                            <h3 class="card-title" style="display: inline-block;">Registrar cliente</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  
                    <div class="box-body">
                        <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ingresa el nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Apellido</label>
                            <input type="text" name="apellido" class="form-control" placeholder="Ingresa el apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Ingresa el email" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Direccion</label>
                                <input type="text" name="direccion" class="form-control" placeholder="Ingrese la direccion" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="text" name="telefono" class="form-control" placeholder="Ingrese un telefono" required>
                            </div>
                        </div>
                        <?php if ($_SESSION["superadmin"]) {
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
                        ?>
                        <div>
                        	<button type='submit' class='btn btn-primary' name="registrarCliente">Registrar Cliente</button>
                   </form>
                   <?php
                        $registroC= new ProductosController();
                        $registroC -> registrarClienteController();
                    ?>


                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>