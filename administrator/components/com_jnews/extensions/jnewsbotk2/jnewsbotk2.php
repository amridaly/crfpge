<?php
defined('_JEXEC') OR die('...Direct Access to this location is not allowed...');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

/**
* @copyright Copyright (C) 2009 Joobi All rights reserved.
* @license This file is released under the GPL license (http://www.gnu.org/licenses )
* @link https://joobi.co
*/
$jNewsMainFrame = JFactory::getApplication();
$jNewsMainFrame->registerEvent('jnewsbot_k2editabs', 'jnewsbot_k2_editab');
$jNewsMainFrame->registerEvent('jnewsbot_transformall', 'jnewsbot_k2_transformall');

function jnewsbot_k2_editab() {

     $limit = 5;

    $limittotal = countK2Items();
    $setLimitk2 = jnews::setLimitPagination($limittotal);

    $task = JRequest::getVar('task','','','WORD');

    //filter
    if(isset($_POST['contentsearchk2']))
    {
        $contentsearch = JRequest::getVar('contentsearchk2', 'post','', 'string');
    }
    else
    {
        $contentsearch = "";
    }



    $toSearch = new stdClass;
    $toSearch->forms = '';
    //$toSearch->hidden = $hidden;
    $toSearch->listsearch = $contentsearch;
    $toSearch->id = 'contentsearchk2';

    $app = JFactory::getApplication();
    $setSortk2 = new stdClass;
    if( ! isset($_POST['k2_filter_order']))
    {
        $setSortk2->orderValue = "a.id";
    }
    else  $setSortk2->orderValue = $_POST['filter_order'];

    $setSortk2->orderDir = $app->getUserStateFromRequest(JNEWS_OPTION . '.k2content.filter_order_Dir', 'filter_order_Dir', 'desc', 'word');

    $sort_select = JRequest::getVar('filter_category_id_k2', '', 'POST', 'int');


    $k2contentitems = jnewsbot_k2_getitems($contentsearch, $setLimitk2, $setSortk2, $sort_select);

	ob_start();

	$js = "var id_global, content_type, hide_title_global;
            function setContentTag(id, hide_title_or_rendering)
            {
                if(id != null) {

                    if(document.getElementById('for_disabled').checked === false)
                    {
                         document.getElementById('hide_title_yes').disabled=false;
                    }

                    if(hide_title_or_rendering ==undefined && hide_title_global == undefined)
                    {
                         hide_title_global = 0;
                    }
                    if(hide_title_or_rendering ==undefined && content_type == undefined)
                    {
                        content_type = 0;
                    }
                    if(id ==='rendering')
                    {
                        content_type = hide_title_or_rendering;
                        if(id_global == undefined)  id_global = 0;
                        if(hide_title_global == undefined) hide_title_global = 0;
                        if(hide_title_or_rendering == 2)
                        {
                           // hide_title_global = 0;
                            document.getElementById('hide_title_no').click();
                            document.getElementById('hide_title_yes').disabled=true;

                        }
                    }
                    if(id == 'hide_title')
                    {
                        hide_title_global = hide_title_or_rendering;
                        if(id_global == undefined) id_global = 0;
                        if(content_type == undefined) content_type = 0;
                    }
                    if( id % 1 === 0)
                    {
                        id_global = id;
                        if(content_type == undefined) content_type = 0;
                        if(hide_title_global == undefined) hide_title_global = 0;
                    }

                    var form = document.adminForm;
                    if(!form){
                            form = document.mosForm;
                    }
                    var tag = '{k2item:' + id_global + '|' + content_type +'|'+hide_title_global+ '}';
                    form.k2tag.value = tag;

                }
                else
                {           var form = document.adminForm;
                            if(!form){
                                    form = document.mosForm;
                            }
                            var tag = form.k2tag.value;     ";

	if( version_compare(JVERSION,'1.6.0','<') ){//1.5
		$js .= " if(window.top.insertTag(tag)){window.top.document.getElementById('sbox-window').close();}";
	}else if(version_compare(JVERSION,'3.0.0','<')){
		$js .= ' if(window.top.insertTag(tag)) {window.parent.SqueezeBox.close();}';
	}else {$js .= ' if(window.top.insertTag(tag)) {
                    var need_click = jQuery(window.top.document).find("div.modal-backdrop");
                    if(need_click.length == 0) window.parent.SqueezeBox.close();
                    else    jQuery(window.top.document).find("div.modal-backdrop").click();}';

        }
		$js .= "}
	}";
//if(window.top.insertTag(tag)){window.top.document.getElementById('sbox-window').close();}
	$doc = JFactory::getDocument();
	$doc->addScriptDeclaration($js);

?>


<style type="text/css">
table.smartcontent {
	border: 1px solid #D5D5D5;
	background-color: #F6F6F6;
	width: 100%;
	margin-bottom: 10px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	padding: 5px;
}
table.smartcontent td.key {
	background-color: #f6f6f6;
	text-align: left;
	width: 140px;
	color: #666;
	font-weight: bold;
	border-bottom: 1px solid #e9e9e9;
	border-right: 1px solid #e9e9e9;
}
</style>
<div id="element-box">
<div class="t">
    <div class="t">
        <div class="t"></div>
    </div>
</div>
<div class="m">



<form id="adminForm" name="adminForm" method="post" action="index.php?option=<?php echo JNEWS_OPTION; ?>&tmpl=component&act=tags&task=k2content">



<table class="smartcontent" width="100%">
<tr>
<td width="185" class="key">
<span class="editlinktip">
<?php
	$tip = _JNEWS_AUTONEWS_TYPE_TIPS;
	$title = _JNEWS_AUTONEWS_TYPE;
	echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
?>
</span>
</td>
<td style="vertical-align: top;">
<span class="editlinktip">
<?php
	$tip = _JNEWS_TITLE_ONLY_TIPS ;
	$title = _JNEWS_TITLE_ONLY;
	$title_only = "<span class=\"editlinktip\">" . jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 ) . "</span>";

	$tip = _JNEWS_INTRO_ONLY_TIPS;
	$title = _JNEWS_INTRO_ONLY;
	$intro_only = "<span class=\"editlinktip\">" . jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 ) . "</span>";

	$tip = _JNEWS_FULL_ARTICLE_TIPS;
	$title = _JNEWS_FULL_ARTICLE ;
	$full_article = "<span class=\"editlinktip\">" . jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 ) . "</span>";
