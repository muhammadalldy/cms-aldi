<?php
require '../vendor/autoload.php';
$client = new GuzzleHttp\Client();
$headers = [
  'Authorization' => 'Bearer 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',
  'Content-Type' => 'application/json'
];
$body = '{
  "prompt": "what is physics?",
  "model": "text-davinci-003"
}';

$request = $client->request('POST', 'https://api.openai.com/v1/completions', $headers, $body); 
$res = $client->sendAsync($request)->wait();
echo $res->getBody();
