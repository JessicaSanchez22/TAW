<?php
	class Controller{
    
    #Se llama a la plantilla 
		public function pagina(){

			include "views/template.php";

		}

    #ENLACES DE LAS PAGINAS
    #-------------------------------
		public function enlacesPaginasController(){

			if(isset($_GET['action'])){

				$enlaces = $_GET['action'];

			}else{
				$enlaces = "index";
			}

			$resp = Paginas::enlacesPaginasModel($enlaces);

			include $resp;
		}


    #Registra los datos del comprobante en la base de datos
		public static function registroComprobantesController(){
      if (isset($_POST["alumna"])) {
        $contador=Crud::ultimoId("pagos");
        $contador=(int)$contador["id"]+1;
        $nombre_imagen=(string)$contador."_".$_FILES["imagen"]["name"]; //Nombre de la imagen concatenando un contador y el nombre del archivo.
        $tipo=$_FILES["imagen"]["type"];
        $tamano=$_FILES["imagen"]["size"];

        if (($nombre_imagen== !NULL) && ($_FILES["imagen"]["size"]<200000)) {
          if ($_FILES["imagen"]["type"]=="image/jpeg"
            ||$_FILES["imagen"]["type"]=="image/jpg"
            ||$_FILES["imagen"]["type"]=="image/png") {
            //$directorio=$_SERVER['DOCUMENT ROOT']."/intranet/uploads/"; //Ruta donde se guardaran la imagenes que subamos
            $directorio="./images/"; 
          //Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
          move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio.$nombre_imagen);
          } else{
            //Si no se cumple el formato
            echo "<script>swal({title: 'No se puede subir una imagen con ese formato', text: 'Por favor, elija otra', type:'error'}); </script>";
          }
        } else {
          if ($nombre_imagen== !NULL) {
             echo "<script>swal({title: 'La imagen es demasiado grande', text: 'Por favor, elija otra', type:'error'}); </script>";
          }
        }

        $nombre_mama=$_POST["nombreMama"]. " ".$_POST["apellidoMama"];

        $datos = array("grupo"=>$_GET["grupo"], "alumna" => $_POST["alumna"], "mama"=> $nombre_mama, "fecha_pago"=>$_POST["fechaPago"], "fecha_envio"=>date("Y-m-d h:i:s"), "folio_autorizacion"=>$_POST["folio"], "ruta_imagen"=>$nombre_imagen);
        //Recibe a través del método post los campos a 
        //registrar y se almacenan los datos en un array asociativo que será usado más adelante, por el modelo.
				
        //Se le dice al modelo que es lo que se va a agregar a la base de datos a través de la funcion que es llamada
				$resp = Crud::registrarComprobanteModel("pagos", $datos);

				if($resp){
					//header("location: index.php?action=ok");
                   echo "<script>swal({title: 'Comprobante registrado con éxito', text: 'Éxtio', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=inicio'
                    }); </script>";
				}
        else{
					 echo "<script>swal({title: 'Algo salió mal', text: 'Intentalo de nuevo', type:'error'}); </script>";
				}

      }

		}


    #Provee el select de opciones
    public static function selectController($tabla){
      $respuesta=Crud::vistaModel($tabla);
      if (isset($_GET["grupo"])) {
        foreach($respuesta as $row => $item){
          if ($_GET["grupo"]==$item["nombre"]){
            echo '<option selected>'.$item["nombre"].'</option>';
          } else{
            echo '<option>'.$item["nombre"].'</option>';
          }
        }
      } else{
        foreach($respuesta as $row => $item){
          echo '<option>'.$item["nombre"].'</option>';
        }
      }

      
    }

    #Filtra la tabla alumnas 
    public static function filtroAlumnasController(){
      $grupo=$_GET["grupo"];
      $respuesta=Crud::filtroAlumnasModel($grupo);

      foreach($respuesta as $row => $item){
          echo '<option>'.$item["nombre"].'</option>';
      }
    }

    public static function loginController(){
      if (isset($_POST["usuario"]) && isset($_POST["password"])) {
        $datos = array( "usuario"=>$_POST["usuario"], "password"=>$_POST["password"]);
        $respuesta = Crud::loginModel("usuarios", $datos);

        if(($respuesta["usuario"] == $_POST["usuario"]) && ($respuesta["password"] == $_POST["password"])){

          $_SESSION["validar"] = true;

          echo "<script>swal({title: 'Credenciales correctas', text: 'Bienvenido', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=lugares'
                    }); </script>";
        } else {
          echo "<script>swal({title: 'Credenciales incorrectas', text: 'Por favor intente de nuevo', type:'error'}); </script>";
          $_SESSION["validar"]=false;
        }
      }
    }


    #Muestra los comprobantes que han sido registrados
    public static function vistaComprobantesController(){
        $respuesta = Crud::vistaModel("pagos");

        foreach($respuesta as $row => $item){
            $grupo = Crud::obtenerNombreModel("grupos", $item["id_grupo"]);
            $alumna = Crud::obtenerNombreModel("alumnas", $item["id_alumna"]);
            echo'<tr>
                  <td>'.$item["id"].'</td>
                  <td>'.$alumna["nombre"].'</td>
                  <td>'.$grupo["nombre"].'</td>
                  <td>'.$item["nombre_mama"].'</td>
                  <td>'.$item["fecha_pago"].'</td>
                  <td>'.$item["fecha_envio"].'</td>
                  <td>'.$item["ruta_imagen"].'</td>
                  </tr>';

        }
    }


	}
  ?>