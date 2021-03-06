<?php 
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

class JFormFieldFaqmultiple extends JFormField
{

//	function fetchElement($name, $value, &$node, $control_name)
	function getInput()
	{        
		ob_start();
        static $embedded;
        if(!$embedded)
        {
            $embedded=true;
        }
		JHTML::_('behavior.modal', 'a.modal');
		$name = $this->name;
		$value = $this->value;

		$editor	=& JFactory::getEditor('tinymce');
		$editor->display('text_for_date','','100%','250','40','6');
		$document		=& JFactory::getDocument();
		$db			=& JFactory::getDBO();
		?>

<script type="text/javascript">


var next=0;
function jSelectCategories(catid, title) {
	

	
		cat_ids =document.getElementById('cats').value;
		
		tbody = document.getElementById('cat');
		
		var  str;
		str=document.getElementById('cats').value;
		
		
       
		
		for(i=0; i<catid.length; i++)
		{
		var  var_serch=","+catid[i]+",";
		
		
		if((!str)||str.indexOf(var_serch)==(-1)){

		
		
		
			tr = document.createElement('tr');
				tr.setAttribute('cat_id', catid[i]);
				tr.setAttribute('id', 'faq_cats_'+next);
				
	
	
				
			var td_info = document.createElement('td');
				td_info.setAttribute('id','info_'+next);
			//	td_info.setAttribute('width','60%');
			
			
			b = document.createElement('b');
				b.innerHTML = title[i];
				b.style.width='120px';
				b.style.float='left';
				b.style.position="inherit";
			
			
			td_info.appendChild(b);
			
			
			//td.appendChild(p_url);
			
			var img_X = document.createElement("img");
					img_X.setAttribute("src", "components/com_spiderfaq/images/delete_el.png");
//					img_X.setAttribute("height", "17");
					img_X.style.cssText = "cursor:pointer; margin-left:30px";
					img_X.setAttribute("onclick", 'remove_row("faq_cats_'+next+'")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+next);
					td_X.setAttribute("valign", "middle");
//					td_X.setAttribute("align", "right");
					td_X.style.width='50px';
					td_X.appendChild(img_X);
					
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", "components/com_spiderfaq/images/up.png");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("faq_cats_'+next+'")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+next);
					td_UP.setAttribute("valign", "middle");
					td_UP.style.width='20px';
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", "components/com_spiderfaq/images/down.png");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("faq_cats_'+next+'")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+next);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.style.width='20px';
					td_DOWN.appendChild(img_DOWN);
				
			tr.appendChild(td_info);
			tr.appendChild(td_X);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tbody.appendChild(tr);

//refresh
			next++;
			}
		}
		
		document.getElementById('cats').value=cat_ids;
		SqueezeBox.close();
		refresh_();
		
	}
	
function remove_row(id){	
	tr=document.getElementById(id);
	tr.parentNode.removeChild(tr);
	refresh_();
}

function refresh_(){

	cat=document.getElementById('cat');
	GLOBAL_tbody=cat;
	tox=',';
	for (x=0; x < GLOBAL_tbody.childNodes.length; x++)
	{
		tr=GLOBAL_tbody.childNodes[x];
		tox=tox+tr.getAttribute('cat_id')+',';
	}

	document.getElementById('cats').value=tox;
}

function up_row(id){
	form=document.getElementById(id).parentNode;
	k=0;
	while(form.childNodes[k])
	{
	if(form.childNodes[k].getAttribute("id"))
	if(id==form.childNodes[k].getAttribute("id"))
		break;
	k++;
	}
	if(k!=0)
	{
		up=form.childNodes[k-1];
		down=form.childNodes[k];
		form.removeChild(down);
		form.insertBefore(down, up);
		refresh_();
	}
}

function down_row(id){
	form=document.getElementById(id).parentNode;
	l=form.childNodes.length;
	k=0;
	while(form.childNodes[k])
	{
	if(id==form.childNodes[k].id)
		break;
	k++;
	}

	if(k!=l-1)
	{
		up=form.childNodes[k];
		down=form.childNodes[k+2];
		form.removeChild(up);
if(!down)
down=null;
		form.insertBefore(up, down);
		refresh_();
	}
}


</script>
<br/>
<br/>
<table>
<tr>
<td>
<a class="modal" href="index.php?option=com_spiderfaq&c=addcat&amp;tmpl=component&amp;object=id" rel="{handler: 'iframe', size: {x: 850, y: 575}}">
<img src="components/com_spiderfaq/images/add_but.png" style=" margin-top: -60px; "/> 
</a>
<table width="100%">
<tbody id="cat"></tbody>
</table>
</td>
</tr>
</table>
<input type="hidden" name="<?php echo $name ?>" id="cats" size="80" value="<?php ?>" />
<?php
JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_spiderfaq/tables');
	$cats=array();
	$cats_id=explode(',',$value);
	
	$cats_id= array_slice($cats_id,1, count($cats_id)-2);  



	foreach($cats_id as $id)
	{
	
		$query ="SELECT * FROM #__spiderfaq_category WHERE published='1' AND id=".$db->escape($id);
		$db->setQuery($query); 
		$is=$db->loadObject();
		if($is)
		$cats[] = $db->loadObject();
		if ($db->getErrorNum())
		{
			echo $db->stderr();
			return false;
		}	
	}
	
if($cats)
{
	foreach($cats as $cat)
	{
		$v_ids[]=$cat->id;
		$v_titles[]=addslashes($cat->title);
		
	}

	$v_id='["'.implode('","',$v_ids).'"]';
	$v_title='["'.implode('","',$v_titles).'"]';
	//print_r ($v_title);
	?>
<script type="text/javascript">                
jSelectCategories(<?php echo $v_id?>,<?php echo $v_title?>);
<?php
}

?>

 </script>
 
 <span id="faq_cats"></span>
		<script type="text/javascript">
        
		show1=document.getElementById("show1").checked;
	if (show1)
	{
document.getElementById("faq_cats").parentNode.parentNode.setAttribute("style","display:none");

	}
	
        </script>
 
      <?php

        $content=ob_get_contents();

        ob_end_clean();
        return $content;

	}
}
?>