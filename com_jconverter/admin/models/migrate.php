<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class JConverterModelMigrate extends JModel
{
	var $_config = null;
	var $_externalDB = null;
	var $_status = array();

	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct() {
		parent::__construct();

		ini_set('max_execution_time','3600');

		$this->_config = $this->getConfig();
		$this->getConnectToExternalDB();

	}


	function getConfig() {

		$configFile = JPATH_COMPONENT.DS.'jconverter_config.php';
		include( $configFile );

		$config = array();
        $config['driver']   = 'mysql';
		$config['host']     = $WpConfig['hostname'];
        $config['user']     = $WpConfig['username'];
        $config['password'] = $WpConfig['password'];
        $config['database'] = $WpConfig['dbname'];
        $config['prefix']   = $WpConfig['prefix'];

		return $config;

	}


	function getConnectToExternalDB () {

		$this->_externalDB = JDatabase::getInstance( $this->_config );
		//echo "hasUTF(): " . $this->_externalDB->hasUTF() . "<br>";
		//print_r($this->_externalDB);

		//mb_detect_order("GB2312,ISO-8859-1,UTF-8");
		//echo implode(", ", mb_detect_order());

		if ( $this->_externalDB->message ) {
			//print_r($this->_externalDB);
			$this->setError($this->_externalDB->message);
			return false;
		}

		$query = "SET NAMES `utf8`";
        $this->_externalDB->setQuery( $query );
        $data = $this->_externalDB->query();

		return true;

	}

	function getMigration () {

		$configFile = JPATH_COMPONENT.DS.'jconverter_config.php';
		include( $configFile );

		//print_r($this);

		if ( !$this->getError() ) {

			//echo "-10";

			if ($WpConfig['backup'] == 1)
				$this->_status['backup'] = $this->__startBackup();
			else
				$this->_status['backup'] = 9999;

			if ($WpConfig['users'] == 1)
				$this->_status['users'] = $this->migrateWpUsers();
			else
				$this->_status['users'] = 9999;

			if ($WpConfig['categories'] == 1)
	        	$this->_status['categories'] = $this->migrateWpCategories();
			else
				$this->_status['categories'] = 9999;

			if ($WpConfig['content'] == 1)
    	    	$this->_status['content'] = $this->migrateWpPosts();
			else
				$this->_status['content'] = 9999;

			if ($WpConfig['pages'] == 1)
	   	     	$this->_status['pages'] = $this->migrateWpPages();
			else
				$this->_status['pages'] = 9999;

			if ($WpConfig['weblinks'] == 1)
				$this->_status['weblinks'] = $this->migrateWpLinks();
			else
				$this->_status['weblinks'] = "9999";

			if ($WpConfig['comments'] == 1)
				$this->_status['comments'] = $this->migrateWpComments();
			else
				$this->_status['comments'] = "9999";

	        //print_r($status);
			//print_r($this->_status);
			//echo "0<br>";

			return $this->_status;

		}

	}

	function __startBackup() {

        $backupFile = "components/com_jconverter/backups/" . $this->_config['database'] . "-" . date("YmdHis") . '.gz';
        $command = "mysqldump --opt -h " . $this->_config['host'] . " -u " . $this->_config['user'] . " -p" .  $this->_config['password'] . " " . $this->_config['database'] . "| gzip > " . $backupFile;
		//echo $command . "<br><br>";
        system($command);

		return 0;
	}


    function getNewParams( $oldParams ) {

		$params = new JParameter('');
		$oldParams = new JParameter( $oldParams );

		$params->set('show_headings', $oldParams->get('leading'));
		$params->set('show_date', $oldParams->get('date'));
        $params->set('date_format', $oldParams->get('date_format'));
        $params->set('filter', 1);
        $params->set('filter_type', $oldParams->get('orderby_pri'));

        $params->set('orderby_sec', $oldParams->get('orderby_sec'));
        $params->set('show_pagination', $oldParams->get('pagination'));
        $params->set('show_pagination_limit', $oldParams->get('pagination_results'));
        $params->set('show_feed_link', '');
        $params->set('show_noauth', '');

        $params->set('show_title', $oldParams->get('page_title'));
        $params->set('link_titles', $oldParams->get('link_titles'));
        $params->set('show_intro', $oldParams->get('intro'));
        $params->set('show_section', '');
        $params->set('link_section', $oldParams->get('sectionid'));

        $params->set('show_category', $oldParams->get('category'));
        $params->set('link_category', $oldParams->get('category_link'));
        $params->set('show_author', $oldParams->get('author'));
        $params->set('show_create_date', $oldParams->get('createdate'));
        $params->set('show_modify_date', $oldParams->get('modifydate'));

        $params->set('show_item_navigation', '');
        $params->set('show_readmore', $oldParams->get('readmore'));
        $params->set('show_vote', '');
        $params->set('show_icons', '');
        $params->set('show_pdf_icon', $oldParams->get('pdf'));

        $params->set('show_print_icon', $oldParams->get('print'));
        $params->set('show_email_icon', $oldParams->get('email'));
        $params->set('show_hits', '');
        $params->set('feed_summary', '');
        $params->set('page_title', '');

        $params->set('show_page_title', $oldParams->get('leading'));
        $params->set('pageclass_sfx', $oldParams->get('pageclass_sfx'));
        $params->set('menu_image', $oldParams->get('menu_image'));
        $params->set('secure', '0');


		//print_r($params);

        return $params;
    }

    function migrateWpUsers() {

		$query = "SELECT u.*, m.meta_value FROM " . $this->_config['prefix'] . "users u, "
		. $this->_config['prefix'] . "usermeta m "
		." WHERE u.id = m.user_id AND m.meta_key = 'wp_capabilities' AND u.user_login != 'admin'";

		//echo $query;

		$this->_externalDB->setQuery( $query );
		$users = $this->_externalDB->loadObjectList();
		//print_r($users);
		//$ret = $this->insertObjectList('#__users', $users);

		$db =& JFactory::getDBO();

		foreach ($users as $user)
		{
			$uType = $this->wpUserType(mysql_real_escape_string($user->meta_value));
			$uName = mysql_real_escape_string($user->display_name);
			$uLogin = mysql_real_escape_string($user->user_login);
			$uEmail = mysql_real_escape_string($user->user_email);
			$uPass = mysql_real_escape_string($user->user_pass);
			$uRegDate = mysql_real_escape_string($user->user_registered);
			$query = "INSERT INTO #__users (name, username, email, password, usertype, registerDate, gid) VALUES ('$uName', '$uLogin', '$uEmail', '$uPass', '$uType', '$uRegDate', 18)";
			//echo $query;
			$db->setQuery( $query );
			$ret = $db->query();

			if($ret != FALSE)
			{
				$query = "SELECT id FROM #__users WHERE name = '$uName'";
				$db->setQuery( $query );
				$uid = $db->loadResult();
				if($uid > 0)
				{
					$query = "INSERT INTO #__core_acl_aro (section_value, value, name) VALUES ('users', '$uid', '$uName')";
					$db->setQuery( $query );
					$ret = $db->query();
					if($ret != FALSE)
					{
						$query = "SELECT id FROM #__core_acl_aro WHERE value = '$uid'";
						$db->setQuery( $query );
						$aroid = $db->loadResult();
						if($aroid > 0)
						{
							$query = "INSERT INTO #__core_acl_groups_aro_map (group_id, aro_id) VALUES (18, '$aroid')";
							$db->setQuery( $query );
							$ret = $db->query();
						}
					}
				}

			}
		}

		return $ret;
	}

	function wpUserType($userDetails) {

		if (strpos($userDetails, 'administrator') !== false)
			return 'Administrator';
		else
			return 'Registered';

	}

	function migrateWpCategories() {

		$this->createWpSection();

		$query = "SELECT name FROM " . $this->_config['prefix'] . "terms";
		//echo $query;

		$this->_externalDB->setQuery( $query );
		$categories = $this->_externalDB->loadObjectList();
		//print_r($categories);

		$db =& JFactory::getDBO();
		$query = "SELECT id FROM #__sections WHERE title = 'WordPress'";
		$db->setQuery( $query );
		$sid = $db->loadResult();

		foreach ($categories as $category)
		{
			$catName = mysql_real_escape_string($category->name);
			$query = "INSERT INTO #__categories (title, section, published) VALUES ('$catName', '$sid', 1)";
			//echo $query;
			$db->setQuery( $query );
			$ret = $db->query();
		}

		return $ret;
	}

	function createWpSection() {

		$db =& JFactory::getDBO();

		$query = "SELECT * FROM #__sections WHERE title = 'WordPress'";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		if (count($rows) < 1)
		{
			$query = "INSERT INTO #__sections (title, scope, published) VALUES ('WordPress', 'content', 1)";
			//echo $query;

			$db->setQuery( $query );
			$ret = $db->query();
			//print_r($categories);
			return $ret;
		}

	}

	function migrateWpPosts() {

		$query = "SELECT * FROM " . $this->_config['prefix'] . "posts WHERE post_status = 'publish' AND post_type = 'post'";
		//echo $query;

		$this->_externalDB->setQuery( $query );
		$posts = $this->_externalDB->loadObjectList();
		//print_r($posts);
		//$ret = $this->insertObjectList('#__users', $users);

		$db =& JFactory::getDBO();
		$query = "SELECT id FROM #__sections WHERE title = 'WordPress'";
		$db->setQuery( $query );
		$sid = $db->loadResult();


		foreach ($posts as $post)
		{
			$pTitle = mysql_real_escape_string($post->post_title);
			$pIntro = mysql_real_escape_string($post->post_excerpt);
			$pContent = mysql_real_escape_string($post->post_content);
			$pDate = mysql_real_escape_string($post->post_date);
			$pId = mysql_real_escape_string($post->ID);
			$query = "INSERT INTO #__content (id, title, introtext, #__content.fulltext, created, created_by, state, sectionid) VALUES ('$pId', '$pTitle', '$pIntro', '$pContent', '$pDate', 62, 1, '$sid')";
			//echo $query;
			$db->setQuery( $query );
			$ret = $db->query();
			//echo $db->errorMsg();
		}

		return $ret;

	}

	function migrateWpPages() {

		$query = "SELECT * FROM " . $this->_config['prefix'] . "posts WHERE post_status = 'publish' AND post_type = 'page'";
		//echo $query;

		$this->_externalDB->setQuery( $query );
		$posts = $this->_externalDB->loadObjectList();
		//print_r($posts);
		//$ret = $this->insertObjectList('#__users', $users);

		$db =& JFactory::getDBO();
		$query = "SELECT id FROM #__sections WHERE title = 'WordPress'";
		$db->setQuery( $query );
		$sid = $db->loadResult();


		foreach ($posts as $post)
		{
			$pTitle = mysql_real_escape_string($post->post_title);
			$pIntro = mysql_real_escape_string($post->post_excerpt);
			$pContent = mysql_real_escape_string($post->post_content);
			$pDate = mysql_real_escape_string($post->post_date);
			$query = "INSERT INTO #__content (title, introtext, #__content.fulltext, created, created_by, state, sectionid) VALUES ('$pTitle', '$pIntro', '$pContent', '$pDate', 62, 1, '$sid')";
			//echo $query;
			$db->setQuery( $query );
			$ret = $db->query();
		}

		return $ret;

	}

    function migrateWpLinks() {


		$this->createWpLinkCategories();

		$query = "SELECT `link_url`, `link_name`, `link_description`"
				." FROM " . $this->_config['prefix'] . "links";

        $this->_externalDB->setQuery( $query );
        $links = $this->_externalDB->loadObjectList();
        //print_r($data);

		$db =& JFactory::getDBO();
		$query = "SELECT id FROM #__categories WHERE section = 'com_weblinks' AND title = 'WordPress Links'";
		$db->setQuery( $query );
		$catid = $db->loadResult();

		foreach ($links as $link)
		{
			$lUrl = mysql_real_escape_string($link->link_url);
			$lName = mysql_real_escape_string($link->link_name);
			$lDesc = mysql_real_escape_string($link->link_description);
			if($catid != null)
				$query = "INSERT INTO #__weblinks (title, url, description, published, catid) VALUES ('$lName', '$lUrl', '$lDesc', 1, '$catid')";
			else
				$query = "INSERT INTO #__weblinks (title, url, description, published) VALUES ('$lName', '$lUrl', '$lDesc', 1)";

			//echo $query;
			$db->setQuery( $query );
			$ret = $db->query();
		}

		return $ret;
    }

	function createWpLinkCategories() {

		$db =& JFactory::getDBO();

		$query = "INSERT INTO #__categories (title, section, published) VALUES ('WordPress Links', 'com_weblinks', 1)";
		$db->setQuery( $query );
		$ret = $db->query();

		return $ret;

	}

    function migrateWpComments() {

		$query = "SELECT * FROM " . $this->_config['prefix'] . "comments";

        $this->_externalDB->setQuery( $query );
        $comments = $this->_externalDB->loadObjectList();
        //print_r($comments);

		$db =& JFactory::getDBO();

		foreach ($comments as $comment)
		{
			$id = mysql_real_escape_string($comment->comment_ID);
			$parentID = mysql_real_escape_string($comment->comment_parent);
			$contentID = mysql_real_escape_string($comment->comment_post_ID);			
			$authName = mysql_real_escape_string($comment->comment_author);
			$authEmail = mysql_real_escape_string($comment->comment_author_email);
			$authUrl = mysql_real_escape_string($comment->comment_author_url);
			$authIP = mysql_real_escape_string($comment->comment_author_IP);
			$commentDate = mysql_real_escape_string($comment->comment_date);
			$commentContent = mysql_real_escape_string($comment->comment_content);
			$commentApproved = mysql_real_escape_string($comment->comment_approved);
												
			$query = "INSERT INTO #__jomcomment (id, parentid, contentid, name, email, website, ip, date, comment, published) VALUES 			('$id', '$parentID', '$contentID', '$authName', '$authEmail', '$authUrl', '$authIP', '$commentDate', '$commentContent', '$commentApproved')";
			//print_r($comment, 1);
			//echo $query;
			$db->setQuery( $query );
			$ret = $db->query();
		}

		return $ret;
    }

}
?>
