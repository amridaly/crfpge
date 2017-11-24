<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');


class JFormFieldStandcatid extends JFormFieldList
{
	
	public $type = 'standcatid';


	protected function getOptions()
	{
		
		$options	= array();
		$extension	= $this->element['extension'] ? (string) $this->element['extension'] : (string) $this->element['scope'];
		$published	= (string) $this->element['published'];

		
		if (!empty($extension)) {

			
			if ($published) {
				$options = JHtml::_('category.options', $extension, array('filter.published' => explode(',', $published)));
			}
			else {
				$options = JHtml::_('category.options', $extension);
			}

			
			if ($action	= (string) $this->element['action']) {

				
				$user = JFactory::getUser();

				foreach($options as $i => $option)
				{
					
					if ($user->authorise('core.create', $extension.'.category.'.$option->value) != true ) {
						unset($options[$i]);
					}
				}

			}

			if (isset($this->element['show_root'])) {
				array_unshift($options, JHtml::_('select.option', '0', JText::_('JGLOBAL_ROOT')));
			}
		}
		else {
			JError::raiseWarning(500, JText::_('JLIB_FORM_ERROR_FIELDS_CATEGORY_ERROR_EXTENSION_EMPTY'));
		}

		$options = array_merge(parent::getOptions(), $options);
?>
  <span id="standcatid"></span>
		<script type="text/javascript">
        
		show0=document.getElementById("show0").checked;
	if (show0)
	{
document.getElementById("standcatid").parentNode.parentNode.setAttribute("style","display:none");

	}
	

	
        </script>



<?php
		return $options;
	}
}
  
?>
