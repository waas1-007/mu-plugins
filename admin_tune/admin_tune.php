<?php
   /*
   Plugin Name: Admin Tuning
   Plugin URI: https://shahbandr.com
   description: Tune Admin
   Version: 1.0
   Author: Shahbandr
   Author URI: https://shahbandr.com
   License: GPL2
   */
// WordPress Custom Font @ Admin
function load_custom_wp_admin_style(){
    wp_register_style( 'custom_wp_admin_css', plugins_url( '/css/admin-style.css', __FILE__ ), false, rand() );
    wp_enqueue_style( 'custom_wp_admin_css' );
	
	wp_register_script( 'custom_wp_admin_js', plugins_url( '/js/admin-script.js', __FILE__ ), false, rand() );
    wp_enqueue_script( 'custom_wp_admin_js' );
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

function load_custom_wp_frontend_style(){
    wp_register_style( 'custom_wp_frontend_css', plugins_url( '/css/custom-frontend-style.css', __FILE__ ), false, rand() );
    wp_enqueue_style( 'custom_wp_frontend_css' );
	
	wp_register_script( 'custom_wp_frontend_js', plugins_url( '/js/custom-frontend-script.js', __FILE__ ), false, rand(), true );
    wp_enqueue_script( 'custom_wp_frontend_js' );
}
add_action('wp_enqueue_scripts', 'load_custom_wp_frontend_style');

function custom_admin_open_sans_font() {
    echo '<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">' . PHP_EOL;
    echo '<style>body, #wpadminbar *:not([class="ab-icon"]), .wp-core-ui, .media-menu, .media-frame *, .media-modal *{font-family: "Tajawal", sans-serif !important;}</style>' . PHP_EOL;
}
add_action( 'admin_head', 'custom_admin_open_sans_font' );
// WordPress Custom Font @ Admin Frontend Toolbar
function custom_admin_open_sans_font_frontend_toolbar() {
    if(current_user_can('administrator')) {
        echo '<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">' . PHP_EOL;
        echo '<style>#wpadminbar *:not([class="ab-icon"]){font-family: "Tajawal", sans-serif !important;}</style>' . PHP_EOL;
    }
}
add_action( 'wp_head', 'custom_admin_open_sans_font_frontend_toolbar' );

// WordPress Custom Font @ Admin Login
function custom_admin_open_sans_font_login_page() {
    if(stripos($_SERVER["SCRIPT_NAME"], strrchr(wp_login_url(), '/')) !== false) {
        echo '<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">' . PHP_EOL;
        echo '<style>body{font-family:"Tajawal", sans-serif !important;}</style>' . PHP_EOL;
   }
}
add_action( 'login_head', 'custom_admin_open_sans_font_login_page' );

// Remove WP Icon
function example_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0 );

// Remove Run Cloud Hub Link from top bar
function wpdocs_remove_customize( $wp_admin_bar ) {
    // Remove customize, background and header from the menu bar.   
    $wp_admin_bar->remove_node( 'runcloud-hub' );  
    //$wp_admin_bar->remove_node( '_options' );   
    //$wp_admin_bar->remove_node( 'archive' );
	//$wp_admin_bar->remove_node( 'comments' );
	//$wp_admin_bar->remove_node( 'edit' );
	
}
add_action( 'admin_bar_menu', 'wpdocs_remove_customize', 999 );


// Adds a new element in an array on the exact place we want (if possible).
function my_awesome_add_element_to_array( $original_array, $add_element_key, $add_element_value, $add_before_key ) {

    // This variable shows if we were able to add the element where we wanted
    $added = 0;

    // This will be the new array, it will include our element placed where we want
    $new_array = array();

    // We go through all the current elements and we add our new element on the place we want
    foreach( $original_array as $key => $value ) {

        // We put the element before the key we want
        if ( $key == $add_before_key ) {
            $new_array[ $add_element_key ] = $add_element_value;

            // We were able to add the element where we wanted so no need to add it again later
            $added = 1;
        }

        // All the normal elements remain and are added to the new array we made
        $new_array[ $key ] = $value;
    }

    // If we failed to add the element earlier (because the key we tried to add it in front of is gone) we add it now to the end
    if ( 0 == $added ) {
        $new_array[ $add_element_key ] = $add_element_value;
    }

    // We return the new array we made
    return $new_array;
}
//add_filter( 'wpmu_users_custom_column', 'my_awesome_column_data', 10, 3 );
//add columns to User panel list page
// function add_user_columns($column) {
//     $column['Mobile'] = 'Mobile';

