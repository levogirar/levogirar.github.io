<?php

/**
 * https://en.wikipedia.org/wiki/Telephone_numbers_in_Spain
 * Phone numbers in Spain are 9 digits if without the country calling code (+34)
 * (?:([+]|00)34(.)?)? -> Country calling code +34 or 0034 (optional)
 * Mobile phone number in Spain starts with 6 or 7
 * Landline in Spain starts with 9
 */

// Spain calling Code
$callingCodeES = '+34';
$callingCodeES2 = "0034";

$url = 'https://camdencoffeeroasters.com/contacto/'; // Target website
$html = file_get_contents($url);  // Download the HTML page

$patternNumberES = '/(?:([+]|00)34(.)?)?(6|9)[0-9]{1,}.[0-9]{1,}.[0-9]{1,}.[0-9]{1,}(.[0-9]{1,})?/'; // Look for a Spanish phone number
$patternMobileES = '/(?:([+]|00)34)?(6|7)[0-9]{8}/'; // Verify Spanish mobile number
$patternPhoneES = '/(?:([+]|00)34)?9[0-9]{8}/'; // Verify Spanish landline number

$dom = new DOMDocument();
@$dom->loadHTML($html); // Symbol '@' added to prevent warning message

// Get website text

// // This does not work (?)
// $bodyTexts = [];
// $webBody = $dom->getElementsByTagName('body');
// $bodyTexts = $webBody->textContent;
// print_r($bodyTexts);

// This works
$bodyTexts = [];
foreach ($dom->getElementsByTagName('body') as $body) {
	$bodyTexts = $body->textContent;
}

// Find phone number & eliminate unnecessary characters
preg_match_all($patternNumberES, $bodyTexts, $numberES);

$eliminate = ['.', ' ', '-']; // Characters to be replaced
$numberES = implode(';', str_replace($eliminate, '', $numberES[0]));

// Sort mobile and landline
preg_match_all($patternMobileES, $numberES, $mobileES);
preg_match_all($patternPhoneES, $numberES, $phoneES);

$mobileES = $mobileES[0];
$phoneES = $phoneES[0];

foreach ($mobileES as &$mobile) {
	if (substr($mobile, 0, 3) === $callingCodeES) {
		$mobile = $mobile;
	} elseif (substr($mobile, 0, 4) === $callingCodeES2) {
		$mobile = str_replace($callingCodeES2, $callingCodeES, substr($mobile, 0, 4)) . substr($mobile, 4, 9); // Change 0034612345678 to +34612345678
	} else {
		$mobile = $callingCodeES . $mobile; // Add +34 to mobile number
	}
}

foreach ($phoneES as &$phone) {
	if (substr($phone, 0, 3) === $callingCodeES) {
		$phone = $phone;
	} elseif (substr($phone, 0, 4) === $callingCodeES2) {
		$phone = str_replace($callingCodeES2, $callingCodeES, substr($phone, 0, 4)) . substr($phone, 4, 9); // Change 0034912345678 to +34912345678
	} else {
		$phone = $callingCodeES . $phone; // Add +34 to landline number
	}
}

// Remove duplicate numbers
$mobileES = array_values(array_unique($mobileES));
$phoneES = array_values(array_unique($phoneES));

print_r($mobileES);
print_r($phoneES);
