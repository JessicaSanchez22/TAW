<?php
if(!$_SESSION["validar"]){
    echo "<script>window.location.href='index.php?action=ingresar'</script>";
    exit();
}
$vender = new ProductosController();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="card-title" style="display: inline-block;">Registrar venta</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Producto:</label>
                                    <select name="producto" class="form-control select2" style="width: 50%;">
                                        <?php
                                        $vender -> obtenerProductosController();
                                        ?>
                                    </select>
                                    <label>Cantidad: </label>
                                    <input type="number" name="cantidad" required style="width: 50%;">
                                </div>
                            </div>
                                <button type='submit' class='btn btn-primary' name="agregarP">Agregar producto</button>
                    
                        <?php //$registroV= new ProductosController();
                        $vender->registrarProductoVController();
                        ?>
                    <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <td>Id venta</td>
                                <td>Id producto</td>
                                <td>Codigo producto</td>
                                <td>Nombre Producto</td>
                                <td>Cantidad</td>
                            </tr>
                                
                            </thead>
                        <tbody>
                        <?php
                        $vender->vistaProdVController();
                        ?>
                        </tbody>
                    </table>

                    <label>Cliente:</label>
                    <select name="cliente" class="form-control select2" style="width: 50%;">
                        <?php
                        $vender -> obtenerClientesController();
                        ?>
                    </select>
                    </div>
                </div>
                  <button type="submit" class="btn btn-success" style="width: 150px;" name="guardar">Registrar Venta</button>                                       <!-- /.card-body -->
             </form>
                <?php
                //$venta=new ProductosController();
                $vender->registrarVentaController();
                ?>
            </div>
        </div>
    </section>
