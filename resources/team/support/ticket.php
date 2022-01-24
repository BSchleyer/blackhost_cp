<?php
$currPage = 'team_Ticket Support';
include BASE_PATH.'app/controller/PageController.php';

$ticket_id = $helper->protect($_GET['id']);
$SQL = $db->prepare("SELECT * FROM `tickets` WHERE `id` = :ticket_id");
$SQL->execute(array(":ticket_id" => $ticket_id));
$ticketInfos = $SQL -> fetch(PDO::FETCH_ASSOC);

$writer_id = $userid;

if(isset($_POST['answerTicket'])){
    $error = null;

    if($_POST['csrf_token'] != $_SESSION['csrf_token']){
        $error = 'Ungültige Anfrage bitte versuche es erneut!';
    }

    if(empty($_POST['message'])) {
        $error = 'Bitte gebe eine Nachricht an';
    }

    if(empty($error)){
        $SQL = $db->prepare("INSERT INTO `ticket_message`(`ticket_id`, `writer_id`, `message`) VALUES (:ticket_id,:writer_id,:message)");
        $SQL->execute(array(":ticket_id" => $ticket_id, ":writer_id" => $writer_id, ":message" => $_POST['message']));

        $SQL = $db->prepare("UPDATE `tickets` SET `last_msg` = 'SUPPORT' WHERE `id` = :id");
        $SQL->execute(array(":id" => $ticket_id));

        if($user->getDataById($ticketInfos['user_id'],'mail_ticket')){
            include BASE_PATH.'app/notifications/mail_templates/support/new_team_response.php';
            $mail_state = sendMail($user->getDataById($ticketInfos['user_id'],'email'), $user->getDataById($ticketInfos['user_id'],'username'), $mailContent, $mailSubject);
        }

        echo sendSuccess('Deine Antwort wurde an den Kunden übermittelt');
    } else {
        echo sendError($error);
    }
}

$state = $ticketInfos['state'];

if($state == 'OPEN'){
    $plain_state = 'Offen';
} elseif($state == 'CLOSED'){
    $plain_state = 'Geschlossen';
}

if($ticketInfos['last_msg'] == 'CUSTOMER'){
    $last_msg = 'Kunde';
} elseif($ticketInfos['last_msg'] == 'SUPPORT'){
    $last_msg = 'Support';
}

if(isset($_POST['closeTicket'])){
    $SQL = $db->prepare("UPDATE `tickets` SET `state` = 'CLOSED' WHERE `id` = :id");
    $SQL->execute(array(":id" => $ticket_id));

    $state = 'CLOSED';

    echo sendSuccess('Das Ticket wurde geschlossen');
}

if(isset($_POST['openTicket'])){
    $SQL = $db->prepare("UPDATE `tickets` SET `state` = 'OPEN' WHERE `id` = :id");
    $SQL->execute(array(":id" => $ticket_id));

    $state = 'OPEN';

    echo sendSuccess('Das Ticket wurde geöffnet');
}


?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-2">
                                Ticket-ID: #<?= $ticket_id; ?>
                            </div>
                            <div class="col-md-3">
                                Status: <?= $plain_state; ?>
                            </div>
                            <div class="col-md-3">
                                Letzte Antwort: <?= $last_msg; ?>
                            </div>
                            <div class="col-md-4">
                                Erstellt am: #<?= $ticketInfos['created_at']; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12"> <br> </div>

                <?php
                $SQL = $db -> prepare("SELECT * FROM `ticket_message` WHERE `ticket_id` = :ticket_id");
                $SQL->execute(array(":ticket_id" => $ticket_id));
                if ($SQL->rowCount() != 0) {
                    while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){
                        $writer_token = $user->getDataById($row['writer_id'],'session_token');
                        if($user->isInTeam($writer_token) == true){ ?>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <p><?= $helper->nl2br2($row['message']); ?></p>
                                        <small style="float: right;"><?= $user->getDataById($row['writer_id'], 'username'); ?> schrieb am <?= $row['created_at']; ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12"> <br> </div>
                        <?php } else { ?>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <p><?= $helper->nl2br2($row['message']); ?></p>
                                        <small style="float: right;"><?= $user->getDataById($row['writer_id'], 'username'); ?> schrieb am <?= $row['created_at']; ?></small>
                                    </div>
                                </div>
                            </div>

                            <?php
                        $thewirter =  $user->getDataById($row['writer_id'], 'username');
                        ?>

                            <div class="col-md-6"></div>
                            <div class="col-md-12"> <br> </div>
                        <?php } } } ?>

                        <?php if($user->getDataById($userid, 'role') == admin) {

                            $userrole = '';

                        } ?>

                <?php if($state == 'OPEN'){ ?>
                    <div class="col-md-12">
                        <form method="post">
                            <input name="csrf_token" value="<?php $csrf_token = $site->generateCSRF(); echo $csrf_token; $_SESSION['csrf_token'] = $csrf_token; ?>" type="hidden">

                            <textarea rows="10" name="message" class="form-control">Hallo <?= $thewirter; ?>,

Text
                        
Mit freundlichen Grüßen,
<?= $user->getDataById($userid, 'firstname') ?> <?= $user->getDataById($userid, 'lastname') ?>
</textarea>
                            <br>
                            <button type="submit" name="answerTicket" class="btn btn-outline-success btn-lg font-weight-bolder"><i class="fas fa-reply"></i> Antworten</button>&nbsp;
                            <button name="closeTicket" type="submit" class="btn btn-outline-primary btn-lg font-weight-bolder"><i class="fas fa-times"></i> Ticket schließen</button>
                        </form>

                    </div>
                <?php } else { ?>

                    <div class="col-md-12">
                        <!--div class="alert alert-primary text-center" role="alert">
                            Das Ticket ist geschlossen!
                        </div-->

                        <div class="col-md-12">
                            <?php if($darkmode){ ?>
                                <div class="alert alert-dark text-center" role="alert">
                            <?php } else { ?>
                                <div class="alert alert-light text-center" role="alert">
                            <?php } ?>
                                <h1 class="alert-heading">
                                    <br>
                                    Das Ticket ist geschlossen! 🔒
                                </h1>
                                <br>
                                <h4>
                                    Dieses Ticket wurde erfolgreich bearbeitet und das Problem des Kundens wurde gelöst,<br>
                                    Du hast die Möglichkeit das Ticket wieder zu öffnen sofern noch handlungsbedarf besteht.
                                </h4>
                                <br>
                                <p>
                                    <form method="post">
                                        <button name="openTicket" type="submit" class="btn btn-outline-success btn-lg font-weight-bolder"><i class="fas fa-lock-open"></i>&nbsp; Ticket wieder öffnen</button>&nbsp;
                                        <a href="<?= env('URL'); ?>team/tickets" class="btn btn-outline-primary btn-lg font-weight-bolder"><i class="fas fa-clipboard-list"></i>&nbsp; Zur Ticket-Übersicht</a>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>

        </div>
    </div>
</div>