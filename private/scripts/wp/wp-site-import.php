<?php

/**
 * Increase php memory limit and max execution time.
 *
 */
if (isset ($_ENV['PANTHEON_ENVIRONMENT'])) {
    ini_set('memory_limit', '1024M');
    ini_set('max_execution_time', 1000);
}

// Choose demo and builder. For Gutenberg, leave $builder empty.
$demo_name = 'Tasty';
$builder = ' ';

// Use site name to determine the demo and builder.
$site_name = $_ENV['PANTHEON_SITE_NAME'];
if (stripos($site_name, 'travel') !== false) {
    $demo_name = 'Travel';
} elseif (stripos($site_name, 'tasty') !== false) {
    $demo_name = 'Tasty';
} elseif (stripos($site_name, 'charity') !== false) {
    $demo_name = 'Charity';
} elseif (stripos($site_name, 'news') !== false) {
    $demo_name = 'News';
}

// Import data into WordPress
echo "Importing demo template...\n";
$demo = $demo_name . ' ' . $builder;
passthru("wp blocksy demo clean");
passthru("wp blocksy demo import:start " . $demo);
passthru("wp blocksy demo import:plugins " . $demo);
passthru("wp blocksy demo import:options " . $demo);
passthru("wp blocksy demo import:widgets " . $demo);
passthru("wp blocksy demo import:content " . $demo);
passthru("wp blocksy demo import:finish");
echo "Import complete.\n";