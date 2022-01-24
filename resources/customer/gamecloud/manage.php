<?php
$currPage = 'back_Gamecloud verwalten';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/gamecloud/manage.php';
$gamecloudid = $serverInfos['id'];
include BASE_PATH.'app/manager/customer/gamecloud/creator.php';
include BASE_PATH.'app/manager/customer/gamecloud/editor.php';
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
							Du bist zufrieden mit unseren Dienstleistungen? <u><a href="https://www.trustpilot.com/evaluate/www.german-host.eu?stars=5" target="_blank" style="color:white;">Bewerte uns doch!</a></u>
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

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Kennung der Cloud:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">GameCloud#<?= $serverInfos['id']; ?></span>
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
                                        <span class="ml-2"><?= $cpucount; ?>/<?= $cpu; ?> vKerne (3.5 GHz)</span>
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
                                        <span class="ml-2"><?= $ramcount; ?>/<?= $ram; ?> GB DDR4 RAM</span>
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
                                        <span class="ml-2"><?= $diskcount; ?>/<?= $disk; ?> GB SSD NVMe</span>
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
                                        <span class="ml-2"><?= $dbcount; ?>/<?= $serverInfos['gs_datenbanken']; ?> <?= $db_titel; ?></span>
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

                				<!-- Modal Start -->
                                <div class="modal fade" id="gameservermodal1" tabindex="-1" role="dialog" aria-labelledby="gameservermodal1Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="gameservermodal1Label">Gameserver anlegen</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">


                                                <ul class="nav nav-pills" id="myTab" role="tablist">

                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="custom-tab1" data-toggle="tab" href="#mcserver" role="tab"  style="color:white;" aria-controls="custom1" aria-selected="true">Minecraft Server</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" id="tssserver-tab1" data-toggle="tab" href="#tssserver" role="tab" style="color:white;" aria-controls="subdomain1" aria-selected="false">Teamspeak Server</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" id="tssserver-tab1" data-toggle="tab" href="#sinusbot" role="tab" style="color:white;" aria-controls="subdomain1" aria-selected="false">SinusBot</a>
                                                    </li>
                                                    
                                                </ul>

                                                <hr>


                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="mcserver" role="tabpanel" aria-labelledby="mcserver-tab1">

                                                        <form method="post">

                                                            <label>RAM (in MB)</label>
                                                            <input class="form-control" type="number" name="create_ram" value="1000" min="1000" max="<?= $serverInfos['gs_ram'] ?>" required>

                                                            <br>

                                                            <label>vKerne (1 Kern = 100)</label>
                                                            <input class="form-control" type="number" name="create_cpu" value="100" min="100" max="<?= $serverInfos['gs_cpu'] ?>" required>

                                                            <br>

                                                            <label>Speicher (in MB)</label>
                                                            <input class="form-control" type="number" name="create_speicher" min="1000" value="1000" max="<?= $serverInfos['gs_disk'] ?>" required>

                                                            <br>

                                                            <label>Datenbanken</label>
                                                            <input class="form-control" type="number" name="create_db" min="0" value="0" max="<?= $serverInfos['gs_datenbanken'] ?>" required>

                                                            <br>
                                                            <hr>

                                                            <button type="submit" name="createMC" class="btn btn-outline-success text-uppercase font-weight-bolder px-15 py-3">
                                                                <i class="fas fa-upload"></i> Server aufsetzen
                                                            </button>
                                                            <button type="button" class="btn btn-outline-primary text-uppercase font-weight-bolder" data-dismiss="modal">
                                                                <i class="fas fa-ban"></i> Abbrechen
                                                            </button>
                                                        </form>

                                                    </div>

                                                    <div class="tab-pane fade" id="tssserver" role="tabpanel" aria-labelledby="tssserver-tab1">

                                                        <form method="post">

                                                            <label>RAM (in MB)</label>
                                                            <input class="form-control" type="number" name="create_ram" value="1000" min="1000" max="<?= $serverInfos['gs_ram'] ?>" required>

                                                            <br>

                                                            <label>vKerne (1 Kern = 100)</label>
                                                            <input class="form-control" type="number" name="create_cpu" value="100" min="100" max="<?= $serverInfos['gs_cpu'] ?>" required>

                                                            <br>

                                                            <label>Speicher (in MB)</label>
                                                            <input class="form-control" type="number" name="create_speicher" min="1000" value="1000" max="<?= $serverInfos['gs_disk'] ?>" required>


                                                            <br>
                                                            <hr>

                                                            <button type="submit" name="createTS" class="btn btn-outline-success text-uppercase font-weight-bolder px-15 py-3">
                                                                <i class="fas fa-upload"></i> Server aufsetzen
                                                            </button>
                                                            <button type="button" class="btn btn-outline-primary text-uppercase font-weight-bolder" data-dismiss="modal">
                                                                <i class="fas fa-ban"></i> Abbrechen
                                                            </button>
                                                        </form>

                                                    </div>

                                                    <div class="tab-pane fade" id="sinusbot" role="tabpanel" aria-labelledby="sinusbot-tab1">

                                                        <form method="post">

                                                            <label>RAM (in MB)</label>
                                                            <input class="form-control" type="number" name="create_ram" value="1000" min="1000" max="<?= $serverInfos['gs_ram'] ?>" required>

                                                            <br>

                                                            <label>vKerne (1 Kern = 100)</label>
                                                            <input class="form-control" type="number" name="create_cpu" value="100" min="100" max="<?= $serverInfos['gs_cpu'] ?>" required>

                                                            <br>

                                                            <label>Speicher (in MB)</label>
                                                            <input class="form-control" type="number" name="create_speicher" min="1000" value="1000" max="<?= $serverInfos['gs_disk'] ?>" required>

                                                            <br>

                                                            <label>Sinusbot Admin Passwort</label>
                                                            <input class="form-control" type="text" name="sinusbotpw" min="1000" value="<?= $helper->generateRandomString(18,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!*?_#^/$%@'); ?>" required>

                                                
                                                            <br>
                                                            <hr>

                                                            <button type="submit" name="createSinusBot" class="btn btn-outline-success text-uppercase font-weight-bolder px-15 py-3">
                                                                <i class="fas fa-upload"></i> Server aufsetzen
                                                            </button>
                                                            <button type="button" class="btn btn-outline-primary text-uppercase font-weight-bolder" data-dismiss="modal">
                                                                <i class="fas fa-ban"></i> Abbrechen
                                                            </button>
                                                        </form>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function orderNow1() {
                                        document.getElementById("orderForm1").submit();
                                        const button = document.getElementById('orderBtn1');
                                        button.disabled = true;
                                        button.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i> wird ausgeführt...';
                                    }
                                </script>
				
				<!-- Modal Ende -->

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h1>Aktionen</h1></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                <a href="#" data-toggle="modal" data-target="#gameservermodal1" class="btn btn-block btn-outline-success">
                                  <i class="fas fa-share-square"></i> Server anlegen    
                                </a>

                                    <div class="mt-5"></div>
                                    <a class="btn btn-block btn-outline-warning" href="<?= $helper->url(); ?>renew/gameserver/mc/<?= $id; ?>"><i class="fas fa-history"></i> <b>Verlängern</b></a>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h1>Instanzen</h1>
                    <small>Die Instanzen werden zu dem oben genannten Konto hinzugefügt</small></div>
                        <div class="card-body">

                        <div class="card card-custom card-stretch gutter-b shadow mb-5">
                        <div class="card-body d-flex flex-column">
                            <table class="table" id="dataTableLoad">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        #
                                    </th>
                                    <th scope="col">
                                        Name
                                    </th>
                                    <th scope="col">
                                        CPU
                                    </th>
                                    <th scope="col">
                                        RAM
                                    </th>
                                    <th scope="col">
                                        SPEICHER
                                    </th>
                                    <th scope="col">
                                        Datenbanken
                                    </th>
                                    <th scope="col">
                                        Status
                                    </th>
                                    <th scope="col">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php
                                $SQL = $db -> prepare("SELECT * FROM `gamecloud_server` WHERE `cloud_id` = :user_id");
                                $SQL->execute(array(":user_id" => $id));
                                if ($SQL->rowCount() != 0) {
                                    while ($servers = $SQL -> fetch(PDO::FETCH_ASSOC)){

                                        if($servers['state'] == 'active'){
                                            $status = '<span class="badge badge-success">Aktiv</span>';
                                        } elseif($servers['state'] == 'suspended'){
                                            $status = '<span class="badge badge-danger">Gesperrt</span>';
                                        }


                                        ?>
                                        <?php
                                        $cpu = $servers['gs_cpu'] / 100;
                                        $ram = $servers['gs_ram'] / 1000;
                                        $disk = $servers['gs_disk'] / 1000;
                                        $datenbanken = $servers['gs_datenbanken'];
                                        ?>

                                        <?php if($datenbanken == NULL) {
                                            $datenbanken = "0";
                                             } ?>


                                        <tr>
                                            <th scope="row"><?= $servers['id']; ?></th>
											<?php if($servers['custom_name'] !== NULL) { ?>
                                            <td><?= $servers['custom_name']; ?> (<?= $servers['gs_name']; ?>)</td>
											<?php } ?>
											<?php if($servers['custom_name'] == NULL) { ?>
                                            <td><?= $servers['gs_name']; ?></td>
											<?php } ?>
                                            <td><?= $cpu ?> vKern(e)</td>
                                            <td><?= $ram ?> GB</td>
                                            <td><?= $disk ?> GB</td>
                                            <td><?= $datenbanken ?> Datenbank(en)</td>
                                            <td><?= $status; ?></td>

                                            <td>

                				<!-- Modal Start -->
                                <div class="modal fade" id="editmodal<?= $servers['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="gameservermodal1Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="gameservermodal1Label">Gameserver anpaasen</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">


                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="mcserver" role="tabpanel" aria-labelledby="mcserver-tab1">

                                                        <form method="post">

                                                            <label>Server-Name</label>
                                                            <input class="form-control" type="text" name="custom_name" value="<?= $servers['custom_name']; ?>">

                                                            <br>

                                                            <label>RAM (in MB)</label>
                                                            <input class="form-control" type="number" name="edit_ram" value="<?= $ram ?>000" min="1000" max="<?= $serverInfos['gs_ram'] ?>" required>

                                                            <br>

                                                            <label>vKerne (1 Kern = 100)</label>
                                                            <input class="form-control" type="number" name="edit_cpu" value="<?= $cpu ?>00" min="100" max="<?= $serverInfos['gs_cpu'] ?>" required>

                                                            <br>

                                                            <label>Speicher (in MB)</label>
                                                            <input class="form-control" type="number" name="edit_speicher" min="1000" value="<?= $disk ?>000" max="<?= $serverInfos['gs_disk'] ?>" required>

                                                            <br>

                                                            <label>Datenbanken</label>
                                                            <input class="form-control" type="number" name="edit_db" min="0" value="<?= $datenbanken ?>" max="<?= $serverInfos['gs_datenbanken'] ?>" required>

                                                            <input hidden name="wisp_id" value="<?= $servers['wisp_id']; ?>">
                                                            <input hidden name="allo_id" value="<?= $servers['allo_id']; ?>">

                                                            <br>
                                                            <hr>

                                                            <button type="submit" name="editServer" class="btn btn-outline-danger text-uppercase font-weight-bolder px-15 py-3">
                                                                <i class="fas fa-edit"></i> Server anpassen
                                                            </button>
                                                            <button type="button" class="btn btn-outline-primary text-uppercase font-weight-bolder" data-dismiss="modal">
                                                                <i class="fas fa-ban"></i> Abbrechen
                                                            </button>
                                                        </form>

                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function orderNow1() {
                                        document.getElementById("orderForm1").submit();
                                        const button = document.getElementById('orderBtn1');
                                        button.disabled = true;
                                        button.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i> wird ausgeführt...';
                                    }
                                </script>
				
				<!-- Modal Ende -->

                                            <form method="post">
                                                <!--<a data-toggle="modal" data-target="#editmodal<?= $servers['id']; ?>" class="btn btn-outline-danger btn-sm font-weight-bolder">
                                                <i class="fa fa-edit"></i>
                                                </a>-->
												
                                                <input hidden name="wisp_id" value="<?= $servers['wisp_id']; ?>">
                                                <button type="submit" name="delServ" class="btn btn-outline-warning btn-sm font-weight-bolder"
                                                data-toggle="tooltip"
							                    data-original-title="Server löschen">
                                                <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                            </td>

                                        </tr>


                                    <?php } } ?>
                                </tbody>
                            </table>
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