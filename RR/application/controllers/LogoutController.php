<?php

class LogoutController extends Zend_Controller_Action
{

    public function init()
    {
		$options = array('layout'   => 'layout');
	    Zend_Layout::startMvc($options);
    }

    public function indexAction()
    {
      	//$mysession = new Zend_Session_Namespace('mysession');
    	if (isset($this->session->id_usuario)){
	    	unset($this->session->id_usuario);
			unset($this->session->nombre_usuario);
			unset($this->session);
			Zend_Session::namespaceUnset('mysession');
			Zend_Session::destroy(); 
	    	$this->_helper->redirector('index','login');
		}
    }


}

