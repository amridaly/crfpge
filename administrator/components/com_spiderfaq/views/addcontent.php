<?php
  /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');


class SpiderfaqViewAddcontent
{


	function addcontent( &$rows, &$pageNav, &$lists )
	{
	JHTML::_('behavior.tooltip');
	JHTML::_('behavior.modal');
		?>
	
<script type="text/javascript">

Joomla.submitbutton= function (pressbutton){

var form = document.adminForm;

if (pressbutton == 'cancel') 

{

submitform( pressbutton );

return;

}

submitform( pressbutton );

}

Joomla.tableOrdering=function( order, dir, task ) {

    var form = document.adminForm;

    form.filter_order_playlist.value     = order;

    form.filter_order_Dir_playlist.value = dir;

    submitform( task );

}

function yyy()
{

	var cid =[];
	var titles =[];
	
	for(i=0; i<<?php echo count($rows) ?>; i++)
		if(document.getElementById("c"+i))
			if(document.getElementById("c"+i).checked)
			{
				cid.push(document.getElementById("c"+i).value);
				titles.push(document.getElementById("titles_"+i).value);
				
			}
	window.parent.jSelectContentCategories(cid, titles);
}

</script>



		
		<form action="index.php?option=com_spiderfaq&c=addcontent&tmpl=component" method="post" name="adminForm" id="adminForm">
    <table>
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
			
			<td align="right" width="100%">
            <button onclick="yyy();" style="width:98px; height:34px; background:url(components/com_spiderfaq/images/add_but.png) no-repeat;border:none;cursor:pointer;">&nbsp;</button>           
             </td>
		</tr>
		</table>  
		


        
   <table class="table table-striped">
    <thead>
    	<tr>
            <th width="30"><?php echo '#'; ?></th>
            <th width="20">
            <input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this,'c')">
            </th>
            <th width="40" class="title"><?php echo JHTML::_('grid.sort',   'ID', 'id', @$lists['order_Dir'], @$lists['order'] ); ?></td>
            
            <th><?php echo JHTML::_('grid.sort', 'Title', 'title', @$lists['order_Dir'], @$lists['order'] ); ?></th>
            
            <th nowrap="nowrap" width="70"><?php echo JHTML::_('grid.sort',   'Published', 'published',@$lists['order_Dir'], @$lists['order'] ); ?></th>
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
	function published_icon( &$row, $i, $task, $imgY = 'tick.png', $imgX = 'publish_x.png', $prefix='' ){
        $img     = $row->published ? $imgY : $imgX;
        $task     = $row->published ? 'unpublish_'.$task : 'publish_'.$task;
        $alt     = $row->published ? JText::_( 'Published' ) : JText::_( 'Unpublished' );
        $action = $row->published ? JText::_( 'Unpublish Item' ) : JText::_( 'Publish item' );
 
        $href = '
        <img src="templates/hathor/images/admin/'. $img .'" border="0" alt="'. $alt .'" />'
        ;
 
        return $href;
    
}
    $k = 0;
	for($i=0, $n=count($rows); $i < $n ; $i++)
	{
		$row = &$rows[$i];
		$checked 	= JHTML::_('grid.id', $i, $row->id);
		$published 	= JHTML::_('grid.published', $row, $i); 
 	$published 	= published_icon($row, $i, 'category'); 
		
		
?>
        <tr class="<?php echo "row$k"; ?>">
        	<td align="center"><?php echo $i+1?></td>
        	<td>
            <input type="checkbox" id="c<?php echo $i?>" value="<?php echo $row->id;?>" />
            <input type="hidden" id="titles_<?php echo $i?>" value="<?php echo  htmlspecialchars($row->cattitle);?>" />
            
            </td>
        	<td align="center"><?php echo $row->id?></td>
        	<td><a style="cursor: pointer;" onclick="window.parent.jSelectContentCategories(['<?php echo $row->id?>'],['<?php echo htmlspecialchars(addslashes($row->cattitle));?>'])"><?php echo $row->cattitle?></a></td>            
                  
        	<td align="center"><?php echo $published?></td>            
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
    </table>
    <input type="hidden" name="c" value="addcontent" />
    <input type="hidden" name="option" value="com_spiderfaq">
    <input type="hidden" name="task" value="">    
    <input type="hidden" name="boxchecked" value="0"> 
	<input type="hidden" name="filter_order" 
value="<?php echo $lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="" />       
    </form>
    <?php
	}
	



}
?>