?>
</span>
<span class="editlinktip">
    <input type="radio" onclick="setContentTag('rendering', 0)" name="content_type" value="0" checked="checked" /><?php echo $full_article; ?>
    <input type="radio"  onclick="setContentTag('rendering', 1)" name="content_type" value="1" /><?php echo $intro_only; ?>
    <input id="for_disabled" type="radio" onclick="setContentTag('rendering', 2)" name="content_type" value="2" /><?php echo $title_only; ?>
</span>

</td>
<td rowspan="2">
        <input onclick="setContentTag(null)" class="inserttag" type="button" label="Insert Tag" name="Insert Tag" value="<?php echo _JNEWS_TAG_INSERT_TAG; ?>"/>
</td>
</tr>

<tr>
	<td width="185" class="key">
		<span class="editlinktip">
			Tag
		</span>
	</td>
	<td style="vertical-align: top;">
		<!-- 	<input type="text" onchange="setCaptionTags();" size="60px" name="jnewstagcaption"> -->
			<input type="text" size="60px" name="k2tag">
	</td>
</tr>
<tr>
	<td width="185" class="key">
		<span class="editlinktip">
                    <?php
			$tip = _JNEWS_HIDE_TITTLE_ARTICLE_TIPS;
                        $title = _JNEWS_HIDE_TITLE;
                        echo jNews_Tools::toolTip($tip, '', 280, 'tooltip.png', $title, '', 0);
                    ?>
		</span>
	</td>
	<td style="vertical-align: top;">
            <span class="hide_title" >
                <input id="hide_title_no" onclick="setContentTag('hide_title', 0);" type="radio" name="hide_title" value="0" checked="checked" /><?php echo 'No'; ?>
                <input id="hide_title_yes" onclick="setContentTag('hide_title', 1);" type="radio" name="hide_title" value="1" /><?php echo 'Yes'; ?>
            </span>
        </td>
