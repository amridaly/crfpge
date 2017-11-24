<?php
defined('_JEXEC') OR die('Access Denied!');
//credits to http://classes.verkoyen.eu/css_to_inline_styles

/**
 * CSS to Inline Styles class
 *
 * This source file can be used to convert HTML with CSS into HTML with inline styles
 *
 * Known issues:
 * - no support for pseudo selectors
 *
 * The class is documented in the file itself. If you find any bugs help me out and report them. Reporting can be done by sending an email to php-css-to-inline-styles-bugs[at]verkoyen[dot]eu.
 * If you report a bug, make sure you give me enough information (include your code).
 *
 * Changelog since 1.0.2
 * - .class are matched from now on.
 * - fixed issue with #id
 * - new beta-feature: added a way to output valid XHTML (thx to Matt Hornsby)
 *
 * Changelog since 1.0.1
 * - fixed some stuff on specifity
 *
 * Changelog since 1.0.0
 * - rewrote the buildXPathQuery-method
 * - fixed some stuff on specifity
 * - added a way to use inline style-blocks
 *
 * License
 * Copyright (c) 2010, Tijs Verkoyen. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 * 3. The name of the author may not be used to endorse or promote products derived from this software without specific prior written permission.
 *
 * This software is provided by the author "as is" and any express or implied warranties, including, but not limited to, the implied warranties of merchantability and fitness for a particular purpose are disclaimed. In no event shall the author be liable for any direct, indirect, incidental, special, exemplary, or consequential damages (including, but not limited to, procurement of substitute goods or services; loss of use, data, or profits; or business interruption) however caused and on any theory of liability, whether in contract, strict liability, or tort (including negligence or otherwise) arising in any way out of the use of this software, even if advised of the possibility of such damage.
 *
 * @author		Tijs Verkoyen <php-css-to-inline-styles@verkoyen.eu>
 * @version		1.0.3
 *
 * @copyright	Copyright (c) 2010, Tijs Verkoyen. All rights reserved.
 * @license		BSD License
 */
class CSSToInlineStyles
{
	/**
	 * The CSS to use
	 *
	 * @var	string
	 */
	private $css;


	/**
	 * The processed CSS rules
	 *
	 * @var	array
	 */
	public $cssRules;


	/**
	 * Should the generated HTML be cleaned
	 *
	 * @var	bool
	 */
	private $cleanup = false;


	/**
	 * The HTML to process
	 *
	 * @var	string
	 */
	private $html;


	/**
	 * Use inline-styles block as CSS
	 *
	 * @var	bool
	 */
	private $useInlineStylesBlock = false;


	/**
	 * Creates an instance, you could set the HTML and CSS here, or load it later.
	 *
	 * @return	void
	 * @param	string[optional] $html	The HTML to process
	 * @param	string[optional] $css	The CSS to use
	 */
	public function __construct($html = null, $css = null)
	{
		if($html !== null) $this->setHTML($html);
		if($css !== null) $this->setCSS($css);
	}


	/**
	 * Convert a CSS-selector into an xPath-query
	 *
	 * @return	string
	 * @param	string $selector	The CSS-selector
	 */
	function buildXPathQuery($selector)
	{
		// redefine
		$selector = (string) $selector;

		// the CSS selector
		$cssSelector = array(	'/(\w)\s+(\w)/',				// E F				Matches any F element that is a descendant of an E element
								'/(\w)\s*>\s*(\w)/',			// E > F			Matches any F element that is a child of an element E
								'/(\w):first-child/',			// E:first-child	Matches element E when E is the first child of its parent
								'/(\w)\s*\+\s*(\w)/',			// E + F			Matches any F element immediately preceded by an element
								'/(\w)\[([\w\-]+)]/',			// E[foo]			Matches any E element with the "foo" attribute set (whatever the value)
								'/(\w)\[([\w\-]+)\=\"(.*)\"]/',	// E[foo="warning"]	Matches any E element whose "foo" attribute value is exactly equal to "warning"
								'/(\w+|\*)+\.([\w\-]+)+/',		// div.warning		HTML only. The same as DIV[class~="warning"]
								'/\.([\w\-]+)/',				// .warning			HTML only. The same as *[class~="warning"]
								'/(\w+)+\#([\w\-]+)/',			// E#myid			Matches any E element with id-attribute equal to "myid"
								'/\#([\w\-]+)/'					// #myid			Matches any element with id-attribute equal to "myid"
							);

		// the xPath-equivalent
		$xPathQuery = array(	'\1//\2',																		// E F				Matches any F element that is a descendant of an E element
								'\1/\2',																		// E > F			Matches any F element that is a child of an element E
								'*[1]/self::\1',																// E:first-child	Matches element E when E is the first child of its parent
								'\1/following-sibling::*[1]/self::\2',											// E + F			Matches any F element immediately preceded by an element
								'\1 [ @\2 ]',																	// E[foo]			Matches any E element with the "foo" attribute set (whatever the value)
								'\1[ contains( concat( " ", @\2, " " ), concat( " ", "\3", " " ) ) ]',			// E[foo="warning"]	Matches any E element whose "foo" attribute value is exactly equal to "warning"
								'\1[ contains( concat( " ", @class, " " ), concat( " ", "\2", " " ) ) ]',		// div.warning		HTML only. The same as DIV[class~="warning"]
								'*[ contains( concat( " ", @class, " " ), concat( " ", "\1", " " ) ) ]',		// .warning			HTML only. The same as *[class~="warning"]
								'\1[ @id = "\2" ]',																// E#myid			Matches any E element with id-attribute equal to "myid"
								'*[ @id = "\1" ]'																// #myid			Matches any element with id-attribute equal to "myid"
							);

		// return
		return (string) '//'. preg_replace($cssSelector, $xPathQuery, $selector);
	}


