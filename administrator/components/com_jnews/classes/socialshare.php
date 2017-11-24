<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

/**
 * class to replaced share tags to social share and links
 */
class jNews_SocialShare {
	/**
	 * 
	 *
	 * @param unknown_type $tags
	 * @param unknown_type $html - true for html and false for text
	 */
	static function mediaShare($tags, $html = true, $mailingId = 0, $full_screen=false){
		if(empty($tags)) return '';
		$mediaHTML = '';
		
		$mediaHTML .= '<table cellpadding="3"><tr>';
		
		//we do a foreach so that the $tags will be replaced in the same order of the tags
		if(!empty($tags)){
			foreach($tags as $tag){
				if($tag == 'facebook') $mediaHTML .= jNews_SocialShare::displayFacebook( $mailingId , $full_screen);
				elseif($tag == 'linkedin') $mediaHTML .= jNews_SocialShare::displayLinkedIn($mailingId);
				else $mediaHTML .= jNews_SocialShare::displayTwitter($mailingId);
			}
		}
		
		$mediaHTML .= '</tr></table>';
		
		return $mediaHTML;
		
	}
	
	/**
	 * 
	 *replacign the tag with facebook share image link
	 * @param unknown_type $mailingId
	 */
	static function displayFacebook( $mailingId= 0 ,$full_screen = false){
		$facebookHTML = '';
		$facebookHTML .= jNews_SocialShare::displaySocialShare( $mailingId, 'facebook' , $full_screen);
		return $facebookHTML; 
	}
	
	/**
	 * 
	 *replacign the tag with linkedin share image link
	 * @param unknown_type $mailingId
	 */
	static function displayLinkedIn($mailingId = 0){
		$linkedInHTML = '';
		
		$linkedInHTML .= jNews_SocialShare::displaySocialShare( $mailingId, 'linkedin');
		
		return $linkedInHTML;
	}
	
	static function displayGoogle($mailingId = 0){
		$googleHTML = '';
		
		return $googleHTML;
	}
	
	/**
	 * 
	 *replacign the tag with twitter share image link
	 * @param unknown_type $mailingId
	 */
	static function displayTwitter( $mailingId = 0 ){
		$twitterHTML = '';
		
		$twitterHTML .= jNews_SocialShare::displaySocialShare( $mailingId, 'twitter');
		
		return $twitterHTML;
	}
	
	static function displaySocialShare( $mailingId = 0, $social = 'facebook', $full_screen=false){
		$socialShareHTML = '';
		
		$Itemid = $GLOBALS[JNEWS.'itemidAca'];
		$archivelink = jNews_Tools::completeLink( 'option='.JNEWS_OPTION.'&act=mailing&task=view&mailingid='.$mailingId  , false, $GLOBALS[JNEWS.'use_sef'] );
		
		$subject = jNews_Mailing::getMailingsSubject($mailingId);
		
		if($social == 'twitter'){
			$img = 'twitter.png';
			$link= "http://twitter.com/home?status=".urlencode($archivelink)."&title=".$subject;
			$title = "Share on Twitter";
		}elseif($social == 'linkedin'){
			$img = 'linkedin.png';
			$link = "http://www.linkedin.com/shareArticle?mini=true&url=".urlencode($archivelink)."&title=".$subject;
			$title = "Share on LinkedIn";
		}else{
			$img = 'facebook.png';
			$full_screen_text = ($full_screen) ? "&format=raw" : "";
		
			$link = "http://www.facebook.com/sharer.php?u=".urlencode($archivelink.$full_screen_text)."&title=".$subject;
			$title = "Share on Facebook";
		}
	
		$imageLink = '<a target="_blank" href="'.$link.'" title="'.$title.'"><img src="'. JNEWS_JPATH_LIVE .'/components/' .JNEWS_OPTION. '/images/share/' . $img. '" width="16" height="16" border="0" alt="" /></a>';
		
		$socialShareHTML .= '<td>'.$imageLink.'</td>';
		
		return $socialShareHTML;
		
	}
	
}