</tr>
</table>
<div id="element-box">
    <div class="t">
        <div class="t">
            <div class="t"></div>
        </div>
    </div>


    <div class="m"  style="position:relative;">


    <input type="hidden" name="option" value="<?php echo JNEWS_OPTION;?>" />
    <input type="hidden" name="limit" value="<?php echo $limit;?>" />
<!--////////////////////////////////////////////////////-->
        <?php
            echo jnews::setTop($toSearch, null);
            $category_list_k2 = getAllCategoriesK2();


        ?>
        <div style="position:absolute;top:5px; left:55%;">
            <select name="filter_category_id_k2" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
                <?php for($i=0; $i<count($category_list_k2);$i++):?>
                <option value="<?php echo $category_list_k2[$i]->id;?>"  <?php if($sort_select == $category_list_k2[$i]->id) echo "selected"?>>
                    <?php echo $category_list_k2[$i]->name;?>
                </option>
               <?php endfor;?>
            </select>
        </div>
        <table class="<?php echo jnews::myTheme(); ?>" cellpadding="0" cellspacing="0">
            <tbody>
                <thead>
                    <tr>
                        <th width="80px" class="title">
                                <?php if($setSortk2->orderDir == 'asc') $new_sort= "desc"; else $new_sort = "asc";?>
                                    <a class="hasTip" title="" onclick="Joomla.tableOrdering('a.title','<?php echo $new_sort;?>', 'k2content');" href="#">
                                       <?php echo _JNEWS_TAGPICKLIST_TITLE; ?>
                                         <?php if(($setSortk2->orderValue == 'a.title')):?><i class="icon-arrow-<?php echo($new_sort == "asc") ?  "up" : "down";?>"></i><?php endif;?>
                                    </a>

                        </th>
                           <th width="80px" class="title">
                                <?php if($setSortk2->orderDir == 'asc') $new_sort= "desc"; else $new_sort = "asc";?>
                                    <a class="hasTip" title="" onclick="Joomla.tableOrdering('a.title_2','<?php echo $new_sort;?>', 'k2content');" href="#">
                                        <?php echo _JNEWS_TAG_ARTICLESECTION; ?>
                                         <?php if(($setSortk2->orderValue == 'a.title_2')):?><i class="icon-arrow-<?php echo($new_sort == "asc") ?  "up" : "down";?>"></i><?php endif;?>
                                    </a>

                        </th>
                        <th width="80px" class="title">
                                <?php if($setSortk2->orderDir == 'asc') $new_sort= "desc"; else $new_sort = "asc";?>
                                    <a class="hasTip" title="" onclick="Joomla.tableOrdering('a.catid','<?php echo $new_sort;?>', 'k2content');" href="#">
                                        <?php echo _JNEWS_TAG_ARTICLECATEGORY; ?>
                                         <?php if(($setSortk2->orderValue == 'a.catid')):?><i class="icon-arrow-<?php echo($new_sort == "asc") ?  "up" : "down";?>"></i><?php endif;?>
                                    </a>

                        </th>
                        <th width="80px" class="title">
                                <?php if($setSortk2->orderDir == 'asc') $new_sort= "desc"; else $new_sort = "asc";?>
                                    <a class="hasTip" title="" onclick="Joomla.tableOrdering('a.id','<?php echo $new_sort;?>', 'k2content');" href="#">
                                       <?php echo "  ID" ?>
                                         <?php if(($setSortk2->orderValue == 'a.id')):?><i class="icon-arrow-<?php echo($new_sort == "asc") ?  "up" : "down";?>"></i><?php endif;?>
                                    </a>

                        </th>

                    </tr>
                </thead>
                <?php

                        if(sizeof($k2contentitems) > 0){
                                $k = 0;
                                foreach($k2contentitems as $k2contentitem){
                                        if (empty($k2contentitem->section)) $k2contentitem->section = JText::_('Uncategorised');
                                        if (empty($k2contentitem->category)) $k2contentitem->category = JText::_('Uncategorised');
                                        echo '<tr style="cursor:pointer" class="row'.$k.'" onclick="setContentTag(\''.$k2contentitem->id.'\');" ><td>'.$k2contentitem->title.'</td><td nowrap="nowrap" align="center">'.$k2contentitem->section.'</td><td nowrap="nowrap" align="center">'.$k2contentitem->category.'</td><td nowrap="nowrap" align="center">'.$k2contentitem->id.'</td></tr>';
                                        $k = 1-$k;
                                }//endforeach
                        }//endif
                ?>
            </tbody>
        </table>
   <?php
    echo jnews::setPaginationBot($setLimitk2, 'margin:auto;');
    ?>