//     return $column;
// }
// add_filter( 'wpmu_users_columns', 'add_user_columns' );

// //add the data
// function add_user_column_data( $val, $column_name, $user_id ) {
//     $user = get_userdata($user_id);
//     $key = 'Mobile';
//     $single = false;
//     $user_mobile = get_user_meta( $user_id, $key, $single );
//     switch ($column_name) {
//         case 'Mobile' :
//             //echo $user_mobile;
//             return $user->last_name;
//             break;
//         default:
//     }
//     return;
// }
// add_filter( 'wpmu_users_custom_column', 'add_user_column_data', 25, 3 );
/**
 * Removes media buttons from post types.
 */
add_filter( 'wp_editor_settings', function( $settings ) {
    $current_screen = get_current_screen();

    // Post types for which the media buttons should be removed.
    $post_types = array( 'product' );

    // Bail out if media buttons should not be removed for the current post type.
    if ( ! $current_screen || ! in_array( $current_screen->post_type, $post_types, true ) ) {
        return $settings;
    }

    $settings['media_buttons'] = false;

    return $settings;
} );
function wp_custom_css() {
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


function remove_from_admin_bar($wp_admin_bar) {
    /*
     * Placing items in here will only remove them from admin bar
     * when viewing the fronte end of the site
    */
    if ( ! is_admin() ) {
        // Example of removing item generated by plugin. Full ID is #wp-admin-bar-si_menu
        $wp_admin_bar->remove_node('wpforms-menu');
 
        // WordPress Core Items (uncomment to remove)
       // $wp_admin_bar->remove_node('updates');
        //$wp_admin_bar->remove_node('comments');
        
        //$wp_admin_bar->remove_node('wp-logo');
        //$wp_admin_bar->remove_node('site-name');
        //$wp_admin_bar->remove_node('my-account');
        //$wp_admin_bar->remove_node('search');
        //$wp_admin_bar->remove_node('customize');
    }
 
    /*
     * Items placed outside the if statement will remove it from both the frontend
     * and backend of the site
    */
    
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('my-sites');
}

add_filter( 'login_title',function($login_title){
	return str_replace(array( ' &lsaquo;', ' &#8212; WordPress',__('WordPress'),), array( ' &lsaquo;', ''),$login_title );
});

function custom_login_title( $login_title ) {
return str_replace(array( ' &lsaquo;', ' &#8212; ووردبريس'), array( ' &lsaquo;', ''),$login_title );
}
add_filter( 'login_title', 'custom_login_title' );

add_filter( 'admin_title',function($admin_title){
	return str_replace(array( ' &lsaquo;', ' &#8212; WordPress',('WordPress'),), array( ' &lsaquo;', ''),$admin_title );
});

function custom_admin_title( $admin_title ) {
return str_replace(array( ' &lsaquo;', ' &#8212; ووردبريس'), array( ' &lsaquo;', ''),$admin_title );
}
add_filter( 'admin_title', 'custom_admin_title' );

/**
 * Enable unfiltered_html capability for Editors.
 *
 * @param  array  $caps    The user's capabilities.
 * @param  string $cap     Capability name.
 * @param  int    $user_id The user ID.
 * @return array  $caps    The user's capabilities, with 'unfiltered_html' potentially added.
 */
function km_add_unfiltered_html_capability_to_editors( $caps, $cap, $user_id ) {

	if ( 'unfiltered_html' === $cap && user_can( $user_id, 'administrator' ) ) {

		$caps = array( 'unfiltered_html' );

	}

	return $caps;
}
add_filter( 'map_meta_cap', 'km_add_unfiltered_html_capability_to_editors', 1, 3 );

add_filter('wu_search_and_replace_on_duplication', function($replace_list, $from_site_id, $to_site_id) {
 
  switch_to_blog( get_current_site()->blog_id );
  
    /**
     * 
     * Transient carries:
     * 
     * 'plan_freq' : The billing frequency chosen by the user (1, 3 or 12);
     * 'plan_id' : The ID of the plan chosen by the user;
     * 'template' : The ID of the site to be used as a template (0 for the default WordPress site);
     * 'blog_title' : The title chosen to the user's site;
     * 'blogname' : The slug of the user's site (the slug portion of yournetwork.com/slug);
     * 'user_name' : Username chosen by the user;
     * 'user_email' : User email entered by the user;
     * 'coupon' : Coupon code name, if entered;
     * 
     * + Whatever custom fields you have added to the sign-up flow =)
     * 
     */
    $transient = WU_Signup()->get_transient(false);

  restore_current_blog();

  $replace_list['noreply1@shahbandr.com'] = $transient['user_email']; // Replace with the user's email
  $replace_list['Shahbandr']  = $transient['blogname']; // ... You can add as many items as you want
 
  return $replace_list;
 
}, 10, 3);


//Display phone no edit profile
add_action('show_user_profile', 'cs_display_phone_number_field_admin_editprofile', 99);
add_action('edit_user_profile', 'cs_display_phone_number_field_admin_editprofile', 99);
function cs_display_phone_number_field_admin_editprofile( $user ) {
?>
    <table class="form-table">
        <tr>
            <th>
                <label for="Mobile"><?php _e( 'Mobile' ); ?></label>
            </th>
            <td>
                <input type="text" name="Mobile" id="Mobile" value="<?php echo esc_attr( get_the_author_meta( 'Mobile', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
    </table>
<?php
}
 

// Hook is used to save custom fields that have been added to the WordPress profile page (if current user) 
add_action( 'personal_options_update', 'cs_update_phone_number_field_admin_editprofile', 99 );
add_action( 'edit_user_profile_update', 'cs_update_phone_number_field_admin_editprofile', 99 );

function cs_update_phone_number_field_admin_editprofile( $user_id ) {
    if ( current_user_can( 'edit_user', $user_id ) )
        update_user_meta( $user_id, 'Mobile', $_POST['Mobile'] );
}

//for change pixel menu 
function cs_add_remove_pixelmenu() {
	
	remove_menu_page( 'pixelyoursite' );
	remove_submenu_page( 'pixelyoursite', 'pixelyoursite_licenses' );
	remove_submenu_page( 'pixelyoursite', 'pixelyoursite_report' );
	
	add_menu_page( 'Marketing Pro', 'Marketing Pro', 'manage_pys', 'pixelyoursite', 'adminPageMain', PYS_URL . '/dist/images/favicon.png', 99 );
}
//add_action( 'admin_menu', 'cs_add_remove_pixelmenu', 999 );

//hide menu bar icon
function cs_remove_adminbar_menu(){
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('new-content');
        $wp_admin_bar->remove_menu('my-sites');
}
add_action( 'wp_before_admin_bar_render', 'cs_remove_adminbar_menu' );

//For remove menus
function cs_add_remove_otherpage_menus() {
	
    remove_menu_page( 'qlwcdc' );
    remove_submenu_page( 'oceanwp-panel', 'edit.php?post_type=oceanwp_library' );
    remove_submenu_page( 'oceanwp-panel', 'oceanwp_library' );
    remove_submenu_page( 'oceanwp-panel', 'oceanwp-panel-scripts' );
    remove_submenu_page( 'oceanwp-panel', 'oceanwp-panel-import-export' );
    remove_submenu_page( 'oceanwp-panel', 'oceanwp-panel-install-demos' );
    remove_submenu_page('options-general.php', 'settings-page-gutenslider');
	remove_submenu_page('index.php', 'owp_setup');
	remove_submenu_page('themes.php', 'custom-header');
	remove_submenu_page( 'themes.php', 'customize' );
	remove_submenu_page( 'themes.php', 'ignition-medi-onboard' );
	remove_submenu_page( 'themes.php', 'ignition-nozama-onboard' );
	remove_submenu_page( 'themes.php', 'ignition-milos-onboard' );
	remove_submenu_page( 'themes.php', 'ignition-convert-onboard' );
	remove_submenu_page( 'themes.php', 'ignition-spencer-onboard' );
	remove_submenu_page( 'themes.php', 'ignition-amaryllis-onboard' );
	remove_submenu_page( 'themes.php', 'ignition-neto-onboard' );
	remove_submenu_page( 'themes.php', 'ignition-decorist-onboard' );
	remove_submenu_page( 'themes.php', 'ignition-loge-onboard' );
}
add_action( 'admin_menu', 'cs_add_remove_otherpage_menus', 9999	 );

add_action( 'admin_menu', function () {
global $submenu;
if ( isset( $submenu[ 'themes.php' ] ) ) {
    foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
		 foreach ($menu_item as $value) {
			if (strpos($value,'header_image') !== false) {
                unset( $submenu[ 'themes.php' ][ $index ] );
            }
        }
    }
}
});

