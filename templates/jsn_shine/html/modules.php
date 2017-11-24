<?php
/**
 * @version $Id: modules.php 18800 2012-11-24 07:29:56Z quocanhd $
 * @package Joomla
 * @copyright Copyright (C) 2005 - 2006 Open Source Matters. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */
jimport( 'joomla.application.module.helper' );


function modChrome_jsnmodule($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'jsn-moduletitle'));
	$moduleTitleOuput = '<span>'.$module->title.'</span>';

	if (preg_match('/^(.+)?(fa fa-[^\s]+)(.+)?$/', $params->get( 'moduleclass_sfx' ), $match))
	{
		$moduleTitleOuput = '<span class="jsn-moduleicon "><i class="' . $match[2] . '"></i>'.$module->title.'</span>';
		$moduleClass = $match[1] . ' ';
	}
	$beginModuleContainerOutput = '';
	$endModuleContainerOutput = '';
	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="jsn-modulecontainer '  . (isset($attribs['columnClass']) ? ' ' . $attribs['columnClass'] : '') . $moduleClass . '"><div class="jsn-modulecontainer_inner">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '"><span data-title="' . $module->title .'">' . $moduleTitleOuput . '</span></' . $headerTag . '>';
			}

			echo '<div class="jsn-modulecontent">';
			echo $module->content;
			echo '<div class="clearbreak"></div></div>';
		echo '</div></' . $moduleTag . '>';
	}
}