</div>
<div class="b">
<div class="b">
<div class="b"></div>
</div>
</div>
</div>
                <input type="hidden" value="<?php echo $task; ?>" name="task"/>
                <input type="hidden" value="<?php echo $setSortk2->orderValue; ?>" name="k2_filter_order"/>
                  <input type="hidden" value="<?php echo $setSortk2->orderValue; ?>" name="filter_order"/>
                <input type="hidden" value="<?php echo $setSortk2->orderDir; ?>" name="filter_order_Dir"/>
</form>
</div>
<div class="b">
<div class="b">
<div class="b"></div>
</div>
</div>
</div>
<?php
	$return = ob_get_contents();
	ob_end_clean();
	return array(_JNEWS_CONTENT_ITEM, $return);
}

function jnewsbot_k2_getitems($filter="", $pagination_obj=null, $sort_obj=null, $sort_select_cat=null)
{


        if($pagination_obj->end < 5)
            $pagination_obj->end = 5;

	$db = JFactory::getDBO();

	$query = "SELECT a.id as id, a.title as title, b.name as category
                    FROM #__k2_items as a
                    LEFT JOIN #__k2_categories AS b ON a.catid = b.id
                    WHERE a.trash = 0  AND a.published = 1 AND b.published = 1 AND b.trash = 0";
        if( ! empty($filter))
        {
            $query .= ' AND a.title LIKE  \'%' . $db->escape($filter) . '%\'';
        }

        if($sort_select_cat )
        {
             $query .= ' AND b.id=' . (int)$sort_select_cat;
        }

        if( ! empty($sort_obj))
        {
            $val_sort = ($sort_obj->orderValue == 'a.title_2') ? "a.title" : $sort_obj->orderValue ;
            $query .= " ORDER BY " . $db->escape($val_sort) . " " . $db->escape($setSort->orderDir);
        }
        else
        {
             $query .= " ORDER BY a.catid, a.created DESC LIMIT 5000";
        }

        if( ! is_null($pagination_obj) && $pagination_obj->start != -1 && $pagination_obj->end)
        {
               $query .= ' LIMIT ' . (int)$pagination_obj->start . ', ' . (int)$pagination_obj->end;
        }


	$db->setQuery($query);
	$k2items = $db->loadObjectList();

	return $k2items;
}

