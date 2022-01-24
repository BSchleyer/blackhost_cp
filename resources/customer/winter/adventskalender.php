<?php
$currPage = 'back_Adventskalender';
include BASE_PATH.'app/controller/PageController.php';

$dateTimeNow = $date->format('Y-m-d H:i:s');
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">


                            <?php
                            $SQL = $db->prepare("SELECT * FROM `adventskalender` WHERE `able_at` < :datenow");
                            $SQL->execute(array(":datenow" => $dateTimeNow));
                            if ($SQL->rowCount() != 0) {
                            while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>
                            <?php } } ?>

<div class="alert alert-primary col-md-12" role="alert">
	Vorsicht: Der Adventskalender wird zum ersten Mal eingesetzt, Fehler sollten daher gemeldet werden.
</div>  

			 <?php if($SQL->rowCount() == 0){ ?>
		  
<div class="alert alert-primary col-md-12" role="alert">
	Stop! Was machst du denn hier? Der Adventskalender wird doch erst ab dem 01.12.2021 geöffnet!
</div>    

                    <?php } ?>


                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Verfügbare Törchen</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL = $db->prepare("SELECT * FROM `adventskalender` WHERE `able_at` < :datenow");
                            $SQL->execute(array(":datenow" => $dateTimeNow));
                            if ($SQL->rowCount() != 0) {
                            while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>

                            <?php
                            $SQL4 = $db->prepare("SELECT * FROM `adventskalender_used` WHERE `userid` = :userid");
                            $SQL4->execute(array(":userid" => $userid));
                            if ($SQL4->rowCount() != 0) {
                            while ($streaknu = $SQL4 -> fetch(PDO::FETCH_ASSOC)){ ?>
		
                            <?php } } ?>

                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">
									Deine Geöffneten Törchen (<?= $SQL4->rowCount(); ?>)
								</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL4 = $db->prepare("SELECT * FROM `adventskalender_used` WHERE `userid` = :userid");
                            $SQL4->execute(array(":userid" => $userid));
                            if ($SQL4->rowCount() != 0) {
                            while ($streak = $SQL4 -> fetch(PDO::FETCH_ASSOC)){ ?>
							
											
							<?php include '_usertemp.php' ?>	
		
                            <?php } } ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-12"> <br> </div>




            </div>

        </div>
    </div>
</div>