add_action('init', 'cs_remove_sidebarmenu', 999);
function cs_remove_sidebarmenu() {
	remove_action( 'admin_menu', array( 'Ocean_Extra_Theme_Panel', 'add_page' ), 0 );
}
function admin_color_scheme() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}
add_action('admin_head', 'admin_color_scheme');

//hide sequential order number tab in woocommerce setting page
add_filter( 'woocommerce_settings_tabs_array', 'shah_filter_wc_settings_tabs_array', 999, 1 );
function shah_filter_wc_settings_tabs_array( $tabs_array ) {
	
	if ( ! is_super_admin() ) {
		unset($tabs_array['wts_settings']);
	}
	
	return $tabs_array;
}

//change register link
add_filter( 'register_url', 'custom_register_url' );
function custom_register_url( $register_url ) {
    $register_url = 'https://shahbandr.com/pricing/';
    return $register_url;
}

//add network active plugins in active plugin filter
function filter_active_plugins( $site_active_plugins ) {
	$network_active_plugins = get_site_option('active_sitewide_plugins');
	foreach($network_active_plugins as $key => $value) {
		array_push($site_active_plugins, $key);
	}
	return $site_active_plugins; 
}; 
add_filter( 'active_plugins', 'filter_active_plugins', 10, 1 );

