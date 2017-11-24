<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');


class SpiderfaqViewQuestions
{
	function setQuestionsToolbar()
	{
	JToolBarHelper::addNew();
	JToolBarHelper::editList();
		JToolBarHelper::title( JText::_( 'Spider FAQ Manager' ), 'generic.png' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		
		JToolBarHelper::deleteList();
		
		
		
		
	}

	function rands( &$rows, &$pageNav, &$lists )
	{
		SpiderfaqViewQuestions::setQuestionsToolbar();
		JHTML::_('behavior.tooltip');
		?>
		<form action="index.php?
option=com_spiderfaq" method="post" name="adminForm" id="adminForm">
    
		<table width="100%">

        <tr>

            <td align="left" width="100%">
                <input type="text" name="search" id="search" value="<?php echo $lists['search'];?>" class="text_area" placeholder="Search" style="margin:0px" />
		
				<button class="btn tip hasTooltip" type="submit" data-original-title="Search"><i class="icon-search"></i></button>
				<button class="btn tip hasTooltip" type="button" onclick="document.getElementById('search').value='';this.form.submit();" data-original-title="Clear"><i class="icon-remove"></i></button>
				
				
				
				<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
					<?php echo $pageNav->getLimitBox(); ?>
				</div>


            </td>

        </tr>

    </table>       
    <?php	
	function published( &$row, $i, $task, $imgY = 'tick.png', $imgX = 'publish_x.png', $prefix='' ){
        $img     = $row->published ? $imgY : $imgX;
        $task     = $row->published ? 'unpublish': 'publish';
        $alt     = $row->published ? JText::_( 'Published' ) : JText::_( 'Unpublished' );
        $action = $row->published ? JText::_( 'Unpublish Item' ) : JText::_( 'Publish item' );
 
        $href = '
        <a href="javascript:void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $prefix.$task .'\')" title="'. $action .'">
        <img src="templates/hathor/images/admin/'. $img .'" border="0" alt="'. $alt .'" /></a>'
        ;
 
        return $href;
    
}   
    ?>
        
        
    <table class="table table-striped">
    <thead>
    	<tr>
        	<th width="20">
            <input type="checkbox" name="toggle"
 value="" onclick="Joomla.checkAll(this)">
            </th>
            <th width="50" class="title">
                <?php echo JHTML::_('grid.sort',   'ID', 'id', @$lists['order_Dir'], @$lists['order'] ); ?></th>
            <th><?php echo JHTML::_('grid.sort',   'Question', 'title', @$lists['order_Dir'], @$lists['order'] ); ?></th>
            <th><?php echo JHTML::_('grid.sort',   'Category', 'cattitle', @$lists['order_Dir'], @$lists['order'] ); ?></th>
			<th nowrap="nowrap" width="8%"><?php echo JHTML::_('grid.sort', 'Order', 'ordering', @$lists['order_Dir'], @$lists['order']);?>&nbsp;<?php echo JHTML::_('grid.order', $rows);
?></a></th>
            <th width="50"  nowrap="nowrap"><?php echo JHTML::_('grid.sort',   'Published', 'published', @$lists['order_Dir'], @$lists['order'] ); ?></th>
        </tr>
    </thead>
	<tfoot>
		<tr>
			<td colspan="11">
			 <?php echo $pageNav->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
               
      <?php
	
    $k = 0;
	for($i=0, $n=count($rows); $i < $n ; $i++)
	{
$row = &$rows[$i];
$checked 	= JHTML::_('grid.id', $i, $row->id);
$published 	= published($row, $i, 'question'); 
// prepare link for id column
$link = JRoute::_( 'index.php?option=com_spiderfaq&task=edit&cid[]='. $row->id );
?>
<tr class="<?php echo "row$k"; ?>">
<td><?php echo $checked?> </td>
<td><a href="<?php echo $link; ?>">
    <?php echo $row->id?></a></td>
<td><a href="<?php echo $link; ?>"><?php echo $row->title?></a></td> 
<td><?php if ($row->cattitle=='') echo 'Uncategorised'; else  echo $row->cattitle?></a></td>     
<td class="order">


<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" /></td>      
<td><?php echo $published?></td>            
</tr>
        <?php
$k = 1 - $k;
	}
	?>
    </table>
    <input type="hidden" name="option" value="com_spiderfaq">
    <input type="hidden" name="task" value="">    
    <input type="hidden" name="boxchecked" value="0"> 
	<input type="hidden" name="filter_order" 
value="<?php echo $lists['order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php
        echo $lists['order_Dir']; ?>" />   
<?php
        echo JHTML::_('form.token');
?>	
    </form>
    <?php
	}

	function setArticleToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');

		JToolBarHelper::title( $task == 'add' ? JText::_( 'Question' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Question' ) . ': <small><small>[ '. JText::_( 'Edit' ). ' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( 'save' );
		JToolBarHelper::apply('apply');
		JToolBarHelper::cancel( 'cancel' );
	}

	function questions(&$rows, &$row, &$lists )
	{
		SpiderfaqViewQuestions::setArticleToolbar();
		JRequest::setVar( 'hidemainmenu', 1 );
        $editor	=& JFactory::getEditor();
		?>
 
<script language="javascript" type="text/javascript">
<!--
Joomla.submitbutton = function submitbutton(pressbutton) {
var form = document.adminForm;
if (pressbutton == 'cancel') {
submitform( pressbutton );
return;
}
			
			
submitform( pressbutton );
}
//-->
</script>         
    <style>
label{
display: inline-block !important;
}

</style>     
<form action="index.php" method="post" name="adminForm" id="adminForm">
<table class="admintable" >
                <tr>
                <td width="100px" >
                <?php echo JText::_( 'Question' ); ?>:
                </td>
                <td>
				<textarea name="title" rows="3" cols="55"><?php echo htmlspecialchars($row->title); ?></textarea>
                 
                </td>
                </tr>
               
                 <tr>
                <td>
                 <?php echo JText::_( 'Select Category' ); ?>:
                </td>
                <td>
               
                 
           <select name="category" class="inputbox" size="1">
          
				
				<?php
	 
    
	for($i=0, $n=count($rows); $i < $n ; $i++)
	{
$rowcat = &$rows[$i];
 if (strlen($rowcat->title)<30){
		 $row_cat=$rowcat->title;
		 }
else{
 $row_cat=substr_replace($rowcat->title,"...",30);
}
?>
<option   value="<?php echo $rowcat->id; ?>" <?php if ($row->category==$rowcat->id) echo 'selected="selected"';   ?>><?php echo $row_cat; ?></option>
        <?php

	}
	?>
              
                
        </select>     
</td>
                </tr>
		

  				<tr>
<td width="100"  class="key">
 <?php echo JText::_( 'Order' ); ?>:
</td>
<td>
<?php
echo $lists['ordering'];
?>
</td>
</tr>  
  
  
  <tr>
                <td >
			     <?php echo JText::_( 'Published' ); ?>:
					</td>
                    <td>	
					
						<?php
                        echo $lists['published'];
						?>
					</td>
                </tr>
                 
         
                
				
                <tr>
				<td>
                <?php echo JText::_( 'Answer' ); ?>:
                </td>			
					<td class="key" >
						<?php
                        echo $editor->display( 'question',$row->text, '800', '550', '75', '20' ) ;
						?>
					</td>
				</tr>
				
				
       

      
                </table>       
<input type="hidden" name="option" value="com_spiderfaq" />
<input type="hidden" name="id" value="<?php echo $row->id?>" />        
<input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />        
<input type="hidden" name="task" value="" />      
<?php
        echo JHTML::_('form.token');
?>  
</form>
 

        <?php		
	}
}
