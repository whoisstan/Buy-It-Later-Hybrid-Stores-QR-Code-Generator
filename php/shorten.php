<?php

include 'settings.php';

function make_bitly_url($url,$login,$appkey)
{
	//create the URL
	$bitly = 'http://api.bit.ly/shorten?version='.$version.'&amp;longUrl='.urlencode($url).'&amp;login='.$login.'&amp;apiKey='.$appkey.'&amp;format=json';
	$response = file_get_contents($bitly);
	
	$json = @json_decode($response,true);
	return $json['results'][$url];
}

echo(json_encode(make_bitly_url($_GET["url"],BITLY_USER_NAME,BITLY_API_KEY,'json')));

?>


