<?php
	//session_start();
    $_SESSION["validar"] = false;
    $_SESSION["usuario"] = "";
    $_SESSION["password"] = "";
    //$_SESSION = array();
    //session_destroy();
    //header("Location:../modules/ingresar.php");
    echo "<script>window.location.href='index.php?action=ingresar'</script>";
    exit();
	//if(!$_SESSION["validar"]){

	//}


?>