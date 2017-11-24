<?php
  /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

class SpiderfaqViewPlggen
{



	function plggenerate(  $themes )
	{
	JHTML::_('behavior.modal', 'a.modal');
		
$document = &JFactory::getDocument(); 
$document->addStyleSheet('components/com_spiderfaq/elements/styles/style.css');  
	?>
	

	<table>
	<tr>
	
	<td id="cuc">Use Standard Category</td>
	<td><input type="radio" name="standcat"  value="0" onChange="show_(0)" checked="checked" id="show0"><label for="show0"> No</label>	
	<input type="radio" name="standcat" value="1"  onChange="show_(1)"  id="show1"><label for="show1">Yes</label></td>
	</tr>


<script type="text/javascript">




function show_(x)
{
	
	if(x==0)
	{

	document.getElementById('cuc').parentNode.parentNode.childNodes[6].setAttribute('style','display:none');	
	document.getElementById('cuc').parentNode.parentNode.childNodes[4].removeAttribute('style');	
	}
	else
	{

	document.getElementById('cuc').parentNode.parentNode.childNodes[4].setAttribute('style','display:none');	
	document.getElementById('cuc').parentNode.parentNode.childNodes[6].removeAttribute('style');	
	}


	
}
</script>
<tr>
<td>Select Categories</td>
<td>
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
				b.style.width='90px';
				b.style.float='left';
				b.style.position="inherit";
			
			
			td_info.appendChild(b);
			
			
			//td.appendChild(p_url);
			
			var img_X = document.createElement("img");
					img_X.setAttribute("src", "components/com_spiderfaq/images/delete_el.png");
//					img_X.setAttribute("height", "17");
					img_X.style.cssText = "cursor:pointer; margin-left:100px";
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
					img_UP.style.cssText = "cursor:pointer; margin-left:20px";
					img_UP.setAttribute("onclick", 'up_row("faq_cats_'+next+'")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+next);
					td_UP.setAttribute("valign", "middle");
					td_UP.style.width='20px';
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", "components/com_spiderfaq/images/down.png");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer; margin-left:20px";
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
<img style="margin-top:-20px" src="components/com_spiderfaq/images/add_but.png" /> 
</a>
<table width="100%">
<tbody id="cat"></tbody>
</table>
</td>
</tr>
</table>
<input type="hidden" name="<?php ?>" id="cats" size="80" value="<?php $value; ?>" />
<?php
JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_spiderfaq/tables');
	$cats=array();
	if(isset($value)){
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
}

?>

 </script>
 
 <span id="faq_cats"></span>
		<script type="text/javascript">
        
		show1=document.getElementById("show1").checked;
	if (show1)
	{
document.getElementById('cuc').parentNode.parentNode.childNodes[4].setAttribute('style','display:none');

	}
	
        </script>
 
</td>
</tr>

<tr>
<td>Select Categories</td>
<td>
<script type="text/javascript">
var next1=0;
function jSelectContentCategories(cid, ctitle) {
	

	
		cat_ids =document.getElementById('contcats').value;
		
		tbody = document.getElementById('contcat');
		
		var  str;
		str=document.getElementById('contcats').value;
		
		
       
		
		for(i=0; i<cid.length; i++)
		{
		var  var_serch=","+cid[i]+",";
		
		
		if((!str)||str.indexOf(var_serch)==(-1)){

		
		
		
			tr = document.createElement('tr');
				tr.setAttribute('cats_id', cid[i]);
				tr.setAttribute('id','cats_'+next1);
				
	
	
				
			var td_info = document.createElement('td');
				td_info.setAttribute('id','cinfo_'+next1);
			//	td_info.setAttribute('width','60%');
			
			
			b = document.createElement('b');
				b.innerHTML = ctitle[i];
				b.style.width='70px';
				b.style.float='left';
				b.style.position="inherit";
			
			
			td_info.appendChild(b);
			
			
			//td.appendChild(p_url);
			
			var img_X = document.createElement("img");
					img_X.setAttribute("src", "components/com_spiderfaq/images/delete_el.png");
//					img_X.setAttribute("height", "17");
					img_X.style.cssText = "cursor:pointer; margin-left:100px";
					img_X.setAttribute("onclick", 'contremove_row("'+"cats_"+next1+'")');
					
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+next1);
					td_X.setAttribute("valign", "middle");
//					td_X.setAttribute("align", "right");
					td_X.style.width='50px';
					td_X.appendChild(img_X);
					
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", "components/com_spiderfaq/images/up.png");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer; margin-left:20px";
					img_UP.setAttribute("onclick", 'contup_row("'+"cats_"+next1+'")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+next1);
					td_UP.setAttribute("valign", "middle");
					td_UP.style.width='20px';
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", "components/com_spiderfaq/images/down.png");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer; margin-left:20px";
					img_DOWN.setAttribute("onclick", 'contdown_row("'+"cats_"+next1+'")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+next1);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.style.width='20px';
					td_DOWN.appendChild(img_DOWN);
				
			tr.appendChild(td_info);
			tr.appendChild(td_X);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tbody.appendChild(tr);

//refresh
			next1++;
			}
		}
		
		document.getElementById('contcats').value=cat_ids;
		SqueezeBox.close();
		contrefresh_();
		
	}
	
function contremove_row(id){	
	tr=document.getElementById(id);
	tr.parentNode.removeChild(tr);
	contrefresh_();
}

function contrefresh_(){
	cat=document.getElementById('contcat');
	
	GLOBAL_tbody=cat;
	tox=',';
	for (x=0; x < GLOBAL_tbody.childNodes.length; x++)
	{
		tr=GLOBAL_tbody.childNodes[x];
		tox=tox+tr.getAttribute('cats_id')+',';
	}

	document.getElementById('contcats').value=tox;
}

function contup_row(id){
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
		contrefresh_();
	}
}

function contdown_row(id){
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
		contrefresh_();
	}
}






</script>
<br/>
<br/>
<table>
<tr>
<td>
<a class="modal" href="index.php?option=com_spiderfaq&c=addcontent&amp;tmpl=component&amp;object=id" rel="{handler: 'iframe', size: {x: 850, y: 575}}">
<img style="margin-top:-20px" src="components/com_spiderfaq/images/add_but.png" /> 
</a>
<table width="100%">
<tbody id="contcat"></tbody>
</table>
</td>
</tr>
</table>
<input type="hidden" name="<?php ?>" id="contcats" size="80" value="<?php $value1; ?>" />
<?php
JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_spiderfaq/tables');
	$contcats=array();
	if(isset($value1)){
	$cats_id=explode(',',$value1);
	
	$cats_id= array_slice($cats_id,1, count($cats_id)-2);  



	foreach($cats_id as $id)
	{
	
		$query ="SELECT * FROM #__categories WHERE extension='com_content' AND id=".$db->escape($id);
		$db->setQuery($query); 
		$is=$db->loadObject();
		if($is)
		$contcats[] = $db->loadObject();
		if ($db->getErrorNum())
		{
			echo $db->stderr();
			return false;
		}	
	}
	
if($contcats)
{
	foreach($contcats as $cat)
	{
		$v_ids[]=$cat->id;
		$v_titles[]=addslashes($cat->title);
		
	}

	$v_id='["'.implode('","',$v_ids).'"]';
	$v_title='["'.implode('","',$v_titles).'"]';
	//print_r ($v_title);
	?>
<script type="text/javascript">                
jSelectContentCategories(<?php echo $v_id?>,<?php echo $v_title?>);
<?php
}
}
?>

 </script>
 
 <span id="standcatidmultiple"></span>
	<script type="text/javascript">
        
		show0=document.getElementById("show0").checked;
	if (show0)
	{
document.getElementById('cuc').parentNode.parentNode.childNodes[6].setAttribute('style','display:none');

	}
	
        </script>

</td>
</tr>

<tr>
<td>Theme</td>
<td>
<?php
	$theme_select='<select style=" text-align:left;" name="theme_search" id="theme_search" class="inputbox" ">';
	foreach($themes as $theme)
	{
		
		$theme_select.='<option value="'.$theme->id.'"';
		 if (strlen($theme->title)<30){
		 $theme_title=$theme->title;
		 }
		 else{
		 $theme_title=substr_replace($theme->title,"...",30);
		 }
		if ($theme->id!="1")
		$theme_select.='disabled >'.$theme_title.'</option>';
		else
		$theme_select.=' >'.$theme_title.'</option>';
		
	}
	echo $theme_select;
?>
</td>
</tr>

<tr>
<td>
Show Search Form:
</td>
<td>
<input type="radio" name="show_searchform" id="show_searchform0"  value="0"  id="show_searchform0"><label for="show_searchform0">No</label>	 
<input type="radio" name="show_searchform" id="show_searchform1" value="1" checked="checked" id="show_searchform1"><label for="show_searchform1">Yes</label>
</td>
</tr>

<tr>
<td>
Expand All Answers After The Page Is Loaded:
</td>
<td width="100px">
<input type="radio" name="expand"  id="expand0" value="0" checked="checked" id="expand0"><label for="expand0">No</label>	 
<input type="radio" name="expand" id="expand1" value="1"   id="expand1"><label for="expand1">Yes</label>
</td>
</tr>

<tr>
<td><input type="image" src="components/com_spiderfaq/images/generate.png" name="generate" id="generate"  value="Generate" onClick="generate()" />

</td>
<td>
<input type="text" name="plugin_code" id="plugin_code" size="100px" readonly="readonly" onclick="SelectAll()" value="" />
</td>
</tr>


</table>


<script>
function SelectAll()
{
document.getElementById('plugin_code').focus();
document.getElementById('plugin_code').select();
}

function generate()
{
if(document.getElementById('show0').checked==true)
var standcategory=0;
else
var standcategory=1;

if(document.getElementById('show0').checked==true)
{
var cats=document.getElementById('cats').value;
cats=cats.substr(1);
categories=cats.slice(0,-1);
}
else
{
var cats=document.getElementById('contcats').value;
cats=cats.substr(1);
categories=cats.slice(0,-1);
}


var theme=document.getElementById('theme_search').value;

if(document.getElementById('show_searchform0').checked==true)
var show_searchform=0;
else
var show_searchform=1;

if(document.getElementById('expand0').checked==true)
var expanded=0;
else
var expanded=1;

document.getElementById('plugin_code').value="{loadspiderfaq standcategory="+standcategory+" categories="+categories+" theme="+theme+" show_searchform="+show_searchform+" expanded="+expanded+" }";
}
</script>
<?php
	}	
	
	
}
