<?php

$username = strtolower($payload->data->username);
$mail = $payload->data->email;
$userid = $row['user_id'];
$db_price = $payload->data->price;
$runtime = $payload->data->runtime;
$planName = $payload->data->planName;
$domainName = $payload->data->domainName;

$plan_id = $keyhelp->getPlanId($planName);

if(is_null($user->getDataById($userid,'keyhelp_uuid'))) {
    $password = $helper->generateRandomString(25, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!*?_#^/$%@');
    $response = $keyhelp->createUser($username, $mail, $password, $plan_id, $username . '-' . $userid);
    if (is_numeric($response->id)) {

        $update = $db->prepare("UPDATE `users` SET `keyhelp_uuid` = :keyhelp_id, `keyhelp_password` = :keyhelp_password, `keyhelp_username` = :keyhelp_username WHERE `id` = :user_id");
        $update->execute(array(":keyhelp_id" => $response->id, ":keyhelp_password" => $response->password, ":keyhelp_username" => $username, ":user_id" => $userid));

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+'.$runtime.' day');
        $new_date = $date->format('Y-m-d H:i:s');

        $insert = $db->prepare("INSERT INTO `webspace`(`plan_id`, `user_id`, `ftp_name`, `ftp_password`, `domainName`, `webspace_id`, `state`, `expire_at`, `price`) VALUES (?,?,?,?,?,?,?,?,?)");
        $insert->execute(array($planName, $userid, 'nothing', 'nothing', $domainName, $response->id, 'active', $new_date, $db_price));

    } else {

        $update = $db->prepare("UPDATE `queue` SET `retries` = :retries, `error_log` = :error_log WHERE `id` = :id");
        $update->execute(array(":retries" => '255', ":error_log" => $response, ":id" => $row['id']));
        die('error happened');

    }
}