<?php
$currPage = 'back_Marktplatz Verwalten';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/marktplatz/manage.php';

$dateMinus = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$dateMinus->modify('+31 day');
$dateTimeMinus3Days = $dateMinus->format('Y-m-d');
$dateTimeMinus3Day = $dateMinus->format('d.m.Y');


if(isset($_POST['useHW'])){

    $url = "https://robot-ws.your-server.de/reset/".$serverInfos['mp_servernumber']."";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
       "Content-Type: application/x-www-form-urlencoded",
       "Authorization: Basic",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $data = "type=hw";
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);

    echo sendSuccess('Der Server wird neugestartet');
}


if(isset($_POST['usePower'])){

    $url = "https://robot-ws.your-server.de/reset/".$serverInfos['mp_servernumber']."";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
       "Content-Type: application/x-www-form-urlencoded",
       "Authorization: Basic",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $data = "type=power";
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);

    echo sendSuccess('Der Server wird gestartet');
}


// RDNS

if(isset($_POST['rdns'])){

$url = "https://robot-ws.your-server.de/rdns/".$serverInfos['mp_ip']."";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
   "Authorization: Basic",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$rdnsentry = $_POST['rdns_record'];
$data = "ptr=".$rdnsentry."";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

    echo sendSuccess('Die RDNS Einstellungen werden in wenigen Minuten übernommen.');
}

// KÜNDIGEN

if(isset($_POST['stornoServer'])){

    $url = "https://robot-ws.your-server.de/server/".$serverInfos['mp_servernumber']."/cancellation";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
       "Content-Type: application/x-www-form-urlencoded",
       "Authorization: Basic",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $data = "cancellation_date=".$dateTimeMinus3Days."";
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);

    $SQL = $db -> prepare("UPDATE `marktplatz` SET `storno` = :storno WHERE `mp_ip` = :mp_ip ");
    $SQL->execute(array(":mp_ip" => $serverInfos['mp_ip'], ":storno" => $dateTimeMinus3Day));
    
        echo sendSuccess('Die Kündigung wurde eingetragen.');
    }


// RESCUEMODE

if(isset($_POST['startRescue'])){
    $url = "https://robot-ws.your-server.de/boot/".$serverInfos['mp_servernumber']."/rescue";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
       "Content-Type: application/x-www-form-urlencoded",
       "Authorization: Basic ",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $data = "os=linux&arch=64";
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);
    
        echo sendInfo('Bitte starten Sie den Server neu um den Rettungsmodus zu aktivieren.');
    }


// NEUINSTALLATION

