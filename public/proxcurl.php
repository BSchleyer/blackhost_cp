<?php

$url = 'http://148.251.186.253:8006/api2/json/nodes/Proxmox-VE/qemu/';
$fields = array(
   'vmid' => urlencode('1'),
   'cores' => urlencode('2'),
   'sockets' => urlencode('4'),
   'name' => urlencode('test'),
   'memory' => urlencode('1000'),
   'onboot' => urlencode('')
);
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
?>