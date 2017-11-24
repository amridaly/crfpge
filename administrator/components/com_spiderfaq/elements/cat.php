<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

class JFormFieldCat extends JFormField
{
	var	$_name = 'cat';
function getInput()
{
	
        ob_start();
        static $embedded;
                if(!$embedded)
        {

            $embedded=true;

        }



            ?>
<span id="cuc"></span>
<fieldset name="gag" class="radio">
<input type="radio" name="<?php echo $this->name;?>"  value="0" <?php if($this->value==0) echo 'checked="checked"'?> onChange="show_(0)" id="show0"><label for="show0"> No</label>
<input type="radio" name="<?php echo $this->name;?>"  value="1" <?php if($this->value==1) echo 'checked="checked"'?> onChange="show_(1)" id="show1"> <label for="show1">Yes</label>
</fieldset>
<script type="text/javascript">




function show_(x)
{
	
	if(x==0)
	{
	document.getElementById('cuc').parentNode.parentNode.parentNode.childNodes[7].setAttribute('style','display:none');	
	document.getElementById('cuc').parentNode.parentNode.parentNode.childNodes[5].removeAttribute('style');	
	}
	else
	{
	document.getElementById('cuc').parentNode.parentNode.parentNode.childNodes[5].setAttribute('style','display:none');	
	document.getElementById('cuc').parentNode.parentNode.parentNode.childNodes[7].removeAttribute('style');	
	}


	
}
</script>

<style>
.control-label label{
width:90px;

}

fieldset label{

}
</style>

        <?php

        $content=ob_get_contents();

        ob_end_clean();
        return $content;
		echo $content;

    }
	}
	
	?>