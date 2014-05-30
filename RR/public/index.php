<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../../ZEND/library'),
	realpath(APPLICATION_PATH . '/../../ZendFramework-1.12.5/library'),
    get_include_path(),
    
)));


/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

/*	CONEXION A LA BASE	*/
$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'implementacion');
Zend_Registry::set('config', $config);

$configDB = $config->resources->db->params;
$mydb = new PDO("mysql:host=" . $configDB->host . ";dbname=" . $configDB->dbname . ";", $configDB->username , $configDB->password);
$mydb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$mydb->setAttribute(PDO::ATTR_CASE,PDO::CASE_NATURAL);
Zend_Registry::set('mydb', $mydb);

/*	MENSAJES	*/
require_once 'Zend/Application.php';
require_once APPLICATION_PATH.'/modules/Mensajes.php';
require_once APPLICATION_PATH.'/modules/FuncionesGrales.php';
$mensajes = new Mensajes();
Zend_Registry::set('mensajes', $mensajes);
$fgrales = new FuncionesGrales();
Zend_Registry::set('funcionesgrales', $fgrales);

$application->bootstrap()
            ->run();