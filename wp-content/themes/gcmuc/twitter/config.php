<?php

/**
 * @file
 * A single location to store configuration.
 */

//get public directory structure eg "/top/second/third" 
$public_directory = dirname($_SERVER['PHP_SELF']); 
//place each directory into array 
$directory_array = explode('/', $public_directory); 
//get highest or top level in array of directory strings 
$public_base = max($directory_array); 

define('CONSUMER_KEY', 'Xn9ZsjwjJtjBaReEMX1veg');
define('CONSUMER_SECRET', 'AEcHkzrNz2vNvayBYzW4gaVUfdMKlqOxlT74YZueN0');
define('OAUTH_CALLBACK', $public_base."/callback.php");
