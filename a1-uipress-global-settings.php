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
if (!defined('ABSPATH')) { //this is for secuirty
    exit;
}

//do not run if user is not in back-end
if (!is_admin()) {
    return;
} //this is for performance


//if the call is from "wp-cli" don't run the code below
if (defined('WP_CLI') && WP_CLI) {
    return;
} //this is important that controlpanel can see all the plugins



//do not run if the call is ajax
if (defined('DOING_AJAX') && DOING_AJAX) {
    return;
} //we do not need to run this in javascript ajax call = This is for perforamnce





//also please exclude your code for superduper!!!!
//First test this using sftp. Do not push the code on GIT while your are testing






//////
///Eslamn code is following
///////



if (WAAS1_RESTRICTION_GROUP_ID != 1) {
    add_filter('site_transient_update_plugins', '__return_false');
    add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );


    add_filter('auto_update_plugin', '__return_false');

    add_filter('auto_update_theme', '__return_false');
    remove_action('load-update-core.php', 'wp_update_plugins');

    add_action('admin_head', function () {
        echo '<style>
    .theme.add-new-theme ,span.theme-count,span.plugin-count,
    .themes-php a.hide-if-no-js.page-title-action,
    a.button.delete-theme,
    .plugins-php a.page-title-action{
        display: none;
    }
      </style>';
    });

    add_action( 'admin_menu',function () {
        remove_submenu_page('options-general.php', 'uip-styles');
        remove_submenu_page('options-general.php', 'uip-settings');
        remove_submenu_page('tools.php', 'action-scheduler');
        remove_submenu_page('index.php', 'update-core.php');
        remove_submenu_page('rank-math', 'rank-math-status');
        remove_submenu_page('woocommerce', 'wc-status');
        remove_submenu_page('yith_plugin_panel', 'yith_system_info');
        remove_submenu_page('yith_plugin_panel', 'yith_plugins_activation');
        remove_submenu_page('pixelyoursite', 'pixelyoursite_report');
        remove_submenu_page('pixelyoursite', 'pixelyoursite_licenses');
    },99999);

    add_action('admin_init', function () {

        $skip_links = [
            'theme-install.php',
            'plugin-install.php',
            'update-core.php'
        ];
        $skip_pages = [
            'uip-styles',
            'uip-settings',
            'rank-math-status',
            'wc-status',
            'yith_system_info',
            'pixelyoursite_licenses',
        ];

        if (
            in_array(basename($_SERVER['DOCUMENT_URI']), $skip_links) or
            (basename($_SERVER['DOCUMENT_URI']) == 'themes.php' and $_GET['action'] == 'delete') or
            (isset($_GET['page']) and in_array($_GET['page'], $skip_pages))
        ) {
            wp_redirect(admin_url('admin.php?page=uip-overview'));
            exit;
        }
    }, 9999, 99);
}
foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/uip/'), array('.', '..')) as $key => $__uip) {
    add_filter('option_' . basename($__uip, '.json'), function ($plugins) use ($__uip) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/uip/' . $__uip, true), true);
    });
}
foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/pys/'), array('.', '..')) as $key => $__uip) {
    add_filter('option_' . basename($__uip, '.json'), function ($plugins) use ($__uip) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/pys/' . $__uip, true), true);
    });
}
foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/menu-editor/'), array('.', '..')) as $key => $__editor) {
    add_filter('option_' . basename($__editor, '.json'), function ($plugins) use ($__editor) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/menu-editor/' . $__editor, true), true);
    });
}
