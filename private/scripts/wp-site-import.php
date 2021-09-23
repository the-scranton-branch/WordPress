<?php

// Get paths for imports
$url      = 'https://demos.oceanwp.org/';
$settings = array(
	'xml_file'       => $url . 'coach/sample-data.xml',
	'theme_settings' => $url . 'coach/oceanwp-export.dat',
	'widgets_file'   => $url . 'coach/widgets.wie',
);

// Load WP core
require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

// Load importer classes
spl_autoload_register(
	function ( $class_name ) {
		include './importers/' . $class_name . '.php';
	}
);

// Enable Ocean theme
echo "Enabling WP plugins and themes...\n";
system( 'wp theme activate oceanwp' );
system( 'wp plugin activate pantheon-advanced-page-cache wp-native-php-sessions ocean-extra wordpress-importer' );

// Import data into WordPress
echo "Importing default content...\n";
system( "wp import {$settings['xml_file']} --authors=skip" );
echo "Import complete.\n";

// Import theme settings
echo "Importing theme settings...\n";
$settings_importer = new OWP_Settings_Importer();
$result            = $settings_importer->process_import_file( $theme_settings );

if ( is_wp_error( $result ) ) {
	echo json_encode( $result->errors );
} else {
	echo 'successful import';
}