	/**
	 * Calculate the specifity for the CSS-selector
	 *
	 * @return	int
	 * @param	string $selector
	 */
	function calculateCSSSpecifity($selector)
	{
		// cleanup selector
		$selector = str_replace(array('>', '+'), array(' > ', ' + '), $selector);

		// init var
		$specifity = 0;

		// split the selector into chunks based on spaces
		$chunks = explode(' ', $selector);

		// loop chunks
		foreach($chunks as $chunk)
		{
			// an ID is important, so give it a high specifity
			if(strstr($chunk, '#') !== false) $specifity += 100;

			// classes are more important than a tag, but less important then an ID
			elseif(strstr($chunk, '.')) $specifity += 10;

			// anything else isn't that important
			else $specifity += 1;
		}

		// return
		return $specifity;
	}


	/**
	 * Cleanup the generated HTML
	 *
	 * @return	string
	 * @param	string $html	The HTML to cleanup
	 */
	function cleanupHTML($html)
	{
		// remove classes
		$html = preg_replace('/(\s)+class="(.*)"(\s)+/U', ' ', $html);

		// remove IDs
		$html = preg_replace('/(\s)+id="(.*)"(\s)+/U', ' ', $html);

		// return
		return $html;
	}


	/**
	 * Converts the loaded HTML into an HTML-string with inline styles based on the loaded CSS
	 *
	 * @return	string
	 * @param	bool $outputXHTML	Should we output valid XHTML?
	 */
	public function convert($outputXHTML = false)
	{
		// redefine
		$outputXHTML = (bool) $outputXHTML;

		// validate
		if($this->html == null) throw new CSSToInlineStylesException('No HTML provided.');

		// should we use inline style-block
		if($this->useInlineStylesBlock)
		{
			// init var
			$matches = array();

			// match the style blocks
			preg_match_all('|<style(.*)>(.*)</style>|isU', $this->html, $matches);

			// any style-blocks found?
			if(!empty($matches[2]))
			{
				// add
				foreach($matches[2] as $match) $this->css .= trim($match) ."\n";
			}
		}

		// process css
		$this->processCSS();

		// create new DOMDocument
		$document = new DOMDocument();

		// set error level
		libxml_use_internal_errors(true);

		// load HTML
		$document->loadHTML($this->html);

		// create new XPath
		$xPath = new DOMXPath($document);

		// any rules?
		if(!empty($this->cssRules))
		{
			// loop rules
			foreach($this->cssRules as $rule)
			{
				// init var
				$query = $this->buildXPathQuery($rule['selector']);

				// validate query
				if($query === false) continue;

				// search elements
				$elements = $xPath->query($query);

				// validate elements
				if($elements === false) continue;

				// loop found elements
				foreach($elements as $element)
				{
					// init var
					$properties = array();

					// get current styles
					$stylesAttribute = $element->attributes->getNamedItem('style');

					// any styles defined before?
					if($stylesAttribute !== null)
					{
						// get value for the styles attribute
						$definedStyles = (string) $stylesAttribute->value;

						// split into properties
						$definedProperties = (array) explode(';', $definedStyles);

						// loop properties
						foreach($definedProperties as $property)
						{
							// validate property
							if($property == '') continue;

							// split into chunks
							$chunks = (array) explode(':', trim($property), 2);

							// validate
							if(!isset($chunks[1])) continue;

							// loop chunks
							$properties[$chunks[0]] = trim($chunks[1]);
						}
					}

					// add new properties into the list
					foreach($rule['properties'] as $key => $value) $properties[$key] = $value;

					// build string
					$propertyChunks = array();

					// build chunks
					foreach($properties as $key => $value) $propertyChunks[] = $key .': '. $value .';';

					// build properties string
					$propertiesString = implode(' ', $propertyChunks);

					// set attribute
					if($propertiesString != '') $element->setAttribute('style', $propertiesString);
				}
			}
		}

		// should we output XHTML?
		if($outputXHTML)
		{
			// set formating
			$document->formatOutput = true;

			// get the HTML as XML
			$html = $document->saveXML(null, LIBXML_NOEMPTYTAG);

			// remove the XML-header
			$html = str_replace('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'."\n", '', $html);
		}

		// just regular HTML 4.01 as it should be used in newsletters
		else
		{
			// get the HTML
//			$html = $document->saveHTML();	// commented because it create funny characters Â
			$html = $this->html;
		}

		// cleanup the HTML if we need to
		if($this->cleanup) $html = $this->cleanupHTML($html);

		// return
		return $html;
	}


