<?php

require_once BASE_PATH . 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sendmail = new sendMail();
class sendMail extends Controller {

    protected $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);

        // smtp details
        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'TLS';
        //$this->mail->SMTPAutoTLS = true;
    }

    public function send($email, $username, $mailContent, $mailSubject) {
        include BASE_PATH.'app/notifications/mail_templates/mail_style.php';

        try {
            // set login data to email settings
            $this->mail->Host = env('MAIL_HOST');
            $this->mail->Username = env('MAIL_USERNAME');
            $this->mail->Password = env('MAIL_PASSWORD');
            $this->mail->Port = env('MAIL_PORT');

            // add contact for sendmail & set from
            $this->mail->setFrom(env('MAIL_USERNAME'), env('MAIL_NAME'));
            $this->mail->addReplyTo('info@black-host.eu', 'BlackHost - Kundenmailer');
            $this->mail->addAddress($email, $username);

            // set html mode, body content and other settings
            $this->mail->isHTML(true);
            $this->mail->Subject = $mailSubject;
            $this->mail->Body = $emailBody;
            $this->mail->AltBody = null;
            $this->mail->CharSet = 'utf-8';

            return $this->mail->send();
        } catch (\Exception $e) {
            return 'Die E-Mail konnte nicht gesendet werden. Fehler: ' . $this->mail->ErrorInfo;
        }
    }

}