<?php
/**
 * @package waas1-fix-language
 */
/*
Plugin Name:  waas1-fix-language.php
Plugin URI: https://waas1.com/
Description: Will try to fix the language path because of multi tenant environment
Version: 1.0.0
Author: Erfan
Author URI: https://waas1.com/
License: GPLv2 or later
*/


//WP_LANG_DIR

add_filter( 'load_textdomain_mofile', function( $mofile, $domain ){
	
	//first see if we are able to reach the mo file
	if( file_exists($mofile) ){ 
		return $mofile; //good return from here
	}else{
		
		//overwrite the path
		$locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
		$newmofile =  WP_PLUGIN_DIR.'/'.$domain.'/languages/'.$domain.'-'.$locale.'.mo';
		if( file_exists($newmofile) ){
			return $newmofile; //good return from here
		}
	}
	
	return $mofile; //else just return what was originally there
	
}, 99999, 2 );




?>