<?php

$url = ''; // Target website
$html = file_get_contents($url);  // Download the HTML page
// Pattern By Eugene Kudashev
// https://anchor.fm/slashcircumflex/episodes/a-zA-Z0-9-_-a-zA-Z0-9---a-zA-Z2-6-enq826
$patternEmail = '/[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,6}/';

preg_match_all($patternEmail, $html, $emails);
print_r($emails);
