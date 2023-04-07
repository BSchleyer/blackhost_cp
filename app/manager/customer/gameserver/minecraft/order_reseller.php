<?php

$order_success = false;

if(isset($_POST['orderRes'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    if(!isset($_POST['wiederruf'])){
        $error = 'Du musst Unsere Wiederrufsbestimmungen akzeptieren';
    }

    if(!isset($_POST['agb'])){
        $error = 'Du musst Unsere AGB und Datenschutzbestimmungen akzeptieren';
    }

    if(empty($_POST['duration'])){
        $error = 'duration not found';
    }
    $runtime = $_POST['duration'];
    if($validate->duration($runtime) != true){
        $error = 'Bitte gebe eine gültige Laufzeit an';
    }

    if(empty($_POST['cores'])){
        $error = 'cores not found';
    }
    if(empty($_POST['memory'])){
        $error = 'memory not found';
    }
    if(empty($_POST['disk'])){
        $error = 'disk not found';
    }
    if(empty($_POST['duration'])){
        $error = 'runtime not found';
    }


	$proname = "MC-GAMESERVER";
	$state = "active";
    $cpu = $_POST['cores'];
    $memory = $_POST['memory'];
    $disk = $_POST['disk'];
	$backups = $_POST['backups'];
	$version = $_POST['version'];
	$version_build = $_POST['version_build'];
	$databases = $_POST['databases'];
	$mainrabatt_script = $_POST['mainrabatt_script'];


    $db_price = 0;
	$pricere1 = 0;
    $price = 0;
	
    $price = number_format($price,0);

    if($price == 10000){
        $error = 'Ungültige Anfrage bitte versuche es erneut (1001)';
    }
	



    if(empty($error)){


    $password = $helper->generateRandomString(25,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    $usercreator = $helper->generateRandomString(4,'0123456789');
		
    $pterodactyl_id = $pterodactyl->createUser($usercreator,'rskunde'.$usercreator, $usercreator.'@host-control.eu', $usercreator,'none', $password);
    $id_data = ($pterodactyl_id);
    $id = $id_data->id;



$limits = [
    'memory' => $memory,
    'swap' => 512,
    'disk' => $disk,
    'io' => 500,
    'cpu' => $cpu
];

$feature_limits = [
    'databases' => $databases,
    'backups' => $backups,
    'allocations' => 1
];


$response = $pterodactyl->create('game.host-control.eu', $id, $version, $limits, $feature_limits, $version_build);


        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

		
		    $gs_username = $usercreator;
			$gs_ram = $memory;
			$gs_disk = $disk;
		    $gs_backups = $backups;
		    $gs_host = "de.intel01.host-control.eu";

        $SQL = $db->prepare("INSERT INTO `gameserver_mc` (
		`user_id`,
		`gs_cpu`,
		`gs_ram`,
		`gs_disk`,
		`gs_backups`,
		`gs_datenbanken`,
		`gs_host`,
		`gs_username`,
		`gs_pass`,
		`state`, 
		`expire_at`, 
		`price`,
		`response`
		) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");


        $SQL->execute(array($userid, $cpu, $gs_ram, $gs_disk, $gs_backups, $databases, $gs_host, $gs_username, $password, $state, $expire_at, $price, json_encode($response)));
		
		include BASE_PATH.'app/manager/customer/gameserver/functions/createMC.php';
		sleep(4);

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$proname.' Bestellung');
		
        $discord->callWebhook('*keinping* Soeben wurde ein neuer MC-RESELLER bestellt von '.$username);

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt ist aktiv und kann nun genutzt werden.';
        header('Location: '.env('URL').'manage/gameserver/mc');


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/gameserver');
    }


}