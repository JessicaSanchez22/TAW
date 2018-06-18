<?php
if(!$_SESSION["validar"]){
    //header("location:index.php?action=ingresar");
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
                            <h3 class="card-title" style="display: inline-block;">Clientes</h3>
                        </div>
                        <a href="index.php?action=registroClientes"><button type="button" class="btn btn-success" name="agregarCliente">
                            Agregar cliente &nbsp&nbsp<i class="right fa fa-plus"></i></button></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Agregado el</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $vistaUsuario = new ProductosController();
                        $vistaUsuario -> vistaClientesController();
                        ?>

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

