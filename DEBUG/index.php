<?php
//$fields = array(
//    'support_pin' => NULL,
//);
//
//$headers = array();
//$headers[] = "X-Api-Key: YEEET";
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL,"https://kd298-1.sylvan.ooo/api/v1/discord/getUserData");
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//$output = curl_exec($ch);
//curl_close ($ch);
//
//$response = json_decode($output);
//dd($response);



//$result = $keyhelp->createUser('bjoern', 'bjrnschleyer@gmail.com', 2, 'Björn', 'Schleyer', 'Schleyer-EDV UG', '+4920951307050', 'Sydowstr. 3', 'Gelsenkirchen', '45894', 'Nordrhein-Westfalen', '1234567890');

$result = $keyhelp->getStats('2');

//$result = $keyhelp->unsuspendUser('2');
//$result = $keyhelp->getHostingPlans();
dd($result);

//dd('hmm was machst du hier?');

//dd($venocix->createVM('8','8192','150','1','Windows2019.eval'));
//dd($venocix->getJobInfo('85'));
//dd($venocix->currentVMStatus('2062'));
//dd($venocix->resetRootPW('VSERVER_ID'));
//dd($venocix->reinstallVM('40037', 'Windows2019.eval'));