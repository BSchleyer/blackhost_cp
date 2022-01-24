<?php
$url = "https://vps.host-control.eu:4083/index.php?act=create&api=json&apikey=LSPDYUO5EWHWUFMA&apipass=bpwfumdimvxunizalyupmily3fsxpsdc";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data ="addvs=1
&virt=kvm
&sgid=2
&ips=".$ipv4."
&rootpass=".$vt_rootpw."
&hostname=".$vt_hostname."
&ram=".$vt_ram."
&swap=512
&bandwidth=0
&user_email=".$usermail."
&user_pass=".$userpass."
&cores=".$vt_cores."
&space=".$vt_space."
&vnc=1
&osid=".$installos."
&nic_type=virtio
&upload_speed=0
&network_speed=0";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
?>