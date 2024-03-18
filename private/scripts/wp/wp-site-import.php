<?php

// Choose demo and builder.
$demo = 'Tasty gutenberg';

// Import data into WordPress
echo "Importing demo template...\n";
passthru("wp blocksy demo import:start " . $demo);
passthru("wp blocksy demo import:plugins " . $demo);
passthru("wp blocksy demo import:options " . $demo);
passthru("wp blocksy demo import:widgets " . $demo);
passthru("wp blocksy demo import:content " . $demo);
passthru("wp blocksy demo import:finish " . $demo);
echo "Import complete.\n";