function jnewsbot_k2_transformall( &$html, &$text, &$subject, $queueInfo=null ) {

	$mainframe = JFactory::getApplication();
	$livesite=$mainframe->getCfg("live_site");
	$sef=$mainframe->getCfg("sef");
        $k2_items = array();
	$k2_items_new = array();
	$k2_items_old = array();
        preg_match_all('/\{k2item:(.{1,8})\|(.{1})}/', $html, $k2_items_old, PREG_SET_ORDER);
        preg_match_all('/\{k2item:(.{1,8})\|(.{1})\|(.{1})}/',$html, $k2_items_new, PREG_SET_ORDER);
        $k2_items = jnewsbot_class_transform_mergeArray($k2_items_new, $k2_items_old);

	foreach ($k2_items as $k2_item) {
		//j15
		if( version_compare(JVERSION,'1.6.0','<') ) $Itemid = $mainframe->getItemId($k2_item[1]);

		if(empty($Itemid)){
			$Itemid = $GLOBALS[JNEWS.'itemidAca'];
		}
		$replacement = jnewsbot_k2_getitem($k2_item[1]);
		if ($GLOBALS[JNEWS.'show_author'] == 1){
			$author = '<br />'.$replacement->created_by_alias;
		}else{
			$author = '';
		}

		$replacement->introtext = str_replace('{mospagebreak}', '<div style="clear: both;" ><div />', $replacement->introtext);
		$replacement->fulltext = str_replace('{mospagebreak}', '<div style="clear: both;" ><div />', $replacement->fulltext);
//   [0] => {k2item:3|1|1}
//    [1] => 3
//    [2] => 1
//    [3] => 1
                if(isset($k2_item[3]))
                {
                    if($k2_item[3] == 1 && $k2_item[2] != 2)  $replacement->title = "";
                }
		if ($k2_item[2] == 0) {
			$html = str_replace($k2_item[0], '<div class="aca_content"><span class="aca_title">' . $replacement->title . '</span>' . "\r\n" . $author .'<br />' . $replacement->introtext . '<br />' . "\r\n" . $replacement->fulltext . "\r\n".'</div>', $html);
		} else {
			if ($GLOBALS[JNEWS.'use_sef'] == '1' AND $sef == '1' AND function_exists('sefRelToAbs')) {
				$link = sefRelToAbs('index.php?option=com_k2&view=item&id='.$k2_item[1].'&Itemid='.$Itemid);
			} else {
				$link = $livesite.'/index.php?option=com_k2&view=item&id='.$k2_item[1].'&Itemid='.$Itemid;
			}

			if ($k2_item[2] == 1) {
				$html = str_replace($k2_item[0], '<div class="aca_content"><span class="aca_title">' . $replacement->title . '</span>' . "\r\n" . $author .'<br />' . $replacement->introtext . '<br />' . "\r\n" . '<a href="' . $link . '"><span class="aca_readmore">' . _JNEWS_READMORE . '</span></a>' . "\r\n".'</div>', $html);
			}else {
				$html = str_replace($k2_item[0], '<a href="' . $link . '"><span class="aca_title">' . $replacement->title . '</span></a>', $html);
			}
		}

		$image = jnewsbot_k2_getimage($replacement->image);

		if( version_compare(JVERSION,'1.6.0','<') ){ //j15
			$imgfolders = '/images/stories';
		}else{ //j16
			$imgfolders = '/images/sampledata';
		}//endif

		foreach($image as $image) {
			$image_string = '<img src="' . $livesite . $imgfolders . $image['image'] . '" align="' . $image['align'] . '" alt="' . $image['alttext'] . '" border="' . $image['border'] . '" />';
			$html = preg_replace('/{mosimage}/', $image_string, $html, 1);
		}//endforeach

	}//endforeach

        $k2_items = array();
        $k2_items_new = array();
	$k2_items_old = array();
        preg_match_all('/\{k2item:(.{1,5})\|(.{1})}/', $text, $k2_items_old, PREG_SET_ORDER);
        preg_match_all('/\{k2item:(.{1,5})\|(.{1})\|(.{1})}/',$text, $k2_items_new, PREG_SET_ORDER);
        $k2_items = jnewsbot_class_transform_mergeArray($k2_items_new, $k2_items_old);

	foreach ($k2_items as $k2_item) {

		//j15
		if( version_compare(JVERSION,'1.6.0','<') )  $Itemid = $mainframe->getItemId($k2_item[1]);

		if(empty($Itemid)){
			$Itemid = $GLOBALS[JNEWS.'itemidAca'];
                }
		$replacement = jnewsbot_k2_getitem($k2_item[1]);
		if ($GLOBALS[JNEWS.'show_author'] == 1){
			$author = "\r\n".$replacement->created_by_alias;
		}else{
			$author = '';
		}

		$replacement->title = strtoupper(jNews_ProcessMail::htmlToText($replacement->title));
		$replacement->introtext = jNews_ProcessMail::htmlToText($replacement->introtext);
		$replacement->fulltext = jNews_ProcessMail::htmlToText($replacement->fulltext);
                if(isset($k2_item[3]))
                {
                    if($k2_item[3] == 1 && $k2_item[2] != 2)  $replacement->title = "";
                }
		if ($k2_item[2] == 0) {
			$text = str_replace($k2_item[0], $replacement->title . $author . "\r\n" . $replacement->introtext . "\r\n" . $replacement->fulltext . "\r\n", $text);
		} else {
			if ($GLOBALS[JNEWS.'use_sef'] == '1' AND $sef == '1' AND function_exists('sefRelToAbs')) {
				$link = sefRelToAbs('index.php?option=com_k2&view=item&id='.$k2_item[1].'&Itemid='.$Itemid);
			} else {
				$link = $livesite.'/index.php?option=com_k2&view=item&id='.$k2_item[1].'&Itemid='.$Itemid;
			}

			if ($k2_item[2] == 1) {
				$text = str_replace($k2_item[0], $replacement->title . $author . "\r\n" . $replacement->introtext . "\r\n" . '* ' . _JNEWS_READMORE . ' ( '. $link . ' )' . "\r\n", $text);
			}else {
				$text = str_replace($k2_item[0], $replacement->title . ' ( ' . $link . ' )', $text);
			}
		}
		$text = str_replace('{mosimage}', '', $text);
	}

	$html = str_replace('{mospagebreak}', '<div style="clear: both;" ><div />', $html);
	$text = str_replace('{mospagebreak}', "\r\n \r\n", $text);

}


