<?php
    include 'conexion.php'; //incuimos el archivo de las conexiones y configs
    $id = isset( $_GET['id'] ) ? $_GET['id'] : ''; /*obtenemos el id del 
    formulario que manda llamar a este archivo*/
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
        <h1>Ventas</h1> <!--tenemos el botón de agregar nuevo para que este nos lleve a la paina
        donde podemos agregar nuevas ventas-->
        <button><a style="text-decoration: none; color:black;" class="button" href="ventas.php">AGREGAR NUEVA</a></button>
        <a style="text-decoration: none; color:black;" class="button" href="index.php">VOLVER</a>
        <div class="row column">
        <div class="callout success">
        <table width="100%">
            <tr><!--Aquí se empieza a listar la tabla que traemos de la base de datos-->
                <th>id</th>
                <th>IdVenta</th>
                <th>IdProducto</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
            <?php 
            $id=
            $sql = "SELECT * FROM detalle_venta WHERE idVenta='$id'"; /*Seleccionamos todo de la tabla detalle_venta
         y mostramos cada uno de los registros
            que tenemos en la tabla*/
                foreach ($pdo->query($sql) as $row) { ?>
                <tr> <!--Después en este foreach lo que se hace es que se obtiene cada registro
                    y por cada registro va mostrando los campos en forma de tabla-->
                    <td style="border: 1px solid black;"><?=$row['id']?></td>
                    <td style="border: 1px solid black;"><?=$row['idVenta']?></td>
                    <td style="border: 1px solid black;"><?=$row['idProducto']?></td>
                    <td style="border: 1px solid black;"><?=$row['cantidad']?></td>
                    <td style="border: 1px solid black;"><?=$row['precioCantidad']?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
 </div>
</div>
</body>
</html>