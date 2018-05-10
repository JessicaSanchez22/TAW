<?php

	class Formulario{
		//Propiedades o componentes del formulario, cada uno de los campos que tendrá.
		public $nombre;
		public $email;
		public $comentario;
		public $sexo;
		public $website;
		public $nameErr;
		public $emailErr;
		public $genderErr;
		public $websiteErr;

		//Funcion que valida que el nombre no esté vació
		function validarNombre($nombre){
			if(empty($nombre)){
				$this->nameErr= "El nombre es un campo requerido";
			} 
			else{
				$this->nombre=$nombre;
			}
		 	//If que determina que solo se usen letras y espacios en blanco.
	        if (!preg_match("/^[a-zA-Z ]*$/",$this->nombre)) {
	            $this->nameErr = "Solo letras y espacios son permititdos";
	        }
		}

		//Funcion que valida que el email no esté vació
		function validarEmail($email){
			if(empty($email)){
				$this->emailErr= "El email es un campo requerido";
			} else {
			    	$this->email=$email;
			    	//If que determina que el email sea válido
					if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			            $this->emailErr = "El email no está en un formato correcto";
			    } 
			}
			
		}
		//funcion que valida que la URL del sitio web esté bien escrita o sea real.
		function validarSitioWeb($website){
			if(empty($website)){
				$this->website="";
			} 
			else{
				$this->website=$website;
			
		        //Revisa si la URL es valida(this regular expression also allows dashes in the URL)
		        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$this->website)) {
		            $this->websiteErr ="URL Invalida";
		        }
		    }
		}
		//funcion que valida el comentario.
		function validarComentario($comentario){
			if(empty($comentario)){
				$this->comentario="";
			} 
			else{
				$this->comentario=$comentario;
			}
			//If que determina que solo se usen letras y espacios en blanco.
	        if (!preg_match("/^[a-zA-Z ]*$/",$this->nombre)) {
	            $this->nameErr = "Solo letras y espacios son permititdos";
	        }
		}
		//funcion que determina que el sexo este seleccionado
		function validarSexo($sexo){
			if (empty($sexo)) {
		        $this->genderErr = "El campo sexo s requerido";
		    } else {
		        $this->sexo = $sexo;
		    }
		}	
	}

$formulario= new Formulario();
foreach ($_POST as $key => $value) {
	switch ($key) {
		case 'name':
			$formulario->validarNombre($value);
			break;
		case 'email':
			$formulario->validarEmail($value);
			break;
		case 'website':
			$formulario->validarSitioWeb($value);
			break;
		case 'comment':
			$formulario->validarComentario($value);
			break;
		case 'gender':
			$formulario->validarSexo($value);
			break;

	}
}
header("Location:formulario.php?nombre=$formulario->nombre&email=$formulario->email&website=$formulario->website&comentario=$formulario->comentario&sexo=$formulario->sexo&nameErr=$formulario->nameErr&emailErr=$formulario->emailErr&genderErr=$formulario->genderErr&websiteErr=$formulario->websiteErr");
?>