<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

class spiderfaqViewspiderfaq extends JViewLegacy
{

    function display($tpl = null)
		{
		    $standcat = JRequest::getVar('standcat');	
			
			$model = $this->getModel();
			$result = $model->FaqArticles();
			$this->assignRef( 'row',	$result[0] );
			$this->assignRef( 'option',	$result[1] );
			$this->assignRef( 'rows',	$result[2] );
			$this->assignRef( 'Itemid',	$result[4] );
			$this->assignRef( 'stl',	$result[7] );
		    $this->assignRef( 'stls',	$result[8] ); 
			
			if($standcat == 1)
			{
			$this->assignRef( 'catid',	$result[3] );
			$this->assignRef( 'cat',	$result[5] );
			$this->assignRef( 'cats',	$result[6] );
			}
			else
			{
			$this->assignRef( 'id',	$result[3] );
			$this->assignRef( 'cat',	$result[5] );
			$this->assignRef( 'cats',	$result[6] );
		
		
			}
			
			
	
			parent::display($tpl);
		}
		

}

?>

