<?php

/**
 * limitations:
 * 1. $url needs to be identical as how it is shown on the address bar. 
 *      https://wuwana.com != https://www.wuwana.com
 */

use function PHPSTORM_META\type;

// $url = 'https://wuwana.com';
// $url = 'https://www.doggybathroom.com/sitemap.xml';
// $url = 'https://www.doggybathroom.com/sitemap_pages_1.xml';
$url = 'https://camdencoffeeroasters.com/sitemap.xml';
// $onlyXml = array();
// $onlyHtml = array();

$xml = simplexml_load_file($url);

print_r($xml);

echo '<br><hr><br>';

$sitemap = $xml->sitemap;

print_r($sitemap->lastmod);

// // check if valid website
// if (@get_headers($url)) {
//     echo '<br>' . $url . ' is a valid URL <br><br>';
//     $links = getLinksFromSitemap($url);
//     echo '<br><br>Total links ' . count($links) . '<br><br>';
// } 
// else { echo '<br>Invalid URL<br>'; }

// foreach ($links as $link)
// {
//     if (@get_headers($link))
//     {
//         echo $link . '<br><br>';
//     }
//     else 
//     {
//         echo 'no valid url <br><br>';
//     }
// }



// foreach ($links as $link) {
//     $i = parse_url($link);
//     echo 'Scheme: ' . $i['scheme'] . '<br>';
//     echo 'Host: ' . $i['host'] . '<br>';
//     echo 'Path: ' . $i['path'] . '<br>';
//     echo 'Query: ' . $i['query'] . '<br>';

//     if (@get_headers($link))
//     {
//        echo $link . ' is website';
//     }
//     else
//     {
//         echo '👎🏼 ' . $link . '<br><br>';
//     }
// }



function sortHtmlFromXml($link) {
    // $onlyXml = array();
    // $onlyHtml = array();
    // // check if XML 
    // if (strpos($link, '.xml')) {
    //     array_push($onlyXml, $link);
    //     return;
    // }
    // // Save link to $onlyHtml
    // array_push($onlyHtml, $link);
    if (strpos($link, '.xml')) {
        $onlyXml[] = $link;
    }
}


/**
 * Get all the links from a XML
 * @param $url.xml
 * @return array
 */
function getLinksFromSitemap($url) {
    // $urlParts = parse_url($url);
    // $siteMap = '/sitemap.xml';
    // $url = $urlParts['scheme'] . '://' . $urlParts['host'] . $siteMap;

    // // check if $url is a XML file or not
    // if (strpos($url, '.xml') != true) { 
    //     return; 
    // }

    // create a new cURL resource
    $curl = curl_init();

    // set URL and other options
    $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36';

    $options = array(
        CURLOPT_USERAGENT => $userAgent,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $url
    );

    curl_setopt_array($curl, $options);

    // grab URL and pass it to the browser
    $data = curl_exec($curl);

    // close cURL resource, and free up system resources
    curl_close($curl);

    // get all links
    $links = array();
    $count = preg_match_all('@<loc>(.+?)<\/loc>@', $data, $matches);

    if (count($matches) > 0) 
    {
        for ($i = 0; $i < $count; ++$i) {
            $links[] = $matches[0][$i];
        }
        return $links;
    }
    return false;
}