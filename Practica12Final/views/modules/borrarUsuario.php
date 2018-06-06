<?php

$id = $_GET["idBorrar"];

$respuesta = CrudProductos::borrarUsuarioModel($id,"users");

if ($respuesta){
    echo "<script>alert('Usuario eliminado')</script>";
    echo "<script>window.location.href = 'index.php?action=usuarios'</script>";
}else{
    echo "<script>alert('Ocurrio un problema')</script>";
    echo "<script>window.location.href = 'index.php?action=usuarios'</script>";
}


?>