	/**
	 * Process the loaded CSS
	 *
	 * @return	void
	 */
	public function processCSS()
	{
		// init vars
		$css = (string) $this->css;

		// remove newlines
		$css = str_replace(array("\r", "\n"), '', $css);

		// replace double quotes by single quotes
		$css = str_replace('"', '\'', $css);

		// remove comments
		$css = preg_replace('|/\*.*?\*/|', '', $css);

		// remove spaces
		$css = preg_replace('/\s\s+/', ' ', $css);

		// rules are splitted by }
		$rules = (array) explode('}', $css);

		// init var
		$i = 1;

		// loop rules
		foreach($rules as $rule)
		{
			// split into chunks
			$chunks = explode('{', $rule);

			// invalid rule?
			if(!isset($chunks[1])) continue;

			// set the selectors
			$selectors = trim($chunks[0]);

			// get cssProperties
			$cssProperties = trim($chunks[1]);

			// split multiple selectors
			$selectors = (array) explode(',', $selectors);

			// loop selectors
			foreach($selectors as $selector)
			{
				// cleanup
				$selector = trim($selector);

				// build an array for each selector
				$ruleSet = array();

				// store selector
				$ruleSet['selector'] = $selector;

				// process the properties
				$ruleSet['properties'] = $this->processCSSProperties($cssProperties);

				// calculate specifity
				$ruleSet['specifity'] = $this->calculateCSSSpecifity($selector);

				// add into global rules
				$this->cssRules[] = $ruleSet;
			}

			// increment
			$i++;
		}

		// sort based on specifity
		if(!empty($this->cssRules)) usort($this->cssRules, array('CSSToInlineStyles', 'sortOnSpecifity'));
	}


	/**
	 * Process the CSS-properties
	 *
	 * @return	array
	 * @param	string $propertyString
	 */
	function processCSSProperties($propertyString)
	{
		// split into chunks
		$properties = (array) explode(';', $propertyString);

		// init var
		$pairs = array();

		// loop properties
		foreach($properties as $property)
		{
			// split into chunks
			$chunks = (array) explode(':', $property, 2);

			// validate
			if(!isset($chunks[1])) continue;

			// add to pairs array
			$pairs[trim($chunks[0])] = trim($chunks[1]);
		}

		// sort the pairs
		ksort($pairs);

		// return
		return $pairs;
	}


	/**
	 * Should the IDs and classes be removed?
	 *
	 * @return	void
	 * @param	bool[optional] $on
	 */
	public function setCleanup($on = true)
	{
		$this->cleanup = (bool) $on;
	}


	/**
	 * Set CSS to use
	 *
	 * @return	void
	 * @param	string $css		The CSS to use
	 */
	public function setCSS($css)
	{
		$this->css = (string) $css;
	}


