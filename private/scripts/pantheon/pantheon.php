<?php

// Enable Pantheon options
if (isset($_POST['environment'])) {

  // Get site settings
  $req = pantheon_curl('https://api.live.getpantheon.com/sites/self/settings', NULL, 8443);
  $settings = json_decode($req['body'], true);

  // Enable Redis
  if ($settings['allow_cacheserver'] != 1) {
    $req = pantheon_curl('https://api.live.getpantheon.com/sites/self/settings', '{"allow_cacheserver":true}', 8443, 'PUT');
  }

  // Get New Relic binding if available.
  $req = pantheon_curl('https://api.live.getpantheon.com/sites/self/environments/self/bindings?type=newrelic', NULL, 8443);
  $nr_bindings = json_decode($req['body'], true);

  // If New Relic not detected, enable New Relic.
  if (empty($nr_bindings)) {
    $req = pantheon_curl('https://api.live.getpantheon.com/sites/self/workflows', '{"type":"enable_new_relic_for_site","params":{"converge":true}}', 8443, 'POST');
  }
}
