<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class JConverterControllerhelp extends JConverterController
{
	function __construct()
	{
		parent::__construct();

	}

    function display() {

        JRequest::setVar( 'view', 'help' );

        parent::display();
    }


}
?>
