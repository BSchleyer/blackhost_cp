<?php
$currPage = 'front_Wikibeitrag lesen';
include BASE_PATH.'app/controller/PageController.php';

$siteid = $helper->protect($_GET['id']);

                $SQL = $db->prepare("SELECT * FROM `wiki` WHERE `id` = :siteid");
                $SQL->execute(array(":siteid" => $siteid));
                if ($SQL->rowCount() != 0) {
                    while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">


<div class="alert alert-primary col-md-12" role="alert">
	Sehr geehrter Leser, aktuell werden die Wiki Einträge noch von unseren Technikern vervollständigt, bitte habt noch etwas Geduld bis
	wir hier mehr Einträge listen können.
</div>


                <div class="col-md-8">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark"><?= $row['title'] ?></span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">
							
							<?= $row['text'] ?>
							
							<br><br>


							<a href="../../wiki" class="btn btn-outline-primary text-uppercase font-weight-bolder pulse-red">
							Beitrag schließen
							</a>
							
                        </div><br>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Informationen</span>
                            </h3>
                        </div>
                        <div class="card-body" style="margin-bottom: -30px;">
							
							Erstellt am: <?= $helper->formatDate($row['created_at']); ?>
							<br>
							Aktualisiert am: <?= $helper->formatDate($row['updated_at']); ?>
							
							<br>
							<br>
							
							Kategroie: <?= $row['kat'] ?>
							<br>
							Beitrags-ID: <?= $row['id'] ?>
							 
                        </div><br>
                    </div>
                </div>

                <div class="col-md-12"> <br> </div>


            </div>

        </div>
    </div>
</div>

<?php } } ?>