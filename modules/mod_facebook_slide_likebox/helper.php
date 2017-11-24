<?php
/**
 * Facebook Likebox Slider
 * @license    GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @link       https://jsns.eu
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');


class modSlideLikebox {
	static function getLikebox( $params )   {
		global $mainframe;
		require_once (JPATH_ROOT.'/modules/mod_facebook_slide_likebox/tmpl/assets/mobile_detect.php');
		$detect = new Mobile_Detect;
		if ( $detect->isMobile() ) {
			#______________________MOBILE________________________
			if (trim($params->get('twitter')) == 1) { $t = 1;} else { $t=0; }
			if (trim($params->get('facebook')) == 1) { $f = 1;} else { $f=0; }

			$sum = $f + $t;
			?>
			<style>
			@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css);

			#social_mobile {
			    position: relative;
			    z-index: 10000;
			}

			#social_mobile a{
			    position: relative;
			    width: 48px;
			    height: 48px;
			    line-height: 24px;
			    display:list-item;
			    list-style-type: none;
			    padding: 5px 0;
			    text-align: center;
			    color: #fff;
			    transition-duration: 0.5s;
			    transition-property: (width);
			    transition-timing-function: ease-in-out;
			}

			#social_mobile a:hover {
			    outline: 0 none !important;
			    color: #fff;
			    width:55px;
			    transition-duration: 0.5s !important;
			    transition-property: (width);
			    transition-timing-function: ease-in-out;
			}
			#social_mobile a.titleText {
			    display: none;
			  }
			/* icon sizes */
			#social_mobile i{
			    line-height: inherit;
			    font-size: 24px;
			    text-align: center;
			    margin-top: 7px;
			    color: #ffffff;
			}

			#social_mobile .top-left{
			    position: fixed;
			    top: 20%;
			    left:0;
			}

			/* facebook */

			#social_mobile .facebook{
			    background-color: #305891;
			}

			/* twitter */

			#social_mobile .twitter{
			    background-color: #05aced;
			}

			#social_mobile .facebook:hover {
			    background-color: #284978;
			}

			/* twitter */

			#social_mobile .twitter:hover {
			    background-color: #0499d4;
			}



			#social_mobile .mtop5{
			    margin-top: 5px;
			}

			@media only screen and (min-device-width: 0px) and (max-width:961px){
			.social_slider {
				display: none;
			}
			    #social_mobile{
			        margin-top: 50px;
			        display: inline;
			    }

			    #social_mobile .top-left{
			        top: auto;
			        bottom: 0;
			        width: 100%;
			        z-index: 999;
			    }

			    #social_mobile a{
			        position: relative;
			        float: left;
			        width: calc(100% / <?php echo $sum; ?>);
			        display:list-item;
			        list-style-type: none;
			    }

			    #social_mobile a:focus, #social_mobile a:hover {
			        width: calc(100% / <?php echo $sum; ?>);
			        -moz-transition-property: none;
			        -webkit-transition-property: none;
			        -o-transition-property: none;
			        transition-property: none;
			    }

			}

			 </style>
			<div id="social_mobile"><div class="top-left">
			<?php
			if (trim($params->get('facebook')) == 1)
			{ ?>
			<a class="facebook pop-upper" href="https://www.facebook.com/<?php echo $params->get('profile_id') ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			<?php }
			if (trim($params->get('twitter')) == 1)
			{ ?>
			<a class="twitter pop-upper" href="https://twitter.com/<?php echo $params->get('twitter_login'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
			<?php } ?>
			</div></div>
			<?php }
			else {
		if (trim( $params->get( 'position' ) ) == 1){
					 ?>
				<style>
					.social_slider {
						position: fixed;
						left: -370px;
						top: 120px;
						z-index: 99997;
					    -webkit-transition: left 1s ease-in-out;
					    -moz-transition: left 1s ease-in-out;
					    -o-transition: left 1s ease-in-out;
					    transition: left 1s ease-in-out;

					}
					.social_slider:hover{
					    left: 0px;
					}
				</style>

					<?php
}
else if (trim( $params->get( 'position' ) ) == 0){

?>
				<style>
					.social_slider {
						position: fixed;
						right: -370px;
						top: 120px;
						z-index: 99997;
					    -webkit-transition: right 1s ease-in-out;
					    -moz-transition: right 1s ease-in-out;
					    -o-transition: right 1s ease-in-out;
					    transition: right 1s ease-in-out;
							-webkit-backface-visibility: hidden;

					}
					.social_slider:hover {
					    right: 0px;
					}
				</style>
					<?php }


if (trim( $params->get( 'fbstyle' ) ) == 0){
	?>
<div class="social_slider" style="top: <?php echo $params->get('margintop') ?> !important;">
<?php } else if (trim( $params->get( 'fbstyle' ) ) == 1){ ?>
<div class="social_slider" style="top: 0px !important;">
<?php } ?>

      <?php

if (trim($params->get('facebook')) == 1)
	{ ?><input id="tab1" type="radio" name="tabs" checked />
<label for="tab1" class="facebook_icon"  style="max-width: 32px;"></label><?php
	} ?>
      <?php

if (trim($params->get('twitter')) == 1)
	{ ?><input id="tab2" type="radio" name="tabs" />
<label for="tab2" class="twitter_icon" style="max-width: 32px;<?php if (trim($params->get('facebook')) == 0)
{ ?> top: 50px;<?php  if (trim($params->get('position')) == 1) { ?>left:370px;<?php } else {?>right:32px;<?php } } else { }?>"></label><?php
	} ?>


      <?php

if (trim($params->get('facebook')) == 1)
	{ ?><section id="content1">
		<div class="facebook_box">
			<iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/<?php
				echo $params->get('profile_id');
				?>&tabs=timeline&width=350&height=470&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=true" width="350" height="470" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true">
			</iframe>
		 </div>
</section>
 	   <?php
	}

if (trim($params->get('twitter')) == 1)
	{ ?>
		<?php if (trim($params->get('facebook')) == 0)
	 { ?>
      <section id="content2" style="display: block;">
	 <?php } else { ?><section id="content2"> <?php } ?>

<div class="twitter_box">
<a class="twitter-timeline" data-width="350" data-height="470" href="https://twitter.com/<?php
echo $params->get('twitter_login');
?>">Tweets by <?php
echo $params->get('twitter_login');
?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
					 </div></section>
	   <?php
	}
?>

<a href="https://jsns.eu" title="JS Network Solutions" target="_blank"  class="copyrightlink">Powered by JS Network Solutions</a>
</div>
<?php
	}
	}
}
?>
