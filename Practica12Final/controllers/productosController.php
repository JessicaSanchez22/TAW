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
            $respuesta = CrudProductos::vistaProductosModel("productos");

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
                      <td><a href="index.php?action=borrarProducto&idBorrar='.$item["id"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a></td>
               </tr>';

            }
        }



		public static function registrarProductoController(){
			if(isset($_POST['nombre'])){
        //Recibe a través del método post los campos a 
        //registrar del producto, y se almacenan los datos en un array asociativo que será usado más adelante, por el modelo.
				$data = array("codigo_producto"=>$_POST["codigo"], "nombre" => $_POST["nombre"], "date_added"=>date("Y-m-d h:i:s"), "precio_producto"=>$_POST["precio"], "cantidad_stock"=>$_POST["stock"], "categoria"=>$_POST["categoria"]);
        //Se le dice al modelo que es lo que se va a agregar a la base de datos a través de la funcion registrarProductoModel
				$resp = CrudProductos::registrarProductoModel("productos", $data);

				if($resp == "success"){
					//header("location: index.php?action=ok");
                    echo "<script>alert('Producto registrado con éxito!')</script>";
                    echo "<script>window.location.href = 'index.php?action=inventario'</script>";
				}
        else{
					//header("location: index.php");
                    echo "<script>window.location.href = 'index.php'</script>";
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

        echo "<script>alert('Producto actualizado con éxito');</script>";
        echo "<script>window.location.href = 'index.php?action=cambioP'</script>";

      }

      else{

        echo "error";

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
                //Verfica si el usuario existe en la base de datos
                if(($respuesta["usuario"] == $_POST["usuario"]) && ($respuesta["password"] == $_POST["password"])){
                    $_SESSION["validar"] = true;
                    $_SESSION["usuario"] = $_POST["usuario"];
                    $_SESSION["password"] = $_POST["password"];

                    //SE utiliza un window.location.href ya que al momento de usar un header location, lo que hace este es que carga todo el MVC completo, y junto con el la sesión, creando conflicto en ciertas partes. Es por esto que se prefiere usar un window location para que solo mueste la pagina que desemos, pero dentro de la misma sesion de usuarios en la que estamos.
                    echo "<script>window.location.href = 'index.php?action=dashboard'</script>";
                }
                else{
                    echo "<script>window.location.href = 'index.php?action=fallo'</script>";
                }

            }
		}

		public static function registrarUsuarioController(){
            if(isset($_POST["usuario"]) && isset($_POST["password"])){
                $datos = array( "nombre"=>$_POST["nombre"], "apellido"=>$_POST["apellido"],
                    "usuario"=>$_POST["usuario"], "password"=>$_POST["password"], "email"=>$_POST["correo"], "date"=>date("Y-m-d h:i:s"));
                //Se le dice al modelo que en la clase "CrudProductos", la funcion "registroarUsuarioModel" reciba en sus 2 parametros los valores "$datos" y el nombre de la tabla a conectarnos la cual es "users"
                $respuesta =  new CrudProductos();
                $respuesta->registrarUsuarioModel("users",$datos);
                //Valiación de la respuesta del modelo para ver si es un usuario correcto.
                if($respuesta){

                    echo "<script>alert('Usuario registrado con éxito');</script>";
                    echo "<script>window.location.href = 'index.php?action=usuarios'</script>";
                }else{

                    echo "<script>alert('Error al intentar registrar usuario');</script>";
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
                      <td><a href="index.php?action=borrarUsuario&idBorrar='.$item["id"].'"><button class="btn btn-danger">Borrar</button></a></td>
                    </tr>';

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

        echo "<script>alert('Usuario actualizado con éxito');</script>";
        echo "<script>window.location.href = 'index.php?action=cambioU'</script>";

      }

      else{

        echo "error";

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
                    echo "<script>alert('Categoria registrada exitosamente');</script>";
                    echo "<script>window.location.href = 'index.php?action=categorias'</script>";
                }else{
                    //header("location:index.php?action=fallo");
                    echo "<script>alert('Hubo un error al registrar la categoria');</script>";
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
                      <td><a href="index.php?action=borrarCategoria&idBorrar='.$item["id_categoria"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i> Borrar</button></a></td>
              			</tr>';

            }
        }

        public static function obtenerCategoriaController(){
            $respuesta = CrudProductos::vistaCategoriasModel("categoria");

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["nombre_categoria"].'</option>';
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

            echo "<script>alert('La categoria se ha actualizado con éxito');</script>";
            echo "<script>window.location.href = 'index.php?action=cambioC'</script>";

          }

          else{

            echo "error";

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
                    echo "<script>alert('Stock actualizado exitosamente');</script>";
                    echo "<script>window.location.href = 'index.php?action=inventario'</script>";
                }else{
                    //header("location:index.php?action=fallo");
                    echo "<script>alert('Error al actualizar el stock');</script>";
                    //echo "<script>window.location.href = 'index.php?action=fallo'</script>";
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
                    echo "<script>alert('Stock actualizado exitosamente');</script>";
                    echo "<script>window.location.href = 'index.php?action=inventario'</script>";
                }else{
                    //header("location:index.php?action=fallo");
                    echo "<script>alert('Hubo un error al actualizar el stock');</script>";
                    //echo "<script>window.location.href = 'index.php?action=fallo'</script>";
                }

            }
        }

	}


?>