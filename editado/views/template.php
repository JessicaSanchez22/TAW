<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Template</title>

	<style>

		nav{
			font-family: cursive;
			font-size: 20px;
			position:relative;
			margin:auto;
			width:100%;
			height:auto;
			background:#45B39D;
		}

		nav ul{
			position:relative;
			margin:auto;
			width:80%;
			text-align: center;
		}

		nav ul li{
			display:inline-block;
			width:24%;
			line-height: 50px;
			list-style: none;
		}

		nav ul li a{
			color:white;
			text-decoration: none;
		}

		section{
			font-family: cursive;
			font-size: 20px;
			position: relative;
			margin: 50px;
			margin-left: 400px;
			width:400px;
		}

		section h1{
			position: relative;
			margin: auto;
			padding:10px;
			text-align: center;
		}

		section form{
			position:relative;
			margin:auto;
			width:400px;
		}

		section form input{
			display:inline-block;
			padding:10px;
			width:95%;
			margin:5px;
		}

		section form input[type="submit"]{
			position:relative;
			margin:20px auto;
			left:4.5%;

		}

		table{
			position:relative;
			margin:auto;
			width:100%;
			left:-10%;
		}

		table thead tr th{
			padding:10px;
			background:#F7DC6F;
		}

		table tbody tr td{
			padding:10px;
			background: #AED6F1;
		}
	</style>

</head>

<body>

<?php include "modules/navegacion.php"; ?>


<section>

<?php 

$mvc = new MaestrosController();
$mvc -> enlacesPaginasController();

 ?>

</section>
	
</body>

</html>