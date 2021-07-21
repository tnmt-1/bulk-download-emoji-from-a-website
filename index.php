<?php
 
 $url = 'https://slack-emoji.webflow.io/';
 
 $html = curlGet($url);
 
 $doc = new DOMDocument;
 @$doc->loadHTML($html);
 $xpath = new DOMXpath($doc);
 
 $imgs = $xpath->query('//*[@class="div-block"]//img');
 foreach ($imgs as $img)
 {
     $src = $img->getAttribute('src');
     $bin = file_get_contents($src);
 
     $filename = pathinfo($src, PATHINFO_BASENAME);
     file_put_contents('./images/' . $filename, $bin);
     echo $filename . PHP_EOL;
 }
 
 function curlGet($url)
 {
     $ch = curl_init($url);
 
     curl_setopt_array($ch, [
         CURLOPT_CUSTOMREQUEST  => 'GET',
         CURLOPT_RETURNTRANSFER => true,
     ]);
 
     return curl_exec($ch);
 }
 