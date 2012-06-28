<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class JConverterControllerCpanel extends JConverterController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		//$this->registerTask( 'add'  , 	'edit' );
	}

    function display() {

        JRequest::setVar( 'view', 'cpanel' );

        parent::display();
    }


}
?>
