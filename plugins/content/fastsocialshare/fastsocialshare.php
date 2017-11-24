<?php
/**
 * @package FASTSOCIALSHARE
 * @author Joomla! Extensions Store
 * @copyright (C) 2013 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html  
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

/**
 * Social Share Buttons Plugin
 *
 * @package		Social Share Buttons Plugins
 * @subpackage	Social
 * @since 		1.5
 */
class plgContentFastSocialShare extends JPlugin {

	/**
	 * Default lang tags
	 * @var string
	 * @access private
	 */
	private $langTag = "en_US";
	
	/**
	 * Default lang starttag
	 * @var unknown
	 * @access private
	 */
	private $langStartTag = 'en';
	
	/**
	 * Component dispatch view
	 * @var unknown
	 * @access private
	 */
	private $componentView = null;

	/**
	 * Generate content
	 * @param   object      The article object.  Note $article->text is also available
	 * @param   object      The article params
	 * @param   boolean     Modules context
	 * @return  string      Returns html code or empty string.
	 */
	private function getContent(&$article, &$params, $moduleContext = false) {

		$doc = JFactory::getDocument();
		/* @var $doc JDocumentHtml */

		$doc->addStyleSheet(JUri::root() . "plugins/content/fastsocialshare/style/style.css");

		$uriInstance = JUri::getInstance();
		
		if(!$moduleContext) {
			if(!class_exists('ContentHelperRoute')) {
				include_once JPATH_SITE . '/components/com_content/helpers/route.php';
			}
			if(!isset($article->slug)) {
				$url = JRoute::_(ContentHelperRoute::getArticleRoute($article->id, $article->catid), false);
			} else {
				$url = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug), false);
			}
			$root = rtrim($uriInstance->getScheme() . '://' . $uriInstance->getHost(), '/');
			$url = $root . $url;
			$title = htmlentities($article->title, ENT_QUOTES, "UTF-8");
		} else {
			$url = JUri::current();
			$title = htmlentities($doc->title, ENT_QUOTES, "UTF-8");
		}

		// Force the http domain?
		if($this->params->get('use_http_domain', 0)) {
			$url = str_replace('https://', 'http://', $url);
		}
		
		$html = $this->getFacebookLike($this->params, $url, $title);
		$html .= $this->getFacebookShareMe($this->params, $url, $title);
		$html .= $this->getTwitter($this->params, $url, $title);
		$html .= $this->getGooglePlusOne($this->params, $url, $title);
		$html .= $this->getLinkedIn($this->params, $url, $title);
		$html .= $this->getPinterest($this->params, $url, $title);
		
		return '<div class="fastsocialshare_container">' . $html . '<div class="fastsocialshare_clearer"></div></div>';
	}

	private function getFacebookLike($params, $url, $title) {
		static $fbRoot = '<div id="fb-root"></div>';
		
		$html = "";
		$appID = null;
		if ($params->get("facebookLikeButton", true)) {
			$layout = $params->get("facebookLikeType", "button_count");
			if (strcmp("box_count", $layout) == 0) {
				$height = "80";
			} else {
				$height = "25";
			}
	
			$html = '<div class="fastsocialshare-share-fbl ' . $layout . '">';
	
			if ($params->get("facebookLikeAppId")) {
				$appID = '&appId=' . $params->get("facebookLikeAppId");
			}
			
			$html .= <<<JS
						$fbRoot
						<script>
						var loadAsyncDeferredFacebook = function() {
							(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/{$this->langTag}/sdk.js#xfbml=1&version=v2.5$appID";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));
						}

				  		if (window.addEventListener)
							window.addEventListener("load", loadAsyncDeferredFacebook, false);
						else if (window.attachEvent)
							window.attachEvent("onload", loadAsyncDeferredFacebook);
						else
					  		window.onload = loadAsyncDeferredFacebook;
						</script>
JS;
			$html .= '
				<div class="fb-like"
					data-href="' . $url . '"
					data-layout="' . $layout . '"
                	data-width="' . $params->get("facebookLikeWidth", "450") . '"
					data-action="' . $params->get("facebookLikeAction", 'like') . '"
					data-show-faces="' . $params->get("facebookLikeShowfaces", 'true') . '"
					data-share="false">
				</div>';
			$html .= '</div>';
		}
	
		$fbRoot = null;
		return $html;
	}
	
	private function getFacebookShareMe($params, $url, $title) {
		// Get the number of shares for this URL
		$sharesCounterCode = null;
		if ($params->get("facebookShareMeCounter", 0)) {
			$encodedUrl = rawurlencode($url);
			$sharesJsonData = file_get_contents("https://graph.facebook.com/?id=" . $encodedUrl);
			if($sharesJsonData) {
				$sharesJsonData = json_decode($sharesJsonData);
				if(isset($sharesJsonData->share)) {
					$sharesObject = $sharesJsonData->share;
					$numberOfShares = $sharesObject->share_count;
					$sharesCounterCode = '<div class="fbshare_container_counter">
											<div class="pluginCountButton pluginCountNum">
												<span>
													<span class="pluginCountTextConnected">' . $numberOfShares . '</span>
												</span>
											</div>
											<div class="pluginCountButtonNub">
												<s></s>
												<i></i>
											</div>
										 </div>';
				}
			}
		}
		
		$html = "";
		if ($params->get("facebookShareMeButton", true)) {
			$colorText = $params->get("facebookShareMeBadgeText", "C0C0C0");
			$badgeColor = $params->get("facebookShareMeBadge", "CC00FF");
			$badgeLabel = $params->get("facebookShareMeBadgeLabel", "Share");
			$encodedUri = rawurlencode($url);
			$html = <<<JS
						<div class="fastsocialshare-share-fbsh">
    					<a style="text-decoration:none; border-radius: 2px; padding:4px 5px; font-size:11px; font-weight: 600; background-color:#$badgeColor; color:#$colorText !important;" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=$encodedUri','fbshare','width=480,height=100')" href="javascript:void(0)"><span style="text-decoration:none; font-weight:bold; font-size:14px;margin-right:4px;">f</span>$badgeLabel</a>
    					$sharesCounterCode
						</div>
JS;
		}
		return $html;
	}
	
	private function getTwitter($params, $url, $title) {
		$twitterCounter = $params->get("twitterCounter", 'none');
		$twitterName = $params->get("twitterName", '');
		$twitterSize = null;
		if($params->get("twitterSize", 0)) {
			$twitterSize = 'data-size="large"';
		}
		
		$html = "";
		if($params->get("twitterButton", true)) {
			$html = <<<JS
						<div class="fastsocialshare-share-tw">
						<a href="https://twitter.com/share" class="twitter-share-button" $twitterSize data-text="$title" data-count="$twitterCounter" data-via="$twitterName" data-url="$url" data-lang="{$this->langStartTag}">Tweet</a>
						</div>
						<script>
							var loadAsyncDeferredTwitter =  function() {
	            						var d = document;
	            						var s = 'script';
	            						var id = 'twitter-wjs';
					            		var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){
						        		js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}
					        		}
						
							if (window.addEventListener)
								window.addEventListener("load", loadAsyncDeferredTwitter, false);
							else if (window.attachEvent)
								window.attachEvent("onload", loadAsyncDeferredTwitter);
							else
								window.onload = loadAsyncDeferredTwitter;
						</script>
JS;
		}
		
		
		return $html;
	}

	private function getLinkedIn($params, $url, $title) {
		$language = "lang: " . $this->langTag;
		
		$html = "";
		if ($params->get("linkedInButton", true)) {
			$dataCounter = $params->get("linkedInType", 'right');
			$html = <<<JS
						<div class="fastsocialshare-share-lin">
						<script type="text/javascript">
							var loadAsyncDeferredLinkedin =  function() {
								var po = document.createElement('script');
								po.type = 'text/javascript';
								po.async = true;
								po.src = 'https://platform.linkedin.com/in.js';
								po.innerHTML = '$language';
								var s = document.getElementsByTagName('script')[0];
								s.parentNode.insertBefore(po, s);
							};
		
							 if (window.addEventListener)
							  window.addEventListener("load", loadAsyncDeferredLinkedin, false);
							else if (window.attachEvent)
							  window.attachEvent("onload", loadAsyncDeferredLinkedin);
							else
							  window.onload = loadAsyncDeferredLinkedin;
						</script>
						<script type="in/share" data-url="$url" data-counter="$dataCounter"></script>
						</div>
JS;
		}
	
		return $html;
	}
	
	private function getGooglePlusOne($params, $url, $title) {
		$plusButton = null;
		$gShareButton = null;
		$gscript = false;
		
		$type = 'size="' . $params->get("plusType", 'medium') . '"';
		$shareAnnotation = $params->get("shareAnnotation", 'bubble');
		$language = " {lang: '" . $this->langStartTag . "'}";

		if($params->get("plusButton", true)) {
			$plusButton = "<g:plusone annotation='$shareAnnotation' $type href='$url'></g:plusone>";
			$gscript = true;
		}
		
		if($params->get("gshareButton", true)) {
			$gShareButton = "<g:plus annotation='$shareAnnotation' href='$url' action='share'></g:plus>";
			$gscript = true;
		}
		
		$html = "";
		if( $gscript ) {
			$html = <<<JS
						<div class="fastsocialshare-share-gone">
						<script type="text/javascript">
							 window.___gcfg = {
						        lang: '{$this->langStartTag}'
						      };
							var loadAsyncDeferredGooglePlus =  function() {
								var po = document.createElement('script'); 
								po.type = 'text/javascript'; 
								po.async = true;
								po.src = 'https://apis.google.com/js/plusone.js';
								po.innerHTML = $language;
								var s = document.getElementsByTagName('script')[0]; 
								s.parentNode.insertBefore(po, s);
							};
			
							 if (window.addEventListener)
							  window.addEventListener("load", loadAsyncDeferredGooglePlus, false);
							else if (window.attachEvent)
							  window.attachEvent("onload", loadAsyncDeferredGooglePlus);
							else
							  window.onload = loadAsyncDeferredGooglePlus;
						</script>
						$plusButton
						$gShareButton
						</div>
JS;
		}
		
		return $html;
	}
	
	private function getPinterest($params, $url, $title) {
		$html = "";
		if($params->get("pinterestButton", true)) {
			$html = <<<JS
						<div class="fastsocialshare-share-pinterest">
						<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" alt="Pin It" /></a>
						<script type="text/javascript">
							(function (w, d, load) {
							 var script, 
							 first = d.getElementsByTagName('SCRIPT')[0],  
							 n = load.length, 
							 i = 0,
							 go = function () {
							   for (i = 0; i < n; i = i + 1) {
							     script = d.createElement('SCRIPT');
							     script.type = 'text/javascript';
							     script.async = true;
							     script.src = load[i];
							     first.parentNode.insertBefore(script, first);
							   }
							 }
							 if (w.attachEvent) {
							   w.attachEvent('onload', go);
							 } else {
							   w.addEventListener('load', go, false);
							 }
							}(window, document, 
							 ['//assets.pinterest.com/js/pinit.js']
							));    
							</script>
						</div>
JS;
		}
	
			return $html;
	}
	
	/**
	 * Add social buttons into the article
	 *
	 * Method is called by the view
	 *
	 * @param   string  The context of the content being passed to the plugin.
	 * @param   object  The content object.  Note $article->text is also available
	 * @param   object  The content params
	 * @param   int     The 'page' number
	 * @since   1.6
	 */
	public function onContentPrepare($context, &$article, &$params, $limitstart) {
		$app = JFactory::getApplication();
		/* @var $app JApplication */
	
		if ($app->isAdmin()) {
			return;
		}
		
		if(!$article instanceof stdClass || $context == 'com_content.categories') {
			return;
		}
	
		$doc = JFactory::getDocument();
		/* @var $doc JDocumentHtml */
		$docType = $doc->getType();
	
		// Check document type
		if (strcmp("html", $docType) != 0) {
			$article->text = str_replace('{fastsocialshare}', '', $article->text);
			return;
		}
		// Output JS APP nel Document
		if($app->input->get('print')) {
			$article->text = str_replace('{fastsocialshare}', '', $article->text);
			return;
		}
	
		$this->componentView = $app->input->get("view");
		$isValidContext = !!preg_match('/com_content/i', $context);
		$isModuleContext = !!preg_match('/mod_custom/i', $context);
		
		// Check if it's a mod_custom context and manage as page URL sharing
		if($isModuleContext) {
			// Get plugin contents
			$content = $this->getContent($article, $params, true);
			$article->text = str_replace('{fastsocialshare}', $content, $article->text);
			return;
		}
		
		// Opengraph meta, extract the first image from the article-entity/first article-entity text html
		$og_incats = $this->params->get('og_incats', false);
		if($article->text && ($context == 'com_content.article' || (in_array($context, array('com_content.category', 'com_content.featured')) && $og_incats))) {
			$property = version_compare(JVERSION, '3.6', '>=') ? 'property' : false;
			if($this->params->get('ogimage_detection', 1) && !$doc->getMetaData('og:image')) {
				$firstImageFound = false;
				$imageDetectionType = $this->params->get('ogimage_detection_type', 'image_fulltext');
				
				// Get the full article image if any
				if($context == 'com_content.article') {
					$imagesDecoded = json_decode($article->images);
					if(isset($imagesDecoded->{$imageDetectionType}) && $imagesDecoded->{$imageDetectionType}) {
						$firstImageFound = true;
						$firstImage = JUri::root(false) . ltrim($imagesDecoded->{$imageDetectionType}, '/');
						$doc->setMetaData('og:image', $firstImage, $property);
					}
				}
				
				// Not found an image in the fulltext image, fallback to the first article image
				if(!$firstImageFound) {
					$firstImageFound = preg_match('/(<img)([^>])*(src=["\']([^"\']+)["\'])([^>])*/i', $article->text, $matches);
					if($firstImageFound) {
						$firstImage = $matches[4];
						$firstImage = preg_match('/^http/i', $firstImage) ? $firstImage : JUri::root(false) . ltrim($firstImage, '/');
						$doc->setMetaData('og:image', $firstImage, $property);
					}
				}
			}
			if($this->params->get('ogtitle_detection', 1) && isset($article->title) && !$doc->getMetaData('og:title')) {
				$doc->setMetaData('og:title', $article->title, $property);
			}
			if($this->params->get('ogdescription_detection', 1) && !$doc->getMetaData('og:description')) {
				if(!trim($article->metadesc)) {
					$dots = JString::strlen($article->text) > 300 ? '...' : '';
					$description = JString::substr(strip_tags($article->text), 0, 300);
					$description = str_replace(PHP_EOL, '', $description);
					$description = str_replace('{fastsocialshare}', '', $description);
					$description .= $dots;
				} else {
					$description = trim($article->metadesc);
				}
				$doc->setMetaData('og:description', $description, $property);
			}
		}
			
		if (!$isValidContext || !isset($this->params)) {
			$article->text = str_replace('{fastsocialshare}', '', $article->text);
			return;
		}
	
		$custom = $this->params->get('custom', 0);
		if ($custom) {
			$foundReplace = strstr($article->text, '{fastsocialshare}');
		}
	
		/** Check for selected views, which will display the buttons. **/
		/** If there is a specific set and do not match, return an empty string.**/
		$showInArticles = $this->params->get('showInArticles', 1);
		$showInFrontpage = $this->params->get('showInFrontPage', 1);
	
		if (!$showInArticles && ($this->componentView == 'article')) {
			return "";
		}
		
		if (!$showInFrontpage && ($this->componentView == 'featured')) {
			return "";
		}
	
		// Check for category view
		$showInCategories = $this->params->get('showInCategories');
	
		if (!$showInCategories && ($this->componentView == 'category')) {
			return;
		}
	
		if (!isset($article) OR empty($article->id)) {
			return;
		}
	
		$excludeArticles = $this->params->get('excludeArticles', array());
		if (!empty($excludeArticles)) {
			$excludeArticles = explode(',', $excludeArticles);
			JArrayHelper::toInteger($excludeArticles);
		}
	
		// Exluded categories
		$excludedCats = $this->params->get('excludeCats', array());
		if (!empty($excludedCats)) {
			$excludedCats = explode(',', $excludedCats);
			JArrayHelper::toInteger($excludedCats);
		}
	
		// Included Articles
		$includedArticles = $this->params->get('includeArticles', array());
		if (!empty($includedArticles)) {
			$includedArticles = explode(',', $includedArticles);
			JArrayHelper::toInteger($includedArticles);
		}
	
		if (!in_array($article->id, $includedArticles)) {
			// Check exluded places
			if (in_array($article->id, $excludeArticles) || in_array($article->catid, $excludedCats)) {
				return "";
			}
		}
	
		// Get plugin contents
		$content = $this->getContent($article, $params);
	
		if ($custom) {
			if ($foundReplace) {
				$article->text = str_replace('{fastsocialshare}', $content, $article->text);
			}
		} else {
			$position = $this->params->get('position');
	
			switch ($position) {
				case 0:
					$article->text = $content . $article->text . $content;
					break;
				case 1:
					$article->text = $content . $article->text;
					break;
				case 2:
					$article->text = $article->text . $content;
					break;
				default:
					break;
			}
		}
		return;
	}
	
	/**
	 * Class Constructor
	 *
	 * @param object $subject The object to observe
	 * @param array  $config  An optional associative array of configuration settings.
	 * Recognized key values include 'name', 'group', 'params', 'language'
	 * (this list is not meant to be comprehensive).
	 * @since 1.5
	 */
	public function __construct(&$subject, $config = array()) {
		parent::__construct($subject, $config);
		$lang = JFactory::getLanguage();
		$locale = $lang->getTag();
		$this->langTag = str_replace("-", "_", $locale);
		$this->langStartTag = @array_shift(explode('-', $locale));
	}
}