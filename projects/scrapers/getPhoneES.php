<?php

/**
 * https://en.wikipedia.org/wiki/Telephone_numbers_in_Spain
 * Phone numbers in Spain are 9 digits if without the country calling code (+34)
 * (?:([+]|00)34(.)?)? -> Country calling code +34 or 0034 (optional)
 * Mobile phone number in Spain starts with 6 or 7
 * Landline in Spain starts with 9
 */

// Spain calling code & patterns
$callingCodeES = '+34';
$callingCodeES2 = "0034";
$patternNumberES = '/(?:([+]|00)34(.)?)?(6|9)[0-9]{1,}.[0-9]{1,}.[0-9]{1,}.[0-9]{1,}(.[0-9]{1,})?/'; // Look for a Spanish phone number
$patternMobileES = '/(?:([+]|00)34)?(6|7)[0-9]{8}/'; // Verify Spanish mobile number
$patternPhoneES = '/(?:([+]|00)34)?9[0-9]{8}/'; // Verify Spanish landline number

$url = 'https://camdencoffeeroasters.com/contacto/'; // Target website
$html = file_get_contents($url);  // Download the HTML page

$dom = new DOMDocument();
@$dom->loadHTML($html); // Symbol '@' added to prevent warning message

// Get website text
$bodyTexts = [];
foreach ($dom->getElementsByTagName('body') as $body) {
	$bodyTexts = $body->textContent;
}

// Find phone number & sanitize results
preg_match_all($patternNumberES, $texts, $numbersES);
$numbersES = array_values(array_unique($numbersES[0])); // Remove duplicates
$eliminate = ['.', ' ', '-']; // Characters to be replaced
$numbersES = str_replace($eliminate, '', $numbersES); // Remove special characters

// Standardize mobile numbers
foreach ($numbersES as &$number) {
	if (substr($number, 0, 3) === $callingCodeES) {
		$number = $number;
	} elseif (substr($number, 0, 4) === $callingCodeES2) {
		$number = str_replace($callingCodeES2, $callingCodeES, substr($number, 0, 4)) . substr($number, 4, 9); // Change 0034612345678 to +34612345678
	} else {
		$number = $callingCodeES . $number; // Add +34 to mobile number
	}
}

//Turn array into string
$numbersES = implode(';', $numbersES);

// Sort mobile and landline
preg_match_all($patternMobileES, $numbersES, $mobilesES);
preg_match_all($patternPhoneES, $numbersES, $phonesES);

$mobilesES = $mobilesES[0];
$phonesES = $phonesES[0];

print_r($mobilesES);
echo '<br/><br/>';
print_r($phonesES);
