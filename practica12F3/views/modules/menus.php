<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?action=dashboard" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>

</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?action=dashboard" class="brand-link">

        <span class="brand-text font-weight-light center">Inventario</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="#" class="d-block"><?php echo " Usuario: ".$_SESSION["usuario"]. " Tienda: ".$_SESSION["nombreTienda"]; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php?action=dashboard" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Dashboard
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?action=inventario" class="nav-link">
                        <i class="nav-icon fa fa-cube"></i>
                        <p>
                            Inventario
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?action=ventas" class="nav-link">
                        <i class="nav-icon fa fa-barcode"></i>
                        <p>
                            Ventas
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?action=categorias" class="nav-link">
                        <i class="nav-icon fa fa-tags"></i>
                        <p>
                            Categorias
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?action=usuarios" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>
                            Usuarios
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <?php
                if ($_SESSION["superadmin"]==true){
                    echo "<li class='nav-item'>
                    <a href='index.php?action=tiendas' class='nav-link'>
                        <i class='nav-icon fa fa-shopping-cart'></i>
                        <p>
                            Tiendas
                            <i class='right fa fa-angle-left'></i>
                        </p>
                    </a>
                </li>";
                }
                ?>

                <li class="nav-item">
                    <a href="index.php?action=salir" class="nav-link">
                        <i class="fa fa-sign-out nav-icon"></i>
                        <p>
                            Salir
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>