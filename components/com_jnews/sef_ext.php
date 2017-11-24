<?php
defined('_JEXEC') or die('Restricted access');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

class sef_jnews {

    function create( $string ) {

    	$string = str_replace( '&amp;', '&', preg_replace( '#(index\.php\??)#i', '', $string ) );
		$query = array();
		$stringExploded = explode( '&', $string );
		foreach( $stringExploded as $oneS ) {
			list( $var, $val ) = explode( '=', $oneS );
			$query[$var] = $val;
		}

		$segments = array();
		if ( isset( $query['act'] ) ) {
			$segments[] = $query['act'];
			unset( $query['act'] );
			if ( isset( $query['task'] ) ) {
				$segments[] = $query['task'];
				unset( $query['task'] );
			}
		}
		unset( $query['option'] );
		if( !empty($query) ) {
			foreach($query as $value ) {
				$segments[] = $value;
			}
		}

        return implode('/',$segments);

    }

}