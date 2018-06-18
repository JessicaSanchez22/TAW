<?php
//session_start();
if(!$_SESSION["validar"]){
    echo "<script>window.location.href='index.php?action=ingresar';</script>";
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
                            <h3 class="card-title" style="display: inline-block;">Ventas</h3>
                        </div>
                        <a href="index.php?action=vender"><button type="button" class="btn btn-success" style="color: white;">
                                Vender &nbsp&nbsp<i class="right fa fa-plus"></i></button></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped"  name="datos">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total venta</th>
                            <th>Id Tienda</th>
                            <th>Id Cliente</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $vistaVentas = new ProductosController();
                        $vistaVentas -> vistaVentasController();
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</section>
</div>