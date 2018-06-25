<?php
if(!$_SESSION["validar"]){
    echo "<script>window.location.href='index.php?action=ingresar'</script>";
    exit();
}
?>
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="card-title" style="display: inline-block;">Grupos</h3>
                            <h4>Festival Verano 2018</h4>
                            <a href="index.php?action=registrarGrupo"><button type="button" class="btn btn-success" style="color: white;"> Registrar grupo &nbsp&nbsp<i class="right fa fa-plus"></i></button></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1"  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $vista = new Controller();
                        $vista-> vistaGruposController();
                        ?>

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

