<!DOCTYPE html>
<html>
<head>
	<title>Danzlife</title>
</head>
<body>
	<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="card-title" style="display: inline-block;">Formulario de envío de comprobantes</h3>
                            <h4>Festival de verano 2018</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  
                    <div class="box-body">
                        <form action="" method="post" role="form" enctype="multipart/form-data">
						<div class="form-group">
                            <div class="form-group">
                                <label>*Grupo:</label>
                                <select name="grupo" class="form-control select2" style="width: 100%;" onchange="location='index.php?action=inicio&grupo='+this.value">
                                    <option>Seleccione un grupo</option>
                                    <?php $s= new Controller();
                                    $s->selectController("grupos");
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label>*Alumna:</label>
                                <select name="alumna" class="form-control select2" style="width: 100%;">
                                    <?php
                                    $s->filtroAlumnasController();
                                    ?>
                                </select>
                                </fieldset>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre">*Nombre de la mamá:</label>
                            <input type="text" name="nombreMama" placeholder="Nombre de mamá" required>
                            <input type="text" name="apellidoMama" class="form" placeholder="Apellido de mamá" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaPago">Fecha de pago</label>
                            <input type="date" name="fechaPago" class="form-control" placeholder="Ingresa la fecha" required>
                        </div>
                        <div class="form-group">
                            <label>*Comprobante de folio:</label>
                            <input name="imagen" size="30" type="file"></input>
                        </div>
                        <div class="form-group">
                            <label for="folio">*Folio de autorización:</label>
                            <input type="text" name="folio" class="form-control" placeholder="Ingrese el folio" required>
                        </div>
                        <div>
                        	<button type='submit' class='btn btn-primary' name="registrarComprobante">Guardar</button>
                   </form>
                   <?php
                        $registroComprobantes= new Controller();
                        $registroComprobantes -> registroComprobantesController();
                    ?>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</body>
</html>