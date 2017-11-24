<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');


jimport( 'joomla.application.component.controller' );

class SpiderfaqControllerCategories extends JControllerLegacy
{
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		
		$this->registerTask( 'add',	  'edit' );
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
	$filter_state = $mainframe-> getUserStateFromRequest( $option.'filter_state', 	'filter_state', '','word' );
	$search_cat = $mainframe-> getUserStateFromRequest( $option.'search_cat', 'search_cat','','string' );
	$search_cat = JString::strtolower( $search_cat );
   
	$limit= $mainframe-> getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart= $mainframe-> getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');

	$where = array();

	if ( $search_cat ) {
		$where[] = 'title  LIKE "%'.$db->escape($search_cat).'%"';
	
	}	
	
	$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
	if ($filter_order == 'id'){
		$orderby 	= ' ORDER BY id '. $filter_order_Dir .'';
	} else {
		$orderby 	= ' ORDER BY '. 
         $filter_order .' '. $filter_order_Dir .', id';
	}	
	
	// get the total number of records
	$query = 'SELECT COUNT(*)'
	. ' FROM #__spiderfaq_category'. $where;
	$db->setQuery( $query );
	$total = $db->loadResult();

	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit );	
	
	
	$query = "SELECT id,published, title as cattitle FROM #__spiderfaq_category". $where. $orderby;
	
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
        $lists['search_cat']= $search_cat;

		require_once JPATH_COMPONENT.'/views/categories.php';
		SpiderfaqViewCategories::categories( $rows, $pageNav, $lists );
		
	}
	
	
	
	

	function edit()
	{
		$db		=& JFactory::getDBO();

	$cid 	= JRequest::getVar('cid', array(0), '', 'array');
	JArrayHelper::toInteger($cid, array(0));
	
	$id 	= $cid[0];

	$row =& JTable::getInstance('faq_categories', 'Table');
	// load the row from the db table
	$row->load($id);
	
	$lists = array();
	 $lists['show_title'] = JHTML::_('select.booleanlist', 'show_title' , 'class="inputbox"', $row->show_title);
	 $lists['show_description'] = JHTML::_('select.booleanlist', 'show_description' , 'class="inputbox"', $row->show_description);
	$lists['published'] = JHTML::_('select.booleanlist', 'published' , 'class="inputbox"', $row->published);

		require_once JPATH_COMPONENT.'/views/categories.php';
		SpiderfaqViewCategories::category( $row, $lists );
	}

	
	function save()
	{
		global $mainframe;
		$mainframe=& JFactory::getApplication();
	$row =& JTable::getInstance('faq_categories', 'Table');
	if(!$row->bind(JRequest::get('post')))
	{
		JError::raiseError(500, $row->getError() );
	}
	$row->title = JRequest::getVar( 'title', '','post', 'string', JREQUEST_ALLOWRAW );
$row->description=JRequest::getVar('description', '', 'post' , 'STRING', JREQUEST_ALLOWRAW);
	
	if(!$row->store()){
		JError::raiseError(500, $row->getError() );
	}
	$mainframe->redirect('index.php?option=com_spiderfaq&c=categories', 'Successfully saved');
	}
	
	
	function apply()
	{
	
		global $mainframe;
		$mainframe=& JFactory::getApplication();
	$row =& JTable::getInstance('faq_categories', 'Table');
	if(!$row->bind(JRequest::get('post')))
	{
		JError::raiseError(500, $row->getError() );
	}
	$row->title = JRequest::getVar( 'title', '','post', 'string', JREQUEST_ALLOWRAW );
	$row->description=JRequest::getVar('description', '', 'post' , 'STRING', JREQUEST_ALLOWRAW);
	
	if(!$row->store()){
		JError::raiseError(500, $row->getError() );
	}
	$mainframe->redirect('index.php?option=com_spiderfaq&c=categories&task=edit&cid[]='.$row->id,'Successfully saved changes');
	}
	

	/*function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_rand' );

		// Initialize variables
		$db		=& JFactory::getDBO();
		$post	= JRequest::get( 'post' );
		$row	=& JTable::getInstance('questions', 'Table');
		$row->bind( $post );
		$row->checkin();
	}*/


	function publish()
	{
		

		$this->setRedirect( 'index.php?option=com_spiderfaq&c=categories' );
  // Initialize variables
  $db 	=& JFactory::getDBO();

  // define variable $cid from GET
  
  $cid = JRequest::getVar( 'cid' , array() , '' , 'array' );	
  JArrayHelper::toInteger($cid);

  $task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__spiderfaq_category'
		. ' SET published = ' . (int) $publish
		. ' WHERE id IN ( '. $cids.'  )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $db->getError() );
		}
		$this->setMessage( JText::sprintf( $publish ? 'Items published' : 'Items unpublished', $n ) );
	}

	function remove()
	{
		global $mainframe;
		$mainframe=& JFactory::getApplication();
  // Initialize variables	
  $db =& JFactory::getDBO();
  // Define cid array variable
  $cid = JRequest::getVar( 'cid' , array() , '' , 'array' );
  // Make sure cid array variable content integer format
  JArrayHelper::toInteger($cid);

  // If any item selected
  if (count( $cid )) {
    // Prepare sql statement, if cid array more than one, 
    // will be "cid1, cid2, ..."
    $cids = implode( ',', $cid );
    // Create sql statement
    $query = 'DELETE FROM #__spiderfaq_category'
    . ' WHERE id IN ( '. $cids .' )'
    ;
    // Execute query
    $db->setQuery( $query );
    if (!$db->query()) {
      echo "<script> alert('".$db->getErrorMsg(true)."'); 
      window.history.go(-1); </script>\n";
    }
  }

  
  
  
  
  
  // After all, redirect again to frontpage
  $mainframe->redirect( "index.php?option=com_spiderfaq&c=categories" );
	
}
}
