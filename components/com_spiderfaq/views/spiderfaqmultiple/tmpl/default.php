<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');
 $db =JFactory::getDBO();
 
$standcat = JRequest::getVar('standcat');
$categories = JRequest::getVar('faq_cats');
$standcategories=JRequest::getVar('standcatids');
$cats=$this->cats;
$rows=$this->rows;

if($standcat==0)
{
$rand_id=explode(',',$categories);
	$random = implode('a',$rand_id);			
	
}
else{
$rand_id=explode(',',$standcategories);
	$random = implode('a',$rand_id);			

}
$id_for_com=rand();			

if($standcat == 0){
  if (isset($_POST["reset".$random]))
{
$rows=$this->rows;
}
else
{
if (isset($_POST["search".$random]))
{

foreach($cats as $cat)
				{
				if($cat)
					{
					
							$query ="SELECT * FROM #__spiderfaq WHERE published='1' AND category=".$db->escape((int)$cat->id)." AND (title LIKE '%".$db->escape($_POST['search'.$random])."%' OR article LIKE '%".$db->escape($_POST['search'.$random])."%' OR fullarticle LIKE '%".$db->escape($_POST['search'.$random])."%')";
							
							$db->setQuery($query); 
							$rows1 = $db->loadObjectList();	
						

							
						$rows[$cat->id] = $rows1;
						
				}
				}
 }
else 
{
$rows=$this->rows;
}
}
}
else
{

 if (isset($_POST["reset".$random]))
{
$rows=$this->rows;
}
else
{
if (isset($_POST["submit".$random]))
{

foreach($cats as $cat)
				{
					if($cat)
					{
						
					
							$query ="SELECT * FROM #__content WHERE state='1' AND catid=".$db->escape((int)$cat->id)." AND (title LIKE '%".$db->escape($_POST['search'.$random])."%' OR introtext LIKE '%".$db->escape($_POST['search'.$random])."%' OR `fulltext` LIKE '%".$db->escape($_POST['search'.$random])."%')";
						
							 $db->setQuery( $query);
							$rows1 = $db->loadObjectList();	
							
						$rows[$cat->id] = $rows1;
				}		
				}
}
else 
{
$rows=$this->rows;
}
}
}

$option=$this->option;
$Itemid=$this->Itemid;
$s=$this->s;
$stls=$this->stls;
$stl=&$stls;
$show_searchform=JRequest::getVar('searchform');
$expand=JRequest::getVar('expand');

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_spiderfaq/css/style.css');
jimport( 'joomla.html.parameter' );



if ($stl->ctpadding)
{
$cattpadding=explode(' ',$stl->ctpadding);
foreach($cattpadding as $padding)
{
if($padding=="")
break;
$ctpadding[]=$padding.'px';
}
$stl->ctpadding=implode(' ',$ctpadding);
}

if ($stl->ctmargin)
{
$cattmargin=explode(' ',$stl->ctmargin);
foreach($cattmargin as $margin)
{
if($margin=="")
break;
$ctmargin[]=$margin.'px';
}
$stl->ctmargin=implode(' ',$ctmargin);
}

if ($stl->cdmargin)
{
$catdmargin=explode(' ',$stl->cdmargin);
foreach($catdmargin as $margin)
{
if($margin=="")
break;
$cdmargin[]=$margin.'px';
}
$stl->cdmargin=implode(' ',$cdmargin);
}

if ($stl->cdpadding)
{
$catdpadding=explode(' ',$stl->cdpadding);
foreach($catdpadding as $padding)
{
if($padding=="")
break;
$cdpadding[]=$padding.'px';
}
$stl->cdpadding=implode(' ',$cdpadding);
}


if ($stl->amargin)
{
$ansmargin=explode(' ',$stl->amargin);
foreach($ansmargin as $margin)
{
if($margin=="")
break;
$amargin[]=$margin.'px';
}
$stl->amargin=implode(' ',$amargin);
}

if ($stl->amarginimage)
{
$ansmarginimage=explode(' ',$stl->amarginimage);
foreach($ansmarginimage as $margin)
{
if($margin=="")
break;
$amarginimage[]=$margin.'px';
}
$stl->amarginimage=implode(' ',$amarginimage);
}

