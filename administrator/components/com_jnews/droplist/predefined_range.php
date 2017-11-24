<?php
defined('_JEXEC') or die('Restricted access');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

 class rangeReportType {

 	public static function rangeType($selected){
		$values = array();
		$values[] = jnews::HTML_SelectOption( 'yesterday', JText::_(_JNEWS_DEFINED_RANGE_YESTERDAY) );
		$values[] = jnews::HTML_SelectOption( 'today', JText::_(_JNEWS_DEFINED_RANGE_TODAY) );
		$values[] = jnews::HTML_SelectOption( 'this-week', JText::_(_JNEWS_DEFINED_RANGE_THIS_WEEK) );
		$values[] = jnews::HTML_SelectOption( 'last-week', JText::_(_JNEWS_DEFINED_RANGE_LAST_WEEK) );
		$values[] = jnews::HTML_SelectOption( 'last-2-weeks', JText::_(_JNEWS_DEFINED_RANGE_LAST_TWO_WEEK) );
		$values[] = jnews::HTML_SelectOption( 'this-month', JText::_(_JNEWS_DEFINED_RANGE_THIS_MONTH) );
		$values[] = jnews::HTML_SelectOption( 'last-month', JText::_(_JNEWS_DEFINED_RANGE_LAST_MONTH) );
		$values[] = jnews::HTML_SelectOption( 'this-year', JText::_(_JNEWS_DEFINED_RANGE_THIS_YEAR) );
		$values[] = jnews::HTML_SelectOption( 'last-year', JText::_(_JNEWS_DEFINED_RANGE_LAST_YEAR) );
		$values[] = jnews::HTML_SelectOption( '2-years-ago', JText::_(_JNEWS_DEFINED_RANGE_TWO_YEARS_AGO) );
		$values[] = jnews::HTML_SelectOption( '3-years-ago', JText::_(_JNEWS_DEFINED_RANGE_3_YEARS_AGO) );

		return jnews::HTML_GenericList(   $values, "rptrange", 'class="inputbox" size="1"', 'value', 'text',$selected);
	}
 }

