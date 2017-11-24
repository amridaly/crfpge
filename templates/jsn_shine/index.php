<?php


/**
 * @package     Joomla.Site
 * @subpackage  Templates.jsn_shine
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery.mmenu.min.all.js');
// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.min.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/bootstrap-responsive.min.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template_pro.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/jsn_mobile.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/jquery.mmenu.all.css');
if($this->params->get('templateColor'))
{
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/colors/'.$this->params->get('templateColor').'.css');
}

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('left') && $this->countModules('right'))
{
	$span = "span6";
}
elseif ($this->countModules('left') && !$this->countModules('right'))
{
	$span = "span8";
}
elseif (!$this->countModules('left') && $this->countModules('right'))
{
	$span = "span8";
}
else
{
	$span = "span12";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />

	<?php if ($this->params->get('googleFontName')) : ?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName'); ?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			body {
				font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName')); ?>', sans-serif;
			}
		</style>
	<?php endif; ?>

	<?php if ($this->params->get('templateWidth')=="fixed"): ?>
	<style type="text/css">
		#jsn-header-inner,
		#jsn-pos-content-top,
		#jsn-content_inner,
		#jsn-content-bottom-inner,
		#jsn-footer-inner {
			width: 1170px;
			min-width: 1170px;
		}
	</style>
	<?php elseif($this->params->get('templateWidth')=="float"): ?>
	<style type="text/css">
		#jsn-header-inner,
		#jsn-pos-content-top,
		#jsn-content_inner,
		#jsn-content-bottom-inner,
		#jsn-footer-inner {
			width: 90%;
			min-width: 90%;
		}
	</style>
	<?php endif; ?>
	
	<script type="text/javascript">
		(function($){

		 $(document).ready(function ()
		 {
		 	$("nav#menu").mmenu({
		        classes : 'mm-light',
				position : 'top'
		      });
		   });
		})(jQuery);
	</script>
</head>

<body  id="jsn-master" class="site <?php echo 'jsn-color-'.$this->params->get('templateColor') . ' ' . $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">

	<!-- Body -->
	<div id="jsn-page">
		<!-- Header -->
		<div id="jsn-header" role="banner">
			<div id="jsn-header-inner" class="clearafter">
				<div id="jsn-logo" class="pull-left">
					<?php
					if (!empty($this->params->get('logoLink'))) {
						echo '<a href="' . $this->params->get('logoLink') . '" title="' . $this->params->get('logoSlogan') . '">';
					}
						// Logo file or site title param
						if ($this->params->get('logoFile'))
						{
							echo '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $this->params->get('logoSlogan') . '" />';
						}
						elseif ($this->params->get('sitetitle'))
						{
							echo '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
						}
						else
						{
							echo '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
						}
					if (!empty($this->params->get('logoLink'))) {
						echo '</a>';
					}
					?>
				</div>
		        <a href="#menu" class="btn btn-navbar"><i class="fa fa-bars"></i></a>
				<?php

					/*====== Show modules in position "mainmenu" ======*/
					if ($this->countModules('toolbar') > 0) {
				?>
					<div id="jsn-pos-toolbar"  class="pull-right">
						<jdoc:include type="modules" name="toolbar" style="jsnmodule" />
					</div>

				<?php
					}
						/*====== Show modules in position "mainmenu" ======*/
						if ($this->countModules('mainmenu') > 0) {
					?>
						<div id="jsn-pos-mainmenu"  class="pull-right">
							<jdoc:include type="modules" name="mainmenu" style="jsnmodule" />
						</div>
				<?php
					}
				?>
			</div>
		</div>
		<div id="jsn-body">
			<div id="jsn-content">
				<div id="jsn-content_inner"  class="row-fluid">
					<?php
					/*====== Show modules in position "content-top" ======*/
					if ($this->countModules('content-top') > 0) {
					?>
					<div id="jsn-content-top">
						<div id="jsn-pos-content-top" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer<?php echo $this->countModules('content-top'); ?> row-fluid">
							<jdoc:include type="modules" name="content-top" style="jsnmodule" />
						</div>
					</div>
					<?php
						}
					?>
					<?php if ($this->countModules('left')) : ?>
						<div id="jsn-leftsidecontent" class="span<?php if ($this->countModules('left') && $this->countModules('right')) { echo 3;}else {echo 4;}?>">
							<div id="jsn-leftsidecontent_inner">
								<jdoc:include type="modules" name="left" style="jsnmodule"/>
							</div>
						</div>
					<?php endif; ?>
					<div id="jsn-maincontent" role="main" class="<?php echo $span; ?> row-fluid">
						<div id="jsn-maincontent_inner">
						<!-- Begin Content -->
						<?php
							/*====== Show modules in position "breadcrumbs" ======*/
							if ($this->countModules('breadcrumbs') > 0) {
						?>
											<div id="jsn-breadcrumbs">
													<jdoc:include type="modules" name="breadcrumbs" />
											</div>
						<?php
							}

							/*====== Show modules in position "user-top" ======*/
							if ($this->countModules('user-top') > 0) {
						?>
											<div id="jsn-pos-user-top" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer<?php echo $this->countModules('user-top'); ?> row-fluid">
													<jdoc:include type="modules" name="user-top" style="jsnmodule" columnClass="span<?php echo ceil(12 / $this->countModules('user-top')); ?>" />
												</div>
						<?php
							}

							/*====== Show modules in position "user1" and "user2" ======*/
							$positionCount = $this->countModules('user1') + $this->countModules('user2');
							if ($positionCount)
							{
								$grid_suffix = $positionCount;
						?>
											<div id="jsn-usermodules1" class="jsn-modulescontainer clearafter">
							<?php
								/*====== Show modules in position "user1" ======*/
								if ($this->countModules('user1') > 0) {
							?>
													<div id="jsn-pos-user1" class="span<?php echo ceil(12 / $grid_suffix); ?>">
														<jdoc:include type="modules" name="user1" style="jsnmodule"/>
													</div>
							<?php
								}

								/*====== Show modules in position "user2" ======*/
								if ($this->countModules('user2') > 0) {
							?>
													<div id="jsn-pos-user2" class="span<?php echo ceil(12 / $grid_suffix); ?>">
														<jdoc:include type="modules" name="user2" style="jsnmodule"/>
													</div>
							<?php
								}
							?>
												</div>
						<?php
							}
						?>
						<div id="jsn-mainbody-content">
							<?php
								/*====== Show modules in position "mainbody-top" ======*/
								if ($this->countModules('mainbody-top') > 0) {
							?>
									<div id="jsn-pos-mainbody-top" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer<?php echo $this->countModules('mainbody-top'); ?> row-fluid">
										<jdoc:include type="modules" name="mainbody-top" style="jsnmodule" class="jsn-roundedbox" columnClass="span<?php echo ceil(12 / $this->countModules('mainbody-top')); ?>" />
									</div>
							<?php
								}

								/*====== Show mainbody ======*/
							?>
								<div id="jsn-mainbody">
									<jdoc:include type="message" />
									<jdoc:include type="component" />
								</div>
							<?php

								/*====== Show modules in position "mainbody-bottom" ======*/
								if ($this->countModules('mainbody-bottom') > 0) {
							?>
														<div id="jsn-pos-mainbody-bottom" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer<?php echo $this->countModules('mainbody-bottom'); ?> row-fluid">
															<jdoc:include type="modules" name="mainbody-bottom" style="jsnmodule" class="jsn-roundedbox" columnClass="span<?php echo ceil(12 / $this->countModules('mainbody-bottom')); ?>" />
														</div>
							<?php
								}
							?>
						</div>
						<?php
							/*====== Show modules in position "user3" and "user4" ======*/
							$positionCount = $this->countModules('user3', 'user4');
							if ($positionCount) {
								$grid_suffix = $positionCount;
						?>
											<div id="jsn-usermodules2" class="jsn-modulescontainer jsn-modulescontainer<?php echo $grid_suffix; ?>">
													<div id="jsn-usermodules2_inner_grid<?php echo $grid_suffix; ?>" class="row-fluid">
							<?php
								/*====== Show modules in position "user3" ======*/
								if ($this->countModules('user3') > 0) {
							?>
														<div id="jsn-pos-user3" class="span<?php echo ceil(12 / $grid_suffix); ?>">
															<jdoc:include type="modules" name="user3" style="jsnmodule" />
														</div>
							<?php
								}

								/*====== Show modules in position "user4" ======*/
								if ($this->countModules('user4') > 0) { ?>
														<div id="jsn-pos-user4" class="span<?php echo ceil(12 / $grid_suffix); ?>">
															<jdoc:include type="modules" name="user4" style="jsnmodule" />
														</div>
							<?php
								}
							?>
														<div class="clearbreak"></div>
													</div>
												</div>
						<?php
							}

							/*====== Show modules in position "user-bottom" ======*/
							if ($this->countModules('user-bottom') > 0) { ?>
											<div id="jsn-pos-user-bottom" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer<?php echo $this->countModules('user-bottom'); ?> row-fluid">
													<jdoc:include type="modules" name="user-bottom" style="jsnmodule" columnClass="span<?php echo ceil(12 / $this->countModules('user-bottom')); ?>" />
											</div>
						<?php } ?>

						<!-- End Content -->
						</div>
					</div>
					<?php if ($this->countModules('right')) : ?>
						<div id="jsn-rightsidecontent" class="span<?php if ($this->countModules('left') && $this->countModules('right')) { echo 3;}else {echo 4;}?>">
							<div id="jsn-rightsidecontent_inner">
								<jdoc:include type="modules" name="right" style="jsnmodule"/>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<?php
				/*====== Show elements in content bottom area ======*/
				if ($this->countModules('content-bottom') && $this->countModules('user5')||$this->countModules('user6')||$this->countModules('user7')) {
			?>
				<div id="jsn-content-bottom">
					<div id="jsn-content-bottom-inner">
					<?php
						/*====== Show modules in position "content-bottom" ======*/
						if ($this->countModules('content-bottom') > 0) {
					?>
		                <div id="jsn-pos-content-bottom" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer<?php echo $this->countModules('content-bottom'); ?> row-fluid">
		                	<jdoc:include type="modules" name="content-bottom" style="jsnmodule" columnClass="span<?php echo ceil(12 / $this->countModules('content-bottom')); ?>" />
		                </div>
					<?php
						}
						if ($this->countModules('user5')||$this->countModules('user6')||$this->countModules('user7')) {
					?>
						<div id="jsn-usermodules3" class="jsn-modulescontainer jsn-modulescontainer<?php echo $this->countModules('user5') + $this->countModules('user6') + $this->countModules('user7'); ?> row-fluid">
					<?php
							/*====== Show modules in position "user5" ======*/
							if ($this->countModules('user5')) {
						?>
							<div id="jsn-pos-user5" class="span4">
								<jdoc:include type="modules" name="user5" style="jsnmodule" />
							</div>
						<?php
							}

							/*====== Show modules in position "user6" ======*/
							if ($this->countModules('user6')) {
						?>
							<div id="jsn-pos-user6" class="span4">
								<jdoc:include type="modules" name="user6" style="jsnmodule" />
							</div>
						<?php
							}

							/*====== Show modules in position "user7" ======*/
							if ($this->countModules('user7')) {
						?>
							<div id="jsn-pos-user7" class="span4">
								<jdoc:include type="modules" name="user7" style="jsnmodule" />
							</div>
						<?php
							}
						?>
						</div>
					<?php
						}
					?>
					</div>
	            </div>
			<?php
				}
			?>
		</div>
	</div>
	<!-- Footer -->
	<?php
		/*====== Show modules in position "footer" and "bottom" ======*/
		$positionCount = $this->countModules('footer') + $this->countModules('bottom');
		if ($positionCount) {
			$grid_suffix = $positionCount;
		}
	?>
	<div id="jsn-footer">
		<div id="jsn-footer-inner">
			<div id="jsn-footermodules" class="jsn-modulescontainer jsn-modulescontainer<?php echo $grid_suffix; ?> row-fluid">
				<?php
					/*====== Show modules in position "footer" ======*/
					if ($this->countModules('footer') > 0) {
				?>
						<div id="jsn-pos-footer" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer<?php echo $this->countModules('footer'); ?> row-fluid">
							<jdoc:include type="modules" name="footer" style="jsnmodule" columnClass="span<?php echo ceil(12 / $this->countModules('footer')); ?>"/>
						</div>
				<?php
					}

					/*====== Show modules in position "bottom" ======*/
					if ($this->countModules('bottom') > 0) {
				?>
						<div id="jsn-pos-bottom" class="jsn-modulescontainer jsn-horizontallayout jsn-modulescontainer<?php echo $this->countModules('bottom'); ?> row-fluid">
							<jdoc:include type="modules" name="bottom" style="jsnmodule" columnClass="span<?php echo ceil(12 / $this->countModules('bottom')); ?>" />
						</div>
				<?php
					}
				?>
						<div class="clearbreak"></div>
			</div>
		</div>
	</div>
	 <?php if ($this->countModules('mainmenu')): ?>
	  	<nav id="menu">
			<jdoc:include type="modules" name="mainmenu" style="jsnmodule" />
		</nav>
	<?php endif; ?>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
