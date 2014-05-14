<?php

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$cache_file = dirname( __FILE__ )."/cache/gcmuc_search.".session_id().".tmp";
$filetime_offset = time() - 60;

if(false && file_exists($cache_file) && filemtime($cache_file) > $filetime_offset) {

	$file_data = file_get_contents($cache_file);
	$search_result = unserialize( stripcslashes( $file_data ) );

} else {
	/* Create a TwitterOauth object with consumer/user tokens. */
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

	if($_SESSION['bearerToken']){
		$connection->generateEncodedBearerCredentials();
		$connection->bearer_access_token = $_SESSION['bearerToken'];
	} else {
		$bearer_token = $connection->getBearerToken();
		$_SESSION['bearerToken'] = $bearer_token;
	}

	$search_result = $connection->GET( "search/tweets", array("q" => $_GET['q'], "since_id" => $_GET['since_id']) );

	$fhandle = fopen($cache_file, "w+");
	fwrite($fhandle, serialize($search_result));
	fclose($fhandle);
}

$path = dirname( __FILE__ )."/cache/";
if ($handle = opendir($path)) {
 while (false !== ($file = readdir($handle))) {
    if ((time()-filectime($path.$file)) > 60 * 60 && $file != "." && $file != "..") {
          unlink($path.$file);
    }
 }
}

header('Content-Type: application/json; charset=utf-8');
echo $_GET['callback'] . '('.json_encode($search_result).')';
