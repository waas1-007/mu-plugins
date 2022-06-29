<?php



function _filter_all_plugins($get_plugins)
{

    $plugins_allowed = [];

    $plan = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/plans/' . WAAS1_RESTRICTION_GROUP_ID . '.json'), true);
    $critical_plugins = @json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/critical_plugins.json'), true);

    if (isset($plan['plugins'])) {
        foreach ($get_plugins as $key =>  $plugin) {
            if (in_array($key, $plan['plugins']) and !in_array($key, $critical_plugins)) {
                $plugins_allowed[$key] = $plugin;
            }
        }

        foreach (get_option('active_plugins') as  $plugin) {
            if (!in_array($plugin, $plan['plugins']) and !in_array($plugin, $critical_plugins)) {
                deactivate_plugins("/$plugin");
            }
        }
        foreach ($critical_plugins as $v) {
           
            if (!is_plugin_active($v)) {
                
                activate_plugin($v);
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

    add_filter('wp_prepare_themes_for_js', 'filter_all_themes', 99, 2);
    add_filter('show_advanced_plugins', function ($default, $type) {
        if ($type == 'mustuse') return false; // Hide Must-Use
        return $default;
    }, 10, 2);

    require_once __DIR__ . '/rebranding/rebranding.php';
}