function jnewsbot_k2_getitem($id) {

	$db = JFactory::getDBO();
	$k2_items=null;
	$query = "SELECT a.title as title, a.catid as catid, a.introtext as introtext, b.name as name, a.created_by_alias as created_by_alias, a.fulltext as 'fulltext', a.gallery as image FROM #__k2_items as a LEFT JOIN #__users as b ON a.created_by = b.id WHERE a.id = $id";
	$db->setQuery($query);
	$k2_items = $db->loadObject();

	if(empty($k2_items)) return false;

	if( empty($k2_items->created_by_alias)) $k2_items->created_by_alias = $k2_items->name;

	if(get_magic_quotes_runtime()) {
		if (!empty($k2_items->title))$k2_items->title = stripslashes($k2_items->title);
		if (!empty($k2_items->introtext))$k2_items->introtext = stripslashes($k2_items->introtext);
		if (!empty($k2_items->fulltext))$k2_items->fulltext = stripslashes($k2_items->fulltext);
		if (!empty($k2_items->image))$k2_items->image = stripslashes($k2_items->image);
		if (!empty($k2_items->created_by_alias))$k2_items->created_by_alias = stripslashes($k2_items->created_by_alias);
		if (!empty($k2_items->catid))$k2_items->catid = stripslashes($k2_items->catid);
	}
		return $k2_items;
}

function jnewsbot_k2_getimage($image) {

	$first = @explode("\n",$image);

	for($i=0, $n=count($first); $i < $n; $i++) {
		$second = explode('|',$first[$i] . '|||');
		$third[$i]['image'] = $second[0];
		$third[$i]['align'] = $second[1];
		$third[$i]['alttext'] = $second[2];
		$third[$i]['border'] = $second[3];
	}
	return $third;
}

function countK2Items()
{
    $db = JFactory::getDBO();
    $query = "SELECT count(*) as count_k2_items FROM #__k2_items as a LEFT JOIN #__k2_categories AS b ON a.catid = b.id
                    WHERE a.trash = 0  AND a.published = 1 AND b.published = 1 AND b.trash = 0";
    $db->setQuery($query);
    $count_k2_items = $db->loadResult();

    return $count_k2_items;

}

function getAllCategoriesK2()
{
    $db = JFactory::getDBO();
    $query =  "SELECT id,name FROM #__k2_categories WHERE published=1 AND trash=0";
    $db->setQuery($query);
    $k2_list_categories = $db->loadObjectList();

    return $k2_list_categories;

}
