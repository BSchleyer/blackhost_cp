<?php
$currPage = 'front_Wiki';
include BASE_PATH.'app/controller/PageController.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">


<div class="alert alert-primary col-md-12" role="alert">
	Sehr geehrter Leser, aktuell werden die Wiki Einträge noch von unseren Technikern vervollständigt, bitte habt noch etwas Geduld bis
	wir hier mehr Einträge listen können.
</div>


                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Allgemein</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL = $db->prepare("SELECT * FROM `wiki` WHERE `kat` = 'allgemein'");
                            $SQL->execute();
                            if ($SQL->rowCount() != 0) {
                            while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Aktuelles</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL2 = $db->prepare("SELECT * FROM `wiki` WHERE `kat` = 'aktuelles'");
                            $SQL2->execute();
                            if ($SQL2->rowCount() != 0) {
                            while ($row = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-12"> <br> </div>

                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Minecraft Gameserver</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL2 = $db->prepare("SELECT * FROM `wiki` WHERE `kat` = 'gameserver_mc'");
                            $SQL2->execute();
                            if ($SQL2->rowCount() != 0) {
                            while ($row = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>


                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Cloudserver</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL2 = $db->prepare("SELECT * FROM `wiki` WHERE `kat` = 'cloudserver'");
                            $SQL2->execute();
                            if ($SQL2->rowCount() != 0) {
                            while ($row = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-12"> <br> </div>

                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Webseite + Funktionen</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL2 = $db->prepare("SELECT * FROM `wiki` WHERE `kat` = 'webseite'");
                            $SQL2->execute();
                            if ($SQL2->rowCount() != 0) {
                            while ($row = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Discord</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL2 = $db->prepare("SELECT * FROM `wiki` WHERE `kat` = 'discord'");
                            $SQL2->execute();
                            if ($SQL2->rowCount() != 0) {
                            while ($row = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-12"> <br> </div>

                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">KVM-Server</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL2 = $db->prepare("SELECT * FROM `wiki` WHERE `kat` = 'kvm'");
                            $SQL2->execute();
                            if ($SQL2->rowCount() != 0) {
                            while ($row = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 flex-fill d-flex">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Webserver</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">

                            <?php
                            $SQL2 = $db->prepare("SELECT * FROM `wiki` WHERE `kat` = 'webserver'");
                            $SQL2->execute();
                            if ($SQL2->rowCount() != 0) {
                            while ($row = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?php include '_temp.php' ?>
							
                            <?php } } ?>

                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>