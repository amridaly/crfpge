<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co
class JFormFieldVmfields extends JFormField{
	function fetchElement($name, $value, &$node, $control_name){
		$db = JFactory::getDBO();
		$db->setQuery('SELECT `virtuemart_custom_id`, `custom_title` FROM #__virtuemart_customs ');
		$tableField = $db->loadObjectList();
		
		if ( empty($tableField) ) {	//old VM version
			$tableField = $db->getTableFields('#__vm_user_info');	
			$fields = reset( $tableField );
			$dropdown = array();
			foreach($fields as $oneField => $fieldType ) {
				$dropdown[] = jnews::HTML_SelectOption( $oneField, $oneField );
			}
			return jnews::HTML_GenericList( $dropdown, $control_name.'['.$name.']' , 'size="1"', 'value', 'text', $value);
		}

		//new VM version
		$dropdown = array();
		foreach($tableField as $oneField => $fieldType ) {
			$dropdown[] = jnews::HTML_SelectOption( $fieldType->virtuemart_custom_id, $fieldType->custom_title );
		}
		return jnews::HTML_GenericList( $dropdown, $control_name.'['.$name.']' , 'size="1"', 'value', 'text', $value);
	}
}
