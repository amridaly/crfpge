<?php
defined('_JEXEC') or die('Restricted access');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

 class subscribersReportType {

 	public static function subscirbersType(){
		$values = array();
		$values[] = jnews::HTML_SelectOption( 'all-users', JText::_(_JNEWS_SUBSCRIBERS_ALL_USERS) );
		$values[] = jnews::HTML_SelectOption( 'registered', JText::_(_JNEWS_SUBSCRIBERS_REGISTERED) );
		$values[] = jnews::HTML_SelectOption( 'guests', JText::_(_JNEWS_SUBSCRIBERS_GUESTS) );

		return jnews::HTML_RadioList(   $values, "subcscriberstype", 'class="inputbox" size="1"', 'value', 'text',"subcscriberstype");
	}
 }

