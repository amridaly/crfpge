<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');


jimport( 'joomla.application.component.controller' );


class SpiderfaqControllerAddcontent extends JControllerLegacy
{
	
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		
		$this->registerTask( 'add',			'edit' );
		$this->registerTask( 'app',		'save' );
		$this->registerTask( 'unpublish',	'publish' );
	}

	
	function display()
	{
		global $mainframe;
	$mainframe=& JFactory::getApplication();
	$option 	= JRequest::getVar('option');
	
    $db =& JFactory::getDBO();
	
	$filter_order= $mainframe->getUserStateFromRequest( $option.'filter_order','filter_order','id','cmd' );
	$filter_order_Dir= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir','','word' );
	$filter_state = $mainframe->
       getUserStateFromRequest( $option.'filter_state', 	'filter_state', '','word' );
	$search = $mainframe->
        getUserStateFromRequest( $option.'searchCat',
        'search','','string' );
	$search = JString::strtolower( $search );
    
	$limit= $mainframe->
        getUserStateFromRequest('global.list.limit', 
        'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart= $mainframe->
        getUserStateFromRequest($option.'.limitstart', 
'limitstart', 0, 'int');

	$where = array();

	if ( $search ) {
		$where[] = 'title  LIKE "%'.$db->escape($search).'%"';
	}	
	
	$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ). 'AND extension="com_content" AND published="1"' : ' WHERE extension="com_content" AND published="1" ' );
	if ($filter_order == 'id'){
		$orderby 	= ' ORDER BY id '. $filter_order_Dir .'';
	} else {
		$orderby 	= ' ORDER BY '. 
         $filter_order .' '. $filter_order_Dir .', id';
	}	
	
	// get the total number of records
	$query = 'SELECT COUNT(*)'
	. ' FROM #__categories'
	. $where;
	$db->setQuery( $query );
	$total = $db->loadResult();


	
	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit );	
	
	
	$query = "SELECT id,published, title as cattitle FROM #__categories". $where .$orderby;
	$db->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
	$rows = $db->loadObjectList();
	if($db->getErrorNum()){
		echo $db->stderr();
		return false;
	}
	
	
	// table ordering
	$lists['order_Dir']	= $filter_order_Dir;
	$lists['order']		= $filter_order;	

	// search filter	
        $lists['search']= $search;

		require_once JPATH_COMPONENT.'/views/addcontent.php';
		SpiderfaqViewAddcontent::addcontent( $rows, $pageNav, $lists );
		
	}

}
