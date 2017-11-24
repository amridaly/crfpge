<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co
if ( !defined('DS') ) define( 'DS', DIRECTORY_SEPARATOR );

$mainframe = JFactory::getApplication();
if(!defined('JNEWS_JPATH_ROOT')) define ('JNEWS_JPATH_ROOT' , JPATH_ROOT );

$subscriberId = JRequest::getInt('subscriber');
$listId = JRequest::getInt('listid');
$lisType = JRequest::getInt('listype');
$mailingId = JRequest::getInt('mailingid');
$action = JRequest::getVar('act', '', '', 'WORD' );
$task = JRequest::getCmd('task', '', '', 'string' );
$message = JRequest::getString('message');
$artId = JRequest::getVar('artId');
$contentType = JRequest::getVar('content_type');
$blogId = JRequest::getVar('blogId');
$blogType = JRequest::getVar('blog_type');
$dealId = JRequest::getVar('dealId');
$dealType = JRequest::getVar('deal_type');
$tmplid = JRequest::getVar('templateid');
$flexiid = JRequest::getVar('flexicontent_catid');
$flexitype = JRequest::getVar('flexicontent_type');
$captchaWidth = JRequest::getInt('captchawidth');
$captchaHeight = JRequest::getInt('captchaheight');
$captchaBGColor = JRequest::getVar('captchabgcolor');
$captchaFTColor = JRequest::getVar('captchaftcolor');

$name = JRequest::getString('name');
$email = JRequest::getString('email');


$cle = JRequest::getVar('cle');
$redirectlink = str_replace('&amp;','&',trim( JRequest::getString('redirectlink') ));

