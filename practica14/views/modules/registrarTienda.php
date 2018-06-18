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
                            <h3 class="card-title" style="display: inline-block;">Registrar tienda</h3>
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
                            <div class="form-group">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="estado" class="form-control select2" style="width: 100%;">
                                    <option>activa</option>
                                    <option>desactiva</option>
                                </select>
                            </div>
                        </div>
                            <?php

                            $regisTienda= new ProductosController();
                            $regisTienda -> registrarTiendaController();

                            ?>

                        </div>
                        <button type='submit' class='btn btn-primary' name='registrarTienda'>Registrar</button>
                    </form>



                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>




