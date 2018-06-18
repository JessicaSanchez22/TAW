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
                            <h3 class="card-title" style="display: inline-block;">Editar Cliente</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
						
						<?php

						$editarC = new ProductosController();
						$editarC -> editarClienteController();
						$editarC -> actualizarClienteController();

						?>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>




