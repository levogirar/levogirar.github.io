<?php

$url = 'https://camdencoffeeroasters.com'; // Target website
$html = file_get_contents($url);  // Download the HTML page
$dom = new DOMDocument();
@$dom->loadHTML($html);

// Remove script tags
// https://stackoverflow.com/questions/7130867/remove-script-tag-from-html-content

$script = $dom->getElementsByTagName('script');

$remove = [];
foreach($script as $item)
{
$remove[] = $item;
}

foreach ($remove as $item)
{
$item->parentNode->removeChild($item); 
}

// Get website texts
foreach ($dom->getElementsByTagName('body') as $body) {
	// Get the body text and add it as a string
	$bodyTexts = $body->textContent . ' ';
}

echo $bodyTexts;

// $patternPostalCodeES = '/\b[0-5][0-9]{4}\b/';

// preg_match_all($patternPostalCodeES, $texts, $onlyDigits);
// $onlyDigits = array_values(array_unique($onlyDigits[0]));

// print_r($onlyDigits);

