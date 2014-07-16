<?php
require_once("simple_html_dom.php");

$url = "http://gdata.youtube.com/feeds/base/standardfeeds/most_viewed?client=ytapi-youtube-browse&alt=rss&time=today";

$xml = file_get_contents($url);

$top = new SimpleXMLElement($xml);

print_r($top);

$title = (string)$top->channel->item[0]->title[0];

$url = (string)$top->channel->item[0]->link[0];

// create an associative array with link and title for youtube
$youtubeArray = array("url" => $url,
	"title" => $title);

// get our current file
$currentContents = file_get_contents("newData.json");

// decode into a php array
$currentArray = json_decode($currentContents,true);


// update the information for reddit
$currentArray['youtube'] = $youtubeArray;

// encode back to JSON and write to file
file_put_contents("newData.json", json_encode($currentArray));