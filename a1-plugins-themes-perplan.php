<?php



function _filter_all_plugins($get_plugins)
{

    $plugins_allowed = [];
    $active_plugins = [];

    $plan = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plans/' . WAAS1_RESTRICTION_GROUP_ID . '.json'), true);

    if (isset($plan['plugins'])) {
        foreach ($get_plugins as $key =>  $plugin) {
            if (in_array($key, $plan['plugins']) or strpos($key, 'shahbandr') !== false) {
                $plugins_allowed[$key] = $plugin;
            }
        }
        
        foreach (get_option('active_plugins') as  $plugin) {
            if (!in_array($plugin, $plan['plugins']) and strpos($plugin, 'shahbandr') === false) {
                deactivate_plugins("/$plugin");
            }
        }
    }

    return  $plugins_allowed;
}

function filter_all_themes($get_themes)
{


    $themes_allowed = [];

    $plan = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plans/' . WAAS1_RESTRICTION_GROUP_ID . '.json'), true);
    if (isset($plan['themes'])) {
        foreach ($get_themes as $key =>  $theme) {
            if (in_array($key, $plan['themes'])) {
                $themes_allowed[$key] = $theme;
            }
        }
    }

    return $themes_allowed;
}

if (WAAS1_RESTRICTION_GROUP_ID != 1) {
    add_filter('all_plugins', '_filter_all_plugins', 99, 1);

    add_filter( 'wp_prepare_themes_for_js', 'filter_all_themes', 99, 2);
}
