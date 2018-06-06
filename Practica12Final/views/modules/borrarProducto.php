<?php

$id = $_GET["idBorrar"];

$respuesta = CrudProductos::borrarProductoModel($id,"productos");

if ($respuesta){
    echo "<script>alert('Producto eliminado')</script>";
    echo "<script>window.location.href = 'index.php?action=inventario'</script>";
}else{
    echo "<script>alert('Ocurrio un problema')</script>";
    echo "<script>window.location.href = 'index.php?action=inventario'</script>";
}


?>