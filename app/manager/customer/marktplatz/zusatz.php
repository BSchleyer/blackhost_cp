<?php

$id = $helper->protect($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `marktplatz` WHERE `id` = :id");
$SQLGetServerInfos -> execute(array(":id" => $id));
$serverInfos = $SQLGetServerInfos -> fetch(PDO::FETCH_ASSOC);

if(!is_null($serverInfos['locked'])){
    $_SESSION['product_locked_msg'] = $serverInfos['locked'];
    header('Location: '.env('URL').'manage/marktplatz');
    die();
}

if(!($serverInfos['deleted_at'] == NULL)){
    header('Location: '.$helper->url().'order/marktplatz');
    die();
}

if($serverInfos['state'] == 'suspended'){
    $suspended = true;
    die(header('Location: '.$helper->url().'renew/marktplatz/'.$id));
} else {
    $suspended = false;
}


if($userid != $serverInfos['user_id']){
    die(header('Location: '.$helper->url().'dashboard'));
}

if($serverInfos['state'] == 'active'){
    $state = '<span class="badge badge-success">Aktiv</span>';
} elseif($serverInfos['state'] == 'suspended') {
    $state = '<span class="badge badge-warning">Gesperrt</span>';
}else {
    $state = '<span class="badge badge-danger">Unbekannt</span>';
}

if(isset($_POST['order'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    $db_price = $_POST['planPrice'];
    $proname = $_POST['plan_id'];
    $price = $db_price * $validate->getIntervalFactor($runtime);
	$priceSetup = $_POST['planPriceSetup'] * $validate->getIntervalFactor($runtime); 
    $price = number_format($price,2);


    if($amount < $price){
        $error = 'Du hast leider nicht genügend Guthaben';
        $_SESSION['error_msg'] = 'Du hast leider nicht genügend Guthaben';
        header('Location: '.env('URL').'accounting/charge');
        die();
    }

    if($amount < $priceSetup+$price){
        $error = 'Du hast leider nicht genügend Guthaben';
        $_SESSION['error_msg'] = 'Du hast leider nicht genügend Guthaben, um die Einrichtungsgebühr des Servers zu decken.';
        header('Location: '.env('URL').'accounting/charge');
        die();
    }

    if($price == 1000){
        $error = 'Ungültige Anfrage bitte versuche es erneut (1001)';
    }

    if(empty($error)){

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

        $SQL = $db->prepare("INSERT INTO `marktplatz_zusatz` (`mp_id`, `zusatz_name`, `locked`) VALUES (?,?,?)");
        $SQL->execute(array($id, $proname, "pending"));

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$proname.' Bestellung');

        $user->removeMoney($priceSetup, $userid);
        $user->addTransaction($userid,'-'.$priceSetup,$proname.' Einrichtungsgebühr');
		
        $discord->callWebhook('<@&874784920332017715> Soeben wurde ein Addon bestellt von '.$username);

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Zusatzpaket wird in kürze freigeschaltet';
        header('Location: '.env('URL').'manage/marktplatz');


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/marktplatz');
    }

}