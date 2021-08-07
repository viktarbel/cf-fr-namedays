<?php // Coffee Friend Name days - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}

// callback: Plugin section
function cf_fr_callback_section() {
	
	echo '<p>'. esc_html__('These settings enable you to customize the plugin settings.', 'cf-fr-namedays') .'</p>';
	
}

// callback: text field
function cf_fr_callback_field_text( $args ) {
	
	$options = get_option( 'cf_fr_namedays_options', cf_fr_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$p     = isset( $args['p'] )     ? $args['p'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="cf_fr_namedays_options_'. $id .'" name="cf_fr_namedays_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="cf_fr_namedays_options_'. $id .'">'. $label .'</label>';
	echo '<p>'. $p .'</p>';
	
}

// callback: textarea field
function cf_fr_callback_field_textarea( $args ) {
	
	$options = get_option( 'cf_fr_namedays_options', cf_fr_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$allowed_tags = wp_kses_allowed_html( 'post' );
	
	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';
	
	echo '<textarea id="cf_fr_namedays_options_'. $id .'" name="cf_fr_namedays_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
	echo '<label for="cf_fr_namedays_options_'. $id .'">'. $label .'</label>';

}