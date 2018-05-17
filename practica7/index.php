<?php
//Incluimos el archivo de las configuraciones
include 'conexion.php';
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
        donde podemos agregar nuevos productos-->
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
            $sql = 'SELECT * FROM productos ORDER BY id ASC'; /*Seleccionamos todo de la tabla futbolistas
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
            $sql = 'SELECT idVenta, sum(precioCantidad) as total FROM detalle_venta GROUP BY idVenta'; /*Aqui la consulta nos trae la venta y
             el total de la venta que se realizo
             , sumando todos los articulos
            y todas las cantidades que se vendieron de 
            cada uno de los articulos*/
                foreach ($pdo->query($sql) as $row) { ?>
                <tr>
                    <td style="border: 1px solid black;"><?=$row['idVenta']?></td>
                    <td style="border: 1px solid black;"><?=$row['total']?></td>
                    <!--Este botón nos permite ver los detalles de la venta y le pasa el id, para que el sistema sepa de que venta se trata-->
                    <td><a href="detallesVenta.php?id=<?php echo $row['idVenta']; ?>" class="button" style="color: white;">Ver detalles de la venta</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
        <div>
        <h1>Promedio de productos</h1> 
        <!--Aqui se muestra el promedio de cada producto, según los productos que se han vendido
            OJO: si el producto aun no se vende, no se saca el promedio-->
        <h4>Según los vendidos en el día</h4>
        <div class="row column">
        <div class="callout success">
        <table width="100%">
            <tr> 
                <th>IdProducto</th>
                <th>Promedio</th>
                <?php 
            $sql = "SELECT p.id , p.precio FROM productos as p , detalle_venta as v WHERE p.id=v.idProducto"; /*Seleccionamos todo de la tabla y
            comenzamos a listar de uno por uno los registros*/
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
