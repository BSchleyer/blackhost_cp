<?php

$record_value = $_POST['record_value'];
$record_ttl = $_POST['record_ttl'];
$record_type = $_POST['record_type'];
$record_name = $_POST['record_name'];
$record_zoneid = $_POST['record_zoneid'];

$SQL = $db->prepare("INSERT INTO `domain_dns` (`domain_id`, `subdomain`, `type`, `ziel`) VALUES (?,?,?,?)");
$SQL->execute(array($id, $_POST['record_name'], $_POST['record_type'], $_POST['record_value']));

// get cURL resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/records');

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
  'value' => $record_value,
  'ttl' => $record_ttl,
  'type' => $record_type,
  'name' => $record_name,
  'zone_id' => $record_zoneid
]; 
$body = json_encode($json_array);

// set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// send the request and save response to $response
//$response = curl_exec($ch);

// stop if fails
//if (!$response) {
//  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
//}

//echo 'HTTP Status Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
//echo 'Response Body: ' . $response . PHP_EOL;

// close curl resource to free up system resources 
curl_close($ch);
?>

?>