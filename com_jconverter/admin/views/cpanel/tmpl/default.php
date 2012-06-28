<?php

defined('_JEXEC') or die('Restricted access');

$version = "v0.3 Beta";

?>
<style>
/* standard form style table */
table.cpanel_about {
	background-color: #F7F8F9;
	border: solid 1px #d5d5d5;
	width: 100%;
	padding: 10px;
	border-collapse: collapse;
}
table.cpanel_about tr.row0 {
	background-color: #F7F8F9;
}
table.cpanel_about tr.row1 {
	background-color: #eeeeee;
}
table.cpanel_about th {
	font-size: 15px;
	font-weight:normal;
	font-variant:small-caps;
	padding-top: 6px;
	padding-bottom: 2px;
	padding-left: 4px;
	padding-right: 4px;
	text-align: left;
	height: 25px;
	color: #666666;
	background: url(../images/background.gif);
	background-repeat: repeat;
}
table.cpanel_about td {
	padding: 3px;
	text-align: left;
	border: 1px;
	border-style:solid;
	border-bottom-color:#EFEFEF;
	border-right-color:#EFEFEF;
	border-left-color:#EFEFEF;
	border-top-color:#EFEFEF;
}

table.cpanel_icon {
	background-color: #F7F8F9;
	border: solid 1px #d5d5d5;
	width: 100%;
	padding: 5px;
}
table.cpanel_icon td {
	padding: 5px;
	text-align: center;
	border: 1x;
	border-style: solid;
	border-bottom-color:#EFEFEF;
	border-right-color:#EFEFEF;
	border-left-color:#EFEFEF;
	border-top-color:#EFEFEF;
}
.cpanel_icon td:hover {
	background-color: #B5CDE8;
	border:	1px solid #30559C;
}
</style>
<table class="cpanel_about">
<tr class="cpanel_about">
	<td width="50%" valign="top" class="cpanel_about">
    <table width="100%" class="cpanel_icon">
    <tr class="cpanel_icon">
    	<td align="center" height="100px" width="33%" class="cpanel_icon" colspan="3">
        	<a href="index2.php?option=com_jconverter&amp;controller=config" style="text-decoration:none;">
            	<img src="templates/khepri/images/header/icon-48-config.png" align="middle" border="0"/><br />
				<?php echo JText::_( 'Configuration' ); ?>
            </a>
        </td>
        <td align="center" height="100px" width="33%" class="cpanel_icon">
            <a href="index2.php?option=com_jconverter&amp;controller=migrate" style="text-decoration:none;">
            	<img src="templates/khepri/images/header/icon-48-install.png" align="middle" border="0" onClick="alert('Please wait. This process can take time depending on size of your WordPress database.');" />
            	<br />
            	<?php echo JText::_( "Start Conversion!") ;?>
            	</a>
        </td>
        <td align="center" height="100px" width="33%" class="cpanel_icon">
            <a href="index2.php?option=com_jconverter&amp;controller=help" style="text-decoration:none;">
                <img src="templates/khepri/images/header/icon-48-help_header.png" align="middle" border="0"/>
                <br />
                <?php echo JText::_( "Help" ) ;?>
                </a>
        </td>
		</tr>
		<tr>
			<td align="center" height="50px" width="33%" class="cpanel_icon" colspan="3">
			</td>
			<td align="center" height="50px" width="33%" class="cpanel_icon">
					<form style="text-align: center;" action="https://www.paypal.com/cgi-bin/webscr" method="post"> <input name="cmd" type="hidden" value="_s-xclick" /> <input name="hosted_button_id" type="hidden" value="8276380" /> <input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" type="image" /> <img src="https://www.paypal.com/en_US/i/scr/pixel.gif" border="0" width="1" height="1" /> </form>
			</td>
			<td align="center" height="50px" width="33%" class="cpanel_icon">
			</td>
		</tr>
	 </table>
      </td>
      <td width="50%" valign="top" align="center">
      <table border="1" width="100%" class="cpanel_about">
         <tr class="cpanel_about">
            <th class="cpanel" colspan="2">JConverter - Wordpress to Joomla Converter</th></td>
         </tr>
         <tr class="cpanel_about"><td bgcolor="#FFFFFF" colspan="2"><br />
      <div style="width=100%" align="center">
      <img src="components/com_jconverter/images/logo.png" align="middle" alt="SopanTech Logo"/>
      <br /><br /></div>

      </td></tr>
         <tr class="cpanel_about">
            <td width="120" bgcolor="#FFFFFF">Installed version:</td>
            <td bgcolor="#FFFFFF"><?php echo $version;?></td>
         </tr>
         <tr class="cpanel_about">
            <td bgcolor="#FFFFFF">Copyright:</td>
            <td bgcolor="#FFFFFF">&copy; 2009-2010 <a href="http://www.sopantech.com/">http://www.sopantech.com/</a></td>
         </tr>
         <tr class="cpanel_about">
            <td bgcolor="#FFFFFF">License:</td>
            <td bgcolor="#FFFFFF"><a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU GPL</a></td>
         </tr>
      </table>
      </td>
   </tr>
</table>
