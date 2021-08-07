<?php // Coffee Friend Name days - Core Functionality


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}


// get a list of today's name days via remote request
function cf_fr_get_namedays() {

	$namedays = get_transient( 'cf_fr_namedays' );
 
	if ( false === $namedays ) {

		$response = wp_safe_remote_get( 'https://day.lt/' );

		$response_code = wp_remote_retrieve_response_code( $response );

		$namedays = array();

		// get custom refresh time option
		$options = get_option( 'cf_fr_namedays_options', cf_fr_options_default() );
	
		if ( isset( $options['custom_refresh_time'] ) && ! empty( $options['custom_refresh_time'] ) ) {
			
			$custom_refresh_time = sanitize_text_field( $options['custom_refresh_time'] );
			
		} else {

			// set default refresh (expiration) time for transient
			$custom_refresh_time = HOUR_IN_SECONDS;

		}
		
		// check if remote request was successful
		if ( 200 === $response_code ) {

			$body = wp_remote_retrieve_body( $response );

			$dom = new DomDocument();

			// hide html errors during page scrapping
			libxml_use_internal_errors(true);
			
			$dom->loadHTML($body);		

			$xpath = new DOMXpath($dom);

			$names = $xpath->query("//p[@class='vardadieniai']/a");

			// add grabbed name days to an array
			foreach ($names as $name) {
			  
				$nodes = $name->childNodes;

				foreach ($nodes as $node) {
			    
					$namedays[] = $node->nodeValue;

				}
			}

			set_transient( 'cf_fr_namedays', $namedays, $custom_refresh_time );

		}

	}

	return $namedays;

}


// styles for name days list
function cf_fr_add_public_styles() {
    
    wp_enqueue_style( 'cf-fr-namedays', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/cf-fr-namedays.css', array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'cf_fr_add_public_styles' );