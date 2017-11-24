<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

class jnews_renderMod {

	function renderModule() {

		$code = jnews::getVar('code', '', null, 'string');
		$config = JFactory::getConfig();
		$secret = $config->get('config.secret');
		if ( $code != $secret ) exit;
		
		$protect = JRequest::getInt('protect');
		$time = time();

		if( empty($protect) || ( $time > $protect + 5 ) || $time < $protect ) exit;

		$id = JRequest::getInt('id');
		if( empty($id) ) exit;

		$db = JFactory::getDBO();
	 	$db->setQuery( 'SELECT * FROM #__modules WHERE `id`=' . (int)$id.' LIMIT 1' );
	 	$module = $db->loadObject();
	
	 	if ( empty($module) ) exit;
	 	
		$module->user  	= substr( $module->module, 0, 4 ) == 'mod_' ?  0 : 1;
		$module->name = $module->user ? $module->title : substr( $module->module, 4 );
		$module->style = null;
		$module->module = preg_replace( '/[^A-Z0-9_\.-]/i', '', $module->module );
		$params = array();
		$lang =& JFactory::getLanguage();
		$lang->load( $module->module );		
		echo JModuleHelper::renderModule( $module, $params );
		exit;
		
	}
	
}
