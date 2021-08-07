<?php // Coffee Friend Name days - Admin Menu


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}

// add sub-level administrative menu
function cf_fr_add_sublevel_menu() {
	
	/*	
	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug, 
		callable $function = ''
	);	
	*/
	
	add_submenu_page(
		'options-general.php',
		esc_html__('Coffee Friend Name days Settings', 'cf-fr-namedays'),
		esc_html__('Coffee Friend Name days', 'cf-fr-namedays'),
		'manage_options',
		'cf-fr-namedays',
		'cf_fr_display_settings_page'
	);
	
}
add_action( 'admin_menu', 'cf_fr_add_sublevel_menu' );