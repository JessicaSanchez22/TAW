<?php
    //session_start();
	if(!$_SESSION["validar"]){
        echo "<script>window.location.href='index.php?action=ingresar';</script>";
		exit();
	}
    if (isset($_GET["idTienda"])) {
        $_SESSION["idTienda"] = $_GET["idTienda"];
    }
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="card-title" style="display: inline-block;">Productos</h3>
                        </div>
                        <a href="index.php?action=registro"><button type="button" class="btn btn-success" style="color: white;">
                            Agregar producto &nbsp&nbsp<i class="right fa fa-plus"></i></button></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Agregado</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $vistaProductos = new ProductosController();
                        $vistaProductos -> vistaProductosController();
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</section>
</div>