<?php
/**
 * @package b1-iframe-my-account
 */
/*
Plugin Name: b1-iframe-my-account.php
Plugin URI: https://waas1.com/
Description: Display an Iframe in wp admin
Version: 1.0.0
Author: Erfan
Author URI: https://waas1.com/
License: GPLv2 or later
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//if the call is from "wp-cli" don't run the code below
if ( defined( 'WP_CLI' ) && WP_CLI ) { return; }

//do not run if the call is ajax
if ( defined('DOING_AJAX') && DOING_AJAX) { return; }


//do not run if user is not in admin/backend side
if ( !is_admin() ) { return; }



//------------
//if we are here it means we are safe to run the rest of the script.
//------------




add_action( 'admin_menu', 'myshahbandr_iframe_my_account_admin_menu' );
function myshahbandr_iframe_my_account_admin_menu(){
	add_menu_page( 'My Account', 'My Account', 'manage_options', 'myshahbandr_account_page', 'myshahbandr_account_page_function', 'dashicons-chart-pie', 999);
}

function myshahbandr_account_page_function(){
?>
    <div id="poststuff" class="oa-document">
        <div class="postbox  hide-if-js" id="postexcerpt" style="display: block; height: 100vh;">
            <iframe src="https://myshahbandr.com/my-account/" width="100%" height="100%"></iframe>
        </div>
    </div>
<?php
}


?>