<?php

/* Load required lib files. */
session_start();

$cache_file = dirname( __FILE__ )."/cache/search.".session_id().".tmp";
$filetime_offset = time() - 60;

if(file_exists($cache_file) && filemtime($cache_file) > $filetime_offset) {

	$file_data = file_get_contents($cache_file);
	$search_result = unserialize( stripcslashes( $file_data ) );

} else {
	$apikey = "0676fee8792b4f930e9b4e0cfbe157ef";

	$q = array(
		"tags"			=> $_GET['q'],
		"api_key"		=> $apikey,
		"method"		=> "flickr.photos.search",
		"format"		=> "json",
		"extras"		=> "owner_name,url_l,icon_server,date_upload,date_taken",
		"per_page"		=> 10,
	);

	$qry = http_build_query($q);
	$url = "http://api.flickr.com/services/rest/?".$qry;

	$search_result = jsonp_decode(file_get_contents($url));

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

function jsonp_decode($jsonp, $assoc = false) { // PHP 5.3 adds depth as third parameter to json_decode
    if($jsonp[0] !== '[' && $jsonp[0] !== '{') { // we have JSONP
       $jsonp = substr($jsonp, strpos($jsonp, '('));
    }
    return json_decode(trim($jsonp,'();'), $assoc);
}