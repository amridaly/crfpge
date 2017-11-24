<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

class JButtonWizard extends JButton {

	var $_name = 'Wizard';

	function fetchButton( $type='Wizard', $namekey='', $id='wizard' ) {

		if( version_compare( JVERSION,'3.0.0','<' ) ) {
			JHTML::_('behavior.mootools');
		} else {
			JHtmlBehavior::framework();
		}

		$defaultPage = 'jnewsdoc_glossary';
		if ( empty($namekey) ) $namekey = $defaultPage;
		else $namekey = 'jnewsdoc_' . $namekey;
		$langID = substr( JNEWS_CONFIG_LANG, 0, 2 );

		$link = 'https://joobi.co/index.php?option=com_jlinks&controller=redirect&link=' . $namekey . '&alt='.$defaultPage.'&lang='.$langID;//.'&Itemid=312';

		$iFrame = "'<iframe src=\'$link\' width=\'100%\' height=\'100%\' scrolling=\'auto\'></iframe>'";
		$js = "var wizardOn = true; function showWizard(){
		var box=$('jNewsWizard');
		if(wizardOn){box.innerHTML = ".$iFrame.";box.style.display = 'block';box.style.height = '0';}";

		$js .= "try{
                   var fx = box.effects({duration: 2500, transition:
					Fx.Transitions.Quart.easeOut});
					if(wizardOn){
						fx.start({'height': 500});
					}else{
						fx.start({'height': 0}).chain(function() {
							box.innerHTML='';
							box.setStyle('display','none');
						});
					}
				}catch(err){
					box.style.height = '500px';
					var myVerticalSlide = new Fx.Slide('jNewsWizard');
 					if(wizardOn){
						myVerticalSlide.slideIn();
					}else{
						myVerticalSlide.slideOut().chain(function() {
						box.innerHTML='';
						box.setStyle('display','none');
					});
				}
			} wizardOn = !wizardOn;}";

		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration( $js );

		if( version_compare( JVERSION,'3.0.0','<' ) ) {
			return '<a href="'.$link.'" target="_blank" onclick="showWizard();return false;" class="toolbar"><span class="icon-32-wizard" title="'. _JNEWS_WIZARD .'"></span>'. _JNEWS_WIZARD .'</a>';
		} else {
			return '<a class="btn btn-small" href="'.$link.'" target="_blank" onclick="showWizard();return false;" class="toolbar"><span style="float:left;" class="icon-16-wizard" title="'. _JNEWS_WIZARD .'"></span><span style="float:left; margin-left:8px;">'. _JNEWS_WIZARD .'</span></a>';
		}


	}

	function fetchId( $type='Wizard', $html = '', $id = 'wizard' ) {
		return $this->_name.'-'.$id;
	}

}


class JToolbarButtonWizard extends JButtonWizard {


}
