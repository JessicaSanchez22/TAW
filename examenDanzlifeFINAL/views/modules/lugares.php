<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="card-title" style="display: inline-block;">Orden de envío de comprobantes</h3>
                            <h4>Festival Verano 2018</h4>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1"  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Nombre Alumna</th>
                            <th>Grupo</th>
                            <th>Nombre mamá</th>
                            <th>Fecha de pago</th>
                            <th>Fecha de envío</th>
                            <th>Imagen</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $vista = new Controller();
                        $vista-> vistaComprobantesController();
                        ?>

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

