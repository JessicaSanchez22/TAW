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
                            <h3 class="card-title" style="display: inline-block;">Registrar alumna</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method='post' role='form'>
                        <div class='box-body'>
                            <div class='form-group'>
                                <label for='nombre'>Nombre: </label>
                                <input type='text' name='nombre' class='form-control'  placeholder='nombre'>
                            </div>
                            <div class='form-group'>
                                <label for='edad'>Edad: </label>
                                <input type='text' name="edad" class='form-control'  placeholder='edad'>
                            </div>
                            <div class='form-group'>
                                <label for='nombre_mama'>Nombre mamá: </label>
                                <input type='text' name="nombre_mama" class='form-control'  placeholder='nombre de la mamá'>
                            </div>

                            <div class='form-group'>
                                <label for='grupo'>Grupo: </label>
                                <select name="grupo" class="form-control select2" style="width: 100%;">
                                    <option>Seleccione un grupo</option>
                                    <?php $s= new Controller();
                                    $s->selectController("grupos");
                                    ?>
                                </select>
                            </div>
                        </div>
                            

                        </div>
                        <div class='form-group'>
                            <button type='submit' class='btn btn-primary' name='registrarAlumnas'>Registrar</button>
                        </div>
                        
                    </form>
                    <?php

                            $regis= new Controller();
                            $regis-> registrarAlumnaController();
                            //$regis-> actualizarNumeroAlumnas();
                            ?>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>




