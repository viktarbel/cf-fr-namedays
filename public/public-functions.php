<?php // Coffee Friend Name days - Public Functionality


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}


function cf_fr_display_namedays( $atts ) {	

	// define shortcode variables for future use
	/* 	
	extract( shortcode_atts( array( 
		
		'att1' => 5,
		'att2' => 'some value',
		
	), $atts ) );
	*/
	
	// remember time before requesting array of the namedays
	$starttime = microtime(true); 

	// get array of name days
	$list = cf_fr_get_namedays();

	$result = '';

	// get custom_message option
	$options = get_option( 'cf_fr_namedays_options', cf_fr_options_default() );
	
	if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {
		
		$custom_message = wp_kses_post( $options['custom_message'] );
		
	} else {

		$custom_message = '';

	}
	
	// for testing the loading time	
	$endtime = microtime(true); 
	$total = round($endtime - $starttime, 5);	

	
	if ( $list ) {

		$result .= '<div id="namedays">';

		if ( $custom_message ) {
			
			$result .= $custom_message;

		}

		$result .= '<ul class="namedays-list">';

		foreach( $list as $name ) {

			$result .= '<li class="name">' . esc_html( $name ) . '</li>';

		}

	      $result .= '</ul>';

	      $result .= '<p class="hidden-message for-testing">List was loaded in ' . $total . ' seconds</p>';


	      $result .= '</div>';  

	} else {

		// show message if either a remote connection error happened or there are no name days on the remote page
		$result .= '<h3 class="cf-fr-notice">' . esc_html__('Sorry, there are no today\'s name days. Please check back later.', 'cf-fr-namedays') . '</h3>';

	}

	return $result;

}
add_shortcode( 'cf_fr_namedays', 'cf_fr_display_namedays' );