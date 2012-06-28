<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class JConverterControllerConfig extends JConverterController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
	}

	function apply() {

		$model = $this->getModel('config');

		$data = JRequest::get( 'post' );

		if ($model->saveConfig($data)) {
			$msg = JText::_( 'Configuration Applied!' );
		} else {
			$msg = JText::_( 'Error Applying Configuration' );
		}

		JRequest::setVar( 'view', 'config' );

		$link = 'index.php?option=com_jconverter&controller=config';
		$this->setRedirect($link, $msg);
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('config');

		$data = JRequest::get( 'post' );

		if ($model->saveConfig($data)) {
			$msg = JText::_( 'Configuration Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Configuration' );
		}

		$link = 'index.php?option=com_jconverter';
		$this->setRedirect($link, $msg);
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Configuration Cancelled' );
		$this->setRedirect( 'index.php?option=com_jconverter', $msg );
	}

    function display() {

        JRequest::setVar( 'view', 'config' );

        parent::display();
    }


}
?>
