<?php

/**
 * @file
 * A single location to store configuration.
 */

//get public directory structure eg "/top/second/third" 
$public_directory = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']); 

define('CONSUMER_KEY', 'Xn9ZsjwjJtjBaReEMX1veg');
define('CONSUMER_SECRET', 'AEcHkzrNz2vNvayBYzW4gaVUfdMKlqOxlT74YZueN0');
define('OAUTH_CALLBACK', $public_directory."/callback.php");
