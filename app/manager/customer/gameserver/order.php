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

    if(empty($_POST['memory'])){
        $error = 'memory not found';
    }
    if(empty($_POST['cores'])){
        $error = 'cores not found';
    }
    if(empty($_POST['disk'])){
        $error = 'disk not found';
    }
    if(empty($_POST['runtime'])){
        $error = 'runtime not found';
    }
    if($site->productOptionEntrieExist('21', $_POST['memory']) == false){
        $error = 'memory option entry does not exists';
    }
    if($site->productOptionEntrieExist('20', $_POST['cores']) == false){
        $error = 'cores option entry does not exists';
    }
    if($site->productOptionEntrieExist('22', $_POST['disk']) == false){
        $error = 'disk option entry does not exists';
    }
    $memory = $_POST['memory'];
    $cpu = $_POST['cores'];
    $disk = $_POST['disk'];
    $runtime = $_POST['runtime'];

    /*
    * calculate price
    */
    $memory_price = $site->getProductOptionEntrie('21', $memory,'price');
    $cpu_price = $site->getProductOptionEntrie('20', $cpu,'price');
    $disk_price = $site->getProductOptionEntrie('22', $disk,'price');

    $db_price = $memory_price + $cpu_price + $disk_price;
    $price = $db_price * $validate->getIntervalFactor($runtime);

    $price = round($price,2);

    if($reseller = true){
        $price = 0;
    }

    if($amount < $price){
        $error = 'Du hast leider nicht genügend Guthaben';
        $_SESSION['error_msg'] = 'Du hast leider nicht genügend Guthaben';
        header('Location: '.env('URL').'accounting/charge');
        die();
    }

    if($validate->duration($runtime) != true){
        $error = 'Bitte gebe eine gültige Laufzeit an';
    }

    if($price <= 0){
        $error = 'Ungültige Anfrage bitte versuche es erneut (1001)';
    }

    if(empty($error)){

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,'Gameserver Bestellung');

        $order_success = true;

        $queue = [
            "action" => "GAMESERVER_ORDER",
            "data" => [
                "username" => $username,
                "email" => $mail,
                "price" => $db_price,
                "runtime" => $runtime,
                "memory" => $memory,
                "disk" => $disk,
                "cpu" => $cpu,
            ]
        ];
        $queue = json_encode($queue);
        $insert = $db->prepare("INSERT INTO `queue`(`user_id`, `payload`) VALUES (?,?)");
        $insert->execute(array($userid, $queue));

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt wird gleich eingerichtet';
        header('Location: '.env('URL').'manage/gameserver');

    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/gameserver');
        die();
    }

}