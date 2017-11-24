<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');


jimport( 'joomla.application.component.controller' );


class SpiderfaqControllerQuestions extends JControllerLegacy
{
	
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		
		$this->registerTask( 'add',			'edit' );
		$this->registerTask( 'apply'	,	'save' );
		$this->registerTask( 'unpublish',	'publish' );
	
	}

	function display()
	{
		global $mainframe;
		
	$mainframe=& JFactory::getApplication();
	$option 	= JRequest::getVar('option');

    $db =& JFactory::getDBO();
	  $table =& JTable::getInstance('faq_questions', 'Table');
    $table->reorder();
	 $filter_order_Dir = $mainframe->getUserStateFromRequest($option . '.filter_order_Dir', 'filter_order_Dir', '', 'word');
    $filter_order     = $mainframe->getUserStateFromRequest($option . '.filter_order', 'filter_order', 'ordering', 'cmd');
    $filter_state     = $mainframe->getUserStateFromRequest($option . '.filter_state', 'filter_state', '', 'word');
    //echo $filter_order_Dir;
    //echo $filter_state;
    $limit            = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
    $limitstart       = $mainframe->getUserStateFromRequest($option . '.limitstart', 'limitstart', 0, 'int');
    $ord              = JRequest::getVar('ord', 1);
    if ($ord and ($filter_order == "title" or $filter_order == "cattitle" or $filter_order == "ordering" or $filter_order == "published" or $filter_order == "id"))
        $order = ' ORDER BY ' . $db->escape($filter_order). ' ' . $db->escape($filter_order_Dir ). ', ordering';
    else
        $order = "";
	
	
	
	$search = $mainframe->getUserStateFromRequest( $option.'search', 'search','','string' );
	$search = JString::strtolower( $search );

	$where = array();

	if ( $search ) {
		$where[] = '#__spiderfaq.title LIKE "%'.$db->escape($search).'%"';
	}	
	
	$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
	
	
	// get the total number of records
	$query = 'SELECT COUNT(*)'. ' FROM #__spiderfaq '. $where	;
	$db->setQuery( $query );
	$total = $db->loadResult();

	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit );	
	
	
	$query = "SELECT #__spiderfaq.*, #__spiderfaq_category.title as cattitle FROM #__spiderfaq left join #__spiderfaq_category on #__spiderfaq_category.id=#__spiderfaq.category ". $where. $order;
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
		
		
		

		require_once JPATH_COMPONENT.'/views/questions.php';
		SpiderfaqViewQuestions::rands( $rows, $pageNav, $lists );
	}

	function edit()
	{
		$db		=& JFactory::getDBO();
    $table =& JTable::getInstance('faq_questions', 'Table');
    $table->reorder();
	$cid 	= JRequest::getVar('cid', array(0), '', 'array');
	JArrayHelper::toInteger($cid, array(0));
	
	$id 	= $cid[0];

	$row =& JTable::getInstance('faq_questions', 'Table');
	$row->load( $id);
	// load the row from the db table

	$query = 'SELECT id, title
		 FROM #__spiderfaq_category 
		'
		;
		$db->setQuery( $query);
		$rows = $db->loadObjectList();
	
	$lists = array();
$ordering['0'] = array(
        'value' => '0',
        'text' => '0 First'
    );
	
	 $db =& JFactory::getDBO();
    $query = "SELECT ordering,title FROM #__spiderfaq order by ordering";
    $db->setQuery($query);
    $rows1 = $db->loadObjectList();
    if ($db->getErrorNum())
      {
        echo $db->stderr();
        return false;
      }
   for ($i = 0, $n = count($rows1); $i < $n; $i++)
      {
        $row1 =& $rows1[$i];
        $ordering1            = $row1->ordering;
		 if (strlen($row1->title)<30){
		 $row_title=$row1->title;
		 }
		 else{
		 $row_title=substr_replace($row1->title,"...",30);
		 }
        $ordering[$ordering1] = array(
            'value' => $row1->ordering,
			'text' => ($row1->ordering . "(" . $row_title . ")")
		
        );
      }
    $ordering[(count($rows1) + 1)] = array(
        'value' => (count($rows1) + 1),
        'text' => (count($rows1) + 1) . ' Last'
    );
	
    if($row->ordering!="")
	{
	$selected=$row->ordering;
	}
	else {	
	if(!$rows1)
	$selected=$ordering[0];		
	else
	$selected=$ordering[(count($rows1) + 1)];
	}
    $lists['ordering']             = JHTML::_('select.genericList', $ordering, 'ordering', 'class="inputbox" ' . '', 'value', 'text', $selected);


	$lists['published'] = JHTML::_('select.booleanlist', 'published' , 'class="inputbox"', $row->published);
   

	if (JString::strlen($row->fullarticle) > 1) {
			$row->text = $row->article . "<hr id=\"system-readmore\" />" . $row->fullarticle;
		} else {
			$row->text = $row->article;
		}
		
		
		
		
	

		require_once JPATH_COMPONENT.'/views/questions.php';
		
		SpiderfaqViewQuestions::questions($rows,  $row, $lists );
		
	
	
	
	}

	/**
	 * Save method
	 */
	function save()
	{
		global $mainframe;
		$mainframe=& JFactory::getApplication();
	$row =& JTable::getInstance('faq_questions', 'Table');
	if(!$row->bind(JRequest::get('post')))
	{
		JError::raiseError(500, $row->getError() );
	}
	
	$task		= JRequest::getCmd( 'task' );
	// Get submitted text from the request variables
		$text = JRequest::getVar( 'question', '', 'post', 'string', JREQUEST_ALLOWRAW );

		// Clean text for xhtml transitional compliance
		$text		= str_replace( '<br>', '<br />', $text );

		// Search for the {readmore} tag and split the text up accordingly.
		$pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';
		$tagPos	= preg_match($pattern, $text);

		if ( $tagPos == 0 )
		{
			$row->article	= $text;
		} else
		{
			list($row->article, $row->fullarticle) = preg_split($pattern, $text, 2);
		}
	
	$filter = new JFilterInput( array(), array(), 1, 1 );
			$row->article	= $filter->clean( $row->article );
			$row->fullarticle	= $filter->clean( $row->fullarticle );
	 $table =& JTable::getInstance('faq_questions', 'Table');
    $table->reorder();
	
	if(!$row->store()){
		JError::raiseError(500, $row->getError() );
	}
	switch ($task)
		{
			case 'apply' :
				$msg = JText::sprintf('Successfully Saved Changes to Question &nbsp' .$row->title);
				$mainframe->redirect('index.php?option=com_spiderfaq&task=edit&cid[]='.$row->id, $msg);
				break;

			case 'save' :
			
				$msg = JText::sprintf('Successfully saved question&nbsp' .$row->title);
				$mainframe->redirect('index.php?option=com_spiderfaq', $msg);
				break;
				
		
			
		}
		
		
				
		
	}
	
	
	
	/*function apply()
	{
		global $mainframe;
		$mainframe=& JFactory::getApplication();
	$row =& JTable::getInstance('questions', 'Table');
	if(!$row->bind(JRequest::get('post')))
	{
		JError::raiseError(500, $row->getError() );
	}
	// Get submitted text from the request variables
		$text = JRequest::getVar( 'question', '', 'post', 'string', JREQUEST_ALLOWRAW );

		// Clean text for xhtml transitional compliance
		$text		= str_replace( '<br>', '<br />', $text );

		// Search for the {readmore} tag and split the text up accordingly.
		$pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';
		$tagPos	= preg_match($pattern, $text);

		if ( $tagPos == 0 )
		{
			$row->article	= $text;
		} else
		{
			list($row->article, $row->fullarticle) = preg_split($pattern, $text, 2);
		}
	
	if(!$row->store()){
		JError::raiseError(500, $row->getError() );
	}
	$mainframe->redirect('index.php?option=com_rand&task=edit&cid[]='.$row->id, 'Message Saved');
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
		

		$this->setRedirect( 'index.php?option=com_spiderfaq' );
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

		$query = 'UPDATE #__spiderfaq'
		. ' SET published = ' . (int) $publish
		. ' WHERE id IN ( '. $db->escape($cids ).'  )'
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
    $query = 'DELETE FROM #__spiderfaq'
    . ' WHERE id IN ( '. $db->escape($cids ).' )'
    ;
    // Execute query
    $db->setQuery( $query );
    if (!$db->query()) {
      echo "<script> alert('".$db->getErrorMsg(true)."'); 
      window.history.go(-1); </script>\n";
    }
  }

  // After all, redirect again to frontpage
  $mainframe->redirect( "index.php?option=com_spiderfaq" );
	
}


function saveorder(&$cid)
  {
  global $mainframe;
     $mainframe = JFactory::getApplication();
    // Check for request forgeries
    JRequest::checkToken() or jexit('Invalid Token');
    // Initialize variables
    $db =& JFactory::getDBO();
    $cid   = JRequest::getVar('cid', array(), '', 'array');
    $total = count($cid);
	
    $order = JRequest::getVar('order', array(0), 'post', 'array');
    JArrayHelper::toInteger($order, array(0));
    $row =& JTable::getInstance('faq_questions', 'Table');
    $groupings = array();
    // update ordering values
    for ($i = 0; $i < $total; $i++)
      {
        $row->load((int) $cid[$i]);
        // track sections
        //echo $row->ordering;
        if ($row->ordering != $order[$i])
          {
            $row->ordering = $order[$i];
            if (!$row->store())
              {
                JError::raiseError(500, $db->getErrorMsg());
              }
          }
      }
    $msg = JText::_('New ordering saved');
    $mainframe->redirect('index.php?option=com_spiderfaq', $msg);
  }

}
