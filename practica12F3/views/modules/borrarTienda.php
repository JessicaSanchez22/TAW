<?php
$id = $_GET["idBorrar"];

$respuesta = CrudProductos::borrarTiendaModel($id,"tienda");

if ($respuesta=="success"){
    echo " <div class='alert alert-success alert-dismissible'> 
                           <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                          <h5><i class='icon fa fa-check'></i> Éxito!</h5>
                          Tienda borrada con éxito.
                        </div> ";

    echo "<script>window.location.href = 'index.php?action=tiendas'</script>";
}else{
    echo " <div class='alert alert-danger alert-dismissible'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                          <h5><i class='icon fa fa-ban'></i> Error!</h5>
                          A ocurrido un error. Por favor intentelo de nuevo.
                        </div> ";
    echo "<script>window.location.href='index.php?action=tiendas'</script>";
}


?>