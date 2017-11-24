<?php
 
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/


defined( '_JEXEC' ) or die( 'Restricted access' );

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_spiderfaq/tables');

require_once( JPATH_COMPONENT.'/controller.php' );

if($controller = JRequest::getVar( 'controller' )) {
    require_once( JPATH_COMPONENT.'/controllers/'.$controller.'.php' );
}

$classname    = 'spiderfaqController'.$controller;
$controller   = new $classname( );

$controller->execute( JRequest::getVar( 'task' ) );

$controller->redirect();

?>