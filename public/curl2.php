<?php
$url = "https://45.142.182.66:4083/index.php?act=add&api=json&apikey=''apipass=''";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data ="addvs=1
&virt=proxk&sgid=2&rootpass=".$vt_rootpw."&hostname=".$vt_hostname."&space=1&ram=".$vt_ram."&swap=0&bandwidth=0&user_email=".$usermail."&user_pass=".$userpass."&cores=".$vt_cores."&num_ipv4=".$vt_ips."&space=".$vt_space."&vnc=0&osid=881";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
?>

<style>
pre {
  display: block;
  font-family: monospace;
  white-space: pre;
  margin: 1em 0;
}
	</style>
<body>

<pre>
<?php
var_dump($resp);
?>
</pre>

</body>