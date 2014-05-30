<?php

class Mensajes{
	private $MENSAJE_USR = array();

	public function Mensajes(){
		$this->MENSAJE_USR["000"] = "Error en la Base de Datos :: ";
		$this->MENSAJE_USR["001"] = "Usuario o contrase&ntilde;a incorrecta";
		$this->MENSAJE_USR["002"] = "En este momento no se puede procesar la solicitud.<br/>Vuelva a intentarlo en unos minutos";
		$this->MENSAJE_USR["007"] = "El tiempo de la sesion ha expirado, ingrese nuevamente";
		$this->MENSAJE_USR["008"] = "Faltan parametros";
	}
	public function getMensaje($code){
		return $this->MENSAJE_USR[$code];
	}

}
