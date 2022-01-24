<?php

$order_success = false;

if(isset($_POST['order'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    if($helper->getSetting('vps') == 0){
        $error = 'Es konnte kein Hostsystem mit genug Leistung gefunden werden.';
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


	$proname = "KVM-IPV6";
	$state = "active";
    $cores = $_POST['cores'];
    $memory = $_POST['memory'];
    $disk = $_POST['disk'];
    $ipv4 = $_POST['ipv4'];
    $ipv6 = $_POST['ipv6'];
    $installos = $_POST['installos'];
	$mainrabatt_script = $_POST['mainrabatt_script'];
    //$runtime = $_POST['duration'];

    $db_price = $site->getProductOptionEntrie('53', $cores,'price')
        +$site->getProductOptionEntrie('1', $memory,'price')
        +$site->getProductOptionEntrie('52', $disk,'price')
        +$site->getProductOptionEntrie('51', $ipv6,'price')
        +$site->getProductOptionEntrie('50', $ipv4,'price');
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

	$userpw = $helper->generateRandomString('24');
    $usermail = $user->getDataById($userid,'username').$helper->generateRandomString('4')."@host-control.eu";

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

		    $vt_rootpw = $helper->generateRandomString('20');
			$vt_hostname = "de.vps".$helper->generateRandomString(5,'1234567890').".black-host.eu";
			$vt_ram = $memory;
		    //usermail wird definiert
			$userpass = $userpw;
			$vt_cores = $cores;
			$vt_ips = $addresses;
		    $vt_space = $disk;

        $SQL = $db->prepare("INSERT INTO `kvm_ipv6` (
		`vt_rootpw`,
		`vt_ownermail`,
		`vt_ownerpass`,
		`vt_ownerid`,
		`kvm_cpu`, 
		`kvm_ram`, 
		`kvm_speicher`, 
		`kvm_ipv4`, 
		`kvm_ipv6`, 
		`state`, 
		`expire_at`, 
		`price`
		) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

        $SQL->execute(array($vt_rootpw, $usermail, $userpw, $userid, $cores, $memory, $disk, $ipv4, $ipv6, $state, $expire_at, $price));
		
		include BASE_PATH.'app/manager/customer/kvm-ipv6/_createVM.php';
		sleep(4);

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$proname.' Bestellung');
		
        $discord->callWebhook('<@&874784920332017715> Soeben wurde ein neuer KVM-IPV6 bestellt von '.$username);

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt ist aktiv und kann nun genutzt werden.';
        header('Location: '.env('URL').'manage/kvm-ipv6s');


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/kvm-ipv6');
    }


}