<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');


jimport( 'joomla.application.component.controller' );


class SpiderfaqControllerImages extends JControllerLegacy
{
	
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		
		
	}

function display(){
	?>
<script type="text/javascript">
<?php $x=JRequest::getVar('a'); ?>
function set_imagevalue<?php echo $x ?>()
{
	var image<?php echo $x ?>= document.getElementById('image<?php echo $x ?>').value;
	if(image<?php echo $x ?>=="") 
	{
		alert('Image is empty'); 
		return;
	}
	window.parent.document.getElementById('imagebox<?php echo $x ?>').src=image<?php echo $x ?>;
	window.parent.document.getElementById('imagebox<?php echo $x ?>').style.display="block";
	window.parent.document.getElementById('<?php echo JRequest::getVar('type'); ?>').value=image<?php echo $x ?>;
	window.parent.SqueezeBox.close();
}

function set_selected_imageofstyle<?php echo $x ?>(x)
{
	document.getElementById('image<?php echo $x ?>').value=x.replace(/\\/g,'/').replace(/\/\//g,'/');
}
</script>
<style>
button   { padding: 3px; border: 1px solid #CCCCCC; color: #0B55C4; background-color: white; }
</style>
<?php   $folders=JRequest::getVar('folders','');
  
  
  $direc = 'components'.DS.'com_spiderfaq'.DS.'upload'.DS.$folders;

  
function deletefiles($delete_file)
{	
	if(is_dir($delete_file))
		{
		$delete_folder = scandir($delete_file);
		foreach($delete_folder as $file)
			if($file!='.' and $file!='..')
				deletefiles($delete_file.DS.$file);
			
		rmdir($delete_file);
		}
	else
		unlink($delete_file);
}
  
if(JRequest::getVar('delete_file','')!='')
deletefiles(JRequest::getVar('delete_file'));

  
if(JRequest::getVar('foldername1','')!='')
mkdir($direc.DS.JRequest::getVar('foldername1'));

$files = JRequest::getVar('file', null, 'files', 'array');
$allowedExtensions = array("jpg","png","gif"); 

if (isset($files["type"]))
  {
  if ($files["error"] > 0)
	{
	echo '<span style="color:red;">Error Code: <b>' . $files["error"] . '</b></span><br />';
	}
  else
	{

	if (file_exists($direc.DS . $files["name"]))
	  {
	  echo '<span style="color:red;"><b>'.$files["name"] . '</b> already exists.</span><br />';
	  }
	else
		{
			$extension= end(explode(".", strtolower($files['name'])));
			if (!in_array($extension,$allowedExtensions))
			{
			  echo '<span style="color:red;"><b>'.$files["name"].'</b> invalid file format</span><br />';
			}
			else
			  {
			  move_uploaded_file($files["tmp_name"],
			  $direc.DS . $files["name"]);
			  echo "<span style='color:blue;'>Stored in: <b>" . $folders.DS. $files["name"].'</b></span><br />';
			  }
		}
	}
  }
  else
  {
  echo 'Allowed file extensions - jpg, png, gif';
  }
  
  
 
echo "<br />Directory: <b>".$folders.DS.'</b><div style="float: right">
			<button type="button" onclick="set_imagevalue'.$x.'()";>Insert</button>
			<button type="button" onclick="window.parent.SqueezeBox.close();">Cancel</button>
		</div>';


echo "<br /><br />";
  
$files1 = scandir($direc);
$nofiles=true;
?>
<hr />
<table cellpadding="5" cellspacing="0" border="1" width="500">
<tr><td>Name</td><td>Size</td><td>Delete</td></tr>
<?php
if($folders!='')
echo '<tr><td colspan="3"><a href="index.php?option=com_spiderfaq&c=images&a='.$x.'&type='.JRequest::getVar('type').'&tmpl=component&folders='.substr($folders,0,strrpos($folders,DS)).'" title="Directory Up" style="text-decoration:none; margin:5px;"><button type="button" onclick=""><img src="components/com_spiderfaq/images/arrow_up.png" alt="" />Folder Up</button></a></td></tr>';

foreach($files1 as $file)
if($file!='.' and $file!='..' and is_dir($direc.DS.$file))
{
	echo '<tr><td><a href="index.php?option=com_spiderfaq&c=images&a='.$x.'&type='.JRequest::getVar('type').'&tmpl=component&folders='.$folders.DS.$file.'" style="color:#333399"><img src="components/com_spiderfaq/images/folder_sm.png" alt="" />&nbsp;'. $file .'</a></td><td>&nbsp;</td><td><a  style="color:#333399" href="javascript:if(confirm(\'Are you sure you want to delete the directory and all its contents?\'))document.forms.delfileform.delete_file.value=\''.addslashes($direc.DS.$file).'\';document.forms.delfileform.submit();">Delete</a></td></tr>';
	$nofiles=false;
}

foreach($files1 as $file)
if(!(is_dir($direc.DS.$file)))
if (in_array(end(explode(".", strtolower($file))),$allowedExtensions))
{
	echo '<tr><td><a href="javascript:set_selected_imageofstyle'.$x.'(\''.addslashes($direc.DS.$file).'\')" style="color:#333399">'. $file .'</a></td><td>'.round(filesize($direc.DS.$file)/1024).' Kb </td><td><a style="color:#333399" href="javascript:if(confirm(\'Are you sure you want to delete?\'))
	document.forms.delfileform.delete_file.value=\''.addslashes($direc.DS.$file).'\';document.forms.delfileform.submit();">Delete</a></td></tr>';
	$nofiles=false;
}

if($nofiles)
echo '<tr><td colspan="3">No Files</td></tr>';

  ?>
  </table>
  <br />
  <table cellpadding="5" cellspacing="0" border="1" width="500">
<tr><td>Create a New Folder</td></tr>
	<tr><td>
	<form action="index.php?option=com_spiderfaq&c=images&a=<?php echo $x ?>&type=<?php echo JRequest::getVar('type'); ?>&tmpl=component&folders=<?php echo $folders ?>" method="post" style="margin:5px;">
			<label for="file">Folder Name</label>
			<input type="text" name="foldername1" id="foldername1" /> 
			<input type="submit" name="submit" value="Create" />
	</form>
	</td></tr>
  </table>
  
  <br />
  <table cellpadding="5" cellspacing="0" border="1" width="500">
<tr><td>Upload a File</td></tr>
	<tr><td>
	<form action="index.php?option=com_spiderfaq&c=images&a=<?php echo $x ?>&type=<?php echo JRequest::getVar('type'); ?>&tmpl=component&folders=<?php echo $folders ?>" method="post"	enctype="multipart/form-data" style="margin:5px;">
			<label for="file">Select a file:</label>
			<input type="file" name="file" id="file" /> 
			<input type="submit" name="submit" value="Upload" />
		</form>
	</td></tr>
  </table>
		
		<br /><br />
  <label for="file">Image URL:</label>
			<input type="text" name="image<?php echo $x ?>" id="image<?php echo $x ?>" size="50" /> 
  <br /><br /><br />
  
		
 
 <form action="index.php?option=com_spiderfaq&c=images&a=<?php echo $x ?>&type=<?php echo JRequest::getVar('type'); ?>&tmpl=component&folders=<?php echo $folders ?>" method="post" name="delfileform">
			<input type="hidden" name="delete_file" /> 
		</form>
 
 
	<?php
}
}
