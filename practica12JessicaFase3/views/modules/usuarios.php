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
                            <h3 class="card-title" style="display: inline-block;">Usuarios</h3>
                        </div>
                        <a href="index.php?action=registroUsuario"><button type="button" class="btn btn-success" name="agregarUdsuario">
                            Agregar usuario &nbsp&nbsp<i class="right fa fa-plus"></i></button></a>
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
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Agregado el</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $vistaUsuario = new ProductosController();
                        $vistaUsuario -> vistaUsuariosController();
                        ?>

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

