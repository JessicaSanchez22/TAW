<?php
$id = $_GET["idBorrar"];

$respuesta = CrudProductos::borrarCategoriaModel($id,"categoria");

if ($respuesta=="success"){
	echo "<script>alert('Categoria eliminada')</script>";
    echo "<script>window.location.href='index.php?action=categorias'</script>";
}else{
    echo "<script>alert('Ocurrio un problema')</script>";
    echo "<script>window.location.href='index.php?action=categorias'</script>";
}


?>