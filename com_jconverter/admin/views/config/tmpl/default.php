<?php

defined('_JEXEC') or die('Restricted access');
?>

<form action="index.php" method="post" name="adminForm">
<div id="editcell">

<table border="0" width="100%">
<tr>
	<td width="50%" valign="top">

	<table class="adminlist">
	<tr>
		<td colspan="2">
			<h3><?php echo JText::_( "WordPress Database Configuration" ); ?></h3>
		</td>
	</tr>
	<tr>
		<td align="right">
			<?php echo JText::_( "Hostname" ); ?>
		</td>
		<td>
			<?php
				if ($this->items['hostname'] == "") {
					$this->items['hostname'] = "localhost";
				}
			?>
			<input type="text" name="hostname" value="<?php echo $this->items['hostname'];?>" />
		</td>
	</tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Database Name" ); ?>
        </td>
        <td>
			<input type="text" name="dbname" value="<?php echo $this->items['dbname'];?>" />
        </td>
    </tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "UserName" ); ?>
        </td>
        <td>
            <input type="text" name="username" value="<?php echo $this->items['username'];?>" />
        </td>
    </tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Password" ); ?>
        </td>
        <td>
			<input type="password" name="password" value="<?php echo $this->items['password'];?>" />
        </td>
    </tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Prefix" ); ?>
        </td>
        <td>
			<?php
				if ($this->items['prefix'] == "") {
					$this->items['prefix'] = "wp_";
				}
			?>
            <input type="text" name="prefix" value="<?php echo $this->items['prefix'];?>" />
        </td>
	</tr>
	<tr>
		<td colspan="2">
			<h3><?php echo JText::_( "Configuration" ); ?></h3>
		</td>
	</tr>

	<tr>
		<td align="right">
			<?php echo JText::_( "Make Backup?" ); ?>
		</td>
		<td>
			<?php echo $this->lists['backup']; ?>
		</td>
	</tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Import Users?" ); ?>
        </td>
		<td>
			<?php echo $this->lists['users']; ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Import Categories?" ); ?>
        </td>
		<td>
			<?php echo $this->lists['categories']; ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Import Posts?" ); ?>
        </td>
		<td>
			<?php echo $this->lists['content']; ?>
        </td>
	</tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Import Pages?" ); ?>
        </td>
		<td>
			<?php echo $this->lists['pages']; ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Import Links?" ); ?>
        </td>
		<td>
			<?php echo $this->lists['weblinks']; ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <?php echo JText::_( "Import Comments in JomComment?" ); ?>
        </td>
		<td>
			<?php echo $this->lists['comments']; ?>
        </td>
    </tr>

	</table>
	</td>

	<td valign="top">
	<table class="adminlist">
    <tr>
        <td align="left">
        <center><strong>IMPORTANT : PLEASE READ</strong></center>
        <hr />
		<p>
			<span style="align: left; color: #000000; font-family: arial; font-size: 13px; line-height: normal"><div  align="left"><ul align="left"><li align="left"><b>WE STRONGLY RECOMMEND THAT YOU FIRST INSTALL JOOMLA <u>WITHOUT SAMPLE DATA</u> AND THEN INSTALL JCONVERTER TO IMPORT WORDPRESS INTO YOUR JOOMLA SITE.</b></li><br/><li align="left">JConverter imports the categories from Wordpress however it doesn't associate the imported posts/pages with corresponding categories since Wordpress allows associating posts/pages with multiple categories but Joomla doesn't. Moreover, since Joomla doesn't support sub-categories, JConverter imports all categories and sub-categories from Wordpress as category.</li><br /><li align="left">Wordpress uses phpass algorithm for users password encryption but Joomla uses MD5. Hence users login password imported from Wordpress will not work. One way to get over it is to install Wordpress "MD5 Password Hashes" plugin before you import your Wordpress site in Joomla using JConverter. This plugin converts the Wordpress passwords in MD5 which Joomla understands - <a href="http://wordpress.org/extend/plugins/md5-password-hashes/" target="_blank">http://wordpress.org/extend/plugins/md5-password-hashes/</a><a href="http://wordpress.org/extend/plugins/md5-password-hashes/" target="_blank"></a><br /><strong><u>NOTE</u> :</strong> We are planning to include a new feature in forthcoming releases where you will be able to set a common password for all users. You can communicate the new password to them using Joomla mass mail feature or by any other means.</li><br /><li align="left"> JConveter imports only database, not the files which might be part of posts/pages (e.g. images etc). That need to be taken care of manually by editing the imported posts/pages in Joomla.</li><br /><li align="left"> For importaing links from WordPress database, JConverter creates a link category "WordPress Links" and imports all links from WordPress under it.</li> <br/><li align="left">Please note that you need to install JomComment before you can import comments</li> </ul></div><div><br /></div></span>   <span>     <img src="https://www.paypal.com/en_US/i/scr/pixel.gif" border="0" width="1" height="1" />  </span>
		</p>
        </td>
    </tr>
	<tr>
        <td align="center">

			<p>If you liked the idea and our extension, please donate for continued development of new features in JConverter and bug fixing.</p>
			<span style="color: #000000; font-family: arial; font-size: 13px; line-height: normal">
			<form style="text-align: center;" action="https://www.paypal.com/cgi-bin/webscr" method="post"> <input name="cmd" type="hidden" value="_s-xclick" /> <input name="hosted_button_id" type="hidden" value="8276380" /> <input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" type="image" /> <img src="https://www.paypal.com/en_US/i/scr/pixel.gif" border="0" width="1" height="1" /> </form>
			</span>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>



</div>

<input type="hidden" name="option" value="com_jconverter" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="config" />

</form>
