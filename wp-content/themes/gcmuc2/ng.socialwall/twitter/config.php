<?php

/**
 * @file
 * A single location to store configuration.
 */

//get public directory structure eg "/top/second/third"
$public_directory = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);

define('CONSUMER_KEY', '7jMCr1qLJVqcgejzUPFPGOlEm');
define('CONSUMER_SECRET', 'o6fCzycyw9kJE09Yd6NxldtN7hcTNe0LiEgxsjFwulj0e2ahnw');
define('OAUTH_CALLBACK', $public_directory."/callback.php");
