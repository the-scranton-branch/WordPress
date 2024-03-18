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
$req = pantheon_curl('https://api.live.getpantheon.com/sites/self/attributes', NULL, 8443);
$meta = json_decode($req['body'], true);

// Install from profile.
$site_name = $meta['label'];

// Define a mapping of keywords to demo names
$demo_map = [
    'travel' => 'Travel',
    'tasty' => 'Tasty',
    'charity' => 'Charity',
    'news' => 'News',
];

// Default demo name if none of the keywords match
$demo_name = 'Tasty';

// Search for keywords in the site name and set the demo name accordingly
foreach ($demo_map as $keyword => $name) {
    if (stripos($site_name, $keyword) !== false) {
        $demo_name = $name;
        break; // Stop the loop once a match is found
    }
}

// Import data into WordPress
echo "Importing demo template...\n";
$demo = $demo_name . ' ' . $builder;
echo "Installing demo: " . $demo . "\n";
passthru("wp blocksy demo clean");
passthru("wp blocksy demo import:start " . $demo);
passthru("wp blocksy demo import:plugins " . $demo);
passthru("wp blocksy demo import:options " . $demo);
passthru("wp blocksy demo import:widgets " . $demo);
passthru("wp blocksy demo import:content " . $demo);
passthru("wp blocksy demo import:finish");
echo "Import complete.\n";