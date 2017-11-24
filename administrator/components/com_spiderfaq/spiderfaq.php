<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_spiderfaq/tables');


$bar= JToolBar::getInstance( 'toolbar' );
$bar->appendButton('Custom','<a href="http://web-dorado.com/products/joomla-faq-extension.html" target="_blank" style=""><img src="components/com_spiderfaq/images/buyme.png" border="0" alt="http://web-dorado.com/products/joomla-faq-extension.html" style="float:left"></a>', 'custom');

$controllerName = JRequest::getCmd( 'c', 'questions' );


if($controllerName == 'categories') {
	JSubMenuHelper::addEntry(JText::_('Questions'), 'index.php?option=com_spiderfaq');
	JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_spiderfaq&c=categories', true );
	JSubMenuHelper::addEntry(JText::_('Themes'), 'index.php?option=com_spiderfaq&c=themes');
	JSubMenuHelper::addEntry(JText::_('Plugin Code Generator'), 'index.php?option=com_spiderfaq&c=plggen');
} else {
if($controllerName == 'themes')
{
	JSubMenuHelper::addEntry(JText::_('Questions'), 'index.php?option=com_spiderfaq');
	JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_spiderfaq&c=categories');
	JSubMenuHelper::addEntry(JText::_('Themes'), 'index.php?option=com_spiderfaq&c=themes', true);
		JSubMenuHelper::addEntry(JText::_('Plugin Code Generator'), 'index.php?option=com_spiderfaq&c=plggen');
	}
	else
	{
	if($controllerName == 'plggen'){
	JSubMenuHelper::addEntry(JText::_('Questions'), 'index.php?option=com_spiderfaq');
	JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_spiderfaq&c=categories');
	JSubMenuHelper::addEntry(JText::_('Themes'), 'index.php?option=com_spiderfaq&c=themes');
		JSubMenuHelper::addEntry(JText::_('Plugin Code Generator'), 'index.php?option=com_spiderfaq&c=plggen', true);
		}
		else{
		JSubMenuHelper::addEntry(JText::_('Questions'), 'index.php?option=com_spiderfaq', true);
	JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_spiderfaq&c=categories');
	JSubMenuHelper::addEntry(JText::_('Themes'), 'index.php?option=com_spiderfaq&c=themes');
		JSubMenuHelper::addEntry(JText::_('Plugin Code Generator'), 'index.php?option=com_spiderfaq&c=plggen');
		
		}
	}
}

switch ($controllerName)
{
	default:
		$controllerName = 'questions';
		// allow fall through

	case 'questions' :
	
	case 'categories':
		// Temporary interceptor
		$task = JRequest::getCmd('task');
		
		if ($task == 'categories') {
			$controllerName = 'categories';
		}
		
		case 'themes':
		// Temporary interceptor
		$task = JRequest::getCmd('task');
		
		if ($task == 'themes') {
			$controllerName = 'themes';
		}
		
		case 'plggen':
		// Temporary interceptor
		$task = JRequest::getCmd('task');
		
		if ($task == 'plggen') {
			$controllerName = 'plggen';
		}
		
case 'addcat':
		// Temporary interceptor
		$task = JRequest::getCmd('task');
		
		if ($task == 'addcat') {
			$controllerName = 'addcat';
		}
	
case 'addcontent':
		// Temporary interceptor
		$task = JRequest::getCmd('task');
		
		if ($task == 'addcontent') {
			$controllerName = 'addcontent';
		}	
		
		
case 'images':
		// Temporary interceptor
		$task = JRequest::getCmd('task');
		
		if ($task == 'images') {
			$controllerName = 'images';
		}
		
		
		
		
		require_once( JPATH_COMPONENT.'/controllers/'.$controllerName.'.php' );
		$controllerName = 'SpiderfaqController'.$controllerName;

		// Create the controller
		$controller = new $controllerName();

		// Perform the Request task
		$controller->execute( JRequest::getCmd('task') );

		// Redirect if set by the controller
		$controller->redirect();
		break;
}


			
			