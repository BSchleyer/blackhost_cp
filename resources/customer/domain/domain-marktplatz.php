<?php
$currPage = 'front_Domain Bestellen';
include BASE_PATH.'app/controller/PageController.php';


if(isset($_POST['orderDomain'])){

    $runtime = "365";

    $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
    $date->modify('+' . $runtime . ' day');
    $expire_at = $date->format('Y-m-d H:i:s');
    $state = "pending";

    if($_POST['domain'] == "discoinsystems") {
        $buyprice = "2";
        $moretime = "3";
    }

    if($_POST['domain'] == "variation-esports") {
        $buyprice = "1";
        $moretime = "3.5";
    }

    if($_POST['domain'] == "löschteuch") {
        $buyprice = "1.5";
        $moretime = "4";
    }

    $domain_name = $_POST['domain'];
    $domain_endung = $_POST['endung'];
        
    $SQL = $db->prepare("INSERT INTO `domains` (
		`user_id`,
		`domain_name`,
        `domain_endung`,
		`state`,
		`expire_at`, 
		`price`
		) VALUES (?,?,?,?,?,?)");


    $SQL->execute(array($userid, $domain_name, $domain_endung, $state, $expire_at, $moretime));

    $SQL = $db->prepare("UPDATE `domain_marktplatz` SET `state` = 'used' WHERE `domain_name` = :domain_name");
    $SQL->execute(array(":domain_name" => $_POST['domain']));

    $user->removeMoney($buyprice, $userid);
    $user->addTransaction($userid,'-'.$buyprice, $domain_name.' Bestellung (Domain)');
		
    $discord->callWebhook('<@&874784920332017715> Soeben wurde eine Domain bestellt von '.$username);
    
    $_SESSION['success_msg'] = 'Vielen Dank! Deine Domain wurde bestellt';
    header('Location: '.env('URL').'manage/domains');
}

if(isset($_POST['createDomain'])){

    $runtime = "365";
    $state = "pending";

    $domain_name = $_POST['domain'];
    $domain_endung = $_POST['endung'];
        
    $SQL = $db->prepare("INSERT INTO `domain_marktplatz` (
		`trader_id`,
        `code`,
		`domain_name`,
        `domain_endung`,
		`state`,
		`price`
		) VALUES (?,?,?,?,?,?)");


    $SQL->execute(array($userid, $_POST['code'], $_POST['domain'], $_POST['endung'], $state, $_POST['price']));


    
    $_SESSION['success_msg'] = 'Vielen Dank! Deine Domain wird in Kürze freigeschaltet';
    header('Location: '.env('URL').'domain/marktplatz');
}

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">


            <div class="row">


                <!--div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Werbung</p>
                                    <h4 class="mb-0"><?= $domain; ?>.de</h4>
									<small>Aktuell für nur <?= $deprice ?>.00€/jahr</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-audio-description" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Werbung</p>
                                    <h4 class="mb-0"><?= $domain; ?>.eu</h4>
									<small>Aktuell für nur <?= $euprice ?>.00€/jahr</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-audio-description" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Werbung</p>
                                    <h4 class="mb-0"><?= $domain; ?>.net</h4>
									<small>Aktuell für nur <?= $netprice ?>.00€/jahr</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-audio-description" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Werbung</p>
                                    <h4 class="mb-0"><?= $domain; ?>.com</h4>
									<small>Aktuell für nur <?= $comprice ?>.00€/jahr</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-audio-description" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--->

                <div class="col-md-12">
                <from method="post">
				<!--<h4>Alle verfügbaren Domainendungen</h4>-->
                    <div class="card card-custom card-stretch gutter-b shadow mb-5">
                        <div class="card-body d-flex flex-column">

                         <div class="form-group row">

                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="Domain Endung" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="Domain Registrierung / Transfer" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="Domain Verlängerung" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            </div>
                                            
                                            
                         </div>


                         <hr>
  

                         <?php
                $SQL = $db->prepare("SELECT * FROM `domain_marktplatz` WHERE `state` = 'active'");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

                        <form method="post">
                         <div class="form-group row">
                         
                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="<?= $row['domain_name']; ?>.<?= $row['domain_endung']; ?>" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="register" class="form-control" value="<?= $row['price']; ?>€" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="register_more" class="form-control" value="<?= $row['price_more']; ?>€" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            <input type="text" name="endung" class="form-control" value="eu" hidden>
                                            <input type="text" name="domain" class="form-control" value="<?= $row['domain_name']; ?>" hidden>

                                            <button type="submit" name="orderDomain" class="btn btn-outline-success btn-sm font-weight-bolder">Domain Bestellen</button>
                                            </div>
                                            
                                            
                         </div>
                        </form>

                        <?php } } ?>


                    
                        </div>
                    </div>
                    </form>
                </div>




            </div>


            <div class="row">

            <div class="col-md-3"> <br> </div>

<div class="col-md-6">
    <form method="post" id="checkform">
        <div class="card card-custom">
        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Externe Domain verkaufen</span>
            </h3>
        </div>
            <div class="card-body">
                <input class="form-control" name="domain" rows="1" placeholder="Deine Domain" required>
                <br>
                <input class="form-control" name="endung" rows="1" placeholder="Deine Domain-Endung" required>
                <br>
                <input class="form-control" name="code" rows="1" placeholder="Der OuthCode" required>
                <br>
                <input type="number" class="form-control" min="1" max="1000" name="price" rows="1" placeholder="Gewünschter Preis" required>
                <br>
                <button type="submit" name="createDomain" class="btn btn-outline-primary btn-block">
                    <b><i class="fas fa-plus"></i> Domain zum Verkauf ausstellen</b>
                </button>
                <center>
                <small>Wir transferieren, nach Anfrage, die Domain und verkaufen diese auf unserem Marktplatz. Nach erfolgreichem Verkauf erhalten Sie
                    den angegeben Betrag per Guthaben oder Auszahlung. Bevor die Domain nicht verkauft wurde, können Sie Ihre Domain jederzeit zurück erhalten.
                </small>
                </center>
            </div>
        </div>
    </form><br>
</div>

<!--<div class="col-md-5">
    <form method="post" id="checkform">
        <div class="card card-custom">
        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Interne Domain verkaufen</span>
            </h3>
        </div>
            <div class="card-body">

                <center>
                <small>
                    Hallo sehr geehrter Kunde, an dieser Funktion wird zurzeit noch gearbeitet.
                </small>
                </center>
            </div>
        </div>
    </form><br>
</div>-->


<div class="col-md-12"> <br> </div>


</div>


        </div>
    </div>
</div>