<?php

$order_success = false;

if(isset($_POST['order'])){

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


	$proname = "SINUSBOT";
	$state = "active";
    $cpu = $_POST['cores'];
    $memory = $_POST['memory'];
    $disk = $_POST['disk'];
	$backups = $_POST['backups'];
	$mainrabatt_script = $_POST['mainrabatt_script'];
    $password_sb = $_POST['password_sb']; 


    $db_price = $site->getProductOptionEntrie('40', $cpu,'price')
        +$site->getProductOptionEntrie('41', $memory,'price')
        +$site->getProductOptionEntrie('23', $backups,'price')
        +$site->getProductOptionEntrie('22', $disk,'price');
	$pricere1 = $db_price * $validate->getIntervalFactor($runtime) * $mainrabatt_script;
    $price = $db_price * $validate->getIntervalFactor($runtime) - $pricere1 - $_POST['codeprice'];
	
    $price = number_format($price,2);

    if($price < $_POST['codeprice']){
        $error = 'Der Gutscheincode entspricht einem zu hohen Wert';
        $_SESSION['error_msg'] = 'Der Gutscheincode entspricht einem zu hohen Wert';
        header('Location: '.env('URL').'dashboard');
        die();
    }

    if($amount < $price){
        $error = 'Du hast leider nicht genügend Guthaben';
        $_SESSION['error_msg'] = 'Du hast leider nicht genügend Guthaben';
        header('Location: '.env('URL').'accounting/charge');
        die();
    }

    if($price == 0){
        $error = 'Ungültige Anfrage bitte versuche es erneut (1001)';
    }
	



    if(empty($error)){

if(is_null($user->getDataByUsername($username,'pterodactyl_id'))){
    $password = $helper->generateRandomString(25,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!*?_#^/$%@');
    $pterodactyl_id = $pterodactyl->createUser($userid,'kunde'.$userid, $mail, $username,'none',$password);
    $id_data = ($pterodactyl_id);
    $id = $id_data->id;
    if(is_numeric($id)){
        $SQL = $db->prepare("UPDATE `users` SET `pterodactyl_id` = :pterodactyl_id, `pterodactyl_password` = :pterodactyl_password WHERE `id` = :user_id");
        $SQL->execute(array(":pterodactyl_id" => $id, ":pterodactyl_password" => $password, ":user_id" => $userid));
    }
}


$limits = [
    'memory' => $memory,
    'swap' => 512,
    'disk' => $disk,
    'io' => 500,
    'cpu' => $cpu
];

$feature_limits = [
    'databases' => 0,
    'backups' => $backups,
    'allocations' => 1
];


$response = $pterodactyl->createSINUS('SinusBot Instanz', $user->getDataById($userid, 'pterodactyl_id'), $password_sb, $limits, $feature_limits);


        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

			$gs_ram = $memory;
			$gs_disk = $disk;
		    $gs_backups = $backups;
		    $gs_host = "de.intel01.host-control.eu";

        $SQL = $db->prepare("INSERT INTO `sinusbots` (
		`user_id`,
		`gs_cpu`,
		`gs_ram`,
		`gs_disk`,
		`gs_backups`,
        `sb_password`,
        `gs_host`,
		`state`, 
		`expire_at`, 
		`price`,
		`response`
		) VALUES (?,?,?,?,?,?,?,?,?,?,?)");


        $SQL->execute(array($userid, $cpu, $gs_ram, $gs_disk, $gs_backups, $password_sb, $gs_host, $state, $expire_at, $price, json_encode($response)));
		
		include BASE_PATH.'app/manager/customer/gameserver/functions/createMC.php';
		sleep(4);

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$proname.' Bestellung');
		
        $discord->callWebhook('<@&874784920332017715> Soeben wurde ein neuer SINUSBOT bestellt von '.$username);

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt ist aktiv und kann nun genutzt werden.';
        header('Location: '.env('URL').'manage/sinusbot');


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/gameserver');
    }


}