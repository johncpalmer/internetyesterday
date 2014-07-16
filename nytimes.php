<?php
$url = "http://rss.nytimes.com/services/xml/rss/nyt/MostViewed.xml";

$xml = file_get_contents($url);

$top = new SimpleXMLElement($xml);

$title = (string)$top->channel->item[0]->title[0];

$url = (string)$top->channel->item[0]->link[0];

// create an associative array with link and title for new york times
$nytArray = array("url" => $url,
	"title" => $title);

// get our current file
$currentContents = file_get_contents("newData.json");

// decode into a php array
$currentArray = json_decode($currentContents,true);


// update the information for reddit
$currentArray['nytimes'] = $nytArray;

// encode back to JSON and write to file
file_put_contents("newData.json", json_encode($currentArray));

//printf('{"title": "%s", "url": "%s"}', $title, $url);