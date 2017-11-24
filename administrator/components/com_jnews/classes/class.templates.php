<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co
class jNews_Templates {

        static $nameNewFolder = "";
	/**
	 * <p>public static function get/load the templates object in the database</p>
	 * @param boolean $onlyPublish - to get/load only the template that is publish (publish = 1)
	 * @param boolean $onlyDefault - to load only the default template (premium = 1)
	 * @param mixed $templateSearch - the template to be seach
	 * @param int $start - start of query
	 * @param int $limit - limit of query
	 * @param availability - show only available templates
	 */
	public static function getTemplates( $onlyPublish=true, $onlyDefault=false, $templateSearch='', $start=-1, $limit=-1, $setSort=null, $onlyavailable=-1 ) {
		$db = JFactory::getDBO();

		$query = 'SELECT * FROM `#__jnews_templates` ';

		$where[] = $onlyPublish ? ' `published`=1 ' : ' `published`<>-1 ';
		$where[] = $onlyDefault ? ' `premium`=1 ' : ' `premium`<>-1 ';

		//if the search of template is not empty
		//if the value is a numeric, we consider it as the template_id so we search by template_id
		if (!empty($templateSearch)) {
				if( is_numeric($templateSearch) ) $where[] = ' `template_id` =' . (int)$templateSearch;
				else $where[] = ' (name LIKE \'%' . $db->escape($templateSearch) . '%\' OR namekey LIKE \'%' . $db->escape($templateSearch) . '%\') ';
		}

		$query .= (count( $where ) ? " WHERE " . implode( ' AND ', $where ) : "");

		if(($onlyavailable == 1 && jnews::getVar('task', '','', 'WORD') == 'assign')) $query .= ' AND `availability`=1 ';

		if( !empty($setSort) ) {
			$s = is_int($setSort->orderValue) ? "$setSort->orderValue" : "`" .$db->escape($setSort->orderValue) . "`";
			$query .= "ORDER BY $s " .$db->escape($setSort->orderDir);
		}else{
			$query .= 'ORDER BY `premium` DESC, `created` DESC, `published` DESC, `ordering` ASC,  `name` ASC';
		}

		if ($start != -1 && $limit != -1) {
			$query .= ' LIMIT ' . (int)$start . ', ' . (int)$limit;
		}

		$db->setQuery($query);
		$templates = $db->loadObjectlist();

		return $templates;
	}


/** public static function that would save the template to its table jnews _templates
	 * @param string $task - task executed
	 * @param int $template_id - template id
	*/
	public static function saveTemplate( $task, $template_id ){
		$template = new stdClass;
		$db = JFactory::getDBO();

		$template->template_id = $template_id;
		$template->name = jnews::getVar('template_name', '', 'request','STRING');
		$template->description = jnews::getVar('description', '', 'request','STRING');
		$template->altbody = JRequest::getVar('alt_body', '', 'request', 'STRING' );
		$template->created = time();
		$template->published = JRequest::getInt('confirmed', 0);
		$template->premium = JRequest::getInt('premium', 0);
		$template->namekey = jnews::getVar('template_namekey', '', 'request', 'STRING' );
		$template->thumbnail = ( !empty( $_FILES['file_0']['name'] ) ? JNEWS_PATH_ADMIN_THUMBNAIL_SHOW . $_FILES['file_0']['name'] : '');
		
		$template->thumbnail = filter_var( $template->thumbnail, FILTER_SANITIZE_URL );
		

	    $template->body = JRequest::getVar('template_body','','request','string', JREQUEST_ALLOWRAW );

		//either  boxes or file
// 		$styleChoseBox = jnews::getVar('stylechosen');

		$styles = JRequest::getVar('styles',array(),'','array');
		$CSStyle = JRequest::getVar('template_customcss', '', 'request', 'STRING');
		$newStyles = JRequest::getVar('otherstyles',array(),'','array');

		if ( !empty($newStyles) ) {
			$countC = count( $newStyles['classname'] );
			for ($i = 0; $i < $countC; $i++) {
				$styles[ $newStyles['classname'][$i] ] = $newStyles['style'][$i];
			}
		}

		//remove empty style
		$wowStyle = array();
		foreach( $styles as $oneK => $oneS ) {
			if ( !empty($oneS) ) $wowStyle[$oneK] = $oneS;
		}

		//we apply the background color defined in the bg color field
		if ( !empty( $styles['color_bg'] ) ) {
	    	$pattern1 = '#^([^<]*<[^>]*background-color:)([^;">]{1,10})#i';
	    	$found = false;
	    	if(preg_match($pattern1,$template->body)){
	    		$template->body = preg_replace($pattern1,'$1'.$styles['color_bg'],$template->body);
	    		$found = true;
	    	}

	    	$pattern2 = '#^([^<]*<[^>]*bgcolor=")([^;">]{1,10})#i';
	    	if(preg_match($pattern2,$template->body)){
	    		$template->body = preg_replace($pattern2,'$1'.$styles['color_bg'],$template->body);
	    		$found = true;
	    	}

	    	if(!$found){
	    		$template->body = '<div style="background-color:'.$styles['color_bg'].';" width="100%">'.$template->body.'</div>';
	    	}
		}

		$template->styles = serialize( $wowStyle );
	    $template->csstyle = $CSStyle;

		// check and create thumbnail folder
		$thumbPath = JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates' .DIRECTORY_SEPARATOR. 'thumbnail';
		if( is_dir( $thumbPath ) ){
			// change thumbnail folder permission
			if( !is_writable( $thumbPath .DIRECTORY_SEPARATOR) ) @chmod( $thumbPath .DIRECTORY_SEPARATOR, 0777 );
       	}else{
       			if( is_dir( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates' ) ){
       				// change templates folder permission
       				if( !is_writable( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates' .DIRECTORY_SEPARATOR) ) @chmod( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates' .DIRECTORY_SEPARATOR, 0777 );

       				// create thumbnail folder
       				if( !is_dir( $thumbPath ) ) @mkdir( $thumbPath, 0777 );
       			}else{
       				// change component folder permission
       				if( !is_writable( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR) ) @chmod( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR, 0777 );
       				// create templates folder
       				if( !is_dir( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates' ) ) @mkdir( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates', 0777 );
       				// create thumbnail folder
       				if( !is_dir( $thumbPath ) ) @mkdir( $thumbPath, 0777 );
       			}
       		}

		//set all template to not premium if the edited template is set to premium
		if ($template->premium) {
			jNews_Templates::updateTemplate($template->premium, 'default', false, false);
		}

		$template->body = jNews_Mailing::replaceOldTagsToNew($template->body);
		$template->altbody = jNews_Mailing::replaceOldTagsToNew($template->altbody);
		if ( empty($template->namekey) ) $template->namekey = 'tp' . time();

		if ($template_id < 1) {//new template

				// upload file
				if( !empty( $template->thumbnail ) && !empty( $_FILES['file_0'])){
					// public static function source in class.mailing.php
					$path = JNEWS_PATH_ADMIN_THUMBNAIL_UPLOAD;
					jNews_Mailing::uploadFiles( $path, array( 'jpg', 'png', 'gif' ) );
				}

				$query = "INSERT INTO `#__jnews_templates` (`name`,`description` , `body` , `altbody`, `created`, `premium` ," .
						" `namekey` , `published` ,`csstyle`, `styles`, `thumbnail` ) " .
					"\n VALUES ( '".$db->escape($template->name)."', '".$db->escape($template->description)."', ".
					"'".$db->escape($template->body)."', ".
					"'".$db->escape($template->altbody)."', ".
					"'" . (int)$template->created."', ".
					"'" . (int)$template->premium."', ".
					"'".$db->escape($template->namekey)."', ".
					"'" . (int)$template->published."', ".
					"'".$db->escape($template->csstyle)."', ".
					"'".$db->escape($template->styles)."', ".
					"'" . (int)$template->thumbnail."' )";
				
				$db->setQuery($query);
				$db->query();

		}else{//edit here

			// upload file but first check and replaced old file
			if (!empty($template->thumbnail) && !empty($_FILES['file_0'])) {
				$path = JNEWS_PATH_ADMIN_THUMBNAIL_UPLOAD;
				// remove the previous image
				$query1 = "SELECT `thumbnail` FROM `#__jnews_templates` WHERE `template_id` = ". (int)$template->template_id;
				$db->setQuery($query1);
				$result = $db->loadResult();

				$thumbnail = str_replace(JNEWS_PATH_ADMIN_THUMBNAIL_SHOW,'',$result);

				if( !empty($thumbnail) ) {
					$findposhttp=strpos($result,'http://');
					$findposwww=strpos($result,'www.');
					if ( ($findposhttp === false ) && ($findposwww === false) ){
						jNews_Attachment::deleteAttachment( $thumbnail, $path );
					}
				}

				// public static function source in class.mailing.php
				// file is save to /root/components/.../templates/image
				jNews_Mailing::uploadFiles( $path, array( 'jpg', 'png', 'gif' ) );

			}

			$query = "UPDATE `#__jnews_templates` SET " .
			"	`name` = '".$db->escape($template->name)."', " .
			"	`description` = '".$db->escape($template->description)."', " .
			"	`body` = '".$db->escape($template->body)."', " .
			"	`altbody` = '".$db->escape($template->altbody)."', " .
			"	`created` = '" . (int)$template->created."', " .
			"	`premium` = '" . (int)$template->premium."', " .
			"	`namekey` = '".$db->escape($template->namekey)."' , " .
			"	`published` = '" . (int)$template->published."' , " .
			"	`csstyle` = '".$db->escape($template->csstyle)."' , " .
			"	`styles` = '".$db->escape($template->styles).'\'';
			$query .= (!empty($template->thumbnail)) ? ", `thumbnail` = '" . (int)$template->thumbnail."'" :"";
			$query .= "	WHERE `template_id`=" . (int)$template->template_id;
			$db->setQuery($query);
			$db->query();
			
		}

		return true;
	}

	/**
	 * <p>public static function to load selected columns in the database</p>
	 * @param string $col - the column to be selected
	 * @param array $where -
	 * @param string $orderby -
	 * @param string $sort - order by DESC/ASC
	 * @return mixed
	 */
	 public static function loadOneTemplate( $col, $template_id, $orderby='template_id', $sort='DESC', $needPremium=false ) {
	 	$db = JFactory::getDBO();
		$query = '';
		$query .= 'SELECT '. $db->escape($col) .' FROM `#__jnews_templates`';
		$where = array();
		if ( !empty($template_id) ) $where[] = ' `template_id`=' . (int)$template_id.' ';
		if ( $needPremium ) $where[] = ' `premium`=1 ';
		$query .= (count( $where ) ? " WHERE " . implode( ' AND ', $where ) : "");
		$query .= ' ORDER BY '.$db->escape($orderby).' '. $db->escape($sort);
		$query .= ' LIMIT 1';
		$db->setQuery($query);

		if($col == '*'){
			$template = $db->loadObject();
			if ( !empty($template) ) {
				$template->name = stripslashes($template->name);
				$template->description = stripslashes($template->description);
				$template->body = stripslashes($template->body);
				$template->altbody = stripslashes($template->altbody);
				$template->namekey = stripslashes($template->namekey);
				$template->csstyle = stripslashes($template->csstyle);
				$template->styles = unserialize(stripslashes($template->styles));
			}
		}else{
			$template = $db->loadResult();
			if($col == 'name') $template = stripslashes($template);
			if($col == 'description') $template = stripslashes($template);
			if($col == 'body') $template = stripslashes($template);
			if($col == 'altbody') $template = stripslashes($template);
			if($col == 'namekey') $template = stripslashes($template);
			if($col == 'cssstyle') $template = unserialize(stripslashes($template));
			if($col == 'styles') $template = unserialize(stripslashes($template));
		}

		return $template;
	 }

	 /**
	  * <p>Functiont to update the template table</p>
	  * @param int $template_id -  id of the template
	  * @param string $task - whether the task is to publised/unpublish or set default
	  * @param boolean $published -  to published or unpublised the template
	  * @param boolean $premium - set the template to premium
	  */
	  public static function updateTemplate( $template_id, $task='published', $published, $premium=true ) {
	  	//if (!empty($template_id)) return false;
		$set = array();
		$where = array();

		if ( empty($template_id) ) return false;
		if ( is_array($template_id) ) $template_id = implode( ',', $template_id);

		//to set published/unpublished the template
		if ( $task == 'published') {
			//check if its a default template
			//you cannot unpublished a default template
			if (!$published){
				$default = jNews_Templates::loadOneTemplate('premium',$template_id);
				if ($default) return false;
			}

			$set[]= $published ? " `published` = 1 " : " `published` = 0 ";
			$where[] = " `template_id` IN ( ".$template_id . ')';

		} elseif ( $task == 'default') {
			if(!$premium){
				//set all template to not default
				$set[]= " `premium` = 0 ";
				$where[] = " `template_id` NOT IN ( ".$template_id . ')';
			}else{
				//set template to premium and published
				$set[]= " `premium` = 1 ";
				$where[] = " `template_id` IN ( ".$template_id . ')';
			}
			if($published) $set[]= " `published` = 1 ";
		}//endelseif

	  	$db = JFactory::getDBO();
		$query = "UPDATE `#__jnews_templates` SET ";
		$query .= implode( ', ', $set );
	  	$query .= (count( $where ) ? " WHERE " . implode( ' AND ', $where ) : "");

	  	$db->setQuery($query);
		$db->query();

		return true;

	  }

	/*<p> public static function to copy a certain template</p>
	 * @params $template_id - the id of the template to be copied
	 * return boolean
	 */
	public static function copyTemplate($template_id){

		$db = JFactory::getDBO();
		$xf = new jNews_Config();
		$template->premium = 0;
		$time = time();
            $query = 'INSERT IGNORE INTO `#__jnews_templates` (`name`, `description`, `body`, `altbody`, `created`, `published`, `premium`, `ordering`, `namekey`, `csstyle`,`styles`, `thumbnail`)';
			$query .= ' SELECT CONCAT(`name`,\'_copy\'), `description`, `body`, `altbody`, '.$time.', `published`, ' . (int)$template->premium . ', `ordering`, CONCAT(`namekey`,\'_copy'.$time.'\'), `csstyle`,`styles`,`thumbnail` FROM `#__jnews_templates` WHERE `template_id` = '.(int)$template_id;
			$db->setQuery($query);
			$db->query();

        return true;

	}


	/*<p>public static function to delete a template</p>
	 * @param $template_id - id of the template
	 */
	public static function deleteTemplate( $templateIDs ){
		if ( empty( $templateIDs ) ) return false;

		$db = JFactory::getDBO();

		foreach( $templateIDs as $template_id ) {
			// remove template file from ftp
			// get namekey of the file... template namekey should be same with the file folder name
			$template = jNews_Templates::loadOneTemplate('*', $template_id);
			if( !empty( $template->premium ) ) continue;

			if( !empty( $template->namekey ) && empty( $template->premium ) ) {
				// get namekey and remove file
				jNews_Templates::removeTemplateFile( $template->namekey );
			}

			if( isset( $template->thumbnail ) && !empty( $template->thumbnail )){

				$path = JNEWS_PATH_ADMIN_THUMBNAIL_UPLOAD;
				$findposhttp=strpos( $template->thumbnail ,'http://');
				$findposwww=strpos( $template->thumbnail ,'www.');

				if ( ($findposhttp === false ) && ($findposwww === false) ){
					jNews_Attachment::deleteAttachment( $template->thumbnail, $path );
				}

			}

		}

		$query = 'DELETE FROM `#__jnews_templates` WHERE `template_id` IN ('. jnews::implode( ',', $templateIDs ) . ')';
		$query .= ' AND `premium` != 1 ';
		$db->setQuery( $query );
		$db->query();

		return true;

	}



/**
 *
 * Convert the CSS style into inline CSS
 * @param array $style
 * @param string $csstyle
 */
	public static function convertCSSInline( $style, $csstyle ) {
		$inline = str_replace( '}', "}\n", $csstyle );
		if ( !empty($style) ) {
			foreach( $style as $cName => $sContent ) {
				if ( empty($sContent) ) continue;
				if( preg_match( '#^style_(.*)$#',$cName, $result) ) {
					if( !empty($sContent) )	$inline.= $result[1].' { '.$sContent.' } '."\n";
				} elseif( !empty($cName) && $cName != 'color_bg' ){
					if ( $cName[0] == '#'
					|| ( strtolower( substr( $cName, 0, 6 ) ) == 'table.' )
					|| ( strtolower( substr( $cName, 0, 4 ) ) == 'div.' )
					|| ( strtolower( substr( $cName, 0, 3 ) ) == 'td.' )
					|| ( strtolower( substr( $cName, 0, 3 ) ) == 'tr.' )
					|| ( strtolower( substr( $cName, 0, 2 ) ) == 'p.' )
					|| ( strtolower( substr( $cName, 0, 5 ) ) == 'span.' )
					) {
						$inline.= $cName.' {'.$sContent.'} '."\n";
					} else {
						$inline.= '.' . $cName.' {'.$sContent.'} '."\n";
					}
				}
			}
		}

		if( version_compare(PHP_VERSION, '5.0.0', '>=') && class_exists('DOMDocument') && function_exists('mb_convert_encoding') ) {
			$inline .= "a img{ border:0px; text-decoration:none;}\n";
		}

		return $inline;
	}


/** public static function to put the CSS in the mailing
 * @param string $body
 * @param int $templateId
 */
	public static function includeStyles( &$body, $templateId ) {
		static $checkMe = true;

		$body = preg_replace('#< *(tr|td|table)([^>]*)(style="[^"]*)background-image *: *url\(\'?([^)\']*)\'?\);?#Ui','<$1 background="$4" $2 $3',$body);
		jNews_ProcessMail::normalizeURL( $body );
		$body = preg_replace('#< *img([^>]*)(style="[^"]*)(float *: *)(right|left|top|bottom|middle)#Ui','<img$1 align="$4" hspace="5" $2$3$4',$body);

		//load template
		$template = jNews_Templates::loadOneTemplate( '*', $templateId );
		$template->csstyle = jNews_Templates::cleanCSSComments( $template->csstyle );

		if ( !empty($template->styles) || !empty( $template->csstyle ) ) {
			$csstyle = jNews_Templates::convertCSSInline( $template->styles, $template->csstyle );
		}

		$themeCSS = array();
		if ( !empty($template->styles) ) {
			foreach($template->styles as $cName => $sContent ) {
				if ( $cName != 'color_bg' ) {
				} elseif ( preg_match('#^tag_(.*)$#',$cName,$result) ) {
					$mainStyle['#< *'.$result[1].'((?:(?!style).)*)>#Ui'] = '<'.$result[1].' style="'.$sContent.'" $1>';
				} else {
					$themeCSS['class="'.$cName.'"'] = 'style="'.$sContent.'"';
				}
			}
		}

		if ( !empty($mainStyle) ) {
			$body = preg_replace( array_keys($mainStyle), $mainStyle, $body );
		}
		if ( !empty($themeCSS) ) {
			$body = str_replace( array_keys($themeCSS), $themeCSS, $body );
		}

		if ( !empty( $template->styles['color_bg'] ) ) {
	    	$pattern1 = '#^([^<]*<[^>]*background-color:)([^;">]{1,10})#i';
	    	$found = false;
	    	if(preg_match($pattern1,$body)){
	    		$body = preg_replace($pattern1,'$1'.$template->styles['color_bg'],$body);
	    		$found = true;
	    	}
	    	$pattern2 = '#^([^<]*<[^>]*bgcolor=")([^;">]{1,10})#i';
	    	if(preg_match($pattern2,$body)){
	    		$body = preg_replace($pattern2,'$1'.$template->styles['color_bg'],$body);
	    		$found = true;
	    	}

	    	if(!$found){
	    		$body = '<div style="background-color:'.$template->styles['color_bg'].';" width="100%">'.$body.'</div>';
	    	}
		}

		if ( $checkMe ) {
			if(version_compare(PHP_VERSION, '5.0.0', '>=') && class_exists('DOMDocument') && function_exists('mb_convert_encoding')){
				require_once( JNEWS_PATH_INCLUDES. 'emogrifier' .DIRECTORY_SEPARATOR. 'emogrifier.php' );
			}
			$checkMe = false;
		}

		if ( !empty($csstyle) && class_exists('Emogrifier') ) {
			$emogrifier = new Emogrifier( $body, $csstyle );
			$body = $emogrifier->emogrify();
			if( strpos($body,'<!DOCTYPE') !== false ) {
				$body = preg_replace('#<\!DOCTYPE.*<body([^>]*)>#Usi', '', $body );
				$body = preg_replace('#</body>.*$#si', '', $body);
			}
		}


	}

	public static function escapeVal($var){

        if (in_array('htmlspecialchars', array('htmlspecialchars', 'htmlentities'))) {
            return call_user_func('htmlspecialchars', $var, ENT_COMPAT, 'UTF-8');
        }

        return call_user_func('htmlspecialchars', $var);
    }

	/**
	 * public static function that will upload template
 	*/
 	public static function uploadTemplate() {

 		jimport( 'joomla.filesystem.archive' );

 		$name = $_FILES['tempupload']['name'];
		$tempPath = JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR.JNEWS_OPTION.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR;


		// check and set permission of the template folder
		if( !empty($name) ) {
			$mediacomjNewsdir = jNews_Templates::_checkpermission( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR.JNEWS_OPTION );
		        $mediacomjNewsTemplatesdir = jNews_Templates::_checkpermission( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates' );

			$mediacomjNewsTemplatesThumbnaildir = jNews_Templates::_checkpermission( JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates'.DIRECTORY_SEPARATOR. 'thumbnail' );

			if( !$mediacomjNewsdir OR !$mediacomjNewsTemplatesdir OR !$mediacomjNewsTemplatesThumbnaildir){
				echo jnews::printM('notice','The following directory is not writable: ' . JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media'.DIRECTORY_SEPARATOR.JNEWS_OPTION );
			
				return false;
			}

		}else{
			//failed
			echo jnews::printM('notice','Did not found a file to upload.' );
		    
			return false;
		}

		// upload template
		$status = true;
		$path = JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media' .DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates';
		$folderName = substr( $name, 0, -4 );  
		$result = jNews_Mailing::uploadFiles( $path, array('zip') );  
            
		$nameRealFolder =  jNews_Templates::openZip($tempPath . $name ); 
		jNews_Templates::$nameNewFolder = "";
            
		if($folderName !== $nameRealFolder )
		{
		    jNews_Templates::$nameNewFolder = $nameRealFolder;
		}
             
		if(jNews_Templates::$nameNewFolder === "")
		{
		    	if( !is_dir( $tempPath . $folderName ) ) $status = mkdir($tempPath.$folderName, 0755 );
		      
		}
		if ( !$status ) {
		        echo jnews::printM('notice','The following directory is not writable: ' . $tempPath );
		        return false;
		}

		         
          
		if( $status && !empty($result) ) {

			$resultArchive = JArchive::extract( $tempPath.$name, $path );
			
			if ( $resultArchive ) {
				// delete zip afterwards
				if( fopen( $tempPath . $name , 'w') ){
					@unlink( $tempPath . $name );
				}

				//we prompt a message that the upload was successful
				echo jnews::printM('green','Successfully uploaded the template'); 
				
				if(is_dir($tempPath.$folderName)) chmod($tempPath.$folderName, 0755);
				
				self::verifyFolder( $path );
				
				if(jNews_Templates::$nameNewFolder === "")
				{
				    return (file_exists($tempPath.$folderName.DIRECTORY_SEPARATOR.'index.html')) ? true : false; 
				}
				else
				{
				    return (file_exists($tempPath.$nameRealFolder.DIRECTORY_SEPARATOR.'index.html')) ? true : false; 
				}
		          
				
			} else {
				echo 'Joomla is unable to extract the file :' . $tempPath.$name;
			}

		}else{		
			return false;
		}

 	}

 	
 	public static function verifyFolder( $path ) {
 		
 		$path = rtrim( $path );
 		
 		$foldersA = JFolder::folders( $path );
 		if ( !empty($foldersA) ) {
 			foreach( $foldersA as $folder ) self::verifyFolder( $path .DIRECTORY_SEPARATOR. $folder );
 		}
 		
 		$filesA = JFolder::files( $path );
 		if ( !empty($filesA) ) {
 			$hasIndex = false;
 			foreach( $filesA as $file ) {
 				$extA = explode( '.', $file );
 				$ext = array_pop( $extA );
 				if ( !in_array( $ext, array( 'jpg', 'png', 'gif', 'html' ) ) ) {
 					JFile::delete( $path .DIRECTORY_SEPARATOR. $file );
 				}
 				if ( 'index.html' == $file ) $hasIndex = true;
 			}
 			if ( ! $hasIndex ) JFile::write( $path .DIRECTORY_SEPARATOR. 'index.html', '<html><body bgcolor="#FFFFFF"></body></html>' );
 		}
 		
 	}
 	
 	

/* public static function that will store template
	 * @param array $templateA
	*/
	public static function storeTemplate( $templateA ){
		$db = JFactory::getDBO();
		
		// check parameter
		// return false
		if( empty($templateA) ) return false;

		// get columns to be insert
		$tempColumnA = array();
		foreach( $templateA as $column=>$template ){
			$tempColumnA[] = '`'. $db->escape( $column ) .'`';
		} 
		$tempColumn = implode( ',', $tempColumnA );

		// get column values to be insert
		$tempColumnValueA = array();
		foreach( $templateA as $column=>$template ){
			$tempColumnValueA[] = '"'. $template .'"';
		} 
		$tempColumnValue = implode( ',', $tempColumnValueA );

		$query = "INSERT INTO `#__jnews_templates` (". $tempColumn .") VALUES (". $db->escape($tempColumnValue) .") ";
		$db->setQuery( $query );
		$result = $db->query();

		$result = ( !empty($result) ) ? true : false;
		return $result;
	}


	/**
	 * public static function that will remove all the file contents and the file folder from 'components/.../template/"FOLDERNAME"'
	*/
	public static function removeTemplateFile( $dirName ){
		// check parameter
		// return false if empty
		if( empty( $dirName ) ) return false;
		// removes/deletes the file from the ftp
		$dir = JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'media' .DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'templates' .DIRECTORY_SEPARATOR. $dirName;
		if( is_dir( $dir ) ){
			if( $dirOpen = opendir( $dir ) ){
				while( ( $dirFile = readdir( $dirOpen ) ) !== false ){
					if(is_dir($dir.DIRECTORY_SEPARATOR.$dirFile)){
						if($dirFile == 'images' OR $dirFile == 'css'){
							if($dirFileOpen = opendir($dir.DIRECTORY_SEPARATOR.$dirFile)){
								while(($nestedDirFile = readdir( $dirFileOpen ) ) !== false ){
									if( !empty($nestedDirFile) && ( $nestedDirFile != '.' ) && ( $nestedDirFile != '..' ) ) @unlink( $dir.DIRECTORY_SEPARATOR.$dirFile .DIRECTORY_SEPARATOR. $nestedDirFile);
								}//endwhile
								rmdir( $dir.DIRECTORY_SEPARATOR.$dirFile );
							}
						}
//						else{
//							if( !empty($dirFile) && ( $dirFile != '.' ) && ( $dirFile != '..' ) ) @unlink( $dir .DIRECTORY_SEPARATOR. $dirFile);
//						}
					}else{
						if( !empty($dirFile) && ( $dirFile != '.' ) && ( $dirFile != '..' ) ) @unlink( $dir .DIRECTORY_SEPARATOR. $dirFile);
					}
				} //endwhile
			}

			// after removing files from the directory specified
			// delete directory folder
			rmdir( $dir );
		}

		return true;
	}

	/**
	 * public static function to count the number of templates
	 */
	public static function countTemplates( $published = 0, $availability = -1) {
		static $count=null;

		if( isset($count) ) return $count;

		$db = JFactory::getDBO();
		$query = "SELECT count(`template_id`) FROM `#__jnews_templates`";

		if( $published == 1) $query .= ' WHERE `published` = 1';

		if($published == 1 && $availability == 1) $query .= ' AND ';
		elseif( $published == 0 && $availability == 1) $query .= ' WHERE ';

		if( $availability == 1) $query .= ' `availability` = 1';

		$db->setQuery( $query );
		$loadResultArray = $db->loadObjectList();
		$result = jnews::convertObjectList2Array( $loadResultArray );

		$count = ( !empty($result) ) ? $result[0] : 0;
		return $count;

	}

	/**
 	  *<p>public static function to clean the content of any comments,tabs, spaces and newlines<p>
 	  *@param string $css - the css file that will be clean with any comments
 	  *@return string
 	  */
	public static function cleanCSSComments( $css = '' ) {
		if ( empty($css) ) return $css;

		// remove comments
	    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
	    // remove tabs, spaces, newlines, etc.
	    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
	    return $css;
	}

	/**
	 * we check here the permission of a directory
	 * @param path - the directory that we need to check
	 * */
	public static function _checkpermission($path){
		$return = true;

		if(empty($path)) $return = false;

		//we check if the path exists
		if( is_dir( $path ) ){
			if(!is_writable( $path)) @chmod( $path, 0755); //we change the permission of the directory
			if(!is_writable( $path))  {
				echo jnews::printM('notice','The following directory is not writable: ' . $path );
				$return = false;
			}
		}else{//if the directory does not exist we create
			@mkdir( $path, 0755);
			$return = true;
		}

		return $return;
	}

	/**
	 *
	 * get templates for the picklist in the list for tempalate selection
	 */
	public static function getTemplatesForPicklist(){
		static $templates=null;

		if( isset($templates) ) return $templates;

		$db = JFactory::getDBO();

		$query = 'SELECT `template_id`, `name` FROM `#__jnews_templates` WHERE `published`=1 AND `availability`=1 ORDER BY `premium` DESC';
		$db->setQuery($query);
		$db->query();
		$templates = $db->loadObjectList();

		return $templates;
	}

        

        public static function openZip($archive) {
          
		$ata = null;
		$metadata = null;		

		if ( ! JFile::exists( $archive ) ) return false;
		
		$data = file_get_contents($archive);
           
		if ( ! $data = JFile::read($archive))
		{
			return false;
		}
		
		$metadata_arr = jNews_Templates::readZipInfo($data);
		if(isset($metadata_arr[0]) && is_array($metadata_arr[0]))
		{
		      $metadata = explode("/", $metadata_arr[0]['name']);  
		      return $metadata[0];		 
		}
		
		return false;

	}
	
	
        public static function readZipInfo(&$data)
	{
               $ctrlDirHeader = "\x50\x4b\x01\x02";
               $ctrlDirEnd = "\x50\x4b\x05\x06\x00\x00\x00\x00";
               $fileHeader = "\x50\x4b\x03\x04";
               $methods = array(0x0 => 'None', 0x1 => 'Shrunk', 0x2 => 'Super Fast', 0x3 => 'Fast', 0x4 => 'Normal', 0x5 => 'Maximum', 0x6 => 'Imploded',0x8 => 'Deflated');
		$entries = array();

		// Find the last central directory header entry
		$fhLast = strpos($data, $ctrlDirEnd);

		do
		{
			$last = $fhLast;
		}
		while (($fhLast = strpos($data, $ctrlDirEnd, $fhLast + 1)) !== false);

		// Find the central directory offset
		$offset = 0;

		if ($last)
		{
			$endOfCentralDirectory = unpack(
				'vNumberOfDisk/vNoOfDiskWithStartOfCentralDirectory/vNoOfCentralDirectoryEntriesOnDisk/' .
				'vTotalCentralDirectoryEntries/VSizeOfCentralDirectory/VCentralDirectoryOffset/vCommentLength',
				substr($data, $last + 4)
			);
			$offset = $endOfCentralDirectory['CentralDirectoryOffset'];
		}

		// Get details from central directory structure.
		$fhStart = strpos($data, $ctrlDirHeader, $offset);
		$dataLength = strlen($data);

		do
		{
			if ($dataLength < $fhStart + 31)
			{
				return false;
			}

			$info = unpack('vMethod/VTime/VCRC32/VCompressed/VUncompressed/vLength', substr($data, $fhStart + 10, 20));
			$name = substr($data, $fhStart + 46, $info['Length']);

			$entries[$name] = array(
				'attr' => null,
				'crc' => sprintf("%08s", dechex($info['CRC32'])),
				'csize' => $info['Compressed'],
				'date' => null,
				'_dataStart' => null,
				'name' => $name,
				'method' => $methods[$info['Method']],
				'_method' => $info['Method'],
				'size' => $info['Uncompressed'],
				'type' => null
			);

			$entries[$name]['date'] = mktime(
				(($info['Time'] >> 11) & 0x1f),
				(($info['Time'] >> 5) & 0x3f),
				(($info['Time'] << 1) & 0x3e),
				(($info['Time'] >> 21) & 0x07),
				(($info['Time'] >> 16) & 0x1f),
				((($info['Time'] >> 25) & 0x7f) + 1980)
			);

			if ($dataLength < $fhStart + 43)
			{
				return false;
			}

			$info = unpack('vInternal/VExternal/VOffset', substr($data, $fhStart + 36, 10));

			$entries[$name]['type'] = ($info['Internal'] & 0x01) ? 'text' : 'binary';
			$entries[$name]['attr'] = (($info['External'] & 0x10) ? 'D' : '-') . (($info['External'] & 0x20) ? 'A' : '-')
				. (($info['External'] & 0x03) ? 'S' : '-') . (($info['External'] & 0x02) ? 'H' : '-') . (($info['External'] & 0x01) ? 'R' : '-');
			$entries[$name]['offset'] = $info['Offset'];

			// Get details from local file header since we have the offset
			$lfhStart = strpos($data, $fileHeader, $entries[$name]['offset']);

			if ($dataLength < $lfhStart + 34)
			{
				if (class_exists('JError'))
				{
					return JError::raiseWarning(100, 'Invalid Zip Data');
				}
				else
				{
					throw new RuntimeException('Invalid Zip Data');
				}
			}

			$info = unpack('vMethod/VTime/VCRC32/VCompressed/VUncompressed/vLength/vExtraLength', substr($data, $lfhStart + 8, 25));
			$name = substr($data, $lfhStart + 30, $info['Length']);
			$entries[$name]['_dataStart'] = $lfhStart + 30 + $info['Length'] + $info['ExtraLength'];

			// Bump the max execution time because not using the built in php zip libs makes this process slow.
			@set_time_limit(ini_get('max_execution_time'));
		}
		while ((($fhStart = strpos($data, $ctrlDirHeader, $fhStart + 46)) !== false));

		return  $metadata = array_values($entries);

		
	}
}
