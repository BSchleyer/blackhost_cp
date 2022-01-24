<?php
$currPage = 'back_Dashboard';
include BASE_PATH.'app/controller/PageController.php';

$notes = $user->getDataById($userid,'notes');

if(isset($_POST['renewPin'])){
    $s_pin = $user->renewSupportPin($userid);
    echo sendSuccess('Support Pin wurde erneuert');
}

//echo sendSweetInfo('test');

if(isset($_POST['useCode'])){
	$codeerror = false;


    // gucken ob code genutzt
    $SQL2 = $db->prepare("SELECT * from `code_used` WHERE `code` = :code AND `user_id` = :userid");
    $code = $_POST['code'];
    $SQL2->execute(array(":code" => $code, ":userid" => $userid));
	while ($rowused = $SQL2 -> fetch(PDO::FETCH_ASSOC)){

	if($rowused['id'] !== ""){
		
			$codeerror = true;
		    echo sendError('Du hast den Code bereits eingelöst');

	}
		
	}
    // gucken ob code genutzt [ENDE]

    // gucken ob code noch nutzbar ist
    $SQL4 = $db->prepare("SELECT * from `codes` WHERE `code` = :code");
    $code = $_POST['code'];
    $SQL4->execute(array(":code" => $code));
	while ($rowhow = $SQL4 -> fetch(PDO::FETCH_ASSOC)){

	if($rowhow['useable'] == "0"){
		
			$codeerror = true;
		    echo sendError('Der Code wurde bereits zu oft verwendet.');

	}
		
	}
    // gucken ob code noch nutzbar ist [ENDE]

    $SQL = $db->prepare("SELECT * from `codes` WHERE `code` = :code");
    $code = $_POST['code'];
	$proname = "Gutschein";
    $SQL->execute(array(":code" => $code));
	while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

	$price = $row['amount'];

		
		// error check
	if($codeerror == false){

		// Code gefunden

	if($row['code'] == $code){
		
		$user->addMoney($price, $userid);
        $user->addTransaction($userid,'+'.$price,$proname.' eingelöst');

        $SQL1 = $db->prepare("INSERT INTO `code_used`(`code`, `user_id`) VALUES ('$code','$userid')");
        $SQL1->execute(array(":code" => $code, ":userid" => $userid));

    
		$SQL3 = $db->prepare("UPDATE `codes` SET `useable` = :newcode WHERE `id` = :codeid");
        $codeid = $row['id'];
		$newcode = $row['useable'] -1;
		$SQL3->execute(array(":codeid" => $codeid, ":newcode" => $newcode));

		echo sendSuccess('Der Code wurde eingelöst');
		header("Refresh:2");

	}
	


	} // error check
	
} // select * from code

	if($SQL->rowCount() == 0){

		    echo sendError('Der Code wurde nicht gefunden');

	}

} // gutschein POST ende

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">

                <?php
                $SQL = $db -> prepare("SELECT * FROM `tickets` WHERE `user_id` = :user_id AND `state` = 'OPEN' AND `last_msg` = 'SUPPORT'");
                $SQL->execute(array(":user_id" => $userid));
                if ($SQL->rowCount() != 0) {
                ?>

<div class="alert alert-warning col-md-12" role="alert">
	Du hast eine Antwort, auf eines deiner Tickets! <a href="tickets">Zu den Tickets</a>
</div>

                <?php } ?>

                            <?php
                            $SQLMON = $db->prepare("SELECT * FROM `transactions` WHERE `user_id` = $userid");
                            $SQLMON->execute();
                            if ($SQLMON->rowCount() != 0) {
                            while ($row = $SQLMON -> fetch(PDO::FETCH_ASSOC)){ ?>
                            <?php } } ?>

                <div class="col-md-3">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Guthaben</p>
                                    <h4 class="mb-0"><?= $amount; ?>
										<i class="fa fa-euro-sign" style="color:<?= env('MAIN_COLOR'); ?>"></i></h4>
									<small>Du hast <?= $SQLMON->rowCount() ?> Transaktionen</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-wallet" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                            <?php
                            $SQLCT = $db->prepare("SELECT * FROM `tickets` WHERE `user_id` = $userid AND `state` = 'CLOSED'");
                            $SQLCT->execute();
                            if ($SQLCT->rowCount() != 0) {
                            while ($row = $SQLCT -> fetch(PDO::FETCH_ASSOC)){ ?>
                            <?php } } ?>

                            <?php
                            $SQLAT = $db->prepare("SELECT * FROM `tickets` WHERE `user_id` = $userid");
                            $SQLAT->execute();
                            if ($SQLAT->rowCount() != 0) {
                            while ($row = $SQLAT -> fetch(PDO::FETCH_ASSOC)){ ?>
                            <?php } } ?>

                <div class="col-md-3">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Deine Tickets</p>
                                    <h4 class="mb-0">
										<i class="fa fa-unlock" style="color:<?= env('MAIN_COLOR'); ?>"></i>
										<?= $user->getOpenTickets($userid); ?> / 
										<i class="fa fa-lock" style="color:<?= env('MAIN_COLOR'); ?>"></i>
										<?= $SQLCT->rowCount() ?></h4>
									<small>Insgesamt sind das <?= $SQLAT->rowCount() ?> Ticket(s)</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-ticket-alt" style="color:#6254FE;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                            <?php
                            $SQLALL = $db->prepare("SELECT * FROM `login_logs`  WHERE `user_id` = $userid AND `show` = '1'");
                            $SQLALL->execute();
                            if ($SQLALL->rowCount() != 0) {
                            while ($row = $SQLALL -> fetch(PDO::FETCH_ASSOC)){ ?>
                            <?php } } ?>

                            <?php
                            $SQLALLG = $db->prepare("SELECT * FROM `login_logs`  WHERE `user_id` = $userid AND `show` = '0'");
                            $SQLALLG->execute();
                            if ($SQLALLG->rowCount() != 0) {
                            while ($row = $SQLALLG -> fetch(PDO::FETCH_ASSOC)){ ?>
                            <?php } } ?>

                <div class="col-md-3">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Deine Logins</p>
                                    <h4 class="mb-0"><?= $SQLALL->rowCount() ?></h4>
									<small>Du hast bereits <?= $SQLALLG->rowCount() ?> Logins gelöscht</small>
                                </div>

                                <div class="avatar-sm rounded-circle align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-door-open" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Support-Pin</p>
                                    <h4 class="mb-0">
                                        <?= $s_pin; ?>
                                        <i style="cursor: pointer;" class="fas fa-copy copy-btn" data-clipboard-text="<?= $s_pin; ?>" data-toggle="tooltip" title="PIN kopieren"></i>
                                        <i style="cursor: pointer;" onclick="renew();" class="fas fa-sync-alt icon-rotate" data-clipboard-text="<?= $s_pin; ?>" data-toggle="tooltip" title="Neuen PIN generieren"></i>
                                    </h4>
									<small>Halte diesen privat!</small>
                                </div>

                                <form method="post" id="renewPin">
                                    <input hidden name="renewPin">
                                </form>

                                <script>
                                    function renew() {
                                        document.getElementById('renewPin').submit();
                                    }
                                </script>

                                <div class="avatar-sm rounded-circle align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-ghost" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
			
			<br>


            <div class="row">

                <div class="col-md-6">
                    <form method="post">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Gutschein-Code einlösen</span>
                            </h3>
                        </div>
                            <div class="card-body">
                                <input class="form-control" name="code" rows="1">
                                <br>
                                <button type="submit" name="useCode" class="btn btn-outline-primary btn-block"><b><i class="fas fa-terminal"></i> Gutschein einlösen</b></button><!-- <br> -->
                            </div>
                        </div>
                    </form><br>
                </div>

                <div class="col-md-6">
                    <?php
                    if(isset($_POST['saveNotes'])){
                        $SQL = $db->prepare("UPDATE `users` SET `notes` = :notes WHERE `id` = :id");
                        $SQL->execute(array(":notes" => $_POST['notes'], ":id" => $userid));

                        $notes = $_POST['notes'];

                        echo sendSuccess('Notizen wurden gespeichert');
                    }
                    ?>
                    <form method="post">
                        <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Notizen</span>
                            </h3>
                        </div>
                            <div class="card-body">
                                <textarea class="form-control" name="notes" rows="5"><?= $helper->xssFix($notes); ?></textarea>
                                <br>
                                <button type="submit" name="saveNotes" class="btn btn-outline-primary btn-block"><b><i class="fas fa-save"></i> Speichern</b></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-12"> <br> </div>

                <div class="col-md-12">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fab fa-teamspeak fa-10x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
                                    <h4>Unser Teamspeak</h4>
                                    <span class="badge badge-primary">ts.black-host.eu</span>
                                    <br>
                                    <br>
                                    <a href="ts3server://ts.black-host.eu" class="btn btn-outline-primary btn-block"><b><i class="fas fa-sign-in-alt"></i> Jetzt verbinden</b></a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fab fa-twitter fa-10x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
                                    <h4>Unser Twitter-Account</h4>
                                    <span class="badge badge-primary">@blackhosteu</span>
                                    <br>
                                    <br>
                                    <a href="https://twitter.com/BlackHostEU" target="_blank" class="btn btn-outline-primary btn-block"><b><i class="fas fa-sign-in-alt"></i> Jetzt Anschauen</b></a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fab fa-discord fa-10x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
                                    <h4>Unser Discord-Server</h4>
                                    <span class="badge badge-primary">dsc.gg/black-host</span>
                                    <br>
                                    <br>
                                    <a href="https://dsc.gg/black-host" target="_blank" class="btn btn-outline-primary btn-block"><b><i class="fas fa-sign-in-alt"></i> Jetzt Anschauen</b></a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fab fa-instagram fa-10x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
                                    <h4>Unser Instagram-Account</h4>
                                    <span class="badge badge-primary">@blackhosteu</span>
                                    <br>
                                    <br>
                                    <a href="https://twitter.com/BlackHostEU" target="_blank" class="btn btn-outline-primary btn-block disabled"><b><i class="fas fa-sign-in-alt"></i> Jetzt Anschauen</b></a>
                                </div>

                                <!--<div class="col-md-3">
                                    <?php if($datasavingmode == 0){ ?>
<iframe src="https://discord.com/widget?id=714148277020524544&theme=dark" width="280" height="340" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                                    <?php } ?>
                                </div>-->

                            </div>
                        </div>
                    </div>
				</div>


                <div class="col-md-12"> <br> </div>


            </div>

        </div>
    </div>
</div>