<?php

$id = $helper->protect($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `sinusbots` WHERE `id` = :id");
$SQLGetServerInfos -> execute(array(":id" => $id));
$serverInfos = $SQLGetServerInfos -> fetch(PDO::FETCH_ASSOC);

if(!is_null($serverInfos['locked'])){
    $_SESSION['product_locked_msg'] = $serverInfos['locked'];
    header('Location: '.env('URL').'manage/sinusbot');
    die();
}

if(!($serverInfos['deleted_at'] == NULL)){
    header('Location: '.$helper->url().'order/sinusbot');
    die();
}

if($serverInfos['state'] == 'suspended'){
    $suspended = true;
    die(header('Location: '.$helper->url().'renew/sinusbot/'.$id));
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