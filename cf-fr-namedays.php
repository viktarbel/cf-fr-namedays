<?php
/*
Plugin Name:  Coffee Friend Name days
Description:  This plugin shows today's name days from https://day.lt/. Use shortcode [cf_fr_namedays] to show today's name days on any post or page.
Author:       Viktar Ramanovich
Version:      1.0
Text Domain:  cf-fr-namedays
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}

// load text domain
function cf_fr_load_textdomain() {
	
	load_plugin_textdomain( 'cf-fr-namedays', false, plugin_dir_path( __FILE__ ) . 'languages/' );
	
}
add_action( 'plugins_loaded', 'cf_fr_load_textdomain' );



// include plugin dependencies: admin only
if ( is_admin() ) {
	
	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
	
}



// include plugin dependencies: public only
if ( !is_admin() ) {

	require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';
	require_once plugin_dir_path( __FILE__ ) . 'public/public-functions.php';

}

// default plugin options
function cf_fr_options_default() {
	
	return array(
		'custom_message'  => '<h3 class="custom-message">'. esc_html__('List of today\'s name days', 'cf-fr-namedays') .'</h3>',		
		'custom_refresh_time' => 3600,
	);
	
}


// delete transients on deactivation
function cf_fr_on_deactivation() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	delete_transient('cf_fr_namedays');

}
register_deactivation_hook( __FILE__, 'cf_fr_on_deactivation' );