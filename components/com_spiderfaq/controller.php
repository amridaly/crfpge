<?php
 
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');



class spiderfaqController extends JControllerLegacy
{

    function display()
		{
		$modelName=JRequest::getVar( 'view'  );
			parent::display();
		}

}
?>