<?php

/**
 * @package 
 */
/*
Plugin Name: 
Plugin URI: https://waas1.com/
Description: custom hooks only for this platform.
Version: 1.0.0
Author: 
Author URI: https://waas1.com/
License: GPLv2 or later
*/


//change log
// version 1.0.1



// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { //this is for secuirty
	exit;
}

//do not run if user is not in back-end
if ( ! is_admin() ) { return; } //this is for performance


//if the call is from "wp-cli" don't run the code below
if ( defined( 'WP_CLI' ) && WP_CLI ) { return; } //this is important that controlpanel can see all the plugins



//do not run if the call is ajax
if ( defined('DOING_AJAX') && DOING_AJAX) { return; } //we do not need to run this in javascript ajax call = This is for perforamnce





//also please exclude your code for superduper.!!!
//First test this using sftp. Do not push the code on GIT while your are testing







//////
///Eslamn code is following
///////



//and please write comments.





function _filter_all_plugins($get_plugins)
{

    $plugins_allowed = [];

    $plan = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plans/' . WAAS1_RESTRICTION_GROUP_ID . '.json'), true);
    // $plan = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plans/2.json'), true);
    $critical_plugins = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plugins/critical_plugins.json'), true);
    $plugins_hidden = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plugins/plugins_hidden.json'), true);

    $plugins_hidden = array_merge($critical_plugins, (is_array($plugins_hidden) ? $plugins_hidden : []));
    if (isset($plan['plugins'])) {
        foreach ($get_plugins as $key =>  $plugin) {
            $plugin['hidden'] = 1;
            if (in_array($key, $plan['plugins']) and !in_array($key, $plugins_hidden)) {
                $plugins_allowed[$key] = $plugin;
            } else if ( !in_array($key, $plugins_hidden)){
                $plugin['hidden'] = 0;

                $plugins_allowed[$key] = $plugin;
            }
        }

        foreach (get_option('active_plugins') as  $plugin) {
            if (!in_array($plugin, $plan['plugins']) and !in_array($plugin, $plugins_hidden)) {
                deactivate_plugins("/$plugin");
            }
        }
        activate_plugin($critical_plugins);

    }

    return  $plugins_allowed;
}

function filter_all_themes($get_themes)
{


    $themes_allowed = [];

    $plan = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plans/' . WAAS1_RESTRICTION_GROUP_ID . '.json'), true);
    // $plan = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plans/2.json'), true);
    if (isset($plan['themes'])) {
        foreach ($get_themes as $key =>  $theme) {
            $theme['hidden'] =0;
            if (in_array($key, $plan['themes'])) {
                $themes_allowed[$key] = $theme;
            }else{
                $theme['hidden'] =-1;
                $themes_allowed[$key] = $theme;
                
            }
        }
    }
    return $themes_allowed;
}

if (WAAS1_RESTRICTION_GROUP_ID != 1) {
add_filter('all_plugins', '_filter_all_plugins', 99, 1);

add_filter('wp_prepare_themes_for_js', 'filter_all_themes', 1, 2);
add_filter('show_advanced_plugins', function ($default, $type) {
    if ($type == 'mustuse') return false; // Hide Must-Use
    return $default;
}, 10, 2);

require_once __DIR__ . '/rebranding/rebranding.php';
}