<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');


jimport( 'joomla.application.component.controller' );

class SpiderfaqControllerPlggen extends JControllerLegacy
{
	
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		
		
	}
	
	function display()
	{

       $db =& JFactory::getDBO();

		$query = 'SELECT *
		 FROM #__spiderfaq_theme 
		 ORDER BY id'
		;
		$db->setQuery( $query );
		$themes = $db->loadObjectList();
		
      
	
require_once(JPATH_COMPONENT.'/views/plggen.php');
		SpiderfaqViewPlggen::plggenerate(  $themes );

	}
	
}
