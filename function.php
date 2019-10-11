<?php
/*
Plugin Name: Preparator for mod_pagespeed
Plugin URI: https://github.com/Nemolo/wp-mod_pagespeed-preparator
Description: Fixes to allow mod_pagespeed to better optimise your site.
Version: 1.0.1
Author: Fabrizio Marconi @ Jef
License: GPLv3+
*/

/** Fix stylesheets by removing id and media attributes, they can be combined. thanks to http://sambull.org */

add_filter( 'style_loader_tag', function ( $html ) {
	if ( preg_match( '/rel=(["\'])stylesheet\1/isS', $html ) ) {
		$html = preg_replace( '/id=(["\']).*?\1/isS', '', $html );
		$html = preg_replace( '/media=(["\']).*?\1/isS', '', $html );
	}

	return $html;
} );

add_filter( 'style_loader_src', function ( $src, $handle ) {
	return str_replace( site_url(), '', $src );
}, 20, 2 );

add_filter( 'script_loader_src', function ( $src, $handle ) {
	return str_replace( site_url(), '', $src );
}, 20, 2 );

