<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

class spiderfaqViewspiderfaqmultiple extends JViewLegacy
{

    function display($tpl = null)
		{
		    $standcat = JRequest::getVar('standcat');	
			
			$model = $this->getModel();
			$result = $model->FaqCategories();
			
			$this->assignRef( 'option',	$result[0] );		
			$this->assignRef( 'Itemid',	$result[2] );
			   $this->assignRef( 'stls',	$result[5] ); 		
		
		
		if($standcat == 1)
			{
			$this->assignRef( 'cats',	$result[1] );
			$this->assignRef( 'rows',	$result[3] );	
			$this->assignRef( 's',	$result[4] );
	
			}
			else
			{
			$this->assignRef( 'cats',	$result[1] );
			$this->assignRef( 'rows',	$result[3] );	
			$this->assignRef( 's',	$result[4] );
			}
			
	
			parent::display($tpl);
		}
		

}

?>

