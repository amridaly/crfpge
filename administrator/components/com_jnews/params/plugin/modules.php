<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

class JFormFieldHelp extends JFormField {
	function fetchElement($name, $value, &$node, $control_name){
		if( version_compare( JVERSION,'3.0.0','<' ) ) {
			JHTML::_('behavior.modal');
		} else {
			JHtml::_('behavior.modal');
		}
		$link = jNews_Tools::completeLink( 'option=com_content&task=element&object=content', true, false, true );
		$text = '<input class="inputbox" id="'.$control_name.'termscontent" name="'.$control_name.'[termscontent]" type="text" size="20" value="'.$value.'">';
		$text .= '<a class="modal" id="termscontent" title="'.JText::_('Select one content which will be displayed for the Terms & Conditions').'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 650, y: 375}}"><button onclick="return false">'.JText::_('Select').'</button></a>';
		$js = "function jSelectArticle(id, title, object) {
			document.getElementById('".$control_name."termscontent').value = id;
			document.getElementById('sbox-window').close();
		}";
		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);
		return $text;
	}
}
