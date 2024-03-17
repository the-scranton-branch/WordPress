<?php

/**
 * Increase php memory limit and max execution time.
 *
 */
if (isset ($_ENV['PANTHEON_ENVIRONMENT'])) {
    ini_set('memory_limit', '1024M');
    ini_set('max_execution_time', 1000);
}

// Enable Ocean theme and plugins
echo "Enabling WP plugins and themes...\n";
passthru("wp theme activate blocksy");
passthru("wp plugin install pantheon-advanced-page-cache wp-native-php-sessions wordpress-importer --activate");
