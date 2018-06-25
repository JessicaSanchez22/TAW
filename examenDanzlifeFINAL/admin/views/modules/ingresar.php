
<body  style="background-color: #CD5C5C;">
<div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Inicio de sesión administrador</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingrese sus credenciales</p>

                <form  method="post">
                    <div class="form-group has-feedback">
                        <input name="usuario" type="text" class="form-control" placeholder="Usuario" required>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="password" type="password" class="form-control" placeholder="Contraseña" required>
                    </div>

                    <div class="row">

                        <!-- /.col -->
                        <div class="text-center col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <?php

                    $ingreso = new Controller();
                    $ingreso -> loginController();
                    if(isset($_GET["action"])){
                        if($_GET["action"] == "fallo"){
                            echo "Fallo al ingresar";
                        }
                    }

                ?>
                <!--<p class="mb-1">
                    <a href="#">I forgot my password</a>
                </p>-->
                <p class="mb-0">
                    <a href="register.html" class="text-center">No tengo una cuenta</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../views/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- iCheck -->
    <script src="../views/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass   : 'iradio_square-blue',
                increaseArea : '20%' // optional
            })
        })
    </script>
