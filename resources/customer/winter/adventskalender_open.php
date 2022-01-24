<?php
$currPage = 'back_Adventskalender Törchen öffnen';
include BASE_PATH.'app/controller/PageController.php';

$dateTimeNow = $date->format('Y-m-d H:i:s');

$siteid = $helper->protect($_GET['id']);

				$SQL2 = $db->prepare("SELECT * FROM `adventskalender` WHERE `id` = :siteid AND `closed_at` > :datenow AND `able_at` < :datenow");
                $SQL2->execute(array(":siteid" => $siteid, ":datenow" => $dateTimeNow));


                $SQL3 = $db->prepare("SELECT * FROM `adventskalender_used` WHERE `tor`= :siteid AND `userid` = :userid");
                $SQL3->execute(array(":siteid" => $siteid, ":userid" => $userid));
                if ($SQL->rowCount() != 0) {
                while ($row3 = $SQL3 -> fetch(PDO::FETCH_ASSOC)){

                }
                }


			if($SQL2->rowCount() !== 0){

			if($SQL3->rowCount() == 0){

                $SQL = $db->prepare("INSERT INTO `adventskalender_used` SET `tor` = :siteid, `userid` = :userid");
                $SQL->execute(array(":siteid" => $siteid, ":userid" => $userid));
				
     
				$SQL2 = $db->prepare("SELECT * FROM `adventskalender` WHERE `id` = :siteid AND `closed_at` > :datenow AND `able_at` < :datenow");
                $SQL2->execute(array(":siteid" => $siteid, ":datenow" => $dateTimeNow));
                if ($SQL2->rowCount() != 0) {
                while ($row2 = $SQL2 -> fetch(PDO::FETCH_ASSOC)){

		  	                 if($row2['amount'] !== 0){

	
								 $price = $row2['amount'];
								 $proname = "Adventskalender";
		
		$user->addMoney($price, $userid);
        $user->addTransaction($userid,'+'.$price,$proname.' Gewinn');

                            } elseif($row2['amount'] == 0) {


                            } else {
                                
                            } // if amount

                     } // db while
				
				} // db row 
			
			} // if sql3

			} // if sql2

?>


                <?php
                $SQL2 = $db->prepare("SELECT * FROM `adventskalender` WHERE `id` = :siteid AND `closed_at` > :datenow AND `able_at` < :datenow");
                $SQL2->execute(array(":siteid" => $siteid, ":datenow" => $dateTimeNow));
                if ($SQL2->rowCount() != 0) {
                while ($row2 = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">



			 <?php if($SQL3->rowCount() == 0){ ?>
		  
<div class="alert alert-success col-md-12" role="alert">
	Deine Belohnung wurde erfolgreich anerkannt.
</div>   


                    <?php } ?>

			 <?php if($SQL3->rowCount() !== 0){ ?>
		  
<div class="alert alert-warning col-md-12" role="alert">
	Hey, deine Belohnung wurde doch bereits anerkannt!
</div>   


                    <?php } ?>



                <div class="col-md-12">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Törchen <?= $row2['id'] ?></span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">
							
							Vielen Dank für das öffnen dieser Tür, du hast folgendes gewonnen:
							<br>
							
							<?= $row2['win'] ?>
							
							<br><br>


							<a href="../../adventskalender" class="btn btn-outline-primary text-uppercase font-weight-bolder pulse-red">
							Zurück zum Adventskalender
							</a>
							
                        </div><br>
                    </div>
                </div>

                <div class="col-md-12"> <br> </div>


            </div>

        </div>
    </div>
</div>

<?php } } ?>