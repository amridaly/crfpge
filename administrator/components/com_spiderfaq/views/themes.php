<?php
  /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

class SpiderfaqViewThemes
{

	function setThemesToolbar()
	{
		JToolBarHelper::title( JText::_( 'Theme  Manager' ), 'generic.png' );
		
		JToolBarHelper::addNew();
		JToolBarHelper::editList();
		JToolBarHelper::deleteList();
		
		
		
		
	}

	function themes( &$rows, &$pageNav, &$lists )
	{
		SpiderfaqViewThemes::setThemesToolbar();
		JHTML::_('behavior.tooltip');
		
		?>
		<form action="#" method="post" name="adminForm" id="adminForm">
<fieldset class="adminform">
<div class="updated" style="font-size: 14px; color:red !important"><p><strong>This feature is disabled for the non-commercial version.</strong></p></div>
<table width="80%">
  <tbody>
                <tr>   
<td width="100%" style="font-size:14px; font-weight:bold"><a href="http://web-dorado.com/joomla-faq-extension-guide-step-1.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a><br>
This section allows you to create/edit themes for the FAQs.<br /> This feature is disabled for
the non-commercial version. <a href="http://web-dorado.com/joomla-faq-extension-guide-step-1.html" target="_blank" style="color:blue; text-decoration:none;">More...</a><br>
Here are some examples of 17 standard templates included in the commercial version. <a href="http://demo.web-dorado.com/spider-faq.html" target="_blank" style="color:blue; text-decoration:none;">Demo</a></td>  

        </tr>


  </tbody></table>
  <img src="components/com_spiderfaq/images/white_theme.png">

</fieldset>
</form>
    <?php
	}
	
	
	
	
	function setThemeToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');

		JToolBarHelper::title( $task == 'add' ? JText::_( 'Theme' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Theme' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( 'save' );
		JToolBarHelper::apply('apply');
		JToolBarHelper::cancel( 'cancel' );
	}

	function theme( &$row, &$lists )
	{
		SpiderfaqViewThemes::setThemeToolbar();
	
	}
	
	
}