//menu active when sales booster sub pages open
add_action( 'admin_footer', 'cs_add_inline_script_in_footer', 999 );
function cs_add_inline_script_in_footer() {
	if(is_admin() && ( ($_REQUEST['post_type'] == 'sb_checkout_booster') || ($_REQUEST['post_type'] == 'sb_order_booster') || ($_REQUEST['post_type'] == 'sb_bought_together') ) ) { ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.uip-flex a[href="admin.php?page=sb-sales-booster"]').next('span').click();
		});
	</script>
	<?php
	}
}

//Fb code Type1
function add_section_main_subsection_facebook_custom($section_ids) {
	
	add_settings_field(
		'wgact_plugin_subsection_facebook_custom_opening_div',
		esc_html__(
			'كود التحقق من النطاق Facebook domain verification code',
			'woocommerce-google-adwords-conversion-tracking-tag'
		),
		'cs_fb_setting_callback_function',
		'wpm_plugin_options_page',
		$section_ids['settings_name']
	);

}

function cs_fb_setting_callback_function() {
	
	$cs_wgact_plugin_options = get_option('wgact_plugin_options');
	$custom_tracking_code = $cs_wgact_plugin_options['facebook']['custom_tracking_code'];
   
	echo "<input type='text' id='wgact_plugin_facebook_custom_tracking_code' name='wgact_plugin_options[facebook][custom_tracking_code]' value='".$custom_tracking_code."' size='40'>";
	
	echo '<br>';
    echo htmlspecialchars('مثال على محتوى الكود كامل <meta name="facebook-domain-verification" content="ylpqp4rux0jm8ez0zhpwknuok0rbcm" />');
	echo '<br>';
    esc_html_e('مثال على القيمة التى يتم اضافتها بالاعلى ylpqp4rux0jm8ez0zhpwknuok0rbcm','woocommerce-google-adwords-conversion-tracking-tag');
	  
}

