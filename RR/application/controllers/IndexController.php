<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        try{
	        $this->mensajes  = Zend_Registry::get('mensajes');
	        $this->baseDatos = new Application_Model_Usuario();

	        $mysession = new Zend_Session_Namespace('mysession');
	        $this->session = $mysession;

	    	$options = array('layout'   => 'layout-sin-login');
	    	Zend_Layout::startMvc($options);
    	}
    	catch(Exception $e){
    		
    	}
    }

    public function indexAction()
    {
    	$options = array('layout'   => 'layout');
    	Zend_Layout::startMvc($options);
    	/*
    	error_log("1111111111111");
    	$this->view->headScript()->appendFile($this->getFrontController()->getBaseUrl().'/js/index-index.js');
    	    	
    	$this->view->nombre_usuario		= $this->session->nombre_usuario;
    	
        $data 	 	= $this->baseDatos->getUsuarios();
        echo "<pre>";
        var_dump($data);
        
        $this->view->error = 1;
        $mensaje = $this->mensajes->getMensaje('002');
        $this->view->mensaje = $mensaje;
        */
    }

    public function loginAction()
    {
    	$salida = array();
    	$salida["status"] 		= "ok";
    	$salida["valido"] 		= "0";
    	$salida["mensajeError"] = "";
    	
    	try{
    		 
    		$login	= $this->getRequest()->getParam("login");
    		$pass 	= $this->getRequest()->getParam("password");
    		
    		if ($login != "" and $pass != "") {
    			
    			$data 	 	= $this->baseDatos->login($login, $pass);
				if(!$data){
					$salida["status"] 		= "er";
					$mensaje = $this->mensajes->getMensaje('001');
					$salida["mensajeError"] = $mensaje;
				}
				else{
					$this->session->id_usuario 		= $data->id;
					$this->session->login_usuario	= $login;
					$this->session->nombre_usuario	= $login;
					$salida["valido"] 		= "1";
				}
    		}
    	}
    	catch (Exception $e){
    		$salida["status"] 		= "er";
    		$salida["mensajeError"] = $this->mensajes->getMensaje("002");
    	}
    	//return Zend_Json::encode($salida);
    	return $this->_helper->json->sendJson($salida);
    }
}

