<?php // Coffee Friend Name days - Register Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}

// register plugin settings
function cf_fr_register_settings() {
	
	/*
		register_setting( 
			string   $option_group, 
			string   $option_name, 
			callable $sanitize_callback = ''
		);
	*/
	
	register_setting( 
		'cf_fr_namedays_options', 
		'cf_fr_namedays_options', 
		'cf_fr_callback_validate_options' 
	); 
	
	/*	
		add_settings_section( 
			string   $id, 
			string   $title, 
			callable $callback, 
			string   $page
		);	
	*/
	
	add_settings_section( 
		'cf_fr_section', 
		esc_html__('Customize Plugin Settings', 'cf-fr-namedays'), 
		'cf_fr_callback_section', 
		'cf-fr-namedays'
	);	
	
	/*
	
	add_settings_field(
    	string   $id, 
		string   $title, 
		callable $callback, 
		string   $page, 
		string   $section = 'default', 
		array    $args = []
	);
	
	*/	
		
	add_settings_field(
		'custom_message',
		esc_html__('Custom Message', 'cf-fr-namedays'),
		'cf_fr_callback_field_textarea',
		'cf-fr-namedays', 
		'cf_fr_section', 
		[ 'id' => 'custom_message', 'label' => esc_html__('Custom text and/or markup before the name days list', 'cf-fr-namedays') ]
	);

	add_settings_field(
		'custom_refresh_time',
		esc_html__('Custom Refresh Time', 'cf-fr-namedays'),
		'cf_fr_callback_field_text',
		'cf-fr-namedays', 
		'cf_fr_section', 
		[ 'id' => 'custom_refresh_time', 'label' => esc_html__('Time after which a new remote request will be made.', 'cf-fr-namedays'), 'p' => esc_html__('Use value in seconds. Ex.: 600 equals 10 minutes; 3600 - 1 hour (default); 21600 - 6 hours; 43200 - 12 hours; and so forth', 'cf-fr-namedays') ]
	);	
    
} 
add_action( 'admin_init', 'cf_fr_register_settings' );


