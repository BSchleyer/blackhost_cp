<?php

$order_success = false;

if(isset($_POST['order'])){

    $error = null;
    $runtime = 30;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    if($helper->getSetting('vps') == 0){
        $error = 'Es konnte kein Hostsystem mit genug Leistung gefunden werden.';
    }



                $SQL = $db->prepare("SELECT * FROM `kvm_packs` WHERE `pack_name` = :name");
                $SQL->execute(array(":name" => $_POST['packname']));
                if ($SQL->rowCount() != 0) {
                while ($packres = $SQL -> fetch(PDO::FETCH_ASSOC)){


	$proname = "KVM-SERVER";
	$state = "active";
    $cores = $packres['pack_cpu'];
    $memory = $packres['pack_ram'];
    $disk = $packres['pack_ssd'];
    $ipv4 = "1";
    $anbindung = "1280000";
    $ipv6 = "0";
    $installos = $_POST['installos'];
    //$runtime = $_POST['duration'];

    $db_price = $packres['pack_price'];
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
    $usermail = $user->getDataById($userid,'username').$helper->generateRandomString('4')."@host-control.eu";

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

		    $vt_rootpw = $helper->generateRandomString('20');
			$vt_hostname = "nld-vps".$helper->generateRandomString(5,'1234567890').".black-host.eu";
			$vt_ram = $memory;
		    //usermail wird definiert
			$userpass = $userpw;
			$vt_cores = $cores;
			$vt_ips = $addresses;
		    $vt_space = $disk;

        $SQL = $db->prepare("INSERT INTO `kvm` (
		`vt_rootpw`,
		`vt_ownermail`,
		`vt_ownerpass`,
		`vt_ownerid`,
		`kvm_cpu`, 
		`kvm_ram`, 
		`kvm_speicher`, 
		`kvm_ipv4`, 
		`kvm_ipv6`, 
		`kvm_anbindung`, 
		`state`, 
		`expire_at`, 
		`price`
		) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $SQL->execute(array($vt_rootpw, $usermail, $userpw, $userid, $cores, $memory, $disk, $ipv4, $ipv6, $anbindung, $state, $expire_at, $price));
		
		include BASE_PATH.'app/manager/customer/kvm/_createVM.php';
		sleep(4);

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$proname.' Bestellung');
		
        $discord->callWebhook('<@&874784920332017715> Soeben wurde ein neuer KVM-SERVER bestellt von '.$username);

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt ist aktiv und kann nun genutzt werden.';
        header('Location: '.env('URL').'manage/kvms');


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/kvm-pakete');
    }

	}}

}