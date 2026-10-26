<?php
$currPage = 'system_paypal ipn';

include_once '../system.php';
include_once BASE_PATH.'vendor/autoload.php';
include_once BASE_PATH.'app/Kernel.php';
include_once BASE_PATH.'app/functions/autoload.php';
include_once BASE_PATH.'app/notifications/sendMail.php';

include BASE_PATH.'app/manager/customer/payment/functions.php';

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

if (isset($_POST["txn_id"]) && isset($_POST["txn_type"])) {

	// serialize processing per transaction id so parallel/replayed IPNs cannot credit twice
	$lockDb = $helper->db();
	$lockName = 'paypal_ipn_' . md5($_POST['txn_id']);
	$lockStmt = $lockDb->prepare("SELECT GET_LOCK(:name, 10)");
	$lockStmt->execute(array(":name" => $lockName));

	$SQL = $db->prepare("SELECT * FROM `transactions` WHERE `state` = 'success' AND `tid` = :tid");
    $SQL->execute(array(":tid" => $_POST['txn_id']));
    if($SQL->rowCount() == 0) {

		$data = [
			'item_name' => $_POST['item_name'],
			'item_number' => $_POST['item_number'],
			'payment_status' => $_POST['payment_status'],
			'payment_amount' => $_POST['mc_gross'],
			'payment_currency' => $_POST['mc_currency'],
			'txn_id' => $_POST['txn_id'],
			'receiver_email' => $_POST['receiver_email'],
			'payer_email' => $_POST['payer_email'],
			'custom' => $_POST['custom'],
		];

		// the payment must be completed, in EUR and addressed to our own PayPal account
		$validPayment = $data['payment_status'] === 'Completed'
			&& $data['payment_currency'] === 'EUR'
			&& strcasecmp(trim((string)$data['receiver_email']), (string)$paypalConfig['email']) === 0
			&& $_POST['txn_type'] === 'web_accept'
			&& is_numeric($data['payment_amount']) && $data['payment_amount'] > 0;

		if ($validPayment && verifyTransaction($_POST)){
			$custom = $data['custom'];
			$user_id = $user->getDataBySession($custom,'id');

			if(!empty($user_id)){
				$money = $data['payment_amount'];
				$username = $user->getDataById($user_id, 'username');

				$site->addTransaction($user_id,'paypal','success', $data['payment_amount'],'Guthabenaufladung mit Paypal', $data['txn_id']);
				$user->addMoney($money, $user_id);

				//$discord->callWebhook('Soeben wurden '.$money.'€ aufgeladen von '.$username.' (PayPal)');

				include BASE_PATH.'app/notifications/mail_templates/payment/payment_done.php';
				sendMail($user->getDataById($user_id,'email'), $user->getDataById($user_id,'username'), $mailContent, $mailSubject);
			}
		}
		
	} else {
        echo 'Transaction already confirmed';
    }

	$lockStmt = $lockDb->prepare("SELECT RELEASE_LOCK(:name)");
	$lockStmt->execute(array(":name" => $lockName));

} else {
    die('error');
}
