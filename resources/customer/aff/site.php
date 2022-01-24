<?php
$currPage = 'back_Affiliate System';
include BASE_PATH.'app/controller/PageController.php';

    $SQL2 = $db->prepare("SELECT * from `aff_clicks` WHERE `owner_name` = :username");
    $SQL2->execute(array(":username" => $username));
    while ($rowmain = $SQL2 -> fetch(PDO::FETCH_ASSOC)){
	}
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
				

                <div class="col-md-6">
				<h4>Alle Aufrufe</h4>	
					<a class="btn btn-outline-primary btn-sm font-weight-bolder" href="../tickets" target="_blank">Fehler/Abuse melden</a>
                    <div class="card card-custom card-stretch gutter-b shadow mb-5">
                        <div class="card-body d-flex flex-column">
                            <table id="dataTableLoad" class="table dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Geklickt auf</th>
                                    <th>Datum/Uhrzeit</th>
                                </tr>
                                </thead>
                                <tbody>
<?php
    $SQL3 = $db->prepare("SELECT * from `aff_clicks` WHERE `owner_name` = :user_id");
    $SQL3->execute(array(":user_id" => $username));
    while ($clickcheck = $SQL3 -> fetch(PDO::FETCH_ASSOC)){
		
		?>

                                        <tr>
                                            <td><?= $clickcheck['id']; ?></td>
                                            <td>cp.black-host.eu/s/<?= $username ?></td>
                                            <td><?= $helper->formatDate($clickcheck['created_at']); ?></td>
                                        </tr>
									
									<?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
				<h4>Deine Links</h4>	
					<a class="btn btn-outline-primary btn-sm font-weight-bolder" href="../tickets" target="_blank">Auszahlung anfragen</a>
                    <div class="card card-custom card-stretch gutter-b shadow mb-5">
                        <div class="card-body d-flex flex-column">
                            <table id="dataTableLoad" class="table dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>Link</th>
                                    <th>Klicks</th>
                                    <th>Wert (@ Klick)</th>
                                    <th>Wert (Gesamt)</th>
                                </tr>
                                </thead>
                                <tbody>
									
									<?php
									$gesamt = $SQL2->rowCount() * 0.10;
									?>

                                        <tr>
                                            <td>cp.black-host.eu/s/<?= $username ?></td>
                                            <td><?= $SQL2->rowCount() ?></td>
                                            <td>0.10€</td>
                                            <td><?= $gesamt; ?>0 €</td>
                                        </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
			
			<br><br><br><br><br><br>

			<center>
				<small align="center">
					Der Mindestbetrag, für eine Auszahlung, beträgt 10.00€ und kann nur in Form von Guthaben
					erfolgen.
				</small>
			</center>


        </div>
    </div>
</div>