<?php

function get_fb_page_contents(){
	$pageID = 76251837108;
	$file = get_theme_root()."/gcmuc/caches/".$pageID."_cache.txt";
	$file_content = @file_get_contents($file);
	if($file_content){
		$page_feed = unserialize( $file_content );
		return $page_feed;	
	} else {
		return false;	
	}
}

function get_twitter_search_objects($term){
	$file = get_theme_root()."/gcmuc/caches/tw_".$term."_cache.txt";
	
	$time_offset = time()-60*5;
	
	if(file_exists($file) && filemtime($file) > $time_offset){
		$twitter_data = @file_get_contents($file);
	} else {
		$twitter_url = "http://search.twitter.com/search.json?q=".urlencode($term)."&rpp=100&include_entities=false&result_type=recent";
		$twitter_data = @file_get_contents($twitter_url);

		if($twitter_data){
			$fh = fopen($file, 'w+') or die("can't open file");
			$feed = ($twitter_data);
			fwrite($fh, $feed);
			fclose($fh);
		}
	}
	
	return json_decode($twitter_data);
}