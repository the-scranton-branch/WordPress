<?php

/**
 * Increase php memory limit and max execution time.
 *
 */
if (isset ($_ENV['PANTHEON_ENVIRONMENT'])) {
    ini_set('memory_limit', '1024M');
    ini_set('max_execution_time', 1000);
}

$req = pantheon_curl('https://api.live.getpantheon.com/sites/self/attributes', NULL, 8443);
$meta = json_decode($req['body'], true);

// Install from profile.
echo "Installing WordPress core...\n";
$title = $meta['label'];
$email = $_POST['user_email'];
passthru("wp core install --title='$title' --admin_user='superuser' --admin_email='$email'");
echo "Installation complete.\n";
