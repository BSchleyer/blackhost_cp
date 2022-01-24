<?php
$currPage = 'back_Ausfallsentschädigung';
include BASE_PATH.'app/controller/PageController.php';

$getback = false;
$getbackerror = false;


// WEB CHECK [START]

                $SQLWEB = $db->prepare("SELECT * FROM `webspace` WHERE `user_id` = :userid");
                $SQLWEB->execute(array(":userid" => $userid));
                if ($SQLWEB->rowCount() != 0) {
                while ($web = $SQLWEB -> fetch(PDO::FETCH_ASSOC)){

} }

			 if($SQLWEB->rowCount() !== 0){
		  
$SQLWEBC = $db -> prepare("SELECT * FROM `timeouts` WHERE `produkt` = 'WEB' AND `state` = 'YES' LIMIT 1");
$SQLWEBC->execute();
if ($SQLWEBC->rowCount() != 0) {
while ($webc = $SQLWEBC -> fetch(PDO::FETCH_ASSOC)){

$getbackWEB = $webc['amount'];
$getback = true;

} }

                    } 

// WEB CHECK [ENDE]

// RSWEB CHECK [START]

                $SQLRSWEB = $db->prepare("SELECT * FROM `webspace_rs` WHERE `user_id` = :userid");
                $SQLRSWEB->execute(array(":userid" => $userid));
                if ($SQLRSWEB->rowCount() != 0) {
                while ($rsweb = $SQLRSWEB -> fetch(PDO::FETCH_ASSOC)){

} }

			 if($SQLWEB->rowCount() !== 0){
		  
$SQLRSWEBC = $db -> prepare("SELECT * FROM `timeouts` WHERE `produkt` = 'RSWEB' AND `state` = 'YES' LIMIT 1");
$SQLRSWEBC->execute();
if ($SQLRSWEBC->rowCount() != 0) {
while ($rswebc = $SQLRSWEBC -> fetch(PDO::FETCH_ASSOC)){

$getbackRSWEB = $rsweb['amount'];
$getback = true;

} }

                    } 

// RSWEB CHECK [ENDE]

// CLOUD CHECK [START]

                $SQLCLOUD = $db->prepare("SELECT * FROM `cloudserver` WHERE `user_id` = :userid");
                $SQLCLOUD->execute(array(":userid" => $userid));
                if ($SQLCLOUD->rowCount() != 0) {
                while ($cloud = $SQLCLOUD -> fetch(PDO::FETCH_ASSOC)){

} }

			 if($SQLCLOUD->rowCount() !== 0){
		  
$SQLCLOUDC = $db -> prepare("SELECT * FROM `timeouts` WHERE `produkt` = 'CLOUD' AND `state` = 'YES' LIMIT 1");
$SQLCLOUDC->execute();
if ($SQLCLOUDC->rowCount() != 0) {
while ($cloudc = $SQLCLOUDC -> fetch(PDO::FETCH_ASSOC)){

$getbackCLOUD = $cloudc['amount'];
$getback = true;

} }

                    } 

// CLOUD CHECK [ENDE]


//

$getbackamount = $getbackWEB+$getbackCLOUD+$getbackRSWEB.".00";

//

// check
$SQLCHECK = $db -> prepare("SELECT * FROM `timeout_back` WHERE `userid` = :userid");
$SQLCHECK->execute(array(":userid" => $userid));

if($SQLCHECK->rowCount() !== 0){
$getbackerror = true;
$getback = false;
$getbackamount = "0.00";
 }

// check ENDE

// IF CLAIM [START]

if(isset($_POST['claimGetBack'])){

if($SQLCHECK->rowCount() !== 0){
$getbackerror = true;
$getback = false;
$getbackamount = "0.00";
 }

	
	if ($getbackerror == false){
		
		$price = $getbackamount;
		$proname = "Ausfallsentschädigung";

        $SQL2 = $db -> prepare("INSERT INTO `timeout_back` SET `userid` = :user_id");
        $SQL2->execute(array(":user_id" => $userid));
		
		$user->addMoney($price, $userid);
        $user->addTransaction($userid,'+'.$price,$proname.' eingelöst');

		echo sendSuccess('Die Entschädigung wurde ausgezahlt');
		header("Refresh:2");		
		
	}

	if ($getbackerror == true){
		echo sendError('Es gab einen Fehler - Bei Fragen wende dich an den Support');
	}


}

// IF CLAIM [ENDE]
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">

  <div class="alert alert-primary col-md-12" role="alert">
	Vorsicht: Diese Funktion befindet sich aktuell in der Beta, Fehler sind daher nicht ausgeschlossen und sollten gemeldet werden.
</div>


			 <?php if($getback == false){ ?>
		  
  <div class="alert alert-warning col-md-12" role="alert">
	Es gab keine Ausfälle in den letzten 7 Tagen, von denen du betroffen warst und/oder die du noch nicht entschädigt bekommen hast.
</div>

            <?php } ?>




                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Entschädigung</p>
                                    <h4 class="mb-0"><?= $getbackamount; ?>€</h4>
									<small>Deine Entschädigung</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-gift" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <form method="post">
                        <div class="card card-custom">
							<center>
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">
									Entschädigung in der Höhe von <?= $getbackamount; ?>€ abholen.
								</span>
                            </h3>
                        </div>
							</center>
                            <div class="card-body">
								

			 <?php if($getback == false){ ?>

                                <button class="btn btn-outline-primary btn-block disabled" disabled="disabled">
									<b><i class="fas fa-times"></i> Keine Entschädigung möglich</b>
								</button>

            <?php } ?>

			 <?php if($getback == true){ ?>

                                <button type="submit" name="claimGetBack" class="btn btn-outline-primary btn-block">
									<b><i class="fas fa-gift"></i> Entschädigung abholen</b>
								</button>

            <?php } ?>
								
                            </div>
                        </div>
                    </form><br>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Entschädigt</p>
                                    <h4 class="mb-0">+ 200.00€</h4>
									<small>Wurde von uns bereits entschädigt</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-money-check-alt" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>




        </div>
    </div>





</div>