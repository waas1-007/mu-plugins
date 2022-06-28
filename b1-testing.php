<?php
/**
 * @package b1-testing
 */
/*
Plugin Name: b1-testing.php
Plugin URI: https://waas1.com/
Description: custom hooks only for this platform.
Version: 1.0.0
Author: Erfan
Author URI: https://waas1.com/
License: GPLv2 or later
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



if ( !is_admin() ) { 
	return; 
}

echo WP_CONTENT_DIR;
die;


?>