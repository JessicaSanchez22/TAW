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
                            <h3 class="card-title" style="display: inline-block;">Imagen del comprobante</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
						
						<?php

						$editar = new Controller();
						$editar -> verImagenController();
						?>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>




