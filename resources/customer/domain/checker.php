<?php
$url = "https://api.godaddy.com/v1/domains/available?domain=".$domain.".".$endung."&checkType=full";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "Authorization: sso-key fYWJCT2tRWxY_k1hg6r6xtxFGHqCMrTCLw:7qxJ44Q3DWc6ezCQGArEGy",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$checkDomain = json_decode($resp, true);

?>