<?php

class AdmController extends Zend_Controller_Action
{

    public function init()
    {
        $this->config 		= Zend_Registry::get('config');
        $this->baseDatos 	= new Application_Model_Usuario();
    }

    public function indexAction()
    {
        // action body
    }

    public function crearusuarioAction()
    {
    	$this->view->headScript()->appendFile($this->getFrontController()->getBaseUrl().'/js/adm-crearusuario.js');
    	/*    	
    	$this->view->nombre_usuario		= $this->session->nombre_usuario;
    	
        $data 	 	= $this->baseDatos->getUsuarios();
        echo "<pre>";
        var_dump($data);
        
        $this->view->error = 1;
        $mensaje = $this->mensajes->getMensaje('002');
        $this->view->mensaje = $mensaje;
        */
    	try {
	    	$request = $this->getRequest();
	    	if ($this->getRequest()->isPost()){
	    		if ($form->isValid($request->getPost())){
	    			$nombre 	= $this->getRequest()->getParam("nombre");
	    			$apellido 	= $this->getRequest()->getParam("apellido");
	    			$email 		= $this->getRequest()->getParam("email");
	    			
	    			$largo_pass = $config->usuario->largo_pass;
	    			$data 	 	= $this->baseDatos->crearUsuario($nombre, $apellido, $email, $largo_pass);
	    			
	    			$this->view->hay_mensaje = 1;
	    			$mensaje = $this->mensajes->getMensaje('009');
	    			$mensaje = preg_replace("#USUARIO#", $nombre, $mensaje);
	    			$mensaje = preg_replace("#PASS#", $data, $mensaje);
	    			
	    			$this->view->mensaje = $mensaje;
    				//$this->_helper->redirector('reporteimprimir','imprimir',null,array('clave'=>$clave));
	    		}
    		}
	    	else{
	    		$form->setDefault("cliente", $this->getRequest()->getParam("cliente"));
	    		//$this->view->trabajoActual =  $this->getRequest()->getParam("trabajo");
	   		}
    	}
    	catch (Exception $e){
    		$this->view->error_ppal = $e->getMessage();
    	}
    }
}



