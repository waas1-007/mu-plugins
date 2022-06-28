<?php
if (WAAS1_RESTRICTION_GROUP_ID != 1) {

    add_action('admin_init', function () {

        remove_submenu_page('options-general.php', 'uip-styles');
        remove_submenu_page('options-general.php', 'uip-settings');
        if (isset($_GET['page']) and in_array($_GET['page'], ['uip-styles', 'uip-settings'])) {
            wp_redirect(admin_url());
            exit;
        }
    }, 999);
    
}
foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/uip/'), array('.', '..')) as $key => $__uip) {
    add_filter('option_' . basename($__uip, '.json'), function ($plugins) use ($__uip) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/uip/' . $__uip, true), true);
    });
}

