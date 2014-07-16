<?php
$url = "http://www.google.com/trends/hottrends/hotItems";

$data = array(
	"ajax" => "1",
	"htd" => "",
	"pn" => "p1",
	"htv" => "l"
);

$options = array(
	"http" => array(
		"header" => "Content-type: application/x-www-form-urlencoded\r\n",
		"method" => "POST",
		"content" => http_build_query($data)
	)
);

$context = stream_context_create($options);

$result = file_get_contents($url, false, $context);

$json = json_decode($result, true);

$phrase = $json["trendsByDateList"][0]["trendsList"][0]["title"];

$url = "http://www.google.com/?gws_rd=ssl#q=" . urlencode($phrase);

// create an associative array with phrase and URL for google
$googleArray = array("url" => $url,
	"title" => $phrase);

// get our current file
$currentContents = file_get_contents("newData.json");

// decode into a php array
$currentArray = json_decode($currentContents,true);


// update the information for reddit
$currentArray['google'] = $googleArray;

// encode back to JSON and write to file
file_put_contents("newData.json", json_encode($currentArray));
