<?php
session_start(); //inicia la sesión para el usuario que 
//acab de ingresar
include 'conexion.php'; /*incluimos el archivo de configuracion 
que vamos a necesitar*/

if(isset($_COOKIE)&&is_array($_COOKIE)&& count($_COOKIE)>0
    && isset($_COOKIE['username'])&& $_COOKIE['username']!=null){
    session_start(); //Según los valores que tienen las cookies
//iniciamos sesión
    $_SESSION['username']=$_COOKIE['username'];
}

$username = $_POST['username']; /*Pasamos como parametros 
lo que el formulario trae en los campos con estos name*/
$password = $_POST['password'];
$sql = "SELECT * FROM usuarios WHERE username = '$username'";

foreach ($pdo->query($sql) as $row) {
 if ($password==$row['password']){ 
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    //Mostramos un mensaje de bienvenida al usuario
    echo "<h3> Bienvenido! " . $_SESSION['username']."<h3>";?>
 <?php } else { 
   echo "Username o Password estan incorrectos.";
   echo "<br><a href='index.php'>Volver a Intentarlo</a>";
 }
}

?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <title>practica7</title><!--Para ver los estilos necesitamos conexion a internet.-->
    <link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
 </head>
 <body>
    <div>
        <a style="text-decoration: none; color:black;" class="button" href="registro.html">Registrarme</a>
        <a style="text-decoration: none; color:black;" class="button" href="login.html">Ingresar</a>
        <h1>Productos</h1>
         <!--tenemos el botón de agregar nuevo para que este nos lleve a la paina
        donde podemos agregar nuevosproductos-->
        <button><a style="text-decoration: none; color:black;" class="button" href="productos.html">AGREGAR NUEVO</a></button>
        <div class="row column">
        <div class="callout success">
        <table width="100%">
            <tr><!--Aqupi se empieza a listar la tabla que trajimos de la base de datos-->
                <th>id</th>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
            <?php 
            $sql = 'SELECT * FROM productos ORDER BY id ASC'; /*Seleccionamos todo de la tabla productos
            y lo odenamos por id de manera ascendente y mostramos cada uno de los registros
            que tenemos en la tabla*/
                foreach ($pdo->query($sql) as $row) { ?>
                <tr> <!--Después en este foreach lo que se hace es que se obtiene cada registro
                    y por cada registro va mostrando los campos en forma de tabla-->
                    <td style="border: 1px solid black;"><?=$row['id']?></td>
                    <td style="border: 1px solid black;"><?=$row['producto']?></td>
                    <td style="border: 1px solid black;"><?=$row['precio']?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
 </div>
    </div>

    <div>
        <h1>Ventas del día</h1> <!--Ahora pasamos a la seccion de ventas, donde podemos ver las ventas que fueron realizadas-->
        <button><a style="text-decoration: none; color:black;" class="button" href="ventas.php">AGREGAR NUEVA </a></button>
        <div class="row column">
        <div class="callout success">
        <table width="100%">
            <tr> <!--Se lleva a cabo el mismo rprocedimiento anterior y se listan cada
                una de las filas de la tabla que tenemos en nuestra base de datos-->
                <th>idVenta</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
            <?php 
            $sql = 'SELECT idVenta, sum(precioCantidad) as total FROM detalle_venta GROUP BY idVenta'; /*Aquí hacemos la operacion de sumar 
            el total de una venta agrupando todo
            el contenido de ella segun el idVenta*/
                foreach ($pdo->query($sql) as $row) { ?>
                <tr>
                    <td style="border: 1px solid black;"><?=$row['idVenta']?></td>
                    <td style="border: 1px solid black;"><?=$row['total']?></td>
                    <!--Nos llevamos el id del registro al que el usuario solicitó ver detalles-->
                    <td><a href="detallesVenta.php?id=<?php echo $row['idVenta']; ?>" class="button" style="color: white;">Ver detalles de la venta</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>

        <div>
            <!--Aquí mostramos el promedio de los productos, vendidos durante el día-->
        <h1>Promedio de productos</h1> 
        <h4>Según los vendidos en el día</h4>
        <div class="row column">
        <div class="callout success">
        <table width="100%">
            <tr> 
                <th>IdProducto</th>
                <th>Promedio</th>
                <?php 
            $sql = "SELECT p.id , p.precio FROM productos as p , detalle_venta as v WHERE p.id=v.idProducto"; /*Seleccionamos los productos y su promedio, pero SOLO DE LOS PRODUCTOS QUE ESTAN EN LA TABLA VENTAS osea, que ya se vendieron en ese día*/
                foreach ($pdo->query($sql) as $row) { ?>
                <tr>
                    <td style="border: 1px solid black;"><?=$row['id']?></td>
                    <td style="border: 1px solid black;"><?=$row['precio']?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
 </div>
    </div>
 </body>
 </html>