//Fb code Type2
// create custom plugin settings menu
add_action('admin_menu', 'cs_create_facebook_menu');
function cs_create_facebook_menu() {

	add_submenu_page('woocommerce', 'Facebook Code', 'Facebook Code', 'administrator', 'custom_facebook_code', 'cs_facebook_code_setting' );
}

function cs_facebook_code_setting() { ?>
<div class="wrap">
<h1><?php echo esc_html__(
			'كود التحقق من النطاق Facebook domain verification code',
			'woocommerce-google-adwords-conversion-tracking-tag'
		);?></h1>

<form method="post" action="">
	
	<?php
	if (isset( $_POST['cs_update_facebook_code_nonce'] ) && wp_verify_nonce( $_POST['cs_update_facebook_code_nonce'], 'cs_update_facebook_code' ) && isset($_REQUEST['cs_facebook_code']) ) {
		$cs_fb_code = esc_attr($_REQUEST['cs_facebook_code']);
		//update_option( 'cs_facebook_code', $cs_fb_code );
		
		$cs_wgact_plugin_options = get_option('wgact_plugin_options');
		$cs_wgact_plugin_options['facebook']['custom_tracking_code'] = $cs_fb_code;
		update_option( 'wgact_plugin_options', $cs_wgact_plugin_options );
		
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
		<td><input type="text" name="cs_facebook_code" id="cs_facebook_code" value="<?php echo esc_attr( $cs_fb_code ); ?>"  size="40">
		<?php 
		echo '<br>';
		echo htmlspecialchars('مثال على محتوى الكود كامل <meta name="facebook-domain-verification" content="ylpqp4rux0jm8ez0zhpwknuok0rbcm" />');
		esc_html_e('مثال على القيمة التى يتم اضافتها بالاعلى ylpqp4rux0jm8ez0zhpwknuok0rbcm','woocommerce-google-adwords-conversion-tracking-tag');
		?>
		</td>
        </tr>
        
		<tr valign="top">
        <th scope="row">&nbsp;</th>
		<td>
		</td>
        </tr>	
    </table>
    
	<?php wp_nonce_field( 'cs_update_facebook_code', 'cs_update_facebook_code_nonce' ); ?>	
    <?php submit_button(); ?>

</form>
</div>
<?php
}

//add fb code in head
add_action('wp_head','add_fb_meta_tag_in_header', 99);
function add_fb_meta_tag_in_header() {

	$cs_wgact_plugin_options = get_option('wgact_plugin_options');
	$custom_tracking_code = $cs_wgact_plugin_options['facebook']['custom_tracking_code'];
	if($custom_tracking_code!="") {
		$output= $custom_tracking_code;
		echo '<meta name="facebook-domain-verification" content="'.$output.'" />' . "\n";
	}
	
}


add_shortcode( 'sitename', function() { return get_bloginfo(); } );
function display_year() {
    $year = date('Y');
    return $year;
}
add_shortcode('year', 'display_year');

//Add Og image tag in head
 function insert_fb_in_head() {
    global $post;
	if ( !is_single() && 'product' == get_post_type() ) {
        return;
	}
	$post_id = $post->ID;
	$featured_image_by_url = get_post_meta( $post_id, '_knawatfibu_url' , true );
	if($featured_image_by_url) {
		if($featured_image_by_url['img_url']!='') { 
			$cs_og_image=$featured_image_by_url['img_url'];
			echo '<meta property="og:image" content="' . $cs_og_image . '"/>';
				echo "
				";
		}
	}
}
//add_action( 'wp_head', 'insert_fb_in_head', 10 );

/* Woocommerce Advanced Admin Menu */
add_filter('woocommerce_get_sections_advanced', 'cs_woocommerce_get_sections_advanced', 99, 1);
function cs_woocommerce_get_sections_advanced($sections) {
	
	if(!current_user_can('manage_network')) {
		unset($sections['keys']);
		unset($sections['webhooks']);
		unset($sections['legacy_api']);
		unset($sections['woocommerce_com']);
		unset($sections['features']);
	}	
	return $sections;
}

//start generate ultimo subscriptions csv
add_action("wp_loaded","cs_after_wp_is_loaded");
function cs_after_wp_is_loaded(){
    remove_all_actions('wp_ajax_wu_generate_subscriptions_csv');
	add_action('wp_ajax_wu_generate_subscriptions_csv', 'custom_generate_subscriptions_csv');
}
function custom_generate_subscriptions_csv() {
	
	if (!current_user_can('manage_network')) {

      wp_die(__('You do not have the necessary permissions to perform this action.', 'wp-ultimo'));

    } // end if;

    global $wpdb;

    $subscriptions = WU_Subscription::get_subscriptions('all', 189, 1);

    $headers = array(
      "ID"                 => " ".__('ID', 'wp-ultimo'),
      'user_id'            => __('User ID', 'wp-ultimo'),
      'integration_status' => __('Integration Status', 'wp-ultimo'),
      'gateway'            => __('Gateway', 'wp-ultimo'),
      'plan_id'            => __('Plan ID', 'wp-ultimo'),
      'freq'               => __('Billing Frequency', 'wp-ultimo'),
      'price'              => __('Price', 'wp-ultimo'),
      'coupon_code'        => __('Coupon Code', 'wp-ultimo'),
      'price_after_coupon' => __('Price (after coupon code)', 'wp-ultimo'),
      'trial'              => __('Trial Days', 'wp-ultimo'),
      'created_at'         => __('Created At', 'wp-ultimo'),
      'active_until'       => __('Active Until', 'wp-ultimo'),
      'last_plan_change'   => __('Last Plan Change', 'wp-ultimo'),
      'paid_setup_fee'     => __('Paid Setup Fee', 'wp-ultimo'),
      'user_email'         => __('User Email', 'wp-ultimo'),
      'display_name'       => __('User Nicename', 'wp-ultimo'),
      'user_login'         => __('User Login', 'wp-ultimo'),
      'first_name'         => __('First Name', 'wp-ultimo'),
      'last_name'          => __('Last Name', 'wp-ultimo'),
      'mobile'             => __('Mobile', 'wp-ultimo'),
      'failed_payment'     => __('Failed payment', 'wp-ultimo'),
      'store_url'     	   => __('Store URL', 'wp-ultimo'),
      'taager_no'     	   => __('Taager no', 'wp-ultimo'),
      'status'             => __('Subscription Status', 'wp-ultimo'),
    );

    /**
     * Format elements
     * @var array
     */
    $subscriptions = array_map(function($element) {

		$subs = wu_get_subscription($element->user_id);
		//echo "<pre>"; print_r($subs); die;
		
		$user_mobile = $subs->get_user_data('Mobile');
		
		if($subs->integration_status == NULL) {
			$failed_payment = 'Not Integrated';
		} elseif($subs->integration_status == 0) {
			$failed_payment = 'Paid';
		} elseif($subs->integration_status == 1) {
			$failed_payment = 'Failed';
		} else {
			$failed_payment = 'Not Integrated';
		}
		
		$user_owned_sites = WU_Site_Owner::get_user_sites($element->user_id);
		$domain_url = '';
		$taager_username = '';
		foreach($user_owned_sites as $user_site_data) {
			//echo "<pre>"; print_r($user_site_data);
			if($user_site_data->ID != '') {
				$domain_url = $user_site_data->site->domain;
				$taager_username = get_blog_option( $user_site_data->ID, 'ta_api_username' );
			}
			
		}
		
		$coupon_code = $subs->get_coupon_code();

		$element_array = array(
		"ID"                 => $subs->ID,
		'user_id'            => $subs->user_id,
		'integration_status' => $subs->integration_status,
		'gateway'            => $subs->gateway,
		'plan_id'            => $subs->plan_id,
		'freq'               => $subs->freq,
		'price'              => $subs->price,
		'coupon_code'        => $coupon_code ? $coupon_code['coupon_code'] : '',
		'price_after_coupon' => $subs->get_price_after_coupon_code(),
		'trial'              => $subs->trial,
		'created_at'         => date("m-d-Y", strtotime($subs->created_at)),
		'active_until'       => date("m-d-Y", strtotime($subs->active_until)),
		'last_plan_change'   => date("m-d-Y", strtotime($subs->last_plan_change)),
		'paid_setup_fee'     => $subs->paid_setup_fee,
		'user_email'         => $subs->get_user_data('user_email'),
		'display_name'       => $subs->get_user_data('display_name'),
		'user_login'         => $subs->get_user_data('user_login'),
		'first_name'         => $subs->get_user_data('first_name'),
		'last_name'          => $subs->get_user_data('last_name'),
		'mobile'          	 => "\t".$user_mobile,
		'failed_payment'     => $failed_payment,
		'store_url'     	 => $domain_url,
		'taager_no'     	 => "\t".$taager_username,
		'status'             => $subs->get_status(),
		);

		return $element_array;

		}, $subscriptions);

		$file_name = sprintf('wp-ultimo-subscriptions-%s', date('Y-m-d'));

		/**
		* Generate the CSV
		*/
		WU_Util::generate_csv($file_name, array_merge(array($headers), $subscriptions));

		die;
}
//end generate ultimo subscriptions csv

//featured image url plugin checkbox
function custom_featured_image_js() {
	
	if( class_exists( 'Featured_Image_By_URL' )) {
		$cs_featured_image_url = 1;
	} else {
		$cs_featured_image_url = 0;
	} ?>
	
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("footer").before('<div id="featured_image_plugin" data-id="$cs_featured_image_url"></div>');
	});
	</script>
	<?php
	
}
add_action('wp_footer', 'custom_featured_image_js');

