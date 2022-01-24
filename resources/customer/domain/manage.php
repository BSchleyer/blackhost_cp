
<?php
$currPage = 'back_Domain Verwaltung';
include BASE_PATH.'app/controller/PageController.php';

$siteid = $helper->protect($_GET['id']);

                $SQL = $db->prepare("SELECT * FROM `domains` WHERE `user_id` = :user_id AND `id` = :siteid AND `state` = 'active'");
                $SQL->execute(array(":user_id" => $userid, ":siteid" => $siteid));
                if ($SQL->rowCount() != 0) {
                    while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

//
// CREATE DNS
//

    if(isset($_POST['changeDNS'])){


$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/records');


curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');


curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
  'Auth-API-Token: npC59LY2E9rEdfWZe6jBMJbaeyo7LHQP',
]);


$json_array = [
  'value' => $_POST['record_value'],
  'ttl' => $_POST['record_ttl'],
  'type' => $_POST['record_type'],
  'name' => $_POST['record_name'],
  'zone_id' => $_POST['record_zoneid']
]; 
$body = json_encode($json_array);


curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);


$response = curl_exec($ch);
$getDomain = json_decode($response, true);

$SQLDNS = $db->prepare("INSERT INTO `domain_dns` (`domain_id`, `subdomain`, `type`, `ziel`) VALUES (?,?,?,?)");
$SQLDNS->execute(array($siteid, $_POST['record_name'], $_POST['record_type'], $_POST['record_value']));

curl_close($ch);

        echo sendSuccess('Die Einträge wurden gespeichert');
    }

//
// DELETE DNS
//


    if(isset($_POST['deleteDNS'])){

        
        $SQLDNS = $db->prepare("DELETE FROM `domain_dns` WHERE `id` = :id");
        $SQLDNS->execute(array(":id" => $_POST['entryid']));
        
        curl_close($ch);
        
                echo sendSuccess('Der DNS Eintrag wurde entfern');
            }


$zoneid = $row['zone_id'];
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-5">
                        <div class="card-header"><h4><?= $row['domain_name']; ?>.<?= $row['domain_endung']; ?></h4></div>
						<br>
						<div class="alert alert-primary col-md-12" role="alert" align="center">         
							Du bist zufrieden mit unseren Dienstleistungen? <u><a href="https://www.trustpilot.com/evaluate/black-host.eu?stars=5" target="_blank" style="color:white;">Bewerte uns doch!</a></u>
						</div>
                        <div class="card-body">
                            <div class="row">
								

								<!-- -->

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
                        <div class="card-header"><h4>Aktionen</h4></div>
                        <div class="card-body">

                            <a class="btn btn-block btn-outline-success" href="<?= $helper->url(); ?>renew/kvm/<?= $siteid; ?>">
								<b><i class="fas fa-history"></i> Verlängern</b>
							</a>
							
							
                            <br>
                            </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card shadow mb-5">
                    <form method="post">
                        <div class="card-header"><h4>DNS Einträge</h4></div>
                        <div class="card-body">

                        <?php include 'actions/dnslist.php'; ?>

                        <?php if($row['zone_id'] == ""){ ?>
                            <div class="alert alert-warning col-md-12" align="center" role="alert">
                            FÜr diese Domain ist die DNS Verwaltung nicht aktiviert. Für eine Aktivierung kontaktiere unseren Support.
                            </div>
                        <?php } ?>
                        <div class="alert alert-primary col-md-12" align="center" role="alert">
                            Das löschen von Einträgen ist zurzeit nicht möglich.
                            </div>



                        <?php
                $SQL = $db->prepare("SELECT * FROM `domain_dns` WHERE $siteid = `domain_id`");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($dns = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>


                        <form method="post">
                         <div class="form-group row">
                                            <div class="col-sm-offset-2 col-md-3">
                                                <input type="text" name="record_name" class="form-control" value="<?= $dns['subdomain']; ?>" disabled>
                                            </div>
                                            <div class="col-sm-4">
                                            <input type="text" name="record_value" class="form-control" value="<?= $dns['type']; ?>" disabled>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="record_value" class="form-control" value="<?= $dns['ziel']; ?>" disabled>
                                                <input hidden type="text" name="record_zoneid" class="form-control" value="<?= $zoneid; ?>">
                                                <input type="number" name="record_ttl" class="form-control"  value="86400" disabled hidden>
                                            </div>
                                            <input type="text" name="entryid" class="form-control" value="<?= $dns['id']; ?>" hidden>
                                            <div class="col-sm-2">
                                            <button disabled type="submit" name="deleteDNS" class="btn btn-outline-warning btn-sm"><b><i class="fas fa-trash"></i> Löschen</b></button>
                                            </div>
                                            
                                            
                         </div>
                        </form>

                         <?php } } ?>


                         <hr>


                        <div class="form-group row">
                                            <div class="col-sm-offset-2 col-md-3">
                                                <input type="text" name="record_name" class="form-control" placeholder="Subdomain">
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="record_type" class="form-control" data-live-search="true">
                                                    <option value="" disabled="" selected="">Bitte auswählen</option>
                                                    <option value="A">A</option>
                                                    <option value="AAAA">AAAA</option>
                                                    <option value="CNAME">CNAME</option>
                                                    <option value="MX">MX</option>
                                                    <option value="SRV">SRV</option>
                                                    <option value="TXT">TXT</option>
                                                    <option value="NS">NS</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="record_value" class="form-control" placeholder="Ziel">
                                                <input hidden type="text" name="record_zoneid" class="form-control" value="<?= $zoneid; ?>">
                                                <input type="number" name="record_ttl" class="form-control" placeholder="TTL" value="86400" disabled hidden>
                                            </div>
                                            <div class="col-sm-2">
                                            <button type="submit" name="changeDNS" class="btn btn-outline-primary btn-sm"><b><i class="fas fa-save"></i> Speichern</b></button>
                                            </div>
                                            
                                            
                         </div>

                        </form>

							
							
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