<?php
defined('_JEXEC') or die('Restricted access');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

	class JFormFieldHelp extends JFormField
	{
		var $type = 'help';
		function getInput() {
			
			if(!defined('JNEWS_JPATH_ROOT')){
				if ( defined('JPATH_ROOT') AND class_exists('JFactory')) {	// joomla 15
					$mainframe = JFactory::getApplication();
					define ('JNEWS_JPATH_ROOT' , JPATH_ROOT );
				}
			}

			jimport('joomla.filesystem.file');
			if ( strtolower( substr( JPATH_ROOT, strlen(JPATH_ROOT)-13 ) ) =='administrator' ) {
				$adminPath = strtolower( substr( JPATH_ROOT, strlen(JPATH_ROOT)-13 ) );
			} else {
				$adminPath = JPATH_ROOT;
			}
			
			if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
			
			$mainAdminPathDefined = $adminPath .DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_jnews'.DIRECTORY_SEPARATOR.'defines.php';
			
			if( version_compare( JVERSION,'3.0.0','<' ) ) {
				JHTML::_('behavior.modal','a.modal');
			} else {
				JHtml::_('behavior.modal','a.modal');
			}			
			
			if ( JFile::exists( $mainAdminPathDefined ) ) {
				require_once( $mainAdminPathDefined );
				if ( JFile::exists(JNEWS_JPATH_ROOT .DIRECTORY_SEPARATOR.'administrator'.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.JNEWS_OPTION.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class.jnews.php')) {
					require_once(JNEWS_JPATH_ROOT .DIRECTORY_SEPARATOR.'administrator'.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.JNEWS_OPTION.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class.jnews.php');
				} else {
					die ("jNews Module\n<br />This module needs the jNews component.");
				}
				$link = JNEWS_HOME_SITE.'/index.php?option=com_jlinks&controller=redirect&link=Mod_jnews'; //this should be a jlinks for the module documentation
				$text = '<a class="modal" title="'.JText::_('Help',true).'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 800, y: 500}}"><button onclick="return false">'.JText::_('Help').'</button></a>';
				return $text;
           }
		}
	}
