<?php

$order_success = false;

if(isset($_POST['order'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

                $SQL = $db->prepare("SELECT * FROM `gamecloud_packs` WHERE `gc_pack_name` = :name");
                $SQL->execute(array(":name" => $_POST['packname']));
                if ($SQL->rowCount() != 0) {
                while ($packres = $SQL -> fetch(PDO::FETCH_ASSOC)){


	$proname = $packres['gc_pack_name'];
	$state = "active";
    $cpu = $packres['gc_pack_cpu'];
    $ram = $packres['gc_pack_ram'];
    $disk = $packres['gc_pack_ssd'];
    $datenbanken = $packres['gc_datenbanken'];
    $runtime = 30;
					
    $db_price = $packres['gc_pack_price'];

    $price = $db_price * $validate->getIntervalFactor($runtime);
    $price = number_format($price,2);


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

	$userpw = $helper->generateRandomString('24');
    $usermail = $user->getDataById($userid,'username').$helper->generateRandomString('4')."@kvmhost.black-host.eu";

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

        $SQL = $db->prepare("INSERT INTO `gamecloud_clouds` (
		`user_id`,
		`gs_cpu`,
		`gs_ram`,
		`gs_disk`,
		`gs_datenbanken`, 
		`state`, 
		`expire_at`, 
		`price`
		) VALUES (?,?,?,?,?,?,?,?)");

        $SQL->execute(array($userid, $cpu, $ram, $disk, $datenbanken, $state, $expire_at, $price));
		
		include BASE_PATH.'app/manager/customer/kvm/functions/createVmAMD.php';
		sleep(4);

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$proname.' Bestellung');
		
        $discord->callWebhook('<@&874784920332017715> Soeben wurde eine neue Gamecloud bestellt von '.$username);

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt ist aktiv und kann nun genutzt werden.';
        header('Location: '.env('URL').'manage/gameclouds');


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/gamecloud');
    }

    }
    }

}