<?php // Coffee Friend Name days - Validate Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}


// validate: is number
function cf_fr_is_number($ref_time) {

	// check if empty
	if ( empty( $ref_time ) ) return false;

	// check format
	if ( $ref_time <= 0 || !is_numeric( $ref_time ) ) return false;

	return true;
}

// callback: validate options
function cf_fr_callback_validate_options( $input ) {
	

	// custom message
	if ( isset( $input['custom_message'] ) ) {
		
		$input['custom_message'] = wp_kses_post( $input['custom_message'] );
		
	}	

	// custom refresh time
	if ( cf_fr_is_number( $input['custom_refresh_time'] ) ) {
		
		$input['custom_refresh_time'] = sanitize_text_field( $input['custom_refresh_time'] );

		delete_transient('cf_fr_namedays');
		
	} else {

		// show settings error if custom refresh time is not valid
		add_settings_error( 'cf_fr_namedays_options', 'invalid-refresh-time', esc_html__('Please enter valid refresh time', 'cf-fr-namedays') );
		
		$input['custom_refresh_time'] = '';

	}	
	
	return $input;		
	
}


