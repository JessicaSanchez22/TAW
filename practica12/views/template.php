<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Template</title>

	<style>
		table {
		    margin: 8px;
		}

		th {
		    font-family: Verdana, fantasy;
		    font-size: 20px;
		    background: #2F9DC6;
		    color: #FFF;
		    padding: 2px 6px;
		    border-collapse: separate;
		    border: 1px solid #000;
		}

		td {
		   font-family: Verdana, fantasy;
		    font-size: 20px;
		    border: 1px solid #DDD;
		}

		nav{
			position:relative;
			font-family: Verdana, fantasy;
		    font-size: 20px;
			margin:auto;
			width:100%;
			height:auto;
			background:#EDBAA6;
		}

		nav ul{
			position:relative;
			margin:auto;
			width:50%;
			text-align: center;
		}

		nav ul li{
			display:inline-block;
			width:15%;
			line-height: 50px;
			list-style: none;
		}

		nav ul li a{
			color:white;
			text-decoration: none;
		}

		section{
			position: relative;
			margin: auto;
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

		select{
			font-family: Verdana, fantasy;
		    font-size: 20px;
			background:#EDBAA6;
			color: white;
		}
	</style>

</head>

<body>

<?php include "modules/navegacion.php"; ?>


<section>

<?php 

$mvc = new MvcController();
$mvc -> enlacesPaginasController();

 ?>

</section>
	
</body>

</html>