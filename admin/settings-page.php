<?php // Coffee Friend Name days - Settings Page


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}

// display the plugin settings page
function cf_fr_display_settings_page() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'cf_fr_namedays_options' );
			
			// output setting sections
			do_settings_sections( 'cf-fr-namedays' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php
	
}


