<?php

defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class JConverterViewHelp extends JView {
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'Help' ), 'help_header.png' );

		parent::display($tpl);
	}
}
