<?php

// get cURL resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/zones');

// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
  'Auth-API-Token: npC59LY2E9rEdfWZe6jBMJbaeyo7LHQP',
]);

// json body
$json_array = [
  'name' => ($domain_name + $domain_endung),
  'ttl' => 86400
]; 
$body = json_encode($json_array);

// set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// send the request and save response to $response
$response = curl_exec($ch);

// close curl resource to free up system resources 
curl_close($ch);

?>