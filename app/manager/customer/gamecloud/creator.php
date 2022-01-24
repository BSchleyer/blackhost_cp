<?php
//
// MC CREATOR [START]
//

if(isset($_POST['createMC'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }



	$proname = "Minecraft Server";
	$state = "active";
    $cpu = $_POST['create_cpu'];
    $memory = $_POST['create_ram'];
    $disk = $_POST['create_speicher'];
	$databases = $_POST['create_db'];
    $version = "14";
    $version_build = "1.8";
	
    $ramav = $serverInfos['gs_ram']  / 1000;
    $cpuav = $serverInfos['gs_cpu']  / 100;
    $diskav = $serverInfos['gs_disk']  / 1000;
    $dbav = $serverInfos['gs_datenbanken'];


    if(($ramav - $ramcount) * 1000 < $memory) {
        $error = 'Du hast nicht genügend Ram frei.';
    }

    if(($cpuav - $cpucount) * 100 < $cpu) {
        $error = 'Du hast nicht genug Kerne frei.';
    }

    if(($diskav - $diskcount) * 1000 < $disk) {
        $error = 'Du hast nicht genug Festplattenspeicher.';
    }

    if($dbav - $dbcount < $databases) {
        $error = 'Du hast keine freien Datenbanken mehr.';
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
    'databases' => $databases,
    'backups' => 0,
    'allocations' => 1
];


$response = $pterodactyl->create('GameCloud - Minecraft Server', $user->getDataById($userid, 'pterodactyl_id'),$version, $limits, $feature_limits, $version_build);
$response_data = ($response);

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

			$gs_ram = $memory;
			$gs_disk = $disk;
		    $gs_backups = $backups;

        $SQL = $db->prepare("INSERT INTO `gamecloud_server` (
		`cloud_id`,
        `wisp_id`,
        `allo_id`,
        `gs_name`,
		`gs_cpu`,
		`gs_ram`,
		`gs_disk`,
		`gs_datenbanken`,
		`state`, 
		`response`
		) VALUES (?,?,?,?,?,?,?,?,?,?)");


        $SQL->execute(array($gamecloudid, $response_data->id, $response_data->allocation, $proname, $cpu, $gs_ram, $gs_disk, $databases, $state, json_encode($response)));
		
		sleep(2);


        $_SESSION['success_msg'] = 'Der Gameserver wurde erfolgreich angelegt.';
        header('Location: '.env('URL').'manage/gamecloud/'.$id);


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'manage/gamecloud/'.$id);
    }


}

//
// MC CREATOR [ENDE]
//


//
// TS CREATOR [START]
//

if(isset($_POST['createTS'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }



	$proname = "Teamspeak Server";
	$state = "active";
    $cpu = $_POST['create_cpu'];
    $memory = $_POST['create_ram'];
    $disk = $_POST['create_speicher'];
    $version = "38";
	
    $ramav = $serverInfos['gs_ram']  / 1000;
    $cpuav = $serverInfos['gs_cpu']  / 100;
    $diskav = $serverInfos['gs_disk']  / 1000;
    $dbav = $serverInfos['gs_datenbanken'];


    if(($ramav - $ramcount) * 1000 < $memory) {
        $error = 'Du hast nicht genügend Ram frei.';
    }

    if(($cpuav - $cpucount) * 100 < $cpu) {
        $error = 'Du hast nicht genug Kerne frei.';
    }

    if(($diskav - $diskcount) * 1000 < $disk) {
        $error = 'Du hast nicht genug Festplattenspeicher.';
    }

    if($dbav - $dbcount < $databases) {
        $error = 'Du hast keine freien Datenbanken mehr.';
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
    'backups' => 0,
    'allocations' => 1
];


$response = $pterodactyl->createTS('GameCloud - Teamspeak Server', $user->getDataById($userid, 'pterodactyl_id'),$version, $limits, $feature_limits);
$response_data = ($response);

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

			$gs_ram = $memory;
			$gs_disk = $disk;
		    $gs_backups = $backups;

        $SQL = $db->prepare("INSERT INTO `gamecloud_server` (
		`cloud_id`,
        `wisp_id`,
        `allo_id`,
        `gs_name`,
		`gs_cpu`,
		`gs_ram`,
		`gs_disk`,
		`gs_datenbanken`,
		`state`, 
		`response`
		) VALUES (?,?,?,?,?,?,?,?,?,?)");


        $SQL->execute(array($gamecloudid, $response_data->id, $response_data->allocation, $proname, $cpu, $gs_ram, $gs_disk, $databases, $state, json_encode($response)));
		
		sleep(2);


        $_SESSION['success_msg'] = 'Der Teamspeak wurde erfolgreich angelegt.';
        header('Location: '.env('URL').'manage/gamecloud/'.$id);


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'manage/gamecloud/'.$id);
    }


}

//
// TS CREATOR [ENDE]
//


//
// SINUSBOT CREATOR [START]
//

if(isset($_POST['createSinusBot'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }



	$proname = "Sinusbot Instanz";
	$state = "active";
    $cpu = $_POST['create_cpu'];
    $memory = $_POST['create_ram'];
    $disk = $_POST['create_speicher'];
    $sinuspass = $_POST['sinusbotpw'];
	
    $ramav = $serverInfos['gs_ram']  / 1000;
    $cpuav = $serverInfos['gs_cpu']  / 100;
    $diskav = $serverInfos['gs_disk']  / 1000;
    $dbav = $serverInfos['gs_datenbanken'];


    if(($ramav - $ramcount) * 1000 < $memory) {
        $error = 'Du hast nicht genügend Ram frei.';
    }

    if(($cpuav - $cpucount) * 100 < $cpu) {
        $error = 'Du hast nicht genug Kerne frei.';
    }

    if(($diskav - $diskcount) * 1000 < $disk) {
        $error = 'Du hast nicht genug Festplattenspeicher.';
    }

    if($dbav - $dbcount < $databases) {
        $error = 'Du hast keine freien Datenbanken mehr.';
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
    'backups' => 0,
    'allocations' => 1
];


$response = $pterodactyl->createSINUS('GameCloud - SinusBot Instanz', $user->getDataById($userid, 'pterodactyl_id'), $sinuspass, $limits, $feature_limits);
$response_data = ($response);

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

			$gs_ram = $memory;
			$gs_disk = $disk;
		    $gs_backups = $backups;

        $SQL = $db->prepare("INSERT INTO `gamecloud_server` (
		`cloud_id`,
        `wisp_id`,
        `allo_id`,
        `gs_name`,
		`gs_cpu`,
		`gs_ram`,
		`gs_disk`,
		`gs_datenbanken`,
		`state`, 
		`response`
		) VALUES (?,?,?,?,?,?,?,?,?,?)");


        $SQL->execute(array($gamecloudid, $response_data->id, $response_data->allocation, $proname, $cpu, $gs_ram, $gs_disk, $databases, $state, json_encode($response)));
		
		sleep(2);


        $_SESSION['success_msg'] = 'Der Sinusbot wurde erfolgreich angelegt.';
        header('Location: '.env('URL').'manage/gamecloud/'.$id);


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'manage/gamecloud/'.$id);
    }


}

//
// SINUSBOT CREATOR [ENDE]
//