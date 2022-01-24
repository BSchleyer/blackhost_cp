<?php
$clickerror = false;

$siteid = $helper->protect($_GET['id']);


// Checker Start
    $SQL3 = $db->prepare("SELECT * from `aff_clicks` WHERE `owner_name` = :user_id AND `user_ip` = :user_ip");
    $SQL3->execute(array(":user_id" => $siteid, ":user_ip" => $user->getIP()));
    while ($usercheck = $SQL3 -> fetch(PDO::FETCH_ASSOC)){
		
if($usercheck['user_ip'] == $user->getIP()){

$clickerror = true;

}
		
}

if($siteid == "KeinSupport"){

$clickerror = true;

}
// Checker Ende


// main

    $SQL2 = $db->prepare("SELECT * from `users` WHERE `username` = :user_id");
    $SQL2->execute(array(":user_id" => $siteid));
    while ($userinfo = $SQL2 -> fetch(PDO::FETCH_ASSOC)){
		
if($clickerror == false){

if($userinfo['user_addr'] !== $user->getIP()){

    $SQL = $db->prepare("INSERT INTO `aff_clicks` SET `user_ip` = :ip, `owner_name` = :owner_name");
    $SQL->execute(array(":ip" => $user->getIP(), ":owner_name" => $siteid));
}

}

header('Location: https://black-host.eu');

}

?>