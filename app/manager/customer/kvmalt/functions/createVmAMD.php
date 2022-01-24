<?php
$url = "https://45.142.182.66:4083/index.php?act=create&api=json&apikey=OW0SOUPDW5NWCJP2&apipass=qot4vtgejjfeqk8aoezbgdsoclor40dq";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data ="addvs=1
&virt=proxk&slave_server=1&sgid=1&ips=".$vt_ips."&rootpass=".$vt_rootpw."&hostname=".$vt_hostname."&space=1&ram=".$vt_ram."&swap=0&bandwidth=0&user_email=".$usermail."&user_pass=".$userpass."&cores=".$vt_cores."&num_ipv4=".$vt_ips."&space=".$vt_space."&vnc=0&osid=881&upload_speed=-1";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
?>