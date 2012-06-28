<?php

defined('_JEXEC') or die('Restricted access');

//print_r($this->status);
?>
<div id="tablecell">
	<div id="fail-message">
		<p><strong>
		You can safely ignore "Failed! - Duplicate Key!" errors. Please verify first that the contents you imported are present in your Joomla site or not.
		</strong></p>
	</div>
    <table class="adminform">
    <tr>
        <th class="title">
            <h3><?php echo JText::_( 'Information' ); ?></h3>
        </th>
        <th class="title">
            <h3><?php echo JText::_( 'Status' ); ?></h3>
        </th>
    </tr>

    <tr class="row0">
        <td align="right">
            <?php echo JText::_( 'Backup old table' ); ?>
        </td>
        <td>
            <?php echo $this->errors['backup']; ?>
        </td>
	</tr>
    <tr class="row1">
        <td align="right">
            <?php echo JText::_( 'Import Users' ); ?>
        </td>
        <td>
			<?php echo $this->errors['users']; ?>
        </td>
    </tr>
    <tr class="row0">
        <td align="right">
            <?php echo JText::_( 'Import Pages' ); ?>
        </td>
        <td>
            <?php echo $this->errors['pages']; ?>
        </td>
    </tr>
    <tr class="row1">
        <td align="right">
            <?php echo JText::_( 'Import Categories' ); ?>
        </td>
        <td>
            <?php echo $this->errors['categories']; ?>
        </td>
    </tr>
    <tr class="row0">
        <td align="right">
            <?php echo JText::_( 'Import Posts' ); ?>
        </td>
        <td>
            <?php echo $this->errors['content']; ?>
        </td>
    </tr>
    <tr class="row1">
        <td align="right">
            <?php echo JText::_( 'Import Weblinks' ); ?>
        </td>
        <td>
            <?php echo $this->errors['weblinks']; ?>
        </td>
    </tr>
    <tr class="row0">
        <td align="right">
            <?php echo JText::_( 'Import Comments' ); ?>
        </td>
        <td>
            <?php echo $this->errors['comments']; ?>
        </td>
    </tr>

    </table>

</div>