add_action('init', 'cs_testing23');
function cs_testing23() {
	
	if($_REQUEST['aaa']!=''){
		
		if(get_current_blog_id() == 2220) {
			update_post_meta( 1732, '_ta_product_price', 280 );
			echo "ff";
			echo $taager_current_price = get_post_meta( 1732, '_ta_product_price', true );
			echo "<br>";
			$taager_product_prices = get_post_meta( 1732, 'taager_product_prices', true );
			echo "<pre>"; print_r($taager_product_prices);
			die;
			
		}	
	}
}

/* add div in coupon */
add_filter('woocommerce_checkout_coupon_message', 'custom_woocommerce_checkout_coupon_message', 99, 1);
function custom_woocommerce_checkout_coupon_message($message) {
	
	$have_coupon_span = "<span class='have_coupon_span'>".esc_html__( 'Have a coupon?', 'woocommerce' )."</span>";
	$custom_message = $have_coupon_span . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</a>';
	return $custom_message;
}	

//popup vaiation selected issue
add_filter('woocommerce_dropdown_variation_attribute_options_args', 'cs_woocommerce_dropdown_variation_attribute_options_args', 10, 1);
function cs_woocommerce_dropdown_variation_attribute_options_args($args) {
	
	if(isset($args['order_bump_index']) && $args['class'] == 'mwb_upsell_offer_variation_select') { 
		unset($args['selected']);
	}
	return $args;
}