if ($stl->amarginimage2)
{
$ansmarginimage2=explode(' ',$stl->amarginimage2);
foreach($ansmarginimage2 as $margin)
{
if($margin=="")
break;
$amarginimage2[]=$margin.'px';
}
$stl->amarginimage2=implode(' ',$amarginimage2);
}

if ($stl->expcolmargin)
{
$ecmargin=explode(' ',$stl->expcolmargin);
foreach($ecmargin as $margin)
{
if($margin=="")
break;
$expcolmargin[]=$margin.'px';
}
$stl->expcolmargin=implode(' ',$expcolmargin);
}

if ($stl->sformmargin)
{
$sfmargin=explode(' ',$stl->sformmargin);
foreach($sfmargin as $margin)
{
if($margin=="")
break;
$sformmargin[]=$margin.'px';
}
$stl->sformmargin=implode(' ',$sformmargin);
}
?>


<style type="text/css" media="screen">
		
#content<?php echo $random ?>{
width: <?php echo $stl->width.'px' ?>;
}

#post_right<?php echo $random ?>{
width: <?php echo $stl->twidth.'px' ?>;
}
		
#post_title<?php echo $random ?>{
height: <?php echo $stl->theight.'px' ?>;
width: <?php echo $stl->twidth.'px' ?>;
border-style: <?php echo $stl->tbstyle ?>;
border-width:<?php echo $stl->tbwidth.'px' ?>;
border-color:<?php echo '#'.$stl->tbcolor ?>;
background-size: <?php echo $stl->tbgsize ?>;
background-repeat:no-repeat;
border-radius:<?php echo $stl->tbradius.'px' ?>;
<?php if($stl->titlebg==1) { if ($stl->tbgimage!="") { ?>
background-image:url('<?php echo  JURI::root()."administrator/".$stl->tbgimage ?>');
<?php }} else { if  ($stl->titlebggrad=="0") { ?>
background-color:#<?php echo $stl->tbgcolor ?>;
<?php } else { if($stl->gradtype!="circle") { ?>
background: -webkit-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
background: -moz-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
background: -o-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
<?php } else { ?> 
background: -webkit-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
background: -moz-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
background: -o-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
<?php } } } ?>

}	

#tchangeimg<?php echo $random ?>{
display: table-cell;
vertical-align: middle;
}

	.post_title #tchangeimg<?php echo $random ?> img{

margin-left:<?php echo $stl->marginlimage1.'px' ?>;
	}

#post_title<?php echo $random ?>:hover{
 <?php if  ($stl->titlebggrad=="0") { ?>
background-color:#<?php echo $stl->tbghovercolor ?>;
<?php } else { if($stl->gradtype!="circle") { ?>
background: -webkit-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
background: -moz-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
background: -o-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
<?php } else { ?> 
background: -webkit-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
background: -moz-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
background: -o-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
<?php } }
?>
}
	

#ttext<?php echo $random ?>{
width:<?php echo $stl->ttxtwidth.'%' ?>;
padding-left:<?php echo $stl->ttxtpleft.'px' ?>;
font-size:<?php echo $stl->tfontsize.'px' ?>;
color:<?php echo '#'.$stl->tcolor ?>;

}

#post_content_wrapper<?php echo $random ?>{
width: <?php echo $stl->awidth.'px' ?>;
border-style: <?php echo $stl->abstyle ?>;
border-width:<?php echo $stl->abwidth.'px' ?>;
border-color:<?php echo '#'.$stl->abcolor ?>;
background-size: <?php echo $stl->abgsize ?>;
border-radius:<?php echo $stl->abradius.'px' ?>;
}
	
.post_content_wrapper #imgbefore<?php echo $random ?> img{

width: <?php echo $stl->aimagewidth.'px' ?>;
height: <?php echo $stl->aimageheight.'px' ?>;
margin-top:<?php echo $stl->amarginimage ?>;
}

.post_content_wrapper #imgafter<?php echo $random ?> img{

width: <?php echo $stl->aimagewidth2.'px' ?>;
height: <?php echo $stl->aimageheight2.'px' ?>;
margin-top:<?php echo $stl->amarginimage2 ?>;
}
	
