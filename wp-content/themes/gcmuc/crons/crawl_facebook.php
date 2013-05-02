<?php

class facebook_crawl {

	protected $pageID, $output, $facebook, $page_feed;

	public function __construct($pageID, $appID, $appSecret) {
		require_once("facebook_sdk/facebook.php");
	
		$config = array();
		$config['appId'] = $appID;
		$config['secret'] = $appSecret;
		
		$this->facebook = new Facebook($config);
		
		$this->pageID = $pageID;
		
		$this->crawl();
	}
	
	private function crawl() {
		if($this->pageID){
			$this->page_feed = $this->facebook->api($this->pageID."/posts");
			if($this->page_feed){
				$this->writeFile();	
			}
		}
		
	}
	
	private function writeFile(){
		$myFile = "../caches/".$this->pageID."_cache.txt";
		$fh = fopen($myFile, 'w+') or die("can't open file");
		$feed = serialize($this->page_feed);;
		fwrite($fh, $feed);
		fclose($fh);	
	}
	
}

$fb_crawl = new facebook_crawl("76251837108", "364461830288428", "db640710aa3e002e70c6df1d15f41559");










// End of crawl_facebook.php