if(isset($_POST['reinstallServer'])){
$url = "https://robot-ws.your-server.de/boot/".$serverInfos['mp_servernumber']."/linux";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
   "Authorization: Basic ",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "dist=".$_POST['install_os']."&arch=64&lang=en";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
    
        echo sendInfo('Starte den Server nun neu');
    }

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
                         
        <?php if($serverInfos['storno'] !== ""){ ?>
        <div class="alert alert-warning col-md-12" role="alert">         
        Für diesen Server liegt zum <b><?= $serverInfos['storno']; ?></b> eine Kündigung vor.
        </div>
        <?php } ?>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h1>Informationen</h1></div>
						<br>
						<div class="alert alert-primary col-md-12" role="alert" align="center">         
							Du bist zufrieden mit unseren Dienstleistungen? <u><a href="https://www.trustpilot.com/evaluate/www.german-host.eu?stars=5" target="_blank" style="color:white;">Bewerte uns doch!</a></u>
						</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">								
									<h5>Informationen</h5>
									<hr>
                                </div>

                                <div class="col-md-9">								
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Name:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $serverInfos['mp_name']; ?></span>
                                    </p>
                                </div>

                                <div class="col-md-12">
                                    <p class="text-muted mb-2 font-13">
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>IPv4:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $serverInfos['mp_ip']; ?></span>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>IPv6:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $serverInfos['mp_ipv6']; ?></span>
                                    </p>
                                </div>

                                <div class="col-md-12">
                                    <p class="text-muted mb-2 font-13">
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Standart Root-Passwort:</strong>  
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">
                                            <span class="noselect" id="gameserver_password">*********************************</span>
                                            <span style="cursor: pointer;" id="gameserver_icon" onclick="passwordEye('gameserver');">
                                                <i class="far fa-eye"></i>
                                            </span>

                                            <i style="cursor: pointer;" class="fas fa-copy copy-btn" data-clipboard-text="<?= $serverInfos['mp_pass']; ?>" data-toggle="tooltip" title="Passwort kopieren"></i>
                                        </span>
                                    </p>
                                </div>

                                <?php
                $SQL = $db -> prepare("SELECT * FROM `marktplatz_zusatz` WHERE `mp_id` = :mp_id");
                $SQL->execute(array(":mp_id" => $id));
                if ($SQL->rowCount() != 0) {
                while ($zusatz = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

                                <div class="col-md-12">
                                    <p class="text-muted mb-2 font-13">
                                    </p>
                                </div>

                                <div class="col-md-3">								
									<h5>Zusatzpakete</h5>
									<hr>
                                </div>

                                <div class="col-md-9">								
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong><?= $zusatz['zusatz_name']; ?>:</strong>  
                                    </p>
                                </div>
                                                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">
                                            <?= $zusatz['zusatz_desc']; ?>
                                            <?php if($zusatz['locked'] == "pending"){ ?>
                                                <a style="color:orange;">Ausstehend - Wartet auf Freischaltung</a>
                                            <?php } ?>
                                        </span>
                                    </p>
                                </div>


                                <?php } } ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h1>Leistung</h1></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">

                                <textarea class="form-control" name="notes" rows="10" disabled><?= $serverInfos['mp_desc']; ?></textarea>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h3 align="center">Server Reset</h3></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post">

                                    <button type="submit" name="useHW" class="btn btn-outline-success btn-block" data-toggle="tooltip" title="Dies erzwingt einen Neustart des Servers.">
									<b><i class="fas fa-redo-alt"></i> Neustart</b>
								</button>

                                <button type="submit" name="startRescue" class="btn btn-outline-warning btn-block" data-toggle="tooltip" title="Der locale Rettungsmodus wird aktiviert.">
									<b><i class="fas fa-first-aid"></i> Rettunsmodus</b>
								</button>

                                <!--<button type="submit" name="usePower" class="btn btn-outline-success btn-block" data-toggle="tooltip" title="Diese Aktion führt dazu, dass ihr Server eingeschaltet wird.">
									<b><i class="fas fa-power-off"></i> Server einschalten</b>
								</button>-->

                                <a href="../../../support" name="" class="btn btn-outline-danger btn-block" data-toggle="tooltip" title="Ein Techniker von uns startet den Server neu">
									<b><i class="fas fa-user"></i> Manuellen Reset</b>
                                    </a>

                                </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h3 align="center">Aktionen</h3></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">

                                <p align="center">Die Kündigung wird für den <?= $dateTimeMinus3Day; ?> eingetragen.</p>

                                <form method="post">

                                <button type="submit" name="stornoServer" class="btn btn-outline-warning btn-block" data-toggle="tooltip" title="Den Server zum <?= $dateTimeMinus3Day; ?> kündigen.">
									<b><i class="fas fa-redo-alt"></i> Server Kündigung</b>
								</button>

                                <a href="../../../zusatz/marktplatz/<?= $serverInfos['id']; ?>" class="btn btn-outline-success btn-block" data-toggle="tooltip" title="Erweitere deinen dedizierten Server.">
									<b><i class="fas fa-plus"></i> Zusatzpakete</b>
                                </a>


                                </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h1>Zugangsdaten</h1></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://robot-ws.your-server.de/server/".$serverInfos['mp_servernumber']."",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response,true);

