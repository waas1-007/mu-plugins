<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
   
    $wp_admin_bar->remove_menu('et-top-bar-general-menu'); 
    $wp_admin_bar->remove_menu('et-panel-welcome'); 
    $wp_admin_bar->remove_menu('et-theme-settings'); 
    $wp_admin_bar->remove_menu('w3tc'); 
    $wp_admin_bar->remove_menu('w3tc_flush'); 
    $wp_admin_bar->remove_menu('w3tc_flush_objectcache'); 
    $wp_admin_bar->remove_menu('new-elementor_library'); 
    $wp_admin_bar->remove_menu('w3tc_flush_pgcache'); 
    $wp_admin_bar->remove_menu('autoptimize-cache-info'); 
    $wp_admin_bar->remove_menu('autoptimize-delete-cache'); 
    $wp_admin_bar->remove_menu('et-theme-settings'); 
    $wp_admin_bar->remove_menu('et-settings-general'); 
    $wp_admin_bar->remove_menu('new-e-landing-page'); 
    
});