	/**
	 * Set HTML to process
	 *
	 * @return	void
	 * @param	string $html
	 */
	public function setHTML($html)
	{
		$this->html = (string) $html;
	}


	/**
	 * Set use of inline styles block
	 * If this is enabled the class will use the style-block in the HTML.
	 *
	 * @param	bool[optional] $on
	 */
	public function setUseInlineStylesBlock($on = true)
	{
		$this->useInlineStylesBlock = (bool) $on;
	}


	/**
	 * Sort an array on the specifity element
	 *
	 * @return	int
	 * @param	array $e1	The first element
	 * @param	array $e2	The second element
	 */
	private static function sortOnSpecifity($e1, $e2)
	{
		// validate
		if(!isset($e1['specifity']) || !isset($e2['specifity'])) return 0;

		// lower
		if($e1['specifity'] < $e2['specifity']) return -1;

		// higher
		if($e1['specifity'] > $e2['specifity']) return 1;

		// fallback
		return 0;
	}

	/**
	 *
	 * get the standard css rules from the css rules of the uploaded template that we receive and transform to an array with the standard selector as key.
	 * @param array $cssRulesA the css of the template
	 * @param array $standardCSSA - predefined css rules in jnews
	 * @return array -the standard/selectors cssrules
	 */
	function getStandardCSSTag($cssRulesA, $standardSelectorsA){
		if(empty($cssRulesA)) return '';
		$standardCSS = array();
		$standardCSSClassesA = array('.unsubscribe', '.subscriptions', '.content', '.title', '.readmore', '.online', '.aca_unsubscribe', '.aca_subscriptions', '.aca_content', '.aca_title', '.aca_readmore', '.aca_online', '.aca_subscribe');

		foreach($cssRulesA as $key => $value){
			if(in_array($value['selector'], $standardSelectorsA) || $value['selector'] == 'body'){//we check if the selector is a standard selector for jnews
				if(!empty($value['properties'])){
					$propertiesA = array();

					foreach($value['properties'] as $propertyKey => $propertyValue){
						if($value['selector'] == 'body'){
							if($propertyKey == 'background-color'){//for the body bgcolor
								$propertiesA[] = $propertyValue;
							}
						}else{
							$propertiesA[] = $propertyKey.':'.$propertyValue.';';
						}


					}

					if($value['selector'] != 'body'){
						if($value['selector'] == '.online') $value['selector'] = 'aca_online';
						if($value['selector'] == '.subscribe') $value['selector'] = 'aca_subscribe';
						if($value['selector'] == '.unsubscribe') $value['selector'] = 'aca_unsubscribe';

						if(in_array($value['selector'], $standardCSSClassesA)) $value['selector'] = substr($value['selector'], 1);
						else $value['selector'] = 'style_'. $value['selector'];
					}

					if($value['selector'] == 'body') $standardCSS['color_bg'] = implode(' ', $propertiesA);
					else $standardCSS[$value['selector']] = implode(' ', $propertiesA);
				}
			}

		}
		return $standardCSS;
	}

	/**
	 *
	 * we get the extra css rules from the css rules of the uploaded template that we receive and transform to string.
	 * @param array $cssRulesA the css of the template
	 * @param array $standardCSSA - predefined css rules in jnews
	 * @param string $extraCSSString formatted css string of the extra css rules
	 */
	function getExtraCSSTag($cssRulesA, $standardSelectorsA){
		if(empty($cssRulesA)) return '';
		$extraCSSString = '';

		foreach($cssRulesA as $key => $value){
			if(!in_array($value['selector'], $standardSelectorsA)){//we check if the selector is not a standard selector for jnews
				$extraCSSString .= $value['selector'].' ';
				$extraCSSString .= "{\r\n";
//				$extraCSSString .= "\t";
				if(!empty($value['properties'])){
					$propertiesA = array();
					foreach($value['properties'] as $propertyKey => $propertyValue){
						if($value['selector'] == 'body' && $propertyKey == 'background-color') continue;//we don't include
						$propertiesA[] = $propertyKey.':'.$propertyValue.';';
					}
					$extraCSSString .= implode("\r\n", $propertiesA);
					$extraCSSString .= "\r\n}\r\n\r\n";
				}
			}
		}
		return $extraCSSString;
	}
}


/**
 * CSSToInlineStyles Exception class
 *
 * @author	Tijs Verkoyen <php-css-to-inline-styles@verkoyen.eu>
 */
class CSSToInlineStylesException extends Exception
{
}
