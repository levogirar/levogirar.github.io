<?php

/**
* Scraper for Facebook.
* Get About
* Get Reviews
*/

$url = 'https://www.facebook.com/RightSideCoffee/about/?ref=page_internal';

$options = array(
	'http'=>array(
	  'method'=>"GET",
	  'header'=>"Accept-language: en\r\n" .
				"Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
				"User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad 
	)
);
  
$context = stream_context_create($options);
$html = file_get_contents($url, false, $context);
$dom = new DOMDocument();
$dom->loadHTML($html);

$scriptElements = [];

foreach($dom->getElementsByTagName('script') as $item)
{ $scriptElements[] = $item; }

foreach ($scriptElements as $item)
{ $item->parentNode->removeChild($item); }


$texts = [];
foreach ($dom->getElementsByTagName('body') as $body) {
	$texts = $body->textContent;
}

print_r($texts);

// $positionStart = strpos($html, ' +3');
// $positionEnd = strpos($html, '<', $positionStart);
// $phoneNumber = trim(substr($html, $positionStart, $positionEnd));

// $positionStart = strpos($dom, '"mailto:');
// $positionEnd = strpos($dom, '"', $positionStart);
// $email = substr($dom, $positionStart, $positionEnd);

// print $email;