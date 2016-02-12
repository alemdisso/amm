<?php
error_reporting(E_ALL | E_STRICT);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

// Ensure zend_version is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../../Zend_1.11.11'),
    get_include_path(),
)));

//$array_path = explode(PATH_SEPARATOR, get_include_path());
//$array_path[] = realpath(APPLICATION_PATH . '/../../Zend_1.11.11');
//$newPathString = implode(PATH_SEPARATOR, $array_path);
//set_include_path($newPathString);

require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_AutoLoader::getInstance();
$autoloader->registerNamespace('PHPUnit_');
$autoloader->registerNamespace('Moxca_');
$autoloader->registerNamespace('Author_');


require_once 'Zend/Application.php';
require_once 'ControllerTestCase.php';
