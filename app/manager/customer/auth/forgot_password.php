<?php

if(isset($_POST['requestReset'])){
    $error = null;

    $captcha_response = $site->validateCaptcha($_POST['h-captcha-response']);
    if($captcha_response == false){
        $error = 'Ungültige Anfrage bitte versuche es erneut (ERR-Captcha)';
    }

    if(empty($_POST['user_info'])){
        $error = 'Bitte gib einen Benutzernamen oder eine E-Mail ein.';
    }

    if(empty($error)){

        $user_name = $_POST['user_info'];

        $SQLGetInfo = $db->prepare("SELECT * FROM `users` WHERE `username` = :user_name OR `email` = :user_mail");
        $SQLGetInfo->execute(array(':user_name' => $user_name, ':user_mail' => $user_name));
        $userInfo = $SQLGetInfo->fetch(PDO::FETCH_ASSOC);

        if ($SQLGetInfo->rowCount() == 1) {

            function generateVerifyCode($length = 15) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            $verify_code = generateVerifyCode();

            $setResetKey = $db->prepare("INSERT INTO `password_resets`(`user_info`, `key`) VALUES (:user_info,:very_code)");
            $setResetKey->execute(array(':user_info' => $user_name, ':very_code' => $verify_code));

            include BASE_PATH.'app/notifications/mail_templates/auth/forgot_password.php';
            sendMail($userInfo['email'], $userInfo['username'], $mailContent, $mailSubject, $emailAltBody);
            echo sendSuccess( 'Wir haben dir eine Email zum zurücksetzen gesendet.');
        } else {
            echo sendError( 'Es existiert kein Account mit dieser Email oder diesem Benutzernamen.');
        }

    } else {
        echo sendError($error);
    }

}


if(isset($_POST['resetPW'])){
    if(isset($_POST['new_password']) && !empty($_POST['new_password'])){
        if(isset($_POST['new_password_repeat']) && !empty($_POST['new_password_repeat'])){
            if($_POST['new_password'] == $_POST['new_password_repeat']){
                if(isset($_POST['key']) && !empty($_POST['key'])){
                    $SQLGetInfo = $db->prepare("SELECT * FROM `password_resets` WHERE `key` = :key");
                    $SQLGetInfo->execute(array(':key' => $_POST['key']));
                    if($SQLGetInfo->rowCount() == 1){
                        $SQLGetInfo = $db->prepare("SELECT * FROM `password_resets` WHERE `key` = :key");
                        $SQLGetInfo->execute(array(':key' => $_POST['key']));
                        $userInfo = $SQLGetInfo->fetch(PDO::FETCH_ASSOC);

                        $cost = 10;
                        $hash = password_hash($_POST['new_password'], PASSWORD_BCRYPT, ['cost' => $cost]);

                        $SQLGetInfo = $db->prepare("UPDATE `users` SET `password` = :password WHERE `username` = :user_name OR `email` = :user_mail");
                        $SQLGetInfo->execute(array(':password' => $hash, ':user_name' => $userInfo['user_info'], ':user_mail' => $userInfo['user_info']));

                        $deleteKey = $db->prepare("DELETE FROM `password_resets` WHERE `key` = :key");
                        $deleteKey->execute(array(':key' => $_POST['key']));

                        //setcookie("pw_reset_success", 'pw_reset_success', time() + 5);
                        header('Refresh: 3; URL='.$url.'login');
                        echo sendSuccess('Erfolgreich','Dein Passwort wurde erfolgreich geändert du kannst dich nun einloggen.');

                    } else {
                        header('Refresh: 3; URL='.$url.'login');
                        echo sendError('Fehler', 'Dieser Reset Key ist ungültig.');
                    }
                }
            } else {
                echo sendError('Fehler', 'Die Passwörter stimmen nicht überein.');
            }
        } else {
            echo sendError('Fehler', 'Bitte wiederhole das Passwort.');
        }
    } else {
        echo sendError('Fehler', 'Bitte gib ein Passwort an.');
    }
}