#atext<?php echo $random ?>{
padding:<?php echo $stl->amargin ?> !important;
font-size:<?php echo $stl->afontsize.'px' ?>;
color:<?php echo '#'.$stl->atxtcolor ?>;
}	

a.more-link, #more-link<?php echo $random ?>{
color:<?php echo '#'.$stl->rmcolor ?> !important; 
font-size:<?php echo $stl->rmfontsize.'px' ?> !important; ;
}

a.more-link, #more-link<?php echo $random ?>:hover{
color:<?php echo '#'.$stl->rmhovercolor ?> !important; ;
}


	#searchform<?php echo $random?>{
margin: <?php echo $stl->sformmargin ?>;
	
	}

	.searchform #search_keyword<?php echo $random?> {
<?php if($stl->sboxbg == 0){
	?>
background:none;
<?php } 
else {
?>
background-color: <?php echo '#'.$stl->sboxbgcolor 
?>
<?php } 
?>;

width: <?php echo $stl->sboxwidth.'px' ?>;
height: <?php echo $stl->sboxheight.'px' ?>;
color: <?php echo '#'.$stl->sboxtcolor ?>;
font-size:<?php echo $stl->sboxfontsize.'px' ?>;
border-style: <?php echo $stl->sboxbstyle ?>;
border-width:<?php echo $stl->sboxbwidth.'px' ?>;
border-color:<?php echo '#'.$stl->sboxbcolor ?>;

}

.searchform #search_button<?php echo $random?>, .searchform #reset_button<?php echo $random?>  {
cursor: pointer;
<?php if($stl->srbg == 0){
	?>
background:none;
<?php } 
else {
?>
background-color: <?php echo '#'.$stl->srbgcolor 
?>
<?php } 
?>;

width: <?php echo $stl->srwidth.'px' ?>;
height: <?php echo $stl->srheight.'px' ?>;
color: <?php echo '#'.$stl->srtcolor ?>;
font-size:<?php echo $stl->srfontsize.'px' ?>;
font-weight:<?php echo $stl->srfontweight ?>;
border-style: <?php echo $stl->srbstyle ?>;
border-width:<?php echo $stl->srbwidth.'px' ?>;
border-color:<?php echo '#'.$stl->srbcolor ?>;

}

#cattitle<?php echo $random?>	{
<?php if($stl->ctbg == 0){
	?>
background:none;
<?php } 
else { if($stl->ctbggrad == 0){
?>
background-color: <?php echo '#'.$stl->ctbgcolor ?>;
<?php } else { if($stl->ctgradtype!="circle") { ?>
background: -webkit-linear-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
background: -moz-linear-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
background: -o-linear-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
<?php } else { ?> 
background: -webkit-radial-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
background: -moz-radial-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
background: -o-radial-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
<?php }

}}
?>

color: <?php echo '#'.$stl->cttxtcolor ?>;
font-size:<?php echo $stl->ctfontsize.'px' ?>;
padding:<?php echo $stl->ctpadding ?>;
margin:<?php echo $stl->ctmargin ?>;
border-radius:<?php echo $stl->ctbradius.'px' ?>;
border-style: <?php echo $stl->ctbstyle ?>;
border-width:<?php echo $stl->ctbwidth.'px' ?>;
border-color:<?php echo '#'.$stl->ctbcolor ?>;
}
	
#catdes<?php echo $random?> {
<?php if($stl->cdbg == 0){
	?>
background:none;
<?php } 
else { if($stl->cdbggrad == 0){
?>
background-color: <?php echo '#'.$stl->cdbgcolor ?>;
<?php } else { if($stl->cdgradtype!="circle") { ?>
background: -webkit-linear-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
background: -moz-linear-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
background: -o-linear-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
<?php } else { ?> 
background: -webkit-radial-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
background: -moz-radial-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
background: -o-radial-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
<?php }

}}
?>

color: <?php echo '#'.$stl->cdtxtcolor ?>;
font-size:<?php echo $stl->cdfontsize.'px' ?>;
margin:<?php echo $stl->cdmargin ?>;	
padding:<?php echo $stl->cdpadding ?>;
border-radius:<?php echo $stl->cdbradius.'px' ?>;
border-style: <?php echo $stl->cdbstyle ?>;
border-width:<?php echo $stl->cdbwidth.'px' ?>;
border-color:<?php echo '#'.$stl->cdbcolor ?>;
	}	
	
	a.post_exp, a.post_coll, #post_expcol<?php echo $random ?>{
