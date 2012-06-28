<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class JConverterControllerMigrate extends JConverterController
{

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		parent::registerDefaultTask('migrate');

		// Register Extra tasks
		//$this->registerTask( 'add'  , 	'edit' );
	}


    function migrate(){

		$model =& $this->getModel('migrate');

		//print_r($model);

		if ( $model->_errors[0] ) {
            $msg = JText::_( $model->_errors[0] );

            $link = 'index.php?option=com_jconverter';
            $this->setRedirect($link, $msg);
		}

		JRequest::setVar( 'view', 'migrate' );
		parent::display();
    }




    function display() {

        JRequest::setVar( 'view', 'migrate' );

        parent::display();
    }


}
?>
