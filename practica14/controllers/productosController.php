<?php

	class ProductosController{
    
    #Se llama a la plantilla 
    #-----------------------

		public function pagina(){

			include "views/template.php";

		}

    #ENLACES
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

  ####################    PRODUCTOS   ############################

        public static function vistaProductosController(){
            $respuesta = CrudProductos::vistaProductosModel($_SESSION['idTienda'], "productos");

            foreach($respuesta as $row => $item){
                $categoria = CrudProductos::obtenerCategoriaModel("categoria", $item["id_categoria"]);
                echo'<tr>
                      <td>'.$item["id"].'</td>
                      <td>'.$item["codigo_producto"].'</td>
                      <td>'.$item["nombre"].'</td>
                      <td>'.$item["date_added"].'</td>
                      <td>'.$item["precio_producto"].'</td>
                      <td>'.$item["cantidad_stock"].'</td>
                      <td>'.$categoria["nombre_categoria"].'</td>
                      <td><a href="index.php?action=editarProducto&id='.$item["id"].'" data-tip="Editar"><button class="btn btn-info"><i class="right fa fa-edit"></i> Editar</button></a></td>
                      <td><a href="index.php?action=agregarStock&idProducto='.$item["id"].'"><button class="btn btn-default">Editar stock <i class="right fa  fa-plus"></i></button></a></td>
                      <td><a href="index.php?action=productos&idBorrar='.$item["id"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a></td>
               </tr>';

            }

            if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = CrudProductos::borrarCategoriaModel($id,"productos");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Producto eliminado', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=productos'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'El producto no ha sido eliminado', text: 'Ha ocurrido un error', type:'error'}); </script>";
              }
            }
        }



		public static function registrarProductoController(){
			if(isset($_POST['nombre'])){
        if ($_SESSION["superadmin"]) {
          
          $data = array("codigo_producto"=>$_POST["codigo"], "nombre" => $_POST["nombre"], "date_added"=>date("Y-m-d h:i:s"), "precio_producto"=>$_POST["precio"], "cantidad_stock"=>$_POST["stock"], "categoria"=>$_POST["categoria"], "id_tienda"=>$_POST["tienda"]);
        } else
        {
          $data = array("codigo_producto"=>$_POST["codigo"], "nombre" => $_POST["nombre"], "date_added"=>date("Y-m-d h:i:s"), "precio_producto"=>$_POST["precio"], "cantidad_stock"=>$_POST["stock"], "categoria"=>$_POST["categoria"]);
        }
        //Recibe a través del método post los campos a 
        //registrar del producto, y se almacenan los datos en un array asociativo que será usado más adelante, por el modelo.
				
        //Se le dice al modelo que es lo que se va a agregar a la base de datos a través de la funcion registrarProductoModel
				$resp = CrudProductos::registrarProductoModel("productos", $data);

				if($resp == "success"){
					//header("location: index.php?action=ok");
                   echo "<script>swal({title: 'Producto registrado con éxito', text: 'Éxtio', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=inventario'
                    }); </script>";
				}
        else{
					 echo "<script>swal({title: 'Producto no registrado', text: 'Ha ocurrido un error', type:'error'}); </script>";
				}
			}

		}

    public static function editarProductoController(){
      $datosController = $_GET["id"];
    $respuesta = CrudProductos::editarProductoModel($datosController, "productos");
    $categoria = CrudProductos::obtenerCategoriaModel("categoria", $respuesta["id_categoria"]);
            echo "<form method='post' role='form' name='productoEditar'>
                      <div class='box-body'>
                          <div class='form-group'>
                            <input type='hidden' value='".$respuesta["id"]."' name='idEditar'>

                              <label for='nombre'>Nombre</label>
                              <input type='text' name='nombreEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["nombre"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='apellido'>Precio</label>
                              <input type='text' name='precioEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["precio_producto"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='codigo'>Codigo</label>
                              <input type='text' name='codigoEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["codigo_producto"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='usuario'>Stock</label>
                              <input type='text' name='stockEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["cantidad_stock"]."' required>
                          </div>
                          <div class='form-group'>
                              <label for='email'>Categoria</label>
                              <select name='categoria' class='form-control select2' style='width: 100%;'>";
                                    
                                    $categorias = new ProductosController();
                                    $categorias -> obtenerCategoriaController();
                                    
                               echo "</select>
                          </div>
      
                      </div>
                          <button type='submit' class='btn btn-primary' name='productoEditar'>Actualizar producto</button>
                  </form>";

      }
       

  public static function actualizarProductoController(){

    if(isset($_POST["productoEditar"])){
      $datosController = array( "id"=>$_POST["idEditar"],
                        "precio_producto"=>$_POST["precioEditar"],
                        "nombre"=>$_POST["nombreEditar"],
                              "cantidad_stock"=>$_POST["stockEditar"],
                              "nombre_categoria"=>$_POST["categoria"],
                              "codigo_producto"=>$_POST["codigoEditar"],
                              "date_added"=>date("Y-m-d h:i:s"));
      
      $respuesta = CrudProductos::actualizarProductoModel($datosController, "productos");

      if($respuesta == "success"){

        echo "<script>swal({title: 'Producto actualizado', text: 'Éxito', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=cambioP'
                    }); </script>";

      }

      else{

        echo "<script>swal({title: 'Producto NO actualizado', text: 'Ha ocurrido un error', type:'error'}); </script>";;

      }

    }
  }

    ##############################   USUARIOS   ##############################
    #LOGIN DE USUARIO
    #--------------------------------------

		public static function loginController(){

            if(isset($_POST["login"])){
                $datos = array( "usuario"=>$_POST["usuario"], "password"=>$_POST["password"]);
                $respuesta = CrudProductos::loginModel("users",$datos);
                $idUsuario=CrudProductos::obtenerIdUsuarioModel("users", $_POST["usuario"]);
                $idVenta=CrudProductos::obtenerIdVenta();
                $super=CrudProductos::esSuper($_POST["usuario"], "users"); //Verifica si el usuario es superadmin
                //$tienda=CrudProductos::obtenerIdTienda("tienda", $nombreTienda);

                //Verfica si el usuario existe en la base de datos
                if(($respuesta["usuario"] == $_POST["usuario"]) && ($respuesta["password"] == $_POST["password"])){
                    $_SESSION["validar"] = true;
                    $_SESSION["usuario"] = $_POST["usuario"];
                    $_SESSION["password"] = $_POST["password"];
                    $_SESSION["id"]=$idUsuario["id"];
                    $nombreTienda=CrudProductos::obtenerNombreTiendaModel("tienda",$_SESSION["idTienda"]);
                    $_SESSION["nombreTienda"]= $nombreTienda["nombre"];
                    if($_SESSION["password"]=="admin" && $_SESSION["usuario"]=="admin"){
                        $_SESSION["superadmin"]=true;
                    } else{
                        $_SESSION["superadmin"]=false;
                    }
                    $_SESSION["idTienda"]=$respuesta["id_tienda"];
                    $_SESSION["idVenta"]=$idVenta["id"];
                    //SE utiliza un window.location.href ya que al momento de usar un header location, lo que hace este es que carga todo el MVC completo, y junto con el la sesión, creando conflicto en ciertas partes. Es por esto que se prefiere usar un window location para que solo mueste la pagina que desemos, pero dentro de la misma sesion de usuarios en la que estamos.
                    echo "<script>swal({title: 'Credenciales correctas', text: 'Bienvenido', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=dashboard'
                    }); </script>";
                }
                else{
                    echo "<script>swal({title: 'Credenciales incorrectas', text: 'Intentelo de nuevo', type: 'error'});</script>";
                }

            }
		}

		public static function registrarUsuarioController(){
		    if (isset($_POST["usuario"]) && isset($_POST["password"])){
          if ($_SESSION["superadmin"]) {
                $datos = array( "nombre"=>$_POST["nombre"], 
                  "apellido"=>$_POST["apellido"],
                    "usuario"=>$_POST["usuario"], 
                    "password"=>$_POST["password"], 
                    "email"=>$_POST["correo"], 
                    "date"=>date("Y-m-d h:i:s"), 
                    "superadmin" => $_POST["superadmin"], 
                    "id_tienda"=>$_POST["tienda"]);
                //Se le dice al modelo que en la clase "CrudProductos", la funcion "registroarUsuarioModel" reciba en sus 2 parametros los valores "$datos" y el nombre de la tabla a conectarnos la cual es "users"
         } else{

                $datos = array( "nombre"=>$_POST["nombre"], 
                  "apellido"=>$_POST["apellido"],
                    "usuario"=>$_POST["usuario"], 
                    "password"=>$_POST["password"], 
                    "email"=>$_POST["correo"], 
                    "date"=>date("Y-m-d h:i:s"));
          }

          $respuesta = CrudProductos::registrarUsuarioModel("users",$datos);
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta){
              echo "<script>swal({title: 'Registro de usuario correcto', text: 'Éxito', type:'success'}, 
              function (){
                window.location.href = 'index.php?action=usuarios'
              }); </script>";
              
          }

          else{

               echo "<script>swal({title: 'Usuario no registrado', text: 'Ha ocurrido un error', type:'error'}); </script>";
            }
        }
    }


    public static function registrarClienteController(){
        if (isset($_POST["nombre"])){
          if ($_SESSION["superadmin"]) {
                $res=CrudProductos::obtenerIdTienda($_POST["tienda"]);
                $idTienda=$res["id"];
           } else{
              $idTienda=$_SESSION["idTienda"];
          }

          $datos = array( "nombre"=>$_POST["nombre"], 
                  "apellido"=>$_POST["apellido"],
                    "email"=>$_POST["email"], 
                    "direccion"=>$_POST["direccion"], 
                    "telefono"=>$_POST["telefono"], 
                    "date"=>date("Y-m-d h:i:s"), 
                    "id_tienda"=>$idTienda);

          $respuesta = CrudProductos::registrarClienteModel("clientes",$datos);
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta){
              echo "<script>swal({title: 'Cliente registrado', text: 'Éxito', type:'success'}, 
              function (){
                window.location.href = 'index.php?action=clientes'
              }); </script>"; 
          }
          else{

               echo "<script>swal({title: 'Cliente no registrado', text: 'Ha ocurrido un error', type:'error'}); </script>";
            }
        }
    }

		public static function vistaUsuariosController(){
            $respuesta = CrudProductos::vistaUsuariosModel("users");

            #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

            foreach($respuesta as $row => $item){
                echo'<tr>
              				<td>'.$item["id"].'</td>
              				<td>'.$item["first_name"].'</td>
              				<td>'.$item["last_name"].'</td>
              				<td>'.$item["usuario"].'</td>
              				<td>'.$item["user_email"].'</td>
              				<td>'.$item["date_added"].'</td>
                      <td><a href="index.php?action=editarUsuario&id='.$item["id"].'"><button class="btn btn-info">Editar</button></a></td>
                      <td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button class="btn btn-danger">Borrar</button></a></td>
                    </tr>';

            }
            if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = CrudProductos::borrarUsuarioModel($id,"users");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Usuario eliminado', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=usuarios'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'Usuario no eliminado', text: 'Error', type:'error'}); </script>";
              }
            }
            
        }

        public static function editarUsuarioController(){
          $datosController = $_GET["id"];
          $respuesta = CrudProductos::editarUsuarioModel($datosController, "users");
            echo "<form method='post' role='form'>
                      <div class='box-body'>
                          <div class='form-group'>
                            <input type='hidden' value='".$respuesta["id"]."' name='idEditar'>
                              <label for='nombre'>Nombre</label>
                              <input type='text' name='nombreEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["first_name"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='apellido'>Apellido</label>
                              <input type='text' name='apellidoEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["last_name"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='usuario'>Usuario</label>
                              <input type='text' name='userEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["usuario"]."' required>
                          </div>
                          <div class='form-group'>
                              <label for='email'>Email</label>
                              <input type='email' name='emailEditar' class='form-control' value='".$respuesta["user_email"]."'>
                          </div>
      
                      </div>
                          <button type='submit' class='btn btn-primary' name='usuarioEditar'>Actualizar usuario</button>
                  </form>";

      }
              #ACTUALIZAR USUARIO
        #------------------------------------
        public static function actualizarUsuarioController(){

          if(isset($_POST["usuarioEditar"])){

            $datosController = array( "id"=>$_POST["idEditar"],
                              "first_name"=>$_POST["nombreEditar"],
                              "last_name"=>$_POST["apellidoEditar"],
                                    "usuario"=>$_POST["userEditar"],
                                    "user_email"=>$_POST["emailEditar"]);
            
            $respuesta = CrudProductos::actualizarUsuarioModel($datosController, "users");

            if($respuesta == "success"){

              echo "<script>swal({title: 'Usuario actualizado con éxito', text: 'Éxito', type:'success'}, 
              function (){
                window.location.href = 'index.php?action=cambioU'
              }); </script>";
            }

          else{

               echo "<script>swal({title: 'Usuario no actualizado', text: 'Ha ocurrido un error', type:'error'}); </script>";
            }

          }
        
        }

    ###############################  CATEGORIAS  ###########################################

        public static function registrarCategoriaController(){
            if(isset($_POST["nombre"]) && isset($_POST["descripcion"])){
                $datos = array( "nombre"=>$_POST["nombre"], "descripcion"=>$_POST["descripcion"], "date"=>date("Y-m-d h:i:s"));
                $respuesta=CrudProductos::registrarCategoriaModel("categoria",$datos);
                //Valiación de la respuesta del modelo para ver si es un usuario correcto.
                if($respuesta){
                    //session_start();
                    echo "<script>swal({title: 'Registro Satisfactorio', text: 'Categoria Registrado Satisfactoriamente', type:'success'}); </script>";
                    echo "<script>window.location.href = 'index.php?action=categorias'</script>";
                }else{
                    //header("location:index.php?action=fallo");
                    echo "<script>swal({title: 'Error', text: 'Ha ocurrido un error al intentar registrar', type:'error'}); </script>";
                    //echo "<script>window.location.href = 'index.php?action=fallo'</script>";
                }

            }
        }

        public static function vistaCategoriasController(){
            $respuesta = CrudProductos::vistaCategoriasModel("categoria");

            foreach($respuesta as $row => $item){
                echo'<tr>
              				<td>'.$item["id_categoria"].'</td>
              				<td>'.$item["nombre_categoria"].'</td>
              				<td>'.$item["descripcion_categoria"].'</td>
              				<td>'.$item["date_added"].'</td>
              				<td><a href="index.php?action=editarCategoria&id='.$item["id_categoria"].'" data-tip="Editar"><button class="btn btn-info"><i class="right fa fa-edit"></i> Editar</button></a></td>
                      <td><a href="index.php?action=categorias&idBorrar='.$item["id_categoria"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a></td>
              			</tr>';

            }

            if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = CrudProductos::borrarCategoriaModel($id,"categoria");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Categoria eliminada', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=categorias'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'La categoria no ha sido eliminada', text: 'Ha ocurrido un error', type:'error'}); </script>";
              }
            }
        }

        public static function obtenerCategoriaController(){
            $respuesta = CrudProductos::vistaCategoriasModel("categoria");

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["nombre_categoria"].'</option>';
            }
        }

        public static function obtenerTiendasController(){
            $respuesta = CrudProductos::vistaTiendasModel("tienda");

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["nombre"].'</option>';
            }
        }


        public static function obtenerProductosController(){

            $respuesta = CrudProductos::vistaProductosModel($_SESSION["idTienda"], "productos");

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["nombre"].'</option>';
            }
        }

        public static function obtenerClientesController(){

            $respuesta = CrudProductos::vistaClientesModel($_SESSION["idTienda"], "clientes");

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["nombre"].'</option>';
            }

        }

        public static function editarCategoriaController(){
      $datosController = $_GET["id"];
    $respuesta = CrudProductos::editarCategoriaModel($datosController, "categoria");
            echo "<form method='post' role='form' name='categoriaEditar'>
                      <div class='box-body'>
                          <div class='form-group'>
                            <input type='hidden' value='".$respuesta["id_categoria"]."' name='idEditar'>

                              <label for='nombre'>Nombre</label>
                              <input type='text' name='nombreEditar' class='form-control' value='".$respuesta["nombre_categoria"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='apellido'>Descripcion</label>
                              <input type='text' name='descripcionEditar' class='form-control' value='".$respuesta["descripcion_categoria"]."'>
                          </div>
      
                      </div>
                          <button type='submit' class='btn btn-primary' name='categoriaEditar'>Actualizar categoria</button>
                  </form>";

      }


            #EDITAR CATEGORIA
      #------------------------------------
      public static function actualizarCategoriaController(){

        if(isset($_POST["categoriaEditar"])){

          $datosController = array( "id_categoria"=>$_POST["idEditar"],
                            "nombre"=>$_POST["nombreEditar"],
                            "descripcion"=>$_POST["descripcionEditar"],
                                  "date_added"=>date("Y-m-d h:i:s"));
          
          $respuesta = CrudProductos::actualizarCategoriaModel($datosController, "categoria");

          if($respuesta == "success"){

            echo "<script>swal({title: 'Categoría actualizada con éxito', text: 'Éxito', type:'success'}, 
              function (){
                window.location.href = 'index.php?action=cambioC'
              }); </script>";
            }

          else{

               echo "<script>swal({title: 'Categoría no actualizada', text: 'Ha ocurrido un error', type:'error'}); </script>";
            }

        }
      
      }

      public static function agregarStockController(){
            if(isset($_POST["agregarStock"])){
                $stock = $_POST["agregarStock"];
                $idProducto = $_POST["idP"];
                $respuesta =  new CrudProductos();
                $respuesta->agregarStockModel("productos",$stock, $idProducto);
                //Valiación de la respuesta del modelo para ver si es un usuario correcto.
                if($respuesta){
                    //session_start();
                    echo "<script>swal({title: 'Stock actualizado', text: 'Éxito', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=inventario'
                    }); </script>";
                }

              else{

                   echo "<script>swal({title: 'Stock no actualizado', text: 'Ha ocurrido un error', type:'error'}); </script>";
                }

            }
        }

        public static function eliminarStockController(){
            if(isset($_POST["eliminarStock"])){
                $stock = $_POST["eliminarStock"];
                $idP = $_POST["idP"];
                $respuesta =  new CrudProductos();
                $respuesta->eliminarStockModel("productos",$stock, $idP);
                //Valiación de la respuesta del modelo para ver si es un usuario correcto.
                if($respuesta){
                    //session_start();
                    echo "<script>swal({title: 'Stock actualizado', text: 'Éxito', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=inventario'
                    }); </script>";
                }

              else{

                   echo "<script>swal({title: 'Usuario no actualizado', text: 'Ha ocurrido un error', type:'error'}); </script>";
                }

            }
        }


        #################### TIENDAS ##############################
        public static function vistaTiendasController(){
            $respuesta = CrudProductos::vistaTiendasModel("tienda");

            foreach($respuesta as $row => $item){
                echo'<tr>
              				<td>'.$item["id"].'</td>
              				<td>'.$item["nombre"].'</td>
              				<td>'.$item["date_added"].'</td>
                      <td>'.$item["estado"].'</td>';

                      if ($item["estado"]=="desactiva") {
                        echo '
                      <td><a href="index.php?action=inventario&idTienda='.$item["id"].'"><button class="btn btn-info" disabled="true"><i ></i> Ir a la tienda</button></a></td>';
                      } else{
                        echo '
                      <td><a href="index.php?action=inventario&idTienda='.$item["id"].'"><button class="btn btn-info"><i ></i> Ir a la tienda</button></a></td>';
                      }
                      
              			echo '<td><a href="index.php?action=editarTienda&id='.$item["id"].'" data-tip="Editar"><button class="btn btn-info"><i class="right fa fa-edit"></i> Editar</button></a></td>
                      <td><a href="index.php?action=tiendas&idBorrar='.$item["id"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a></td>
              			</tr>';

            }

            if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = CrudProductos::borrarTiendaModel($id,"tienda");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Tienda eliminada con exito', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=tiendas'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'La tienda no ha sido eliminada', text: 'Ha ocurrido un error', type:'error'}); </script>";
              }
            }
        }


        public static function asignarTienda($idt){
          if (isset($_GET["idTienda"])) {
            $idTienda=$_GET["idTienda"];
            $_SESSION["idTienda"]=$idTienda;
            echo "ENTRO";
          }
        }

        public static function registrarTiendaController(){
            if(isset($_POST["nombre"])){
                $datos = array( "nombre"=>$_POST["nombre"], "date"=>date("Y-m-d h:i:s"), "estado"=>$_POST["estado"]);
                $respuesta=CrudProductos::registrarTiendaModel("tienda",$datos);
                if ($respuesta) {
                    echo "<script>swal({title: 'Tienda registrada con éxito', text: 'Éxtio', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=tiendas'
                    }); </script>";
                    //echo "<script></script>";
                } else {
                  echo "<script>swal({title: 'No se pudo registrar la tienda', text: 'Intente de nuevo más tarde.', type:'error'}); </script>";

                }

            }
        }

        public static function obtenerIdVenta(){
            $respuesta=CrudProductos::obtenerIdVenta();
            if ($respuesta) {
              $_SESSION["idVenta"]=$respuesta["id"];
            }
        }


        public static function editarTiendaController(){
            $datosController = $_GET["id"];
            $respuesta = CrudProductos::editarTiendaModel($datosController, "tienda");
            echo " <form method='post' role='form' name='tiendaEditar'>
                      <div class='box-body'>
                          <div class='form-group'>
                            <input type='hidden' value='".$respuesta["id"]."' name='idEditar'>

                              <label for='nombre'>Nombre</label>
                              <input type='text' name='nombreEditar' class='form-control' value='".$respuesta["nombre"]."'>

                              <label for='estado'>Estado</label>
                              <input type='text' name='estadoEditar' class='form-control' value='".$respuesta["estado"]."'>
                          </div>
                      </div>
                          <button type='submit' class='btn btn-primary' name='tiendaEditar'>Actualizar tienda</button>
                  </form> ";

        }


        #EDITAR 
        #------------------------------------
        public static function actualizarTiendaController(){

            if(isset($_POST["tiendaEditar"])){

                $datosController = array( "id"=>$_POST["idEditar"],
                    "nombre"=>$_POST["nombreEditar"],
                    "date_added"=>date("Y-m-d h:i:s"), "estado"=>$_POST["estadoEditar"]);

                $respuesta = CrudProductos::actualizarTiendaModel($datosController, "tienda");

                if ($respuesta == "success") {
                    echo "<script>swal({title: 'Tienda actualizada con éxito', text: 'Éxtio', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=tiendas'
                    }); </script>";
                } else {
                  echo "<script>swal({title: 'No se pudo actualizar la tienda', text: 'Intente de nuevo más tarde.', type:'error'}); </script>";

                }
              
            }

        }

        public static function vistaVentasController(){
            $respuesta = CrudProductos::vistaVentasModel("ventas");
            foreach($respuesta as $row => $item){
                echo'<tr>
              				<td>'.$item["id"].'</td>
              				<td>'.$item["total_venta"].'</td>
              				<td>'.$item["id_tienda"].'</td>
                      <td>'.$item["id_cliente"].'</td>
              				<td>'.$item["date_added"].'</td>
                      <td><a href="index.php?action=ventas&idBorrar='.$item["id"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a></td>
                      <td><a href="index.php?action=detalleVenta&idDetalle='.$item["id"].'" data-tip="Detalle"><button class="btn btn-info"><i class="right fa fa-info"></i> Ver detalle</button></a></td>
                    </tr>';

            }

            if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = CrudProductos::borrarVentaModel($id,"ventas");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Venta eliminada', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=ventas'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'La venta no ha sido eliminada', text: 'Ha ocurrido un error', type:'error'}); </script>";
              }
            }

        }

        public static function detalleVentaController(){
              $id = $_GET["idDetalle"];

              $respuesta2 = CrudProductos::detalleVentaModel($id,"venta");

              foreach($respuesta2 as $row => $item){
                echo'<tr>
                      <td>'.$item["id_venta"].'</td>
                      <td>'.$item["id_producto"].'</td>
                      <td>'.$item["codigo_producto"].'</td>
                      <td>'.$item["nombre_producto"].'</td>
                      <td>'.$item["cantidad"].'</td>
                      <td>'.$item["total"].'</td>
                    </tr>';

              }
        }

         public static function registrarProductoVController(){
            if(isset($_POST["agregarP"]) && isset($_POST["cantidad"])){
              $prod =CrudProductos::obtenerProdPorNombre("productos", $_POST["producto"]);
              $idVenta=CrudProductos::obtenerIdVenta();

              if ($_POST["cantidad"] <= $prod["cantidad_stock"]) {
                CrudProductos::eliminarStockModel("productos", $_POST["cantidad"], $prod["id"]);
                $total= (int) $prod["precio_producto"]*(int)$_POST["cantidad"];
                $datos = array("id_venta"=>$idVenta["id"], "id_producto"=>$prod["id"], "codigo_producto"=>$prod["codigo_producto"], "nombre_producto"=>$prod["nombre"],"cantidad"=>$_POST["cantidad"], "total"=> $total);
                $respuesta=CrudProductos::registrarProductoVModel("venta",$datos);
                //Valiación de la respuesta del modelo para ver si es un usuario correcto.
                if($respuesta){
                    //session_start();
                    echo "<script>swal({title: 'Producto agregado al carrito', text: 'Producto registrado', type:'success'}); </script>";
                    //echo "<script>window.location.href = 'index.php?action=vender'</script>";
                }else{
                    //header("location:index.php?action=fallo");
                    echo "<script>swal({title: 'Error', text: 'Ha ocurrido un error al intentar agregar el producto', type:'error'}); </script>";
                    //echo "<script>window.location.href = 'index.php?action=fallo'</script>";
                }
              }
              else{
                 echo "<script>swal({title: 'Error', text: 'No hay stock suficiente', type:'error'}); </script>";
              }

            } else if (isset($_POST["cantidad"]) && $_POST["cantidad"]<=0) {
              echo "<script>swal({title: 'Ingrese una cantidad correcta de stock', text: 'Error', type:'error'}); </script>";
            }
        }

        public static function vistaProdVController(){
            $respuesta = CrudProductos::vistaProdVModel("venta");
            foreach($respuesta as $row => $item){
                echo'<tr>
                      <td>'.$item["id_venta"].'</td>
                      <td>'.$item["id_producto"].'</td>
                      <td>'.$item["codigo_producto"].'</td>
                      <td>'.$item["nombre_producto"].'</td>
                      <td>'.$item["cantidad"].'</td>
                    </tr>';
            }
        }


        public static function registrarVentaController()
        {
          if (isset($_POST["guardar"])) {
           
            $total= CrudProductos::sumarTotal("venta");
            $datos = array("date_added"=>date("Y-m-d h:i:s"), 
                          "total_venta" => $total["total"], 
                          "id_tienda" => $_SESSION["idTienda"],
                          "cliente"=> $_POST["cliente"]);
            
            //Se le dice al modelo que en la clase "CrudProductos", la funcion "registroarUsuarioModel" reciba en sus 2 parametros los valores "$datos" y el nombre de la tabla a conectarnos la cual es "users"
            $respuesta = CrudProductos::registrarVentaModel("ventas", $datos);
            $_SESSION["idVenta"]+=1;
            //Valiación de la respuesta del modelo para ver si es un usuario correcto.
            if ($respuesta) {
                echo "<script>swal({title: 'Venta registrada con éxito', text: 'Éxtio', type:'success'}, 
                    function (){
                      window.location.href = 'index.php?action=ventas'
                    }); </script>";
            } else {
              echo "<script>swal({title: 'No se realizo la venta', text: 'Venta no registrada', type:'error'}); </script>";
            }
            
          }
        }

        public static function obtenerNumProductos() //Cuenta el numero de productos que hay
        {
          $numProductos = CrudProductos::totalProductos();
          if ($numProductos) {
            echo "<h3>".$numProductos["totalP"]."</h3>";
          }
        }

        public static function obtenerNumVentas() //Cuenta el numero de ventas realizadas
        {
          $num = CrudProductos::totalVentas();
          if ($num) {
            echo "<h3>".$num["totalV"]."</h3>";
          }
        }

        public static function obtenerNumUsuarios() //Cuenta el numero de usuarios que existen
        {
          $num = CrudProductos::totalUsuarios();
          if ($num) {
            echo "<h3>".$num["totalU"]."</h3>";
          }
        }


        public static function vistaClientesController(){
            $respuesta = CrudProductos::vistaClientesModel($_SESSION["idTienda"],"clientes");

            #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

            foreach($respuesta as $row => $item){
                echo'<tr>
                      <td>'.$item["id"].'</td>
                      <td>'.$item["nombre"].'</td>
                      <td>'.$item["apellido"].'</td>
                      <td>'.$item["email"].'</td>
                      <td>'.$item["direccion"].'</td>
                      <td>'.$item["telefono"].'</td>
                      <td>'.$item["date_added"].'</td>
                      <td><a href="index.php?action=editarCliente&id='.$item["id"].'"><button class="btn btn-info">Editar</button></a></td>
                      <td><a href="index.php?action=clientes&idBorrar='.$item["id"].'"><button class="btn btn-danger">Borrar</button></a></td>
                    </tr>';

            }
            if (isset($_GET["idBorrar"])) {
              $id = $_GET["idBorrar"];

              $respuesta2 = CrudProductos::borrarClienteModel($id,"clientes");

              if($respuesta2){
                  //session_start();
                  echo "<script>swal({title: 'Cliente eliminado', text: 'Éxito', type:'success'}, 
                  function (){
                    window.location.href = 'index.php?action=clientes'
                  }); </script>";
              }

              else{

                 echo "<script>swal({title: 'Cliente no eliminado', text: 'Error', type:'error'}); </script>";
              }
            }
            
        }


        public static function editarClienteController(){
          $datosController = $_GET["id"];
          $respuesta = CrudProductos::editarClienteModel($datosController, "clientes");
            echo "<form method='post' role='form'>
                      <div class='box-body'>
                          <div class='form-group'>
                            <input type='hidden' value='".$respuesta["id"]."' name='idEditar'>
                              <label for='nombre'>Nombre</label>
                              <input type='text' name='nombreEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["nombre"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='apellido'>Apellido</label>
                              <input type='text' name='apellidoEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["apellido"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='email'>Direecion</label>
                              <input type='email' name='emailEditar' class='form-control' value='".$respuesta["email"]."'>
                          </div>
                          <div class='form-group'>
                              <label for='usuario'>Direccion</label>
                              <input type='text' name='direccionEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["direccion"]."' required>
                          </div>
                          <div class='form-group'>
                              <label for='usuario'>Telefono</label>
                              <input type='text' name='telefonoEditar' class='form-control' id='exampleInputEmail1' value='".$respuesta["telefono"]."' required>
                          </div>
      
                      </div>
                          <button type='submit' class='btn btn-primary' name='clienteEditar'>Actualizar usuario</button>
                  </form>";

      }
        
        public static function actualizarClienteController(){

          if(isset($_POST["clienteEditar"])){

            $datosController = array( "id"=>$_POST["idEditar"],
                              "nombre"=>$_POST["nombreEditar"],
                              "apellido"=>$_POST["apellidoEditar"],
                                    "direccion"=>$_POST["direccionEditar"],
                                    "telefono"=>$_POST["telefonoEditar"],
                                    "email"=>$_POST["emailEditar"], 
                                    "date"=>date("Y-m-d h:i:s"));
            
            $respuesta = CrudProductos::actualizarClienteModel($datosController, "clientes");

            if($respuesta == "success"){

              echo "<script>swal({title: 'Cliente actualizado con éxito', text: 'Éxito', type:'success'}, 
              function (){
                window.location.href = 'index.php?action=cambioCliente'
              }); </script>";
            }

          else{

               echo "<script>swal({title: 'Cliente no actualizado', text: 'Ha ocurrido un error', type:'error'}); </script>";
            }

          }
        
        }
          
	}
  ?>