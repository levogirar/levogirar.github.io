<?php

$url = ''; // Target website

$html = file_get_contents($url);  // Download the HTML page
$position = stripos($html, '</head>');

if ($position == false)  // or 0
{
	return print 'Nothing found';
}  // We can not do anything without the <head> part

// Remove the <body> part to only parse the <head> (optimization)
$html = substr($html, 0, $position) . '</head><body></body></html>';
$dom = new DOMDocument();
$dom->loadHTML($html);

$metas = [];

foreach ($dom->getElementsByTagName('meta') as $meta) {
	if ($meta->hasAttribute('property')) {
		$metas[strtolower($meta->getAttribute('property'))] = trim($meta->getAttribute('content'));
	} elseif ($meta->hasAttribute('name')) {
		$metas[strtolower($meta->getAttribute('name'))] = trim($meta->getAttribute('content'));
	}
}

// Now we can choose which description we prefer if we found many!

if (!empty($metas['description'])) {
	return print $metas['description'];
}

if (!empty($metas['og:description'])) {
	return print $metas['og:description'];
}

if (!empty($metas['twitter:description'])) {
	return print $metas['twitter:description'];
}

// If there were no description available maybe we can use the page title...
$title = $dom->getElementsByTagName('title')->item(0);

if ($title != null && !empty($title->nodeValue)) {
	return print trim($title->nodeValue);
}

if (!empty($metas['og:title'])) {
	return print $metas['og:title'];
}

if (!empty($metas['twitter:title'])) {
	return print $metas['twitter:title'];
}

return print 'Nothing found';
