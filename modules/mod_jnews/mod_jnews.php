<?php
defined('_JEXEC') or die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

if(!defined('JNEWS_JPATH_ROOT')){
	if ( defined('JPATH_ROOT') AND class_exists('JFactory') ) {	// joomla 15
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
if ( !defined('DS') ) define( 'DS', DIRECTORY_SEPARATOR );
$mainAdminPathDefined = $adminPath .DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_jnews'.DIRECTORY_SEPARATOR.'defines.php';

if ( JFile::exists( $mainAdminPathDefined ) ) {
	require_once( $mainAdminPathDefined );
	
	if ( JFile::exists(JNEWS_JPATH_ROOT .DIRECTORY_SEPARATOR.'administrator'.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.JNEWS_OPTION.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class.jnews.php')) {
		require_once(JNEWS_JPATH_ROOT .DIRECTORY_SEPARATOR.'administrator'.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.JNEWS_OPTION.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'class.jnews.php');
	} else {
		die ("jNews Module. This module needs jNews component.");
	}
	
	$jNewsModule = new jnews_module();
	echo $jNewsModule->normal( $params, $module );
	
}
