<?php

/**
 * @package 
 */
/*
Plugin Name:  admin-tune
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





//also please exclude your code for superduper.!!!
//First test this using sftp. Do not push the code on GIT while your are testing





if (WAAS1_RESTRICTION_GROUP_ID != 1) {

    function wp_custom_css()
    {
        echo '<style>
        .woocommerce-embed-page #wpbody .woocommerce-layout, .woocommerce-embed-page .woocommerce-layout__notice-list-hide+.wrap {
            padding-top: 10px;
        }
        .woocommerce-embed-page #screen-meta, .woocommerce-embed-page #screen-meta-links {
            top: 0px;
        }
        .woocommerce-layout__header {
            display: none;
        }
        .woocommerce-layout__activity-panel-tabs {
            display: none;
        }
        .woocommerce-layout__header-breadcrumbs {
            display: none;
        }
        </style>';
    }
    add_action('admin_head', 'wp_custom_css');

    add_filter('login_title', function ($login_title) {
        return str_replace(array(' &lsaquo;', ' &#8212; WordPress', __('WordPress'), ' &#8212; ووردبريس', 'ووردبريس'), array(' &lsaquo;', ''), $login_title);
    });


    add_filter('admin_title', function ($admin_title) {
        return str_replace(array(' &lsaquo;', ' &#8212; WordPress', ('WordPress'), ' &lsaquo;', ' &#8212; ووردبريس'), array(' &lsaquo;', ''), $admin_title);
    });


    function cs_add_remove_otherpage_menus()
    {

        remove_menu_page('qlwcdc');
        remove_submenu_page('oceanwp-panel', 'edit.php?post_type=oceanwp_library');
        remove_submenu_page('oceanwp-panel', 'oceanwp_library');
        remove_submenu_page('oceanwp-panel', 'oceanwp-panel-scripts');
        remove_submenu_page('oceanwp-panel', 'oceanwp-panel-import-export');
        remove_submenu_page('oceanwp-panel', 'oceanwp-panel-install-demos');
        remove_submenu_page('options-general.php', 'settings-page-gutenslider');
        remove_submenu_page('index.php', 'owp_setup');
        remove_submenu_page('themes.php', 'custom-header');
        remove_submenu_page('themes.php', 'customize');
        remove_submenu_page('themes.php', 'ignition-medi-onboard');
        remove_submenu_page('themes.php', 'ignition-nozama-onboard');
        remove_submenu_page('themes.php', 'ignition-milos-onboard');
        remove_submenu_page('themes.php', 'ignition-convert-onboard');
        remove_submenu_page('themes.php', 'ignition-spencer-onboard');
        remove_submenu_page('themes.php', 'ignition-amaryllis-onboard');
        remove_submenu_page('themes.php', 'ignition-neto-onboard');
        remove_submenu_page('themes.php', 'ignition-decorist-onboard');
        remove_submenu_page('themes.php', 'ignition-loge-onboard');
    }
    add_action('admin_menu', 'cs_add_remove_otherpage_menus', 9999);

    add_action('admin_menu', function () {
        global $submenu;
        if (isset($submenu['themes.php'])) {
            foreach ($submenu['themes.php'] as $index => $menu_item) {
                foreach ($menu_item as $value) {
                    if (strpos($value, 'header_image') !== false) {
                        unset($submenu['themes.php'][$index]);
                    }
                }
            }
        }
    });

    add_action('init', 'cs_remove_sidebarmenu', 999);
    function cs_remove_sidebarmenu()
    {
        remove_action('admin_menu', array('Ocean_Extra_Theme_Panel', 'add_page'), 0);
    }


    //hide sequential order number tab in woocommerce setting page
    add_filter('woocommerce_settings_tabs_array', 'shah_filter_wc_settings_tabs_array', 999, 1);
    function shah_filter_wc_settings_tabs_array($tabs_array)
    {

        if (!is_super_admin()) {
            unset($tabs_array['wts_settings']);
        }

        return $tabs_array;
    }

    //change register link
    // add_filter('register_url', 'custom_register_url');
    // function custom_register_url($register_url)
    // {
    //     $register_url = 'https://shahbandr.com/pricing/';
    //     return $register_url;
    // }


    //Fb code Type1
    // function add_section_main_subsection_facebook_custom($section_ids)
    // {

    //     add_settings_field(
    //         'wgact_plugin_subsection_facebook_custom_opening_div',
    //         esc_html__(
    //             'كود التحقق من النطاق Facebook domain verification code',
    //             'woocommerce-google-adwords-conversion-tracking-tag'
    //         ),
    //         'cs_fb_setting_callback_function',
    //         'wpm_plugin_options_page',
    //         $section_ids['settings_name']
    //     );
    // }

    // function cs_fb_setting_callback_function()
    // {

    //     $cs_wgact_plugin_options = get_option('wgact_plugin_options');
    //     $custom_tracking_code = $cs_wgact_plugin_options['facebook']['custom_tracking_code'];

    //     echo "<input type='text' id='wgact_plugin_facebook_custom_tracking_code' name='wgact_plugin_options[facebook][custom_tracking_code]' value='" . $custom_tracking_code . "' size='40'>";

    //     echo '<br>';
    //     echo htmlspecialchars('مثال على محتوى الكود كامل <meta name="facebook-domain-verification" content="ylpqp4rux0jm8ez0zhpwknuok0rbcm" />');
    //     echo '<br>';
    //     esc_html_e('مثال على القيمة التى يتم اضافتها بالاعلى ylpqp4rux0jm8ez0zhpwknuok0rbcm', 'woocommerce-google-adwords-conversion-tracking-tag');
    // }
    // create custom plugin settings menu
    add_action('admin_menu', 'cs_create_facebook_menu');
    function cs_create_facebook_menu()
    {

        add_submenu_page('woocommerce', 'Facebook Code', 'Facebook Code', 'administrator', 'custom_facebook_code', 'cs_facebook_code_setting');
    }



    function cs_facebook_code_setting()
    { ?>
        <div class="wrap">
            <h1><?php echo esc_html__(
                    'كود التحقق من النطاق Facebook domain verification code',
                    'woocommerce-google-adwords-conversion-tracking-tag'
                ); ?></h1>

            <form method="post" action="">

                <?php
                if (isset($_POST['cs_update_facebook_code_nonce']) && wp_verify_nonce($_POST['cs_update_facebook_code_nonce'], 'cs_update_facebook_code') && isset($_REQUEST['cs_facebook_code'])) {
                    $cs_fb_code = esc_attr($_REQUEST['cs_facebook_code']);
                    //update_option( 'cs_facebook_code', $cs_fb_code );

                    $cs_wgact_plugin_options = get_option('wgact_plugin_options');
                    $cs_wgact_plugin_options['facebook']['custom_tracking_code'] = $cs_fb_code;
                    update_option('wgact_plugin_options', $cs_wgact_plugin_options);
                } ?>

                <?php
                $cs_wgact_plugin_options = get_option('wgact_plugin_options');
                $cs_fb_code = $cs_wgact_plugin_options['facebook']['custom_tracking_code']; ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo esc_html__(
                                            'كود التحقق من النطاق Facebook domain verification code',
                                            'woocommerce-google-adwords-conversion-tracking-tag'
                                        ); ?></th>
                        <td><input type="text" name="cs_facebook_code" id="cs_facebook_code" value="<?php echo esc_attr($cs_fb_code); ?>" size="40">
                            <?php
                            echo '<br>';
                            echo htmlspecialchars('مثال على محتوى الكود كامل <meta name="facebook-domain-verification" content="ylpqp4rux0jm8ez0zhpwknuok0rbcm" />');
                            esc_html_e('مثال على القيمة التى يتم اضافتها بالاعلى ylpqp4rux0jm8ez0zhpwknuok0rbcm', 'woocommerce-google-adwords-conversion-tracking-tag');
                            ?>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">&nbsp;</th>
                        <td>
                        </td>
                    </tr>
                </table>

                <?php wp_nonce_field('cs_update_facebook_code', 'cs_update_facebook_code_nonce'); ?>
                <?php submit_button(); ?>

            </form>
        </div>
<?php
    }

    //add fb code in head
    add_action('wp_head', 'add_fb_meta_tag_in_header', 99);
    function add_fb_meta_tag_in_header()
    {

        $cs_wgact_plugin_options = get_option('wgact_plugin_options');
        $custom_tracking_code = $cs_wgact_plugin_options['facebook']['custom_tracking_code'];
        if ($custom_tracking_code != "") {
            $output = $custom_tracking_code;
            echo '<meta name="facebook-domain-verification" content="' . $output . '" />' . "\n";
        }
    }


    /* Woocommerce Advanced Admin Menu */
    add_filter('woocommerce_get_sections_advanced', 'cs_woocommerce_get_sections_advanced', 99, 1);
    function cs_woocommerce_get_sections_advanced($sections)
    {

        if (!current_user_can('manage_network')) {
            unset($sections['keys']);
            unset($sections['webhooks']);
            unset($sections['legacy_api']);
            unset($sections['woocommerce_com']);
            unset($sections['features']);
        }
        return $sections;
    }
}
