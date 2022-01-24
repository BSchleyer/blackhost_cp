<?php

//
// EDITOR [START]
//

if(isset($_POST['editServer'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }


    $cpu = $_POST['edit_cpu'];
    $memory = $_POST['edit_ram'];
    $disk = $_POST['edit_speicher'];
    $databases = $_POST['edit_db'];
    $customname = $_POST['custom_name'];
	$wisp_id = $_POST['wisp_id'];
	$allo_id = $_POST['allo_id'];
	
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

$response = $pterodactyl->updateBuild($wisp_id, $limits, $feature_limits, $allo_id);
$response_data = ($response);


                $SQL = $db->prepare("UPDATE `gamecloud_server` SET 
				`custom_name` = :custom_name,
				`gs_cpu` = :gs_cpu,
				`gs_ram` = :gs_ram,
				`gs_disk` = :gs_disk,
				`gs_datenbanken` = :gs_datenbanken,
				`response` = :response
				WHERE `wisp_id` = :wisp_id
				");
		
                $SQL->execute(array(
					":custom_name" => $_POST['custom_name'],
					":gs_cpu" => $cpu,
					":gs_ram" => $memory,
					":gs_disk" => $disk,
					":gs_datenbanken" => $databases,
					":response" => json_encode($response),
					":wisp_id" => $wisp_id
				));
		
		sleep(2);


        $_SESSION['success_msg'] = 'Der Server wurde erfolgreich angepasst.';
        header('Location: '.env('URL').'manage/gamecloud/'.$id);


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'manage/gamecloud/'.$id);
    }


}

//
// EDITOR [ENDE]
//
?>