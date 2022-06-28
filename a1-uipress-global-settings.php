<?php
if (WAAS1_RESTRICTION_GROUP_ID != 1) {

require_once __DIR__.'/rebranding/rebranding.php';
}
foreach (array_diff(scandir(WPMU_PLUGIN_DIR . '/json/uip/'), array('.', '..')) as $key => $__uip) {
    add_filter('option_' . basename($__uip,'.json'), function ($plugins) use ($__uip) {
        return json_decode(file_get_contents(WPMU_PLUGIN_DIR . '/json/uip/' . $__uip,true),true);
    });
}
