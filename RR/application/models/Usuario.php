<?php

class Application_Model_Usuario{
	
    private $_baseDatos		= NULL;
	
    public function __construct(array $options = null){
		try{    	
			$db 						= Zend_Registry::get('mydb');
			$this->_baseDatos 			= $db;
			$this->mensajes  			= Zend_Registry::get('mensajes');
			$this->funcionesgrales  	= Zend_Registry::get('funcionesgrales');
		}
		catch(Exception $e){
			throw new Exception($e->getMessage(), $e->getCode());
		}	
    }
    public function login($login = "", $pass = ""){
    	try{
    		if(($login != "") AND ($pass != "")){
	    		$consulta = " SELECT id FROM usuario WHERE email = :login AND password = :pass ";
	    		$smt = $this->_baseDatos->prepare($consulta);
	    		$res = $smt->execute(array('login' => $login, 
	    								   'pass' => md5($pass)));
	    		$row = $smt->fetch( PDO::FETCH_OBJ );
	    		return $row;
    		}
    		else{
    			error_log($this->mensajes->getMensaje('008'));
    			throw new Exception($this->mensajes->getMensaje('008'), "008");
    		}
    	}
    	catch(Exception $e){
    		error_log(print_r($e->getCode(),1));
    		error_log(print_r($e->getMessage(),1));
    		throw new Exception($e->getMessage(), $e->getCode());
    	}
    }
    public function getUsuarios(){
    	try{
    		$consulta = " SELECT * FROM usuario ";
    		$smt = $this->_baseDatos->prepare($consulta);
    		$res = $smt->execute(array());
    		$rows = $smt->fetchAll( PDO::FETCH_OBJ );
    		return $rows;
    	}
    	catch(Exception $e){
    		throw new Exception($e->getMessage(), $e->getCode());
    	}
    }    
    public function crearUsuario($nombre = "", $apellido = "", $email ="", $largo_pass = 0){
    	try{
    		if($nombre == "" or $email == ""){
    			throw new Exception($this->mensajes->getMensaje('008'), "008");
    		}
    		
    		$pass = $this->funcionesgrales->random_gen($largo_pass);
    		
    		$consulta = " INSERT INTO usuario (email, nombre, passowrd) VALUES (:email, :nombre, :pass) ";
    		$smt = $this->_baseDatos->prepare($consulta);
    		$res = $smt->execute(array('login' => $login, 
    								   'nombre'=> $nombre,
    								   'pass' => md5($pass)));
    		//$row = $smt->fetch( PDO::FETCH_OBJ );
    		return $pass;
    	}
    	catch(Exception $e){
    		throw new Exception($e->getMessage(), $e->getCode());
    	}
    }
}