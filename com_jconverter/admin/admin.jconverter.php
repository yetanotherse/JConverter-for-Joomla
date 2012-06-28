<?php

// no direct access
defined('_JEXEC') or die('Restricted access');


// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );

// Require specific controller if requested
$controller = JRequest::getVar('controller', 'cpanel');

//echo $controller;

if($controller) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	//echo $path;
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = 'Cpanel';
    }
}


// Create the controller
$classname	= 'JConverterController'.$controller;
//echo $classname;
$controller = new $classname( );
//$controller->registerDefaultTask('cpanel');

// Perform the Request task
$controller->execute( JRequest::getVar('task'));

// Redirect if set by the controller
$controller->redirect();

?>
