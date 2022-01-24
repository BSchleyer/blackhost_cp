<?php

if(isset($_POST['order'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    $runtime = 30;
    $db_price = $_POST['planPrice'];
    $proname = $_POST['plan_id'];
	$state = 'pending';
    $price = $db_price * $validate->getIntervalFactor($runtime);
    $price = number_format($price,2);


    if($amount < $price){
        $error = 'Du hast leider nicht genügend Guthaben';
        $_SESSION['error_msg'] = 'Du hast leider nicht genügend Guthaben';
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

        $SQL = $db->prepare("INSERT INTO `webspace_rs` (`plan_id`, `user_id`, `state`, `expire_at`, `price`) VALUES (?,?,?,?,?)");
        $SQL->execute(array($proname, $userid, $state, $expire_at, $price));

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$proname.' Bestellung');
		
        $discord->callWebhook('<@&874784920332017715> Soeben wurde ein neuer Reseller-Webspace bestellt von '.$username);

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt wird in kürze freigeschaltet';
        header('Location: '.env('URL').'manage/reseller/webspace');


    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/webspace');
    }

}