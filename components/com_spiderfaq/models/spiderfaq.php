<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model' );

class spiderfaqModelspiderfaq extends JModelLegacy

{

function FaqArticles()
{
$standcat = JRequest::getVar('standcat');
if($standcat == 0){
 $option=JRequest::getVar('option');
  $id = (int)JRequest::getVar('faq_cat');
  $tid = (int)JRequest::getVar('theme');

  $Itemid = (int)JRequest::getVar('Itemid');
  $row = JTable::getInstance( 'faq_questions', 'Table');
  $row->load($id);
 $cat = JTable::getInstance( 'faq_categories', 'Table');
  $cat->load($id);
  $stl = JTable::getInstance( 'faq_themes', 'Table');
  $stl->load($tid);
  
  
  $db = JFactory::getDBO();

	
	
$query = "SELECT * FROM #__spiderfaq
  WHERE published= '1' and category= ".$db->escape($id)." ORDER BY `ordering`" ;
 $db->setQuery( $query);
  $rows = $db->loadObjectList();

  
   $query2 = "SELECT * FROM #__spiderfaq_category
  WHERE published= '1' and id= ".$db->escape($id);
  $db->setQuery( $query2 );
  $cats = $db->loadObject();
 
  $query3 = "SELECT * FROM #__spiderfaq_theme
  WHERE id= ".$db->escape($tid);
  $db->setQuery( $query3 );
  $stls = $db->loadObject();

  
$query1 = "SELECT count(*) FROM #__spiderfaq
  WHERE published= '1' and category=".$db->escape($id);
$db->setQuery($query1);
$count = $db->loadResultArray();




 return array($row, $option,$rows,$id,$Itemid,$cat,$cats,$stl,$stls);
}
else{
  $option=JRequest::getVar('option');
  $catid = (int)JRequest::getVar('standcatid');
 $Itemid = (int)JRequest::getVar('Itemid');
  $tid = (int)JRequest::getVar('theme');
  $row = JTable::getInstance( 'faq_questions', 'Table');
  $row->load($catid);
  $cat = JTable::getInstance( 'faq_categories', 'Table');
  $cat->load($catid);
  $stl = JTable::getInstance( 'faq_themes', 'Table');
  $stl->load($tid);
  
  
  $db =& JFactory::getDBO();
  $query = "SELECT * FROM #__content
  WHERE state='1' AND catid=".$db->escape($catid)." ORDER BY `ordering`";
  
  $db->setQuery( $query );
  $rows = $db->loadObjectList();
  
 $query1 = "SELECT count(*) FROM #__content
  WHERE state='1' AND catid=".$db->escape($catid);
  $db->setQuery( $query1 );
  $count = $db->loadResultArray();

  
  
   $query2 = "SELECT * FROM #__categories
  WHERE published= '1' and id= ".$db->escape($catid);
  $db->setQuery( $query2 );
  $cats = $db->loadObject();
  
  
    $query3 = "SELECT * FROM #__spiderfaq_theme
  WHERE id=".$db->escape($tid);
  $db->setQuery( $query3 );
  $stls = $db->loadObject();
  
   return array($row, $option,$rows,$catid,$Itemid,$cat,$cats,$stl,$stls);
  }
 
}


}

?>