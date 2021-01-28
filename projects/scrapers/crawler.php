<?php

/**
 * Resources:
 * - https://github.com/adavijit/AVDOJO-TUTORIALS/blob/master/webcrawling_php.php
 * 
 * Limitations:
 * - Shopify sites
 * - Redirect links (ie levogirar.com -> levogirar.github.io)
 */

$url = 'https://www.bolsoaurora.es'; // Target website

// Find the base url
$url = 'http://' . parse_url($url, PHP_URL_HOST);

$pages = ['', 'contacto', 'contact'];

$bodyTexts = '';

foreach ($pages as &$page) {
	$url = $url . '/' . $page;
	// Verify if it is a valid website
	$file_headers = @get_headers($url);
	if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		// do nothing
	} else { // Save body text in array
		$html = file_get_contents($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		// Get the body text and add it as a string
		foreach ($dom->getElementsByTagName('body') as $body) {
			$bodyTexts = $bodyTexts . $body->textContent;
		}
	}
	// Reset the URL
	$url = 'http://' . parse_url($url, PHP_URL_HOST);
}
