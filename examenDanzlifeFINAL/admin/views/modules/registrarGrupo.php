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
                            <h3 class="card-title" style="display: inline-block;">Registrar grupo</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method='post' role='form'>
                        <div class='box-body'>
                            <div class='form-group'>
                                <input type='hidden' value='nombre' name='idEditar'>
                                <label for='nombre'>Nombre: </label>
                                <input type='text' name='nombre' class='form-control'  placeholder='nombre'>
                            </div>
                        </div>
                            <?php

                            $regis= new Controller();
                            $regis-> registrarGrupoController();

                            ?>

                        </div>
                        <div class='form-group'>
                            <button type='submit' class='btn btn-primary' name='registrarGrupo'>Registrar</button>
                        </div>
                        
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>




