<?php
class Database
{
    private static $dbName = 'crud_php' ; //Base de datos en la que guardamos los datos de los usuarios
    private static $dbHost = 'localhost' ; //host de la base de datos, normalmente es localhost
    private static $dbUsername = 'root'; //Nuestro usuario de acceso a nuestras bases de datos
    private static $dbUserPassword = ''; //Nuestra contraseña de usuario de la base de datos
     
    private static $cont  = null;
     
    public function __construct() { //Esta función es el constructor de la clase. La inicialización de esta clase no está permitida.
        die('Init function is not allowed');
    }
     
    public static function connect() { //Esta es la funcion principal de esta clase, se usa paraasegurar que solo una conexión a la base de datos se usa a lo largo de toda la aplicación.
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect(){ //Desconecta de la base de datos (cierra la conexión)
        self::$cont = null;
    }
}
?>