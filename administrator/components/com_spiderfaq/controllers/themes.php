<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');


jimport( 'joomla.application.component.controller' );

class SpiderfaqControllerThemes extends JControllerLegacy
{
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		
		$this->registerTask( 'add',			'edit' );
		$this->registerTask( 'app',		'save' );
		
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
        getUserStateFromRequest( $option.'searchTheme',
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
	
	$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
	if ($filter_order == 'id'){
		$orderby 	= ' ORDER BY id '. $filter_order_Dir .'';
	} else {
		$orderby 	= ' ORDER BY '. 
         $filter_order .' '. $filter_order_Dir .', id';
	}	
	
	// get the total number of records
	$query = 'SELECT COUNT(*)'
	. ' FROM #__spiderfaq_theme'
	. $where
	;
	$db->setQuery( $query );
	$total = $db->loadResult();

	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit );	
	
	
	$query = "SELECT id,title as cattitle FROM #__spiderfaq_theme". $where. $orderby;
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

		require_once(JPATH_COMPONENT.'/views/themes.php');
		SpiderfaqViewThemes::themes( $rows, $pageNav, $lists );
		
	}
	
	function edit()
	{
		$db		=& JFactory::getDBO();
$document		=& JFactory::getDocument();
		$document->addScript(JURI::root() . 'administrator/components/com_spiderfaq/elements/js/jscolor/jscolor.js');
		$document->addScript(JURI::root() . 'administrator/components/com_spiderfaq/elements/js/theme_reset.js');
	$cid 	= JRequest::getVar('cid', array(0), '', 'array');
	JArrayHelper::toInteger($cid, array(0));
	
	$id 	= $cid[0];

	$row =& JTable::getInstance('faq_themes', 'Table');
	// load the row from the db table
	$row->load($id);
	
	$lists = array();
	 
 
	

		require_once JPATH_COMPONENT.'/views/themes.php';
		SpiderfaqViewThemes::theme( $row, $lists );
	}
	
	function save()
	{
		global $mainframe;
		$mainframe=& JFactory::getApplication();
	$row =& JTable::getInstance('faq_themes', 'Table');
	if(!$row->bind(JRequest::get('post')))
	{
		JError::raiseError(500, $row->getError() );
	}
	$row->title = JRequest::getVar( 'title', '','post', 'string', JREQUEST_ALLOWRAW );
	
	if(!$row->store()){
		JError::raiseError(500, $row->getError() );
	}
	$mainframe->redirect('index.php?option=com_spiderfaq&c=themes', 'Successfully saved');
	}

	function apply()
	{
		global $mainframe;
		$mainframe=& JFactory::getApplication();
	$row =& JTable::getInstance('faq_themes', 'Table');
	if(!$row->bind(JRequest::get('post')))
	{
		JError::raiseError(500, $row->getError() );
	}
	$row->title = JRequest::getVar( 'title', '','post', 'string', JREQUEST_ALLOWRAW );
	
	if(!$row->store()){
		JError::raiseError(500, $row->getError() );
	}
	$mainframe->redirect('index.php?option=com_spiderfaq&c=themes&task=edit&cid[]='.$row->id,'Successfully saved changes');
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
    $query = 'DELETE FROM #__spiderfaq_theme'
    . ' WHERE id IN ( '. $db->escape($cids ) .' )'
    ;
    // Execute query
    $db->setQuery( $query );
    if (!$db->query()) {
      echo "<script> alert('".$db->getErrorMsg(true)."'); 
      window.history.go(-1); </script>\n";
    }
  }
  // After all, redirect again to frontpage
  $mainframe->redirect( "index.php?option=com_spiderfaq&c=themes" );
	
}

}
