<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.parameter.element');
$document		=& JFactory::getDocument();
$document->addScript(JURI::root() . 'administrator/components/com_spiderfaq/elements/js/jscolor/jscolor.js');

class JFormFieldFaq extends JFormField
{
	
	
	var     $type  = 'Faq';

	function getInput()
	{
		
		
		$db =& JFactory::getDBO();

		$query = 'SELECT id, title
		 FROM #__spiderfaq_category 
		 WHERE published = 1
		 ORDER BY id'
		;
		$db->setQuery( $query );
		$options = $db->loadObjectList();
		
        $name = $this->name;
		$value = $this->value;
		$node =  $this->element;
		$control_name = $this->options['title'];
		$id=  $this->id;
		?>
        <span id="faq_cat"></span>
		<script type="text/javascript">
        
		show1=document.getElementById("show1").checked;
	if (show1)
	{
document.getElementById("faq_cat").parentNode.parentNode.setAttribute("style","display:none");

	}
	
	
        </script>
        <?php
		
		for($i=0;$i<count($options);$i++)
		{
		$rowcat=&$options[$i];
		if (strlen($rowcat->title)<30){
		 $row_cat=$rowcat->title;
		 }
else{
 $row_cat=substr_replace($rowcat->title,"...",30);
}
$options[$i]->title=$row_cat;
		}
		
		
		return JHTML::_('select.genericlist', $options, $this->name, $control_name, 'id', 'title', $this->value );
		
		 
	}
}
?>
