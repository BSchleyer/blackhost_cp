<?php
$currPage = 'back_Gameserver verwalten';
include BASE_PATH.'app/controller/PageController.php';

include BASE_PATH.'app/manager/customer/gameserver/manage.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h1>Informationen</h1></div>
						<br>
						<div class="alert alert-primary col-md-12" role="alert" align="center">         
							Du bist zufrieden mit unseren Dienstleistungen? <u><a href="https://www.trustpilot.com/evaluate/black-host.eu?stars=5" target="_blank" style="color:white;">Bewerte uns doch!</a></u>
						</div>
                        <div class="card-body">
                            <div class="row">
								
                                <div class="col-md-2">								
									<h5>Hosting</h5>
									<hr>
                                </div>

                                <div class="col-md-10">								
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Verwaltungs-Url:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><a href="<?= env('PTERODACTYL_USER_URL'); ?>" target="_blank"><?= env('PTERODACTYL_USER_URL'); ?></a></span>
                                    </p>
                                </div>

                                <!--<div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Hostserver:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $serverInfos['gs_host']; ?></span>
                                    </p>
                                </div>-->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Kennung des Servers:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">Gameserver#<?= $serverInfos['id']; ?></span>
                                    </p>
                                </div>
								
								<!-- -->

                                <div class="col-md-12">
									<br>
                                </div>

                                <div class="col-md-2">								
									<h5>Leistung</h5>
									<hr>
                                </div>

                                <div class="col-md-10">								
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Zugewiesene CPU:</strong>
                                    </p>
                                </div>

								<?php
								$cpu = $serverInfos['gs_cpu'] / 100;
								?>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $cpu; ?> vKern (3.5 GHz)</span>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Zugewiesener RAM:</strong>
                                    </p>
                                </div>

								<?php
								$ram = $serverInfos['gs_ram'] / 1000;
								?>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $ram; ?> GB DDR4 ECC</span>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Zugewiesener Speicher:</strong>
                                    </p>
                                </div>
								
								<?php
								$disk = $serverInfos['gs_disk'] / 1000;
								?>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $disk; ?> GB SSD NVMe</span>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Zugewiesene Datenbanken:</strong>
                                    </p>
                                </div>
								
								<?php

								if($serverInfos['gs_datenbanken'] == 0){
									
									$db_titel = "Datenbanken";
								}

								if($serverInfos['gs_datenbanken'] > 0){
									
									$db_titel = "Datenbank";
								}

								if($serverInfos['gs_datenbanken'] > 1){
									
									$db_titel = "Datenbanken";
								}
								?>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $serverInfos['gs_datenbanken']; ?>x <?= $db_titel; ?></span>
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Externe Backups:</strong>
                                    </p>
                                </div>

								<?php

								if($serverInfos['gs_backups'] == 0){
									
									$bu_titel = "Externe Backups";
								}

								if($serverInfos['gs_backups'] > 0){
									
									$bu_titel = "Externes Backup";
								}

								if($serverInfos['gs_backups'] > 1){
									
									$bu_titel = "Externe Backups";
								}
								?>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $serverInfos['gs_backups']; ?>x <?= $bu_titel; ?></span>
                                    </p>
                                </div>
								
								<!-- -->

                                <div class="col-md-12">
									<br>
                                </div>

                                <div class="col-md-3">								
									<h5>Panel Zugang</h5>
									<hr>
                                </div>

                                <div class="col-md-9">								
                                </div>

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Panel E-Mail:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $user->getDataById($userid,'email'); ?></span>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Panel Passwort:</strong>  
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">
                                            <span class="noselect" id="gameserver_password">*********************************</span>
                                            <span style="cursor: pointer;" id="gameserver_icon" onclick="passwordEye('gameserver');">
                                                <i class="far fa-eye"></i>
                                            </span>

                                            <i style="cursor: pointer;" class="fas fa-copy copy-btn" data-clipboard-text="<?= $user->getDataById($userid,'pterodactyl_password'); ?>" data-toggle="tooltip" title="Passwort kopieren"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h1>Verwaltung</h1></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post">
                                        <a href="<?= env('PTERODACTYL_USER_URL'); ?>" target="_blank" class="btn btn-block btn-outline-success"><i class="fas fa-share-square"></i> <b>Einloggen</b></a>
                                    </form>

                                    <div class="mt-5"></div>
                                    <a class="btn btn-block btn-outline-warning" href="<?= $helper->url(); ?>renew/gameserver/mc/<?= $id; ?>"><i class="fas fa-history"></i> <b>Verlängern</b></a>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h1>Installations-Feedback</h1>	
							<small>Leite den folgenden Text, bei einem Bestellfehler, an den Support weiter.</small>
						</div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">

									<pre style="color:white;">
<?php

$json = $serverInfos['response'];


var_dump(json_decode($json));

?></pre>


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
                $('#gameserver_password').html("<?= $user->getDataById($userid,'pterodactyl_password'); ?>");
                $('#gameserver_icon').html('<i class="far fa-eye-slash"></i>');
                gameserver = false;
            } else {
                $('#gameserver_password').html('************');
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