// view result
var_dump($result);
?>



                                <textarea class="form-control" name="notes" rows="5" disabled><?php  ?></textarea>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h3 align="center">Reverse DNS - <a style="color:<?= env('MAIN_COLOR'); ?>">NEU</a></h3></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                <form method="post" name="rdns">

                                <input class="form-control" name="" rows="1" value="<?= $serverInfos['mp_ip']; ?>" disabled>

                                <br>

                                <input class="form-control" name="rdns_record" rows="1" placeholder="">

                                <br>

                                <button type="submit" name="rdns" class="btn btn-outline-success btn-block" data-toggle="tooltip" title="Hier kannst du den RDNS Eintrag deiner IP ändern">
									<b><i class="fas fa-save"></i> Speichern</b>
								</button>

                                </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!--<div class="col-md-4">
				</div>-->

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h3 align="center">Neuinstallation - <a style="color:<?= env('MAIN_COLOR'); ?>">NEU</a></h3></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">

                                <p align="center">Wichtig: Starte den Server nach dem Klick auf "Server Neuinstallieren" neu und warte
									10 Minuten, bis du dich erneut in den Server einloggst.</p>

                                <form method="post">
<select class="form-control" name="install_os">
                                    <option value="Debian 11.1 base">Debian 11</option>
                                    <option value="Debian 10.11 minimal">Debian 10</option>
                                    <option value="Ubuntu 21.10 base">Ubuntu 21.10</option>
                                    <option value="Ubuntu 20.04.3 LTS minimal">Ubuntu 20.04</option>
                                </select>
									
									<br>

                                <button type="submit" name="reinstallServer" class="btn btn-outline-warning btn-block" data-toggle="tooltip" title="Achtung: Alle Daten auf dem Server gehen verloeren">
									<b><i class="fas fa-redo-alt"></i> Server Neuinstallieren</b>
								</button>


                                </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>

    let gameserver = true;
    function passwordEye(type) {
        if(type == 'gameserver'){
            if(gameserver){
                $('#gameserver_password').html("<?= $serverInfos['mp_pass']; ?>");
                $('#gameserver_icon').html('<i class="far fa-eye-slash"></i>');
                gameserver = false;
            } else {
                $('#gameserver_password').html('*********************************');
                $('#gameserver_icon').html('<i class="far fa-eye"></i>');
                gameserver = true;
            }
        }
    }

    var countDownDate = new Date("<?= $serverInfos['expire_at']; ?>").getTime();
    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(days == 1){ var days_text = ' Tag' } else { var days_text = ' Tage'; }
        if(hours == 1){ var hours_text = ' Stunde' } else { var hours_text = ' Stunden'; }
        if(minutes == 1){ var minutes_text = ' Minute' } else { var minutes_text = ' Minuten'; }
        if(seconds == 1){ var seconds_text = ' Sekunde' } else { var seconds_text = ' Sekunden'; }

        if(days == 0 && !(hours == 0 && minutes == 0 && seconds == 0)){
            $('#countdown<?= $row["id"]; ?>').html(hours+hours_text+', '+  minutes+minutes_text+' und ' +  seconds+seconds_text);
            if(days == 0 && hours == 0 && !(minutes == 0 && seconds == 0)){
                $('#countdown<?= $row["id"]; ?>').html(minutes+minutes_text+' und '+  seconds+seconds_text);
                if(days == 0 && hours == 0 && minutes == 0 && !(seconds == 0)){
                    $('#countdown<?= $row["id"]; ?>').html(seconds+seconds_text);
                }
            }
        } else {
            $('#countdown').html(days+days_text+', '+  hours+hours_text+', '+  minutes+minutes_text+' und '+  seconds+seconds_text);
        }

        if (distance <= 0) {
            clearInterval(x);
        }
    }, 1000);
</script>