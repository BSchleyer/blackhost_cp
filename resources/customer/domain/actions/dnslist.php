<?php

// get cURL resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/records?zone_id='.$zoneid.'');

// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Auth-API-Token: npC59LY2E9rEdfWZe6jBMJbaeyo7LHQP',
]);

// send the request and save response to $response
$response = curl_exec($ch);

// stop if fails
//if (!$response) {
//  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
//}
//echo $response;
//var_dump(json_encode($response));

$response_data = ($response);

curl_close($ch);

?>