<?php 

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$temporary_credentials = $connection->getRequestToken(OAUTH_CALLBACK);
$oauth_token = $connection->getBearerToken();


$search_result = $connection->GET( "search/tweets", array("q" => $_GET['q'], "since_id" => $_GET['since_id']) );


header('Content-Type: application/json; charset=utf-8');
echo $_GET['callback'] . '('.json_encode($search_result).')';