color:<?php echo '#'.$stl->expcolcolor ?> ;
font-size:<?php echo $stl->expcolfontsize.'px' ?>;

}

a.post_exp:hover, a.post_coll:hover, #post_expcol<?php echo $random ?>:hover{
color:<?php echo '#'.$stl->expcolhovercolor ?> !important;
background:none !important;
}

.expcoll, #expcol<?php echo $random ?>{
margin:<?php echo $stl->expcolmargin ?>;
color:<?php echo '#'.$stl->expcolcolor ?> ;
}

	
	</style>
	

	<script>
	

function faq_delsearch<?php echo $random ?>()
{
document.getElementById('search_keyword<?php echo $random ?>').value="";
}	


var change = true;
function faq_changesrc<?php echo $random ?>(x)
{
if (document.getElementById('stl<?php echo $random ?>'+x))
{

if(change) {
change = false;
if (document.getElementById('stl<?php echo $random ?>'+x).src=="<?php echo  JURI::root().'administrator/'.$stl->tchangeimage1; ?>")
{
document.getElementById('stl<?php echo $random ?>'+x).src="<?php echo 'administrator/'.$stl->tchangeimage2; ?>";
document.getElementById('stl<?php echo $random ?>'+x).style.marginLeft="<?php echo $stl->marginlimage2.'px' ?>";

}
else
{
document.getElementById('stl<?php echo $random ?>'+x).src="<?php echo 'administrator/'.$stl->tchangeimage1; ?>";
document.getElementById('stl<?php echo $random ?>'+x).style.marginLeft="<?php echo $stl->marginlimage1.'px' ?>";

}

}

setTimeout("change=true",400);
}
}





var changeall = true;

function faq_changeexp<?php echo $random ?>()
{
for (i=0; i<<?php echo $s ?>; i++)
{
if (document.getElementById('stl<?php echo $random ?>'+i))
{
document.getElementById('stl<?php echo $random ?>'+i).src="<?php echo 'administrator/'.$stl->tchangeimage2; ?>";
document.getElementById('stl<?php echo $random ?>'+i).style.marginLeft="<?php echo $stl->marginlimage2.'px' ?>";

}
}
}


function faq_changecoll<?php echo $random ?>()
{
if(changeall) {
changeall = false;
for (i=0; i<<?php echo $s ?>; i++)
{
if (document.getElementById('stl<?php echo $random ?>'+i))
{
document.getElementById('stl<?php echo $random ?>'+i).src="<?php echo 'administrator/'.$stl->tchangeimage1; ?>";
document.getElementById('stl<?php echo $random ?>'+i).style.marginLeft="<?php echo $stl->marginlimage1.'px' ?>";

}
}
}
setTimeout("changeall=true",400);
}


</script>


	<script type="text/javascript" src="administrator/components/com_spiderfaq/elements/js/jquery-1.2.6.pack.js"></script>
	<script type="text/javascript" src="administrator/components/com_spiderfaq/elements/js/effects.core.packed.js"></script>
	<script type="text/javascript" src="administrator/components/com_spiderfaq/elements/js/jquery.scrollTo.js"></script>
      <script type="text/javascript" src="administrator/components/com_spiderfaq/elements/js/loewy_blog.js"></script>

	
	
<?php if($expand=='1')
{
?>
<script>

$(window).load(function(){iiiiiiiiiii=<?php echo $id_for_com ?>; $('#<?php echo $id_for_com ?> .post_exp')[0].click();  faq_changeexp<?php echo $random ?>();}) 
</script>
<?php
}
?>	

	

<div id="<?php echo $id_for_com; ?>">
<div id="contentOuter"><div id="contentInner">
  <div id="content<?php echo $random ?>" >
  
<ul class="posts" style="<?php if ($stl->background=="0") {?> background-color:<?php echo '#'.$stl->bgcolor; ?><?php } else { if ($stl->background=="1") { ?><?php if ($stl->bgimage!="") {?> background-image:url(<?php echo 'administrator/'.$stl->bgimage ?>) <?php } } }?> ">			
			<!-- Loop Starts -->
			<li class="selected" id="post-1236" >

