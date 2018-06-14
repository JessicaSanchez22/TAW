<?php
//session_start();
if(!$_SESSION["validar"]){
    //header("location:index.php?action=ingresar");
    echo "<script>window.location.href='index.php?action=ingresar';</script>";
    exit();
}
$idP = $_GET["idProducto"];

$producto = CrudProductos::obtenerProductModel("productos", $idP);

?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 100px 300px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="card-title" style="display: inline-block;">Agregar elementos al Stock</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" >
                    <div class="row">
                        <div style="display: inline-block; float: left;">
                            <p style="font-size: 20px;">Codigo: <?php echo $producto["codigo_producto"]?></p>
                            <p style=" font-size: 20px;">Nombre: <?php echo $producto["nombre"]?></p>
                            <p style="font-size: 20px;">Fecha agregado: <?php echo $producto["date_added"]?></p>
                            <p style="font-size: 20px;">Precio: <?php echo $producto["precio_producto"]?></p>
                            <p style="font-size: 20px;">Stock actual: <?php echo $producto["cantidad_stock"]?></p>

                        </div>
                         <img src="views/modules/box.png" width="100px" height="100px" style="display: inline-block; float: left; margin: 5px">
                    </div>
                    <div>
                        <form method='post' role='form'>
                            <input name="idP" type="hidden" value="<?php echo $idP?>">
                            <button class="btn btn-info">Agregar stock</button>
                            <input name="agregarStock" type="text" required>
                        </form>
                        <?php
                        $vistaStock = new ProductosController();
                        $vistaStock -> agregarStockController();
                        //$vistaUsuario -> borrarUsuarioController();
                        ?>
                        <br>
                        <form method='post' role='form'>
                            <input name="idP" type="hidden" value="<?php echo $idP?>">
                            <button class="btn btn-danger">Eliminar Stock</button>
                            <input name="eliminarStock" type="text" required>
                        </form>
                        <?php
                        $vistaStock -> eliminarStockController();
                        ?>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>