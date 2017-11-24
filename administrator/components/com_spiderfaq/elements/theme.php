<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.parameter.element');

class JFormFieldTheme extends JFormField
{
	
	
	var     $type  = 'Theme';

	function getInput()
	{
		
		
		$db =& JFactory::getDBO();

		$query = 'SELECT *
		 FROM #__spiderfaq_theme 
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
 
		<script type="text/javascript">
 
	
        </script>
        <?php
		
		$theme_select='<select style=" text-align:left;" name="'.$this->name.'" id="theme_search" class="inputbox" onchange="change_select();">';
	for($i=0;$i<count($options);$i++)
	{
		$rowtheme=&$options[$i];
		$theme_select.='<option value="'.$rowtheme->id.'"';
		
		 if (strlen($rowtheme->title)<30){
		 $theme_title=$rowtheme->title;
		 }
		 else{
		 $theme_title=substr_replace($rowtheme->title,"...",30);
		 }
		 if ($rowtheme->id!="1")
		$theme_select.='disabled >'.$theme_title.'</option>';
		else
		$theme_select.=' >'.$theme_title.'</option>';
	}
	$theme_select.='</select>';
	echo $theme_select; 
		 
	}
}
?>
