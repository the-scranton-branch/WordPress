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
$name = 'Tasty';
$builder = ' ';
$demo = $name . ' ' . $builder;

// Import data into WordPress
echo "Importing demo template...\n";
passthru("wp blocksy demo clean");
passthru("wp blocksy demo import:start " . $demo);
passthru("wp blocksy demo import:plugins " . $demo);
passthru("wp blocksy demo import:options " . $demo);
passthru("wp blocksy demo import:widgets " . $demo);
passthru("wp blocksy demo import:content " . $demo);
passthru("wp blocksy demo import:finish");
echo "Import complete.\n";