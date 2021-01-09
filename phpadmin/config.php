<?php

include 'sentry.php';

$CONFIG['api_url'] = 'http://vvsubotapi.t.frogling.com/api/';
//$CONFIG['api_key'] = '63px3s';
if (isset($_COOKIE['api_key'])) {
$CONFIG['api_key'] = $_COOKIE['api_key'];
} else {
  $CONFIG['api_key'] = null;
}
