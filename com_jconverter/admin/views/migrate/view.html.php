<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class JConverterViewMigrate extends JView
{
	/**
	 *
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(  JText::_( 'Migrate!' ), 'install.png' );
		//JToolBarHelper::deleteList();
		//JToolBarHelper::editListX();
		//JToolBarHelper::addNewX();
        //JToolBarHelper::cancel();
        //JToolBarHelper::save();
		//JToolBarHelper::spacer();

		$status = & $this->get('Migration');

		//print_r($status);
		//print_r($items);

		// Get data from the model
		///$items		= & $this->get( 'Data');

		//$this->assignRef('items',		$items);

		$errors = $this->__errorCheck($status);

		$this->assignRef('errors', $errors);

		parent::display($tpl);
	}

	function __errorCheck ( $status ) {

		//print_r($status);

		$errors = array();

		foreach ($status as $key => $value) {

			if ($value == 1062) {
				$errors[$key] = "FAILED! - Duplicate key";
            }else if ($value == 1054) {
                $errors[$key] = "FAILED! - Unknown columm";
			}else if ($value == 0) {
				$errors[$key] = "OK!";
			}else if ($value == 9999) {
				$errors[$key] = "Disable";
			}
		}

		return $errors;
	}

}
