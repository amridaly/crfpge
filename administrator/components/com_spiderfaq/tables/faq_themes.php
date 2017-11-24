<?php
 /**
 * @package Spider FAQ Lite
 * @author Web-Dorado
 * @copyright (C) 2012 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
 
defined('_JEXEC') or die('Restricted access');

class TableFaq_themes extends JTable
{
    var $id 		= null;	  
	var $title = null;
	var $background   = 2;
	var $bgcolor     = null;
	var $bgimage     = null;
	var $width    = null;	
	var $ctbg      = 0;
	var $ctbggrad      = 0;
	var $ctbgcolor     = null;
	var $ctgradtype     = null;
	var $ctgradcolor1     = null;
	var $ctgradcolor2     = null;
	var $cttxtcolor      = null;
	var $ctfontsize      = null;
	var $ctmargin     = null;	
	var $ctpadding     = null;		
	var $ctbstyle      = null;	
	var $ctbwidth      = null;
	var $ctbcolor      = null;	
	var $ctbradius      =  null;
	var $cdbg      = 0;
	var $cdbggrad      = 0;
	var $cdbgcolor     = null;
	var $cdgradtype     = null;
	var $cdgradcolor1     = null;
	var $cdgradcolor2     = null;
	var $cdtxtcolor      = null;
	var $cdfontsize      = null;
	var $cdmargin      = null;
	var $cdpadding      = null;
	var $cdbstyle      = null;	
	var $cdbwidth      =  null;
	var $cdbcolor      = null;	
	var $cdbradius      =  null;	
	var $paddingbq		= null;
	var $marginleft  = null;	
	var $theight		= null;
	var $twidth		= null;
	var $tfontsize  = null;
	var $ttxtwidth  =  null;
	var $ttxtpleft  =  null;
    var $tcolor          = null;
	var $titlebg          = null;
	var $tbgcolor         = null;
	var $tbgimage     = null;
	var $titlebggrad     = null;
	var $gradtype     = null;		
	var $gradcolor1     = null;		
	var $gradcolor2     = null;	
	var $tbghovercolor     = null;		
	var $tbgsize      = null;    
	var $tbstyle     = null;		
	var $tbwidth      = null;
    var $tbcolor      = null;	
	var $tbradius      = null;	
	var $tchangeimage1     = null;
	var $marginlimage1     = null;
	var $tchangeimage2     = null;
	var $marginlimage2     = null;
	var $awidth          = null;    
	var $amargin 		= null;	
	var $afontsize     = null;	
	var $abg          = null;
	var $abgcolor         = null;
	var $abgimage     = null;
	var $abgsize     = null;
	var $abstyle     = null;		
	var $abwidth      = null;
    var $abcolor      = null;	
	var $abradius      = null;
	var $aimage     = null;
	var $aimage2     = null;
	var $aimagewidth  = null;
	var $aimageheight  = null;
	var $amarginimage  = null;	
	var $aimagewidth2  = null;
	var $aimageheight2  = null;
	var $amarginimage2  = null;	
    var $atxtcolor   = null;	
	var $expcolcolor  =  null;
	var $expcolfontsize  = null;
	var $expcolmargin  = null;
	var $expcolhovercolor  =  null;	
	var $sformmargin  = null;
	var $sboxwidth     = null;
	var $sboxheight     = null;
	var $sboxbg     = 0;
    var $sboxbgcolor      = null; 
	var $sboxbstyle      = null;
	var $sboxbwidth      = null;
	var $sboxbcolor      = null;
	var $sboxfontsize     = null;
	var $sboxtcolor      = null;
	var $srwidth     = null;
	var $srheight     = null;
	var $srbg                = 0;
	var $srbgcolor     = null;
	var $srbstyle     = null;
	var $srbwidth     = null;
	var $srbcolor     = null;	
	var $srfontsize     = null;
	var $srfontweight     = null;
	var $srtcolor     = null;
	var $rmcolor     = null;
	var $rmhovercolor     = null;
	var $rmfontsize     = null;
	
	/**
	* @param database A database 
        connector object */
	function __construct(&$db)
	{
		parent::__construct( '#__spiderfaq_theme', 'id', $db );
	}	
	
}

?>