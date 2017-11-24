<?php

 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
defined('_JEXEC') or die('Restricted access');
class TableFaq_questions extends JTable
{
	var $id 		= null;
	var $title 		= null;
	
	var $category     = null;
	var $article 		= null;	
	var $fullarticle 		= null;	
	var $ordering = null;
	var $published 		= 1;	
	
	/**
	* @param database A database 
        connector object */
	function __construct(&$db)
	{
		parent::__construct( '#__spiderfaq', 'id', $db );
	}	
	
}




?>