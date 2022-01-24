<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($user_email, $user_name, $mailContent, $mailSubject, $emailAltBody = null){

    include BASE_PATH.'app/notifications/mail_templates/mail_style.php';

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'webmail.black-host.eu';
        $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;
        $mail->Username = 'no-reply@black-host.eu';
        $mail->Password = 'd71^Dcb2';
        $mail->Port = 25;

        $mail->setFrom('no-reply@black-host.eu', 'BlackHost - Kundenmailer');
        $mail->addAddress($user_email, $user_name);

        $mail->isHTML(true);
        $mail->Subject = $mailSubject;
        $mail->Body = $emailBody;
        $mail->AltBody = $emailAltBody;
        $mail->CharSet = 'utf-8';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'abc';
        return 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    }

}