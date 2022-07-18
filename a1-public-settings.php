<?php
if (!defined('ABSPATH')) {
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
    $wp_admin_bar->remove_menu('rank-math');
    $wp_admin_bar->remove_menu('seopress_custom_top_level');
    $wp_admin_bar->remove_menu('trp_edit_translation');
    $wp_admin_bar->add_menu(
        array(
            'title'     => 'مسح الكاش',
            'href'  => '?remove_cash=remove_cash',
        )
    );
});
add_action('init', function () {
    if (isset($_GET['remove_cash']) and $_GET['remove_cash']) {
        if (function_exists('w3tc_flush_all')) {
            w3tc_flush_all();
        }
        wp_redirect($_SERVER['HTTP_REFERER']);
        exit;
    }
});

add_filter('login_title', function ($login_title) {
    return str_replace(array(' &lsaquo;', ' &#8212; WordPress', __('WordPress'), ' &#8212; ووردبريس', 'ووردبريس'), array(' &lsaquo;', ''), $login_title);
});


add_filter('admin_title', function ($admin_title) {
    return str_replace(array(' &lsaquo;', ' &#8212; WordPress', ('WordPress'), ' &lsaquo;', ' &#8212; ووردبريس'), array(' &lsaquo;', ''), $admin_title);
});

foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/uip/'), array('.', '..')) as $key => $__uip) {
    add_filter('pre_option_' . basename($__uip, '.json'), function ($plugins) use ($__uip) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/uip/' . $__uip, true), true);
    });
}

foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/pys/'), array('.', '..')) as $key => $__uip) {
    add_filter('pre_option_' . basename($__uip, '.json'), function ($plugins) use ($__uip) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/pys/' . $__uip, true), true);
    });
}
foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/menu-editor/'), array('.', '..')) as $key => $__editor) {
    add_filter('pre_option_' . basename($__editor, '.json'), function ($plugins) use ($__editor) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/menu-editor/' . $__editor, true), true);
    });
}

add_action('admin_footer', function () {
    if (current_user_can('administrator')) {
?>
        <script src="https://snippets.freshchat.com/js/fc-pre-chat-form-v2.min.js"></script>
        <script>
            var preChatTemplate = {
                //Form header color and Submit button color.
                mainbgColor: '#2d2d2d',
                //Form Header Text and Submit button text color.
                maintxColor: '#fff',
                //Chat Form Title
                heading: 'خدمة العملاء ',
                //Chat form Welcome Message
                textBanner: 'من فضلك ادخل البيانات المطلوبه للتحدث مع خدمة العملاء ',
                //Submit Button Label.
                SubmitLabel: 'ابدأ المحادثة',
                //Fields List - Maximum is 5
                //All the values are mandatory and the script will not work if not available.
                fields: {
                    field2: {
                        //Type for Name - Do not Change
                        type: "name",
                        //Label for Field Name, can be in any language
                        label: "الاسم",
                        //Default - Field ID for Name - Do Not Change
                        fieldId: "name",
                        //Required "yes" or "no"
                        required: "yes",
                        //Error text to be displayed
                        error: "ادخل الاسم بطريقه صحيحه"
                    },
                    field3: {
                        //Type for Email - Do Not Change
                        type: "email",
                        //Label for Field Email, can be in any language
                        label: " البريد الالكترونى المسجل لدينا",
                        //Default - Field ID for Email - Do Not Change
                        fieldId: "email",
                        //Required "yes" or "no"
                        required: "yes",
                        //Error text to be displayed
                        error: "ادخل عنوان بريد الكترونى صحيح"
                    },
                }
            };
            window.fcSettings = {
                token: "b7421e9a-140d-4c46-a3b2-fd9c4ccd1c11",
                host: "https://wchat.freshchat.com",
                config: {
                    cssNames: {
                        //The below element is mandatory. Please add any custom class or leave the default.
                        widget: 'custom_fc_frame',
                        //The below element is mandatory. Please add any custom class or leave the default.
                        expanded: 'custom_fc_expanded'
                    }
                },
                onInit: function() {
                    console.log('widget init');
                    fcPreChatform.fcWidgetInit(preChatTemplate);
                }
            };
        </script>
        <script src="https://wchat.freshchat.com/js/widget.js" async></script>
<?php
    }
});
