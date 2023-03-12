<?php

$order_success = false;

if(isset($_POST['order'])){

    $error = [];

    if($helper->getSetting('webspace') == 0){
        array_push($error, 'Die Bestellung ist derzeit deaktiviert');
    }

    if(!$user->sessionExists($_COOKIE['session_token'])){
        array_push($error, 'Bitte logge dich erst ein');
    }

    if(empty($_POST['domainName'])){
        array_push($error,  'Bitte gebe einen Domain Name an');
    }

    if($validate->is_domain_name($_POST['domainName']) == false){
        array_push($error, 'Bitte gebe einen gültigen Domain Name an.');
    }

    if(!isset($_POST['wiederruf'])){
        array_push($error, 'Du musst Unsere Wiederrufsbestimmungen akzeptieren');
    }

    if(!isset($_POST['agb'])){
        array_push($error, 'Du musst Unsere AGB und Datenschutzbestimmungen akzeptieren');
    }

//    if(empty($_POST['runtime'])){
//        array_push($error, 'runtime not found';
//    }
    $runtime = 30;
    if($validate->duration($runtime) != true){
        array_push($error, 'Bitte gebe eine gültige Laufzeit an');
    }

    if(empty($_POST['planName'])){
        array_push($error, 'Es konnte kein Webspace Paket gefunden werden');
    }

    if($helper->getWebspaceType() == 'plesk') {
        if ($plesk->getPrice($_POST['planName']) == false) {
            array_push($error, 'Es konnte kein Webspace Paket mit diesem Namen gefunden werden');
        }

        $db_price = $plesk->getPrice($_POST['planName']);
    } elseif($helper->getWebspaceType() == 'keyhelp') {
        if ($keyhelp->getPrice($_POST['planName']) == false) {
            array_push($error, 'Es konnte kein Webspace Paket mit diesem Namen gefunden werden');
        }

        $db_price = $keyhelp->getPrice($_POST['planName']);
    }

    $price = $db_price * $validate->getIntervalFactor($runtime);
    $price = number_format($price,2);

    if($amount < $price){
        array_push($error, 'Du hast leider nicht genügend Guthaben');
        $_SESSION['error_msg'] = 'Du hast leider nicht genügend Guthaben';
        header('Location: '.env('URL').'accounting/charge');
        die();
    }

    if($price == 0){
        array_push($error, 'Ungültige Anfrage bitte versuche es erneut (1001)');
    }

    if(empty($error)){

        $discord->callWebhook('<@&874784920332017715> Soeben wurde ein neuer Webspace bestellt von '.$username);

        if($helper->getWebspaceType() == 'plesk') {

            $SQL = $db->prepare("SELECT * FROM `webspace_packs` WHERE `plesk_id` = :plesk_id");
            $SQL->execute(array(":plesk_id" => $_POST['planName']));
            $response = $SQL->fetch(PDO::FETCH_ASSOC);

            $queue = [
                "action" => "PLESK_ORDER",
                "data" => [
                    "username" => $username.$userid,
                    "email" => $mail,
                    "price" => $db_price,
                    "planName" => $_POST['planName'],
                    "domainName" => $_POST['domainName'],
                    "runtime" => 30
                ]
            ];
            $queue = json_encode($queue);
            $insert = $db->prepare("INSERT INTO `queue`(`user_id`, `payload`) VALUES (?,?)");
            $insert->execute(array($userid, $queue));

        } elseif($helper->getWebspaceType() == 'keyhelp') {

            $SQL = $db->prepare("SELECT * FROM `webspace_packs` WHERE `keyhelp_id` = :keyhelp_id");
            $SQL->execute(array(":keyhelp_id" => $_POST['planName']));
            $response = $SQL->fetch(PDO::FETCH_ASSOC);

            $queue = [
                "action" => "KEYHELP_ORDER",
                "data" => [
                    "username" => $username.$userid . '-' . $helper->generateRandomString('4', '01234567890'),
                    "email" => $mail,
                    "price" => $db_price,
                    "planName" => $_POST['planName'],
                    "domainName" => $_POST['domainName'],
                    "runtime" => 30
                ]
            ];
            $queue = json_encode($queue);
            $insert = $db->prepare("INSERT INTO `queue`(`user_id`, `payload`) VALUES (?,?)");
            $insert->execute(array($userid, $queue));
        }

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,'Webspace Bestellung');

        if($user->getDataById($userid,'mail_order')){
            include BASE_PATH.'app/notifications/mail_templates/product/order.php';
            $mail_state = $sendmail->send($mail, $username, $mailContent, $mailSubject);
        }

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt wird gleich eingerichtet';
        header('Location: '.env('URL').'manage/webspace');

    } else {
        foreach ($error as $item) {
            echo sendError($item);
        }
    }

}