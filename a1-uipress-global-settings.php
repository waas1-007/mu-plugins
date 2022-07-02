<?php
if (WAAS1_RESTRICTION_GROUP_ID != 1) {
add_action('admin_head', function () {
    echo '<style>
    .theme.add-new-theme ,span.theme-count,span.plugin-count,
    .themes-php a.hide-if-no-js.page-title-action,
    a.button.delete-theme{
        display: none;
    }
      </style>';
});

add_action('admin_init', function () {
    remove_submenu_page('options-general.php', 'uip-styles');
    remove_submenu_page('options-general.php', 'uip-settings');
    if (
        basename($_SERVER['DOCUMENT_URI']) == 'theme-install.php' or
        (basename($_SERVER['DOCUMENT_URI']) == 'themes.php' and $_GET['action'] == 'delete') or
        (isset($_GET['page']) and in_array($_GET['page'], ['uip-styles', 'uip-settings']))
    ) {
        wp_redirect(admin_url('admin.php?page=uip-overview'));
        exit;
    }
}, 999);
}
foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/uip/'), array('.', '..')) as $key => $__uip) {
    add_filter('option_' . basename($__uip, '.json'), function ($plugins) use ($__uip) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/uip/' . $__uip, true), true);
    });
}

foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/menu-editor/'), array('.', '..')) as $key => $__editor) {
    add_filter('option_' . basename($__editor, '.json'), function ($plugins) use ($__editor) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/menu-editor/' . $__editor, true), true);
    });
}
