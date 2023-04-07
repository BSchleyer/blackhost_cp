<?php

if(isset($_POST['order'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    $runtime = 30;
    $db_price = $_POST['planPrice'];
    $proname = $_POST['plan_id'];
    $disk = $_POST['disk'];
	$state = 'pending';
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

        $SQL = $db->prepare("INSERT INTO `marktplatz` (`mp_name`, `user_id`, `mp_desc`, `state`, `expire_at`, `price`) VALUES (?,?,?,?,?,?)");
        $SQL->execute(array($proname, $userid, $disk, $state, $expire_at, $price));

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$proname.' Bestellung');

        if($priceSetup != 0.00) {
            $user->removeMoney($priceSetup, $userid);
            $user->addTransaction($userid,'-'.$priceSetup,$proname.' Einrichtungsgebühr');
        }
		
        $discord->callWebhook('<@&874784920332017715> Soeben wurde ein neuer Marktplatz-Paket bestellt von '.$username);

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt wird in kürze freigeschaltet';
        header('Location: '.env('URL').'manage/marktplatz');


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/marktplatz');
    }

}