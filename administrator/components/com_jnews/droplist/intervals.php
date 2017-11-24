<?php
defined('_JEXEC') or die('Restricted access');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

 class intervalReportType {

 	public static function intervalType($selected){
		$values = array();
		$values[] = jnews::HTML_SelectOption('daily', JText::_(_JNEWS_INTERVAL_DAILY) );
		$values[] = jnews::HTML_SelectOption( 'weekly', JText::_(_JNEWS_INTERVAL_WEEKLY) );
		$values[] = jnews::HTML_SelectOption( 'monthly', JText::_(_JNEWS_INTERVAL_MONTHLY) );
		$values[] = jnews::HTML_SelectOption( 'yearly', JText::_(_JNEWS_INTERVAL_YEARLY) );

		return jnews::HTML_RadioList(   $values, "rptinterval", 'class="inputbox" size="1"','value', 'text',$selected);
	}
 }

