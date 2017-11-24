<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model' );

class spiderfaqModelspiderfaqmultiple extends JModelLegacy

{

function FaqCategories()
{
$standcat = JRequest::getVar('standcat');
if($standcat == 0){
 $option=JRequest::getVar('option');
  $tid = (int)JRequest::getVar('theme');
  $Itemid = (int)JRequest::getVar('Itemid');

  
  $cats=array();

  
  $db = JFactory::getDBO();

	$cats_id=explode(',',JRequest::getVar('faq_cats'));
	
				$cats_id= array_slice($cats_id,1, count($cats_id)-2); 
		foreach($cats_id as $cat_id)
				{
					$query ="SELECT * FROM #__spiderfaq_category WHERE published='1' AND id=".$db->escape((int)$cat_id);
						
					$db->setQuery($query); 
					$cats[] = $db->loadObject();

					if ($db->getErrorNum())
					{
						echo $db->stderr();
						return false;
					}	
				}

$s=0;
$k=0;         
				foreach($cats as $cat)
				{
					
					 if($cat)
					{	
					
							$query ="SELECT * FROM #__spiderfaq WHERE published='1' AND category=".$db->escape((int)$cat->id)." ORDER BY `ordering`";
							$db->setQuery($query); 
							$rows1 = $db->loadObjectList();	
							
						$rows[$cat->id] = $rows1;
						$s+=count($rows[$cat->id]);	
						$k=1;
				}
				
				}
if(	$k==0)
{
$rows="";
}				
				
 $query1 = "SELECT * FROM #__spiderfaq_theme
  WHERE id=" .$db->escape($tid);
  $db->setQuery( $query1 );
  $stls = $db->loadObject(); 
  
 return array($option,$cats,$Itemid,$rows,$s,$stls);
}
else{
  $option=JRequest::getVar('option'); 
  $Itemid = (int)JRequest::getVar('Itemid');
  $tid = (int)JRequest::getVar('theme');
   $db =JFactory::getDBO();
   
  $catsid = explode(',',JRequest::getVar('standcatids'));

$catsid= array_slice($catsid,1, count($catsid)-2); 

 $cats=array();


		foreach($catsid as $catid)
				{
					$query ="SELECT * FROM #__categories WHERE published='1' AND extension='com_content' AND id=".$db->escape((int)$catid);
						 
					$db->setQuery($query); 
					$cats[] = $db->loadObject();

					if ($db->getErrorNum())
					{
						echo $db->stderr();
						return false;
					}	
				}
			

$s=0;
$k=0;
           
					
				foreach($cats as $cat)
				{
						 if($cat)
					{
					
							$query ="SELECT * FROM #__content WHERE state='1' AND catid=".$db->escape((int)$cat->id)." ORDER BY `ordering`";
							$db->setQuery($query); 
							$rows1 = $db->loadObjectList();	
							
						$rows[$cat->id] = $rows1;
						$s+=count($rows[$cat->id]);	
						$k=1;
				}
				
				}
if(	$k==0)
{
$rows="";
}				
				
   $query1 = "SELECT * FROM #__spiderfaq_theme
  WHERE id= ".$db->escape($tid);
  $db->setQuery( $query1 );
  $stls = $db->loadObject();
 	
   return array($option,$cats,$Itemid,$rows,$s,$stls);
  }
 
}


}

?>