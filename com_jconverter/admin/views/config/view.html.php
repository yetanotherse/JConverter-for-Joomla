<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');
jimport('joomla.filesystem.file');

class JConverterViewConfig extends JView
{
	/**
	 * Hellos view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'Configuration' ), 'config.png' );
		//JToolBarHelper::deleteList();
		//JToolBarHelper::editListX();
		//JToolBarHelper::addNewX();
		JToolBarHelper::apply();
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();

		$configFile = JPATH_COMPONENT.DS.'jconverter_config.php';
		if (JFile::exists( $configFile )) {
			include( $configFile );
		}

		$lists['users'] = JHTML::_('select.booleanlist', 'users', '', $WpConfig['users']);
		$lists['backup'] = JHTML::_('select.booleanlist', 'backup', '', $WpConfig['backup']);
		$lists['pages'] = JHTML::_('select.booleanlist', 'pages', '', $WpConfig['pages']);
		$lists['categories'] = JHTML::_('select.booleanlist', 'categories', '', $WpConfig['categories']);
		$lists['content'] = JHTML::_('select.booleanlist', 'content', '', $WpConfig['content']);
		$lists['weblinks'] = JHTML::_('select.booleanlist', 'weblinks', '', $WpConfig['weblinks']);
		$lists['comments'] = JHTML::_('select.booleanlist', 'comments', '', $WpConfig['comments']);
		
		$this->assignRef('lists', $lists);
		$this->assignRef('items', $WpConfig);
		$this->assignRef('ext', $ext);

		parent::display($tpl);
	}
}
