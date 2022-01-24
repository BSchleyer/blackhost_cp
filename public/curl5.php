<?php
$ipv4 = "1";
$vt_rootpw = "";
$vt_hostname = "testttt";
$vt_ram = "12000";
$usermail = "test@mail.de";
$userpass = "";
$vt_cores = "6";
$vt_space = "100";
$installos = "979";
$anbindung = "12800000";
?>

<?php
$url = "https://vps.host-control.eu:4083/index.php?act=create&api=json&apikey=''&apipass''";

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
&rootpass=".$vt_rootpw."
&nic_type=e1000
&ips=".$ipv4."
&hostname=".$vt_hostname."
&ram=".$vt_ram."
&swap=0
&bandwidth=0
&user_email=".$usermail."
&user_pass=".$userpass."
&cores=".$vt_cores."
&space=".$vt_space."
&vnc=1
&osid=".$installos."
&upload_speed=".$anbindung."
&network_speed=".$anbindung."";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
?>