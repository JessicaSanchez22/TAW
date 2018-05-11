<?php
include 'dbconexion.php';

class CRUD{
	public function insert(){
		$pdo = Database::connect();
        $sql = "INSERT INTO usuarios (id,usuario,password) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array(null,$usuario,$password));
        Database::disconnect();
        header("Location: index.php");
	}
}
?>