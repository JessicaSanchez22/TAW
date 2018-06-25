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


    #Provee el select de opciones
    public static function selectController($tabla){
      $respuesta=Crud::vistaModel($tabla);

      foreach($respuesta as $row => $item){
          echo '<option>'.$item["nombre"].'</option>';
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
          $_SESSION["validar"]=true;
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
                  <td><a href="index.php?action=verImagen&id='.$item["id"].'" data-tip="VerImagen"><button class="btn btn-info"><i class="right fa fa-eye"></i> Ver Imagen </button></a>
                  <a href="index.php?action=lugares&idBorrar='.$item["id"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a>
                  </td>
                  </tr>';

        }

        if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = Crud::borrarModel($id,"pagos");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Comprobante eliminado', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=lugares'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'No se ha eliminado', text: 'Ha ocurrido un error', type:'error'}); </script>";
              }
        }

    }

    #Muestra los comprobantes que han sido registrados
    public static function vistaGruposController(){
        $respuesta = Crud::vistaModel("grupos");

        foreach($respuesta as $row => $item){
            echo'<tr>
                  <td>'.$item["id"].'</td>
                  <td>'.$item["nombre"].'</td>
                  <td><a href="index.php?action=editarGrupo&id='.$item["id"].'" data-tip="editar"><button class="btn btn-edit"><i class="right fa fa-edit"></i>Editar</button></a>
                  <a href="index.php?action=grupos&idBorrar='.$item["id"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a>
                  </td>
                  </tr>';

        }

        if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = Crud::borrarModel($id,"grupos");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Registro eliminado', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=grupos'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'No se ha eliminado', text: 'Ha ocurrido un error', type:'error'}); </script>";
              }
        }
    }


    public static function vistaAlumnasController(){
        $respuesta = Crud::vistaModel("alumnas");
        
        foreach($respuesta as $row => $item){
          $grupo= Crud::obtenerNombreModel("grupos", $item["id_grupo"]);
            echo'<tr>
                  <td>'.$item["id"].'</td>
                  <td>'.$item["nombre"].'</td>
                  <td>'.$item["edad"].'</td>
                  <td>'.$item["nombre_mama"].'</td>
                  <td>'.$grupo["nombre"].'</td>
                  <td><a href="index.php?action=editarAlumna&id='.$item["id"].'" data-tip="editar"><button class="btn btn-edit"><i class="right fa fa-edit"></i>Editar</button></a>
                  <a href="index.php?action=alumnas&idBorrar='.$item["id"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a></td>
                  </tr>';

        }

        if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = Crud::borrarModel($id,"alumnas");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Alumna eliminada', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=alumnas'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'No se ha eliminado', text: 'Ha ocurrido un error', type:'error'}); </script>";
              }
        }
    }

    public static function registrarGrupoController(){
      if(isset($_POST["nombre"])){
        $datos = array("nombre"=>$_POST["nombre"]);
        $respuesta=Crud::registrarGrupoModel($datos);
        if ($respuesta) {
            echo "<script>swal({title: 'Grupo registrado con éxito', text: 'Éxito', type:'success'}, 
            function (){
              window.location.href = 'index.php?action=grupos'
            }); </script>";
            //echo "<script></script>";
        } else {
          echo "<script>swal({title: 'No se ha podido registrar', text: 'Intente de nuevo más tarde.', type:'error'}); </script>";

        }
      }
    }

    public static function registrarAlumnaController(){
      if(isset($_POST["nombre"]) && isset($_POST["edad"])){
        $datos = array("nombre"=>$_POST["nombre"], "edad"=>$_POST["edad"], "nombre_mama"=>$_POST["nombre_mama"], "grupo"=>$_POST["grupo"]);
        $respuesta=Crud::registrarAlumnaModel($datos);
        if ($respuesta) {
            echo "<script>swal({title: 'Registro exitoso', text: 'Éxito', type:'success'}, 
            function (){
              window.location.href = 'index.php?action=alumnas'
            }); </script>";
            //echo "<script></script>";
        } else {
          echo "<script>swal({title: 'No se ha podido registrar', text: 'Intente de nuevo más tarde.', type:'error'}); </script>";

        }

        if ($actualizado) {
          echo "<script>swal({title: Numero de alumnas actualizado', text: 'Éxito', type:'success'}, 
          function (){
            window.location.href = 'index.php?action=alumnas'
          }); </script>";
        }
      }
    }

    public static function editarAlumnaController(){
      $datosController = $_GET["id"];
      $respuesta = Crud::editarAlumnaModel($datosController, "alumnas");
      echo " <form method='post' role='form' name='alumnaEditar'>
                <div class='box-body'>
                    <div class='form-group'>
                      <input type='hidden' value='".$respuesta["id"]."' name='idEditar'>

                        <label for='nombre'>Nombre</label>
                        <input type='text' name='nombreEditar' class='form-control' value='".$respuesta["nombre"]."'>

                        <label for='edad'>Edad</label>
                        <input type='text' name='edadEditar' class='form-control' value='".$respuesta["edad"]."'>

                         <label for='estado'>Mamá</label>
                        <input type='text' name='mamaEditar' class='form-control' value='".$respuesta["nombre_mama"]."'>

                        <div class='form-group'>
                                <label for='grupo'>Grupo: </label>
                                <select name='grupoEditar' class='form-control select2' style='width: 100%;''>
                                    <option>Seleccione un grupo</option>";
                                    $s= new Controller();
                                    $s->selectController('grupos');
                                  
                                echo "</select>
                            </div>
                    </div>
                </div>
                    <button type='submit' class='btn btn-primary' name='alumnaEditar'>Actualizar alumna</button>
            </form> ";

    }


    #EDITAR 
    #------------------------------------
    public static function actualizarAlumnaController(){

      if(isset($_POST["alumnaEditar"])){

          $datosController = array( "id"=>$_POST["idEditar"],
              "nombre"=>$_POST["nombreEditar"],
              "edad"=>$_POST["edadEditar"], "nombre_mama"=>$_POST["mamaEditar"], "grupo"=>$_POST["grupoEditar"]);

          $respuesta = Crud::actualizarAlumnaModel($datosController, "alumnas");

          if ($respuesta == "success") {
              echo "<script>swal({title: 'Actualizacion realizada con éxito', text: 'Éxito', type:'success'}, 
              function (){
                window.location.href = 'index.php?action=alumnas'
              }); </script>";
          } else {
            echo "<script>swal({title: 'No se pudo actualizar', text: 'Intente de nuevo más tarde.', type:'error'}); </script>";

          }
        
      }
    }


    public static function editarGrupoController(){
      $datosController = $_GET["id"];
      $respuesta = Crud::editarAlumnaModel($datosController, "grupos");
      echo " <form method='post' role='form' name='grupoEditar'>
                <div class='box-body'>
                    <div class='form-group'>
                      <input type='hidden' value='".$respuesta["id"]."' name='idEditar'>

                        <label for='nombre'>Nombre</label>
                        <input type='text' name='nombreEditar' class='form-control' value='".$respuesta["nombre"]."'>
                    </div>
                </div>
                    <button type='submit' class='btn btn-primary' name='grupoEditar'>Actualizar grupo</button>
            </form> ";

    }


    #EDITAR 
    #------------------------------------
    public static function actualizarGrupoController(){

      if(isset($_POST["grupoEditar"])){

          $datosController = array( "id"=>$_POST["idEditar"],
              "nombre"=>$_POST["nombreEditar"]);

          $respuesta = Crud::actualizarGrupoModel($datosController, "grupos");

          if ($respuesta == "success") {
              echo "<script>swal({title: 'Actualizacion realizada con éxito', text: 'Éxito', type:'success'}, 
              function (){
                window.location.href = 'index.php?action=grupos'
              }); </script>";
          } else {
            echo "<script>swal({title: 'No se pudo actualizar', text: 'Intente de nuevo más tarde.', type:'error'}); </script>";

          }
        
      }
    }

    public static function verImagenController(){
      $idImagen=$_GET["id"];
      $ruta_img=Crud::verImagenModel($idImagen);
      echo "<div>
             <img src='../images/"; echo $ruta_img["ruta_imagen"]; echo "' alt='' />
          </div>";
    }

	}
  ?>