<?php if ( $show_searchform == 1)
{ ?>

<form  class="searchform" id="<?php echo 'searchform'.$random ?>" action="<?php echo  $_SERVER['REQUEST_URI']; ?>" method="post">
 
 
		<div align="right"><input type="text" class="search_keyword" id="<?php echo 'search_keyword'.$random ?>" name="<?php echo 'search'.$random ?>"    value="<?php if(isset($_POST['search'.$random])) { echo $_POST['search'.$random]; } ?>"  /></div>
	<div align="right" style="margin-top:10px;"><input class="search_button" id="<?php echo 'search_button'.$random ?>" type="submit" name="<?php echo 'submit'.$random ?>" value="<?php echo JText::_("SEARCH"); ?>"/>
		              <input class="reset_button" id="<?php echo 'reset_button'.$random ?>" onclick="faq_delsearch<?php echo $random ?>()"  type="submit"  name="<?php echo 'reset'.$random ?>" value="<?php echo JText::_("RESET"); ?>"/>
	</div>
		</form>
		
<?php	
}

 
	
 	
				
if($standcat == 1){                                          /*standart category -yes */

$a=false;
foreach($cats as $cat)
 {
if ($cat)
{
$a=true;
}
}

if($a)
{
 echo '<div class="expcoll" id="expcol'.$random. '">
     <a class="post_exp" id="post_expcol'.$random. '"><span onclick="iiiiiiiiiii='.$id_for_com.'; faq_changeexp'.$random.'()">'.JText::_("EXPANDALL").' </span></a><span>|</span>
     <a  class="post_coll" id="post_expcol'.$random. '"><span onclick="jjjjjjjjjjj='.$id_for_com.'; faq_changecoll'.$random.'()">'.JText::_("COLLAPSEALL").'</span></a></div>';

}


	
$n=0;		
foreach($cats as $cat)
 {
if ($cat)
{


$k=0;
 for ($i=0;$i<count($rows[$cat->id]);$i++)
 {
 $row = &$rows[$cat->id][$i];

$param = new JInput();
$show_category = $param->get('show_category'); 
$app = JFactory::getApplication('site');
$componentParams = $app->getParams('com_content');
$show_category_global = $componentParams->get('show_category');

if ($show_category=="")
		$show_category=$show_category_global;		
		
if ($show_category==0)
$k=1;
}



if ($k==1)
{
echo '<div style="padding-bottom:60px"></div>';
}
else
echo '<div class="cattitle"  id="cattitle'.$random. '">'.$cat->title.'</div>';
if ($cat->description!="")
echo '<div class="catdes" id="catdes'.$random. '">'.$cat->description.'</div>';
else{
echo '<div style="padding-top:18px"></div>';
}

if(count($rows[$cat->id]))
{


 $p=1;	
 for ($i=0;$i<count($rows[$cat->id]);$i++)
 {
 $row = &$rows[$cat->id][$i];
 
 $param = new JInput();
$show_title = $param->get('show_title'); 

$app = JFactory::getApplication('site');
$componentParams = $app->getParams('com_content');
$show_title_global = $componentParams->get('show_title');
 
if ($show_title=="")
		$show_title=$show_title_global;



	if($show_title==1) 
	{
   
		
			echo '</li><li id="post-1236" class="selected" style="margin-left:'.$stl->marginleft.'px"><div class="post_top">
				  <div class="post_right" id="post_right'.$random.'">
					  <a href="#" class="post_ajax_title"><span onclick="faq_changesrc'.$random.'('.$n.')"><h2 class="post_title" id="post_title'.$random.'">
					  '?><?php if ($stl->tchangeimage1!=""){ echo'<div class="tchangeimg" id="tchangeimg'.$random.'"><img src="administrator/'.$stl->tchangeimage1.'"  id="stl'.$random.$n.'" /></div>'  ?><?php } echo '<div class="ttext" id="ttext'.$random.'">'.$p.'. '.$row->title.'</div></h2></span></a>
				    </div>
			    </div>';
			
			if (strlen($row->fulltext)>1){
					  echo '<div class="post_content">
				  <div class="post_content_wrapper" id="post_content_wrapper'.$random.'" style="'?><?php if($stl->abg==1) {  if ($stl->abgimage!="") { echo 'background-image:url(administrator/'.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
				    '?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$random. '"><img src="administrator/'.$stl->aimage.'"  /></div>'  ?><?php } echo '<div class="post_right" id="post_right'.$random.'"><div class="atext" id="atext'.$random. '">'.$row->introtext.'<p><a href="#" class="more-link" id="more-link'.$random. '">More</a></p>
			            <div class="post_content_more" style="margin-top:-6px;">'.$row->fulltext.'</div>	    
			               </div></div>'?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$random. '"><img src="administrator/'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
			       </div></div>
				</li>';
			}
			else{
			echo '<div class="post_content">
				  <div class="post_content_wrapper" id="post_content_wrapper'.$random.'" style="'?><?php if($stl->abg==1) {  if ($stl->abgimage!="") { echo 'background-image:url(administrator/'.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
				    '?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$random. '"><img src="administrator/'.$stl->aimage.'"  /></div>'  ?><?php } echo '<div class="post_right" id="post_right'.$random.'">'?><?php if ($row->introtext!=""){ echo '<div class="atext" id="atext'.$random. '">'.$row->introtext.'</div>'?><?php } else echo '<div style="margin-top:50px"></div>
					</div>'?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$random. '"><img src="administrator/'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
			       </div></div>
				</li>';
			}
		
		}
	else 
		{
			echo '</li><li id="post-1236" class="selected" style="margin-left:'.$stl->marginleft.'px"><div class="post_top">
				  <div class="post_right" id="post_right'.$random.'">
					  <a href="#" class="post_ajax_title"><span onclick="faq_changesrc'.$random.'('.$n.')"><h2 class="post_title" id="post_title'.$random.'">
					  '?><?php if ($stl->tchangeimage1!=""){ echo'<div class="tchangeimg" id="tchangeimg'.$random.'"><img src="administrator/'.$stl->tchangeimage1.'"  id="stl'.$random.$n.'" /></div>'  ?><?php } echo '<div class="ttext" id="ttext'.$random.'">'.$p.'. '.$row->title.'</div></h2></span></a>
				    </div>
			    </div>';
			
				
	if (strlen($row->fulltext)>1){
					  echo '<div class="post_content">
				  <div class="post_content_wrapper" id="post_content_wrapper'.$random.'" style="'?><?php if($stl->abg==1) {  if ($stl->abgimage!="") { echo 'background-image:url(administrator/'.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
				    '?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$random. '"><img src="administrator/'.$stl->aimage.'"  /></div>'  ?><?php } echo '<div class="post_right" id="post_right'.$random.'"><div class="atext" id="atext'.$random. '">'.$row->introtext.'<p><a href="#" class="more-link" id="more-link'.$random. '">More</a></p>
			            <div class="post_content_more" style="margin-top:-6px;">'.$row->fulltext.'</div>	    
			               </div></div>'?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$random. '"><img src="administrator/'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
			       </div></div>
				</li>';
			}
			else{
			echo '<div class="post_content">
				  <div class="post_content_wrapper" id="post_content_wrapper'.$random.'" style="'?><?php if($stl->abg==1) {  if ($stl->abgimage!="") { echo 'background-image:url(administrator/'.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
				    '?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$random. '"><img src="administrator/'.$stl->aimage.'"  /></div>'  ?><?php } echo '<div class="post_right" id="post_right'.$random.'">'?><?php if ($row->introtext!=""){ echo '<div class="atext" id="atext'.$random. '">'.$row->introtext.'</div>'?><?php } else echo '<div style="margin-top:50px"></div>
					</div>'?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$random. '"><img src="administrator/'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
			       </div></div>
				</li>';
			}
		
		}
		echo '<div style="padding-bottom:'.$stl->paddingbq.'px"></div>';	
	$n++;	
$p++;
}
}

	
	else{
	if(isset($_POST['submit'.$random]))
{
echo 'Question(s) not found';
}
else
echo 'There are no questions in this category';
	
	}
	echo '<div style="padding-bottom:30px;"></div>';	
	}
	}	
 }
 
		else{      		                  /* standart category- no */
$a=false;
foreach($cats as $cat)
 {
if ($cat)
{
$a=true;
}
}

if($a)
{
 echo '<div class="expcoll" id="expcol'.$random. '">
     <a class="post_exp" id="post_expcol'.$random. '"><span onclick="iiiiiiiiiii='.$id_for_com.'; faq_changeexp'.$random.'()">'.JText::_("EXPANDALL").' </span></a><span>|</span>
     <a  class="post_coll" id="post_expcol'.$random. '"><span onclick="jjjjjjjjjjj='.$id_for_com.'; faq_changecoll'.$random.'()">'.JText::_("COLLAPSEALL").'</span></a></div>';

}

		
$n=0;	
	
foreach($cats as $cat)
 {
if ($cat)
{


if ($cat->show_title==1)
{
if ($cat->title=="Uncategorised")
echo '<div class="cattitle" id="cattitle'.$random. '">'.JText::_("UNCATEGORISED").'</div>';
else
echo '<div class="cattitle" id="cattitle'.$random. '">'.$cat->title.'</div>';
}
if ($cat->show_description==1 && $cat->description!="")
echo '<div class="catdes" id="catdes'.$random. '">'.$cat->description.'</div>';
else{
echo '<div style="padding-top:18px"></div>';
}

if(count($rows[$cat->id]))
{


$p=1;
 for ($i=0;$i<count($rows[$cat->id]);$i++)
 {
 $row = &$rows[$cat->id][$i];


	
			echo '</li><li id="post-1236" class="selected" style="margin-left:'.$stl->marginleft.'px"><div class="post_top">
				  <div class="post_right" id="post_right'.$random.'">
					  <a href="#" class="post_ajax_title"><span onclick="faq_changesrc'.$random.'('.$n.')"><h2 class="post_title" id="post_title'.$random.'">
					  '?><?php if ($stl->tchangeimage1!=""){ echo'<div class="tchangeimg" id="tchangeimg'.$random.'"><img src="administrator/'.$stl->tchangeimage1.'"  id="stl'.$random.$n.'" /></div>'  ?><?php } echo '<div class="ttext" id="ttext'.$random.'">'.$p.'. '.$row->title.'</div></h2></span></a>
				    </div>
			    </div>';
			
				
	if (strlen($row->fullarticle)>1){
					  echo '<div class="post_content">
				  <div class="post_content_wrapper" id="post_content_wrapper'.$random.'" style="'?><?php if($stl->abg==1) {  if ($stl->abgimage!="") { echo 'background-image:url(administrator/'.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
				    '?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$random. '"><img src="administrator/'.$stl->aimage.'"  /></div>'  ?><?php } echo '<div class="post_right" id="post_right'.$random.'"><div class="atext" id="atext'.$random. '">'.$row->article.'<p><a href="#" class="more-link" id="more-link'.$random. '">More</a></p>
			            <div class="post_content_more" style="margin-top:-6px;">'.$row->fullarticle.'</div>	    
			               </div></div>'?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$random. '"><img src="administrator/'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
			       </div></div>
				</li>';
			}
			else{
			echo '<div class="post_content">
				  <div class="post_content_wrapper" id="post_content_wrapper'.$random.'" style="'?><?php if($stl->abg==1) {  if ($stl->abgimage!="") { echo 'background-image:url(administrator/'.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
				    '?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$random. '"><img src="administrator/'.$stl->aimage.'"  /></div>'  ?><?php } echo '<div class="post_right" id="post_right'.$random.'">'?><?php if ($row->article!=""){ echo '<div class="atext" id="atext'.$random. '">'.$row->article.'</div>'?><?php } else echo '<div style="margin-top:50px"></div>
					</div>'?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$random. '"><img src="administrator/'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
			       </div></div>
				</li>';
			}

		
	echo '<div style="padding-bottom:'.$stl->paddingbq.'px"></div>';	
		
	$n++;	
$p++;
}


	}
	else{
if(isset($_POST['submit'.$random]))
{
echo 'Question(s) not found';
}
else
echo 'There are no questions in this category';	
	
	}
	
	echo '<div style="padding-bottom:30px;"></div>';		
	}
	}
}
?>


			</ul>		
	  </div></div></div></div>
	  