require_once( JNEWS_JPATH_ROOT .DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_jnews'.DIRECTORY_SEPARATOR.'defines.php');

require_once( JNEWSPATH_FRONT . 'jnews.html.php' );

require_once( JNEWSPATH_CLASS . 'class.jnews.php');
require_once( JNEWSPATH_CLASS . 'frontend.php' );
require_once( JNEWSPATH_ADMIN . 'admin.jnews.html.php' );
require_once( JNEWSPATH_ADMIN . 'views'.DIRECTORY_SEPARATOR.'subscribers.jnews.html.php' );
require_once( JNEWSPATH_ADMIN . 'views'.DIRECTORY_SEPARATOR.'lists.jnews.html.php' );
require_once( JNEWSPATH_ADMIN . 'views'.DIRECTORY_SEPARATOR.'mailings.jnews.html.php' );
require_once( JNEWSPATH_ADMIN . 'views'.DIRECTORY_SEPARATOR.'templates.jnews.html.php' );
require_once( JNEWSPATH_ADMIN . 'views'.DIRECTORY_SEPARATOR.'tags.jnews.html.php' );

if( JNEWS_DEBUG ) {
	ini_set('display_errors',true);
	error_reporting(E_ALL);
}

$my	= JFactory::getUser();
$subscriber = new stdClass;
$userId = $my->id;
$validated = false;

//we get the subscriber Info
$qid[0] = $subscriberId;
if ( $subscriberId > 0 ){
    $subscriber = jNews_Subscribers::getSubscribersFromId($qid, false);
}

if ( $subscriberId>0 && !empty($cle) && $userId<1) {
	if (md5($subscriber->email)==$cle){
		$userId = $subscriberId;
		$validated = true;
	} else {
		 echo jnews::printM('red' , _NOT_AUTH);
		 $subscriberId = 0;
	}
 }

$document= JFactory::getDocument();

$d['subscriberId'] = $subscriberId;
$d['cle'] = $cle;
 if ( $userId>0 && empty($cle)){
 	$validated = true;
 	$subscriberId = jNews_Subscribers::getSubscriberIdFromUserId($userId);
 }
$showPanel = false;
echo '<!--  Beginning : '.jnews::version().'   -->'."\n\r";

//added this line so that if the action show is used the subscribe action will be executed
if ($userId <= 0){
	if($action=='show') $action='subscribe';
}


jimport('joomla.application.module.helper');
$module = JModuleHelper::getModule('jnews');
$moduleParams = new JRegistry();
if( ! method_exists($moduleParams,'loadString'))
{
    $data = trim($module->params);
    $options = array('processSections' => false);
    if ((substr($data, 0, 1) != '{') && (substr($data, -1, 1) != '}'))
    {
	    $ini = JRegistryFormat::getInstance('INI');
	    $obj = $ini->stringToObject($data, $options);
    }
    else
    {
	    $obj = json_decode($data);
    }
    $moduleParams->loadObject($obj);
} else {
	    
	if ( empty($module->params) ){
	    if ( ! is_object($module)) {
	        $module = new stdClass();
	    }
		$module->params = '{"enable_captcha":"1","captcha_width":"110","captcha_height":"40"}';
	} 
    if ( !empty($module->params) ) $moduleParams->loadString( $module->params );
}

$param = 2;

switch ($action)
{

	case ('subscribers'):
		frontend::showSubscribersFE($listId, $action, $task, true);
		break;

	case ('confirm'):
		$message = jnews::printYN( frontend::confirmRegistration($d) ,  _JNEWS_ACCOUNT_CONFIRMED , _JNEWS_VERIFY_INFO );
		$showPanel = true;

		$db = JFactory::getDBO();

		$query = 'UPDATE IGNORE `#__jnews_subscribers` as S LEFT JOIN `#__users` AS U ON U.`email` = S.`email` SET S.`user_id` = U.`id` WHERE U.`id` > 0 AND S.`id`=' . (int)$subscriberId;
		$db->setQuery($query);
		$db->query();

		if(!empty($GLOBALS[JNEWS.'redirectconfirm'])){
			jNews_Tools::redirect($GLOBALS[JNEWS.'redirectconfirm'], $message);
		}
		break;

	case ('sublist'):
		frontEnd::showSubscriberLists($subscriberId, 'subscribeAll');
		break;

	case ('mailing'):
		frontEnd::mailingOptions( $action, $task, $listId, $mailingId, $subscriberId, $lisType, $artId, $contentType, $blogId, $blogType, $dealId, $dealType, $tmplid, $flexiid, $flexitype, $captchaWidth, $captchaHeight, $captchaBGColor, $captchaFTColor);
		break;

	case ('show'):
		if(!$validated) $subscriberId=0;
		frontEnd::subscriptions($subscriber, $subscriberId, 0, 'save');
		break;

	case ('subone'):
		if(!$validated) $subscriberId=0;
		frontEnd::subscriptions($subscriber, $subscriberId, $listId, 'subscribe');
		if(!empty($GLOBALS[JNEWS.'subs_redirect_url'])){
			jNews_Tools::redirect($GLOBALS[JNEWS.'subs_redirect_url'], $message);
		}
		break;

	case ('change'):
		frontEnd::changeSubscriptions($subscriber, $subscriberId, $cle,'save');
		break;

	case ('unsubscribe'):
		frontEnd::unsubscribe($subscriber,$subscriberId, $cle, $mailingId, 'remove');
		$showPanel = false;
		break;

	case ('unsubscribeall'):
		$message = jnews::printYN(frontEnd::unsubscribeall($subscriber, $subscriberId, $cle), _JNEWS_UNSUBSCRIBE_ALL_MESS, _NOT_AUTH);
		$showPanel = true;
		break;

	case ('remove'):
		JSession::checkToken() or die( 'Invalid Token' );
		$message = jnews::printYN( frontEnd::remove($subscriber, $subscriberId, $cle, $listId) ,  _JNEWS_UNSUBSCRIBE_MESS , _NOT_AUTH );
		$showPanel = true;
		break;

	case ('save'):
				$subIdd = 0;
                if ($userId !== 0) {
                    $subIdd = (int)jNews_Subscribers::getSubscriberIdFromUserId($userId); 
                }


              //redirect if user = 2 and this user tries to change not his own list
                if ($subIdd !== 0 && $subIdd !== (int)jnews::getVar('subscriber_id')) {
                    jnews::printYN( false,  '' , _JNEWS_ERROR );
                    break;
                }
                else if ($subIdd !== 0 && $subIdd === (int)jnews::getVar('subscriber_id')) {
                    //donot need to check captcha
                }
                else {
                    $security_captcha_enter = jnews::getVar('security_code');
		
				    if( !empty($_SESSION['captcha']) && $_SESSION['captcha'] != strtolower($security_captcha_enter) )
				    {   
		                                ob_end_clean();
		                                echo "<script>alert('".addslashes(_JNEWS_CAPTCHA_MSG)."'); window.history.go(-1);</script>\n";
		                                break;
				    }

                }
		JSession::checkToken() or die( 'Invalid Token' );
		$message = jnews::printYN( jNews_Subscribers::updateCBFESubscriber() ,  _JNEWS_UPDATED_SUCCESSFULLY , _JNEWS_ERROR );
		$showPanel = true;
		break;

	case ('log'):
		jNews_ProcessMail::logStatistics( $mailingId );
		break;

	case ('rendermod'):
		require_once( JNEWSPATH_CLASS . 'rendermod.php' );
		$rendMod = new jnews_renderMod();
		$rendMod->renderModule();
		break;

	case ('updatesubscription'):
		$message = frontEnd::updateFrontSubscription($subscriberId);
		if (!empty($redirectlink)) {
			jNews_Tools::redirect($redirectlink, $message);
		} else {
			$showPanel = true;
		}
		break;

	case ('module'):
		$modID = JRequest::getInt('modid');
		if(empty($modID)) return;
		$db = JFactory::getDBO();
	 	$db->setQuery('SELECT * FROM #__modules WHERE id=' . (int)$modID.' AND `module` = \'mod_jnews\' LIMIT 1');
	 	$moduleO = $db->loadObject();
	 	if ( empty($moduleO) ) {
	 		echo 'The module was not found';
	 		return;
	 	}
		$moduleO->user = substr( $moduleO->module, 0, 4 ) == 'mod_' ?  0 : 1;
		$moduleO->name = $moduleO->user ? $moduleO->title : substr( $moduleO->module, 4 );
		$moduleO->style = null;
		$moduleO->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $moduleO->module);
		$moduleO->effect = 'normal';

		$params = array();
		echo JModuleHelper::renderModule( $moduleO, $params );
		break;

	case ('deleteattach'):

		$path = JNEWS_JPATH_ROOT_NO_ADMIN . $GLOBALS[JNEWS.'upload_url'];
		$arr = array(null);
		// Get the files and folders
		jimport('joomla.filesystem.folder');
		$files2		= JFolder::files($path, '.', true, true);
		$folders	= JFolder::folders($path, '.', true, true);
		// Merge files and folders into one array
		$files = array_merge($files2, $folders);
		// Sort them all
		asort($files);

		// check deleted attachments
		$rem = jnews::getVar('rem' );

		if( !empty($rem) ){
			// get the lenght of the previous url
			$reml = jnews::getVar('reml' );
			jNews_Attachment::deleteAttachment($rem);
			jNews_Attachment::deleteAttachmentQuery($rem);
		}
		break;

	case ('noredsubscribe'):

		JSession::checkToken() or die( 'Invalid Token' );

		$userid = JRequest::getInt('userid');
		$sublists = jnews::getVar('modsubscribed_lists');
		if($moduleParams->get('enable_captcha'))
		{
		    $security_captcha_enter = jnews::getVar('security_code');

		    if( !empty($_SESSION['captcha']) && $_SESSION['captcha'] != strtolower($security_captcha_enter) )
		    {
				ob_end_clean();
				echo "";
				die;
		    }

		}


		$modsub = new stdClass;
		$modsub->email = jnews::getVar('modemail' );
		$modsub->name = jnews::getVar('modname', '', '', 'STRING' );
		$modsub->passwordA = jnews::getVar('modpasswordA');
		if ( empty($modsub->email) ) $modsub->email = jnews::getVar('email');
		if ( empty($modsub->name) ) $modsub->name = jnews::getVar('name');
		if ( empty($modsub->passwordA) ) $modsub->passwordA = jnews::getVar('passwordA');

		if ( !jNews_Subscribers::validEmail($modsub->email) ) {
			echo '<br />'.jnews::printM('red' , _JNEWS_EMAIL_INVALID );
			echo "<script>alert('".addslashes(_JNEWS_EMAIL_INVALID)."'); window.history.go(-1);</script>\n";
			break;
		}
		$modsub->name = str_replace( array( '"', "=", 'INSERT ' ), '_', $modsub->name );

		//we need to check the pwd
		if ( crypt( $GLOBALS[JNEWS.'url_pass'], $GLOBALS[JNEWS.'url_pass'] ) != $modsub->passwordA ) die( 'Invalid password' );

		$modsub->subscribedlists = $sublists;
		$modsub->column1 = jnews::getVar('modcolumn1','');
		$modsub->column2 = jnews::getVar('modcolumn2','');
		$modsub->column3 = jnews::getVar('modcolumn3','');
		$modsub->column4 = jnews::getVar('modcolumn4','');
		$modsub->column5 = jnews::getVar('modcolumn5','');
		$receivedHTML = jnews::getVar('modreceivehtml', 0 );
		$modsub->receive_html = ( ( isset($receivedHTML) &&
		 ( ( is_bool($receivedHTML) && $receivedHTML )
		  || ( is_string($receivedHTML) && ( $receivedHTML == 'true' || $receivedHTML == '1' ) )
		  || ( is_int($receivedHTML) && $receivedHTML )
		  ) )  ? 1 : 0 );

		$modsub->effect = jnews::getVar('modeffect','');
		$modsub->module_message = jnews::getVar('module_message','');
		$modsub->red_subscription = jnews::getVar('red_subscription','');
		if ( $userid>0 ) {
			$database = JFactory::getDBO();

			$query = 'SELECT * FROM `#__users` WHERE `id`=\'' . (int)$userid . '\'';
	     	$database->setQuery($query);
						$user = $database->loadObject();

			if (!empty($user) ) {
				$modsub->name = $user->name;
				$modsub->email = $user->email;
			} else {
				break;
			}
		}

		if( $userid>0 ) {
			$message_arr = frontEnd::newSubscriber($modsub->name, $modsub->email,true, $modsub );
                        $message = $message_arr['message'];
                        $newSubscriberContinue = $message_arr['newsubscriber'];
                        echo $message;
		}else{
			$message_arr = frontEnd::newSubscriber($modsub->name, $modsub->email,false, $modsub );
			$message = $message_arr['message'];
                        $newSubscriberContinue = $message_arr['newsubscriber'];
                        echo $message;
		}
               $_SESSION['newSubscriberContinue'] = $newSubscriberContinue;


		exit;
		break;
        case ('continuesubscrib'):

            	$secret_code = jnews::getVar('secret');
                if($secret_code == '741852')
                {
                    frontEnd::newSubscriberContinue($_SESSION['newSubscriberContinue']);
                    unset($_SESSION['newSubscriberContinue']);
                }
                exit;
                break;


	case ('subscribe'):
		JSession::checkToken() or die( 'Invalid Token' );
		$dontCheckPassword = true;

	case ('urlsubscribe'):

		if ( empty($dontCheckPassword) ) {
			$URLPWD = jnews::getVar('passwordA');
			//cehck URL password
			if ( $GLOBALS[JNEWS.'url_pass'] != $URLPWD ) die( 'Invalid password' );
		}

		$userid = intval( JRequest::getInt('userid', 0) );
		if ( $userid>0 ) {
			$database = JFactory::getDBO();

			$query = 'SELECT * FROM `#__users` WHERE `id`=\'' . (int)$userid . '\'';
	     	$database->setQuery($query);
			$user = $database->loadObject();

			if (!empty($user) ) {
				$name = $user->name;
				$email = $user->email;
			} else {
				break;
			}

		} elseif ( !jNews_Subscribers::validEmail($email) ) {
			echo '<br />'.jnews::printM('red' , _JNEWS_EMAIL_INVALID );
			echo "<script>alert('".addslashes(_JNEWS_EMAIL_INVALID)."'); window.history.go(-1);</script>\n";
			break;
		}

		if($userid>0){
			$message_arr = frontEnd::newSubscriber( $name, $email, true );
            $message = $message_arr['message'];
            frontEnd::newSubscriberContinue($message_arr['newsubscriber']);
		}else{
			$security_captcha_enter = jnews::getVar('security_code');

			if ( isset($security_captcha_enter) && isset($_SESSION['captcha']) ) {
				if( !empty($_SESSION['captcha']) && $_SESSION['captcha'] != strtolower($security_captcha_enter) ) {
					ob_end_clean();
					echo '<br />'.jnews::printM('red' , _JNEWS_CAPTCHA_MSG);
					echo "<script>alert('".addslashes(_JNEWS_CAPTCHA_MSG)."'); window.history.go(-1);</script>\n";
					break;
				}
			}

			$name = str_replace( array( '"', "=", 'INSERT ' ), '_', $name );
			$message_arr = frontEnd::newSubscriber( $name, $email );
            $message = $message_arr['message'];
            frontEnd::newSubscriberContinue($message_arr['newsubscriber']);

		}

		if($GLOBALS[JNEWS.'addEmailRedLink'] ){
			if(strpos($redirectlink,'?')){
				$redirectlink .= '&email='.$email;
			}else{
				$redirectlink .= '?email='.$email;
			}//endelse
		}

		$showMessage = jnews::getVar('listname', 0);

		if (!empty($redirectlink)) {
			if (!$showMessage)  $message = '';
			jNews_Tools::redirect( $redirectlink, $message );
		} else {
			$showPanel = true;
		}
		break;

	case ('list'):
		if(empty($listId)) $listId = jnews::getVar('list_id' );
		frontEnd::showLists($subscriberId, $listId, $lisType, $action, $task);
		break;

	case ('statistics'):
		if(empty($listType)) $listType =1;
		frontend::statisticsFE($action, $task, $listId, $listType, $mailingId, $message,$Itemid);
		break;

	case ('token'):
		jNews_Auto::receiveToken();
		break;

	case ('fwdtofriend'):
		frontEnd::fwdtofriend($action, $task);
		break;

	case ('templates'):
		frontEnd::assignTemplate();
		$showPanel = false;
		break;

	case ('tags'):
		frontEnd::assignTag($action, $task);
		$showPanel = false;
		break;
	case ('captcha'):

		$file_for_incluse = "captcha";

		include_once $file_for_incluse .DIRECTORY_SEPARATOR. 'captchasecurityimages.php';
		exit;
		break;

	case ('flexicontentsubscribe'):
		//get jnews session
		$mySess = JFactory::getSession();
		$countriesChecked = $mySess->get('flexi_countries','','JNEWLSETTER');
		$industriesChecked = $mySess->get('flexi_industries','','JNEWLSETTER');
		$listid = $mySess->get('modjnewsflexi_listid','','JNEWLSETTER');

		//we save the selected countries and industries to an object
		$paramObject = new stdClass;
		$paramObject->country = $countriesChecked;
		$paramObject->industry = $industriesChecked;

		//serialize the params
		$params = base64_encode( serialize($paramObject) );

		//we get the current user
		$user = JFactory::getUser();

		//get subscriber info by passing the user id
		$userInfo=jNews_Subscribers::getSubscriberInfoFromUserId($user->id);

		if(!empty($listid)){

			if(!isset($userInfo->id) || empty($userInfo->id)){
				$subscriber = new stdClass;
				$subscriberId = 0;
				$subscriber->user_id = $user->id;
				$subscriber->name = $user->name;
				$subscriber->email = $user->email;
				$subscriber->ip = jNews_Subscribers::getIP();
				$subscriber->receive_html = 1;
				$subscriber->confirmed = 1;
				$subscriber->subscribe_date = time();
				$subscriber->language_iso = 'eng';
				$subscriber->timezone = '00:00:00';
				$subscriber->blacklist = 0;
				$subscriber->params = '';
				$subscriber->admin_id = 62;
		$subscriber->id = 0;

				//notice columns
				if($GLOBALS[JNEWS.'level'] > 2){//check if the version of jnews is pro
					$subscriber->column1='';
					$subscriber->column2='';
					$subscriber->column3='';
					$subscriber->column4='';
					$subscriber->column5='';
				}//end if check if the version is pro

				//jNews_Subscribers::insertSubscriber($subscriber, $subscriberId);
				jNews_Subscribers::saveSubscriber($subscriber, $subscriberId,true,$listid);

				//get subscriber info by passing the user id
				$userInfo=jNews_Subscribers::getSubscriberInfoFromUserId($user->id);

			}else{

			}//end if

			//save the subscriber id and list to listssubscribers table
			$subscriber->id=$userInfo->id;
			$subscriber->list_id=$listid;
			$subscriber->flexicontentFlag = true;//a flag that the subscription is from a tenders subscription from the flexicontent module
			$subscriber->params=$params;
			jNews_ListsSubs::saveToListSubscribers($subscriber);
		}


		//clear jnews session
		$mySess->clear('flexi_countries','JNEWLSETTER');
		$mySess->clear('flexi_industries','JNEWLSETTER');
		$mySess->clear('modjnewsflexi_listid','JNEWLSETTER');

		echo '<div id=mod_message><span style="color:green;">You have been successfully subscribed to smartflexi articles.</span></div>';
		//echo jnews::printM('green','Successfully subscribed to smartflexi articles.');

//		break;

	default:
		if (class_exists('jNews_Auto')) {

			$showPanel = false;

			switch ($action) {

				case ('cron'):
					//we save here the time the cron has been launched
					$config['lasttime_cron_triggerred'] = time();
					$jNewsConfig = new jNews_Config;
					$jNewsConfig->saveConfig( $config );

					if( !empty($GLOBALS[JNEWS.'j_cron']) || $GLOBALS[JNEWS.'j_cron'] != '0' ){ //No Cron

						$password = jnews::getVar('password', '', '', 'string' );
						if(!empty($password)){
							$decodepass = base64_decode($password);

							if( $decodepass == $GLOBALS[JNEWS.'cron_pass'] ){
                                                     		echo "<br/>jNews Cron launched";
								$status = jNews_Auto::execute( false );
								if ( $status ) echo "<br/>Successfully processed queue!";
							}else{
								return false;
							}

						}else{
							echo "<br/>jNews Cron launched";
							$status = jNews_Auto::execute( false );
							if ( $status ) echo "<br/>Successfully processed queue!";
						}

						//check if we have caching in Joomla
						$conf	= JFactory::getConfig();
						$cacheTime = $conf->get('cachetime');

						if ( !empty($cacheTime) && $cacheTime > $GLOBALS[JNEWS.'cron_max_freq'] * 0.8 ) {

							$db = JFactory::getDBO();
							if(version_compare(JVERSION,'1.6.0','<')){
								$db->setQuery("SELECT `published` FROM `#__plugins` WHERE `element`='cache'  AND `folder`='system' ");
							}else{
								$db->setQuery("SELECT `enabled` FROM `#__extensions` WHERE `type` = 'plugin' AND `element`='cache' ");
							}
							$published = $db->loadResult();

							if ( $published ) {
								jNews::printM( 'warning' , 'ONLY IF YOU USE YOUR OWN SERVER CRON TASK!'  );
								jNews::printM( 'warning' , 'You NEED to reduce the cache time on your website in order for the cron task to work properly!'  );
								jNews::printM( 'warning' , 'You need to put the cache time less than :' . ($GLOBALS[JNEWS.'cron_max_freq'] * 0.8) . ' minutes' );
								jNews::printM( 'warning' , 'Or increase your jNews scheduler to :' . ($cacheTime * 1.2)  . ' minutes' );
							}
						}

					}else{
						jnews::printM( 'error', _JNEWS_NOCRON_USED );
					}

					break;
				default :
					$showPanel = true;
					break;

			}

		} else {

			$showPanel = true;

		}
		break;
 }
echo $message;

if ($showPanel) frontEnd::introduction( $subscriberId, $listId, $lisType );
frontHTML::_footer();
echo "\n\r".'<!--  End : '.jnews::version().'   -->'."\n\r";
