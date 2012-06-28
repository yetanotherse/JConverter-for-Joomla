<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class JConverterModelConfig extends JModel
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();

		//$array = JRequest::getVar('cid',  0, '', 'array');
		//$this->setId((int)$array[0]);
	}


	function saveConfig( $post ) {

		$configText = "<?php\n";
		$configText .= "\$WpConfig['hostname'] = \"" . $post['hostname'] . "\";\n";
		$configText .= "\$WpConfig['dbname'] = \"" . $post['dbname'] . "\";\n";
		$configText .= "\$WpConfig['username'] = \"" . $post['username'] . "\";\n";
		$configText .= "\$WpConfig['password'] = \"" . $post['password'] . "\";\n";
		$configText .= "\$WpConfig['prefix'] = \"" . $post['prefix'] . "\";\n";
		$configText .= "\$WpConfig['backup'] = \"" . $post['backup'] . "\";\n";
		$configText .= "\$WpConfig['users'] = \"" . $post['users'] . "\";\n";
		$configText .= "\$WpConfig['pages'] = \"" . $post['pages'] . "\";\n";
		$configText .= "\$WpConfig['categories'] = \"" . $post['categories'] . "\";\n";
		$configText .= "\$WpConfig['content'] = \"" . $post['content'] . "\";\n";
		$configText .= "\$WpConfig['weblinks'] = \"" . $post['weblinks'] . "\";\n";
		$configText .= "\$WpConfig['comments'] = \"" . $post['comments'] . "\";\n";
		$configText .= "?>\n";

		jimport('joomla.filesystem.file');

        $configFile = JPATH_COMPONENT.DS.'jconverter_config.php';

        if (JFile::exists( $configFile )) {
			require_once( $configFile );
        }else{
			JFile::copy( $configFile . '.orig', $configFile );
		}

		$return = JFile::write($configFile, $configText);

		return $return;

	}


}
?>
