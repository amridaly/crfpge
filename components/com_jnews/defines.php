<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

$mainframe = JFactory::getApplication();

define ('JNEWS_JPATH_ROOT_NO_ADMIN' , JPATH_ROOT );
define( 'JNEWS_DEBUG', $mainframe->getCfg('debug') );

define( 'JNEWS_SITE_URL', JURI::root() );
define( 'JNEWS_JPATH_LIVE', rtrim( JURI::root(), "/" ));

define( 'JNEWS_SITE_NAME', $mainframe->getCfg('sitename') );
define( 'JNEWS_TIME_OFFSET', $mainframe->getCfg('offset') );

$lang= JFactory::getLanguage();
define( 'JNEWS_CONFIG_LANG', $lang->getTag() );

//define( 'JNEWS_JPATH_LIVE_NO_HTTPS', str_replace('https:','http:',JNEWS_JPATH_LIVE) );
define( 'JNEWS_JPATH_LIVE_NO_HTTPS', JNEWS_JPATH_LIVE );
define( 'JNEWS_OPTION', 'com_jnews' );

define('JNEWS', 'jnews_');
if ( !defined('DS') ) define( 'DS', DIRECTORY_SEPARATOR );
define( 'JNEWSPATH_ADMIN' , JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'administrator' .DIRECTORY_SEPARATOR. 'components' .DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_SITE', JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'administrator' .DIRECTORY_SEPARATOR. 'components' .DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_FRONT' , JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'components' .DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_CLASS', JNEWSPATH_ADMIN  . 'classes' .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_SITE_VIEW', JNEWSPATH_SITE  . 'views' .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_FRONT_VIEW', JNEWSPATH_FRONT  . 'views' .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_FRONT_CLASS', JNEWSPATH_FRONT  . 'classes' .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_ADMIN_VIEW', JNEWSPATH_ADMIN  . 'views' .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_ADMIN_CONTROLLER', JNEWSPATH_ADMIN  . 'controllers' .DIRECTORY_SEPARATOR);
define( 'JNEWSPATH_CLASS_SITE', JNEWSPATH_SITE  . 'classes' .DIRECTORY_SEPARATOR);

define( 'JNEWS_PATH_LANG', JNEWS_JPATH_ROOT_NO_ADMIN .DIRECTORY_SEPARATOR. 'administrator' .DIRECTORY_SEPARATOR. 'components'.DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR. 'language' .DIRECTORY_SEPARATOR);
define('JNEWSPATH_FRONT_TEMPLATES', JNEWSPATH_FRONT  . 'templates' .DIRECTORY_SEPARATOR);
define('JNEWSPATH_MEDIA', JNEWS_JPATH_ROOT_NO_ADMIN.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.JNEWS_OPTION);
define('JNEWSPATH_TEMPLATES', JNEWS_JPATH_ROOT_NO_ADMIN.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.JNEWS_OPTION.DIRECTORY_SEPARATOR.'templates' .DIRECTORY_SEPARATOR);

if (!defined('_MOS_NOTRIM')) define( '_MOS_NOTRIM', 0x0001 );
if (!defined('_MOS_ALLOWHTML')) define( '_MOS_ALLOWHTML', 0x0002 );
if (!defined('_MOS_ALLOWRAW')) define( '_MOS_ALLOWRAW', 0x0004 );
if(!defined('_BUTTON_LOGIN') and defined('BUTTON_LOGIN')) define('_BUTTON_LOGIN',BUTTON_LOGIN);

//urls
define('JNEWS_PATH_FRONT', JURI::root().'components' .DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR);
define( 'JNEWS_URL_ADMIN', JNEWS_JPATH_LIVE.'/administrator/components/'.JNEWS_OPTION.'/' );

if ($mainframe->isAdmin()){
	define( 'JNEWS_PATH_ADMIN', JURI::base().'components' .DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR);
	define( 'JNEWS_PATH_ADMIN_IMAGES2', JURI::base().'components/'.JNEWS_OPTION.'/images/' );
}else{
	define( 'JNEWS_PATH_ADMIN', JURI::base().'administrator'.DIRECTORY_SEPARATOR.'components' .DIRECTORY_SEPARATOR. JNEWS_OPTION .DIRECTORY_SEPARATOR);
	define( 'JNEWS_PATH_ADMIN_IMAGES2', JURI::base().'administrator/components/'.JNEWS_OPTION.'/images/');
}

//define( 'JNEWS_PATH_ADMIN_IMAGES', JNEWS_PATH_ADMIN.'images'.DIRECTORY_SEPARATOR);

//includes file path
define( 'JNEWS_PATH_INCLUDES', JNEWSPATH_FRONT.'includes'.DIRECTORY_SEPARATOR);

//includes url
define( 'JNEWS_URL_INCLUDES', JNEWS_JPATH_LIVE . '/components/'.JNEWS_OPTION.'/includes/' );
define( 'JNEWSCOMP_AIMG', JNEWS_JPATH_LIVE . '/administrator/components/' . JNEWS_OPTION .'/images/' );


define( 'JNEWS_PATH_ADMIN_THUMBNAIL_SHOW', JURI::root().'media/'.JNEWS_OPTION.'/templates/thumbnail/');
define( 'JNEWS_PATH_ADMIN_THUMBNAIL_UPLOAD', JNEWSPATH_TEMPLATES. 'thumbnail' );

define( 'JNEWS_HOME_SITE', 'https://joobi.co');//we wil be using this constant to be able to easily change the site from joobi.co to acajoom.com
