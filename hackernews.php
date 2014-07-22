<?php
require_once("simple_html_dom.php");
$url = "http://www.daemonology.net/hn-daily/index.rss";

$xml = file_get_contents($url);

$top = new SimpleXMLElement($xml);

$html = str_get_html((string)$top->channel->item[0]->description[0]);

$elt = $html->find(".storylink a");

$title = $elt[0]->nodes[0]->{"_"}[4];
$url = $elt[0]->attr["href"];

// create an associative array with link and title for new york times
$hackerNewsArray = array("url" => $url,
	"title" => $title);

// get our current file
$currentContents = file_get_contents("newData.json");

// decode into a php array
$currentArray = json_decode($currentContents,true);


// update the information for reddit
$currentArray['hackerNews'] = $hackerNewsArray;

// encode back to JSON and write to file
file_put_contents("newData.json", json_encode($currentArray));

//printf('{"title": "%s", "url": "%s"}', str_replace("&quot;", "\\\"", $title), $url);