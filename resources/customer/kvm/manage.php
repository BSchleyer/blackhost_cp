<?php
$currPage = 'back_KVM Verwaltung';
include BASE_PATH.'app/controller/PageController.php';

$siteid = $helper->protect($_GET['id']);

                $SQL = $db->prepare("SELECT * FROM `kvm` WHERE `vt_ownerid` = :user_id AND `id` = :siteid AND `state` = 'active'");
                $SQL->execute(array(":user_id" => $userid, ":siteid" => $siteid));
                if ($SQL->rowCount() != 0) {
                    while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-5">
						<div class="card-header"><h4>Übersicht</h4></div>
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

								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Login-URL:</strong>
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><a href="<?= env('KVM_MAIN_URL'); ?>" target="_blank"><?= env('KVM_MAIN_URL'); ?></a></span>
                                    </p>
                                </div>

								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Benutzername:</strong>   
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $row['vt_ownermail']; ?></span>  
                                    </p>
                                </div>
								
								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Login Passwort:</strong>   
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">
                                            <span class="noselect" id="plesk_password">*********************************</span>
                                            <span style="cursor: pointer;" id="plesk_icon" onclick="passwordEye('plesk');">
                                                <i class="far fa-eye"></i>
                                            </span>

                                            <i style="cursor: pointer;" class="fas fa-copy copy-btn" data-clipboard-text="<?= $row['vt_ownerpass']; ?>" data-toggle="tooltip" title="Passwort kopieren"></i>
                                        </span>
                                    </p>
                                </div>
								
								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Root Passwort:</strong>   
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">
                                            <span class="noselect" id="root_password">*********************************</span>
                                            <span style="cursor: pointer;" id="root_icon" onclick="passwordEye('root');">
                                                <i class="far fa-eye"></i>
                                            </span>

                                            <i style="cursor: pointer;" class="fas fa-copy copy-btn" data-clipboard-text="<?= $row['vt_rootpw']; ?>" data-toggle="tooltip" title="Passwort kopieren"></i>
                                        </span>
                                    </p>
                                </div>

								<!-- -->

                                <div class="col-md-12">
									<br>
                                </div>


                                <div class="col-md-3">								
									<h5>KVM Leistung</h5>
									<hr>
                                </div>

                                <div class="col-md-10">								
                                </div>

								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Kerne:</strong>   
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $row['kvm_cpu']; ?> virtuelle Kerne</span>  
                                    </p>
                                </div>

								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Arbeitsspeicher:</strong>   
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $row['kvm_ram']; ?> MB DDR3 RAM</span>  
                                    </p>
                                </div>

								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Festplattenspeicher:</strong>   
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $row['kvm_speicher']; ?> GB SSD NVMe</span>  
                                    </p>
                                </div>

								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>IPv4 Adressen:</strong>   
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $row['kvm_ipv4']; ?> IPv4 enthalten</span>  
                                    </p>
                                </div>

								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>IPv6 Adressen:</strong>   
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $row['kvm_ipv6']; ?> IPv6 enthalten</span>  
                                    </p>
                                </div>

								<!-- -->

                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Anbindung:</strong>   
                                    </p>
                                </div>
								<?php if($row['anbindung'] == 1280000) {
						        $anbindung = "10";
					            } ?>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">10 GB (Shared)</span>  
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
                                        <strong>Preis:</strong> 
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $row['price']; ?>€ / Monat</span>  
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Laufzeit:</strong>  
                                    </p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2">
                                            <span id="countdown">Lädt...</span>
                                        </span>
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h4>Verwaltung</h4></div>
                        <div class="card-body">

                            <!--<form method="post">
                                <button type="submit" class="btn btn-block btn-outline-primary" name="login">
									<b>
										<i class="fas fa-sign-in-alt"></i> Direkter Login</b>
								</button>
                            </form>

                            <br>-->
							
                            <a class="btn btn-block btn-outline-primary" href="<?= env('KVM_MAIN_URL'); ?>" target="_blank">
								<b><i class="fas fa-sign-in-alt"></i> Zur KVM-Verwaltung</b>
							</a>

                            <br>
                            <a class="btn btn-block btn-outline-success" href="<?= $helper->url(); ?>renew/kvm/<?= $siteid; ?>">
								<b><i class="fas fa-history"></i> Verlängern</b>
							</a>
							
                            <br><br>
							
							
                            <br>
                            </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    let plesk = true;
    let ftp = true;

    function passwordEye(type) {
        if(type == 'plesk'){
            if(plesk){
                $('#plesk_password').html("<?= $row['vt_ownerpass']; ?>");
                $('#plesk_icon').html('<i class="far fa-eye-slash"></i>');
                plesk = false;
            } else {
                $('#plesk_password').html('*********************************');
                $('#plesk_icon').html('<i class="far fa-eye"></i>');
                plesk = true;
            }
        }

        if(type == 'root'){
            if(plesk){
                $('#root_password').html("<?= $row['vt_rootpw']; ?>");
                $('#root_icon').html('<i class="far fa-eye-slash"></i>');
                plesk = false;
            } else {
                $('#root_password').html('*********************************');
                $('#root_icon').html('<i class="far fa-eye"></i>');
                plesk = true;
            }
        }

        if(type == 'ftp'){
            if(ftp){
                $('#ftp_password').html("<?= $serverInfos['ftp_password']; ?>");
                $('#ftp_icon').html('<i class="far fa-eye-slash"></i>');
                ftp = false;
            } else {
                $('#ftp_password').html('*********************************');
                $('#ftp_icon').html('<i class="far fa-eye"></i>');
                ftp = true;
            }
        }
    }
</script>
<script>
    var countDownDate = new Date("<?= $row['expire_at']; ?>").getTime();
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

<?php } }?>