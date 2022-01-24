<?php
$currPage = 'front_Domain Bestellen';
include BASE_PATH.'app/controller/PageController.php';

$deprice = "5";
$euprice = "5";
$netprice = "15";
$comprice = "15";
$beprice = "9";
$linkprice = "15";
$devprice = "16";

$domain = $_POST['domain'];

if($domain == "Black-Host")
{
    $error = true;
}

if(isset($_POST['orderDomain'])){

    $runtime = "365";

    $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
    $date->modify('+' . $runtime . ' day');
    $expire_at = $date->format('Y-m-d H:i:s');
    $state = "pending";

    if($_POST['endung'] == "de") {
        $buyprice = $deprice;
    }

    if($_POST['endung'] == "eu") {
        $buyprice = $euprice;
    }

    if($_POST['endung'] == "net") {
        $buyprice = $netprice;
    }

    if($_POST['endung'] == "com") {
        $buyprice = $comprice;
    }

    if($_POST['endung'] == "be") {
        $buyprice = $beprice;
    }

    if($_POST['endung'] == "link") {
        $buyprice = $linkprice;
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


    $SQL->execute(array($userid, $domain_name, $domain_endung, $state, $expire_at, $buyprice));

    $user->removeMoney($buyprice, $userid);
    $user->addTransaction($userid,'-'.$buyprice, $domain_name.' Bestellung (Domain)');
		
    $discord->callWebhook('<@&874784920332017715> Soeben wurde eine Domain bestellt von '.$username);
    
    $_SESSION['success_msg'] = 'Vielen Dank! Deine Domain wurde erstellt';
    header('Location: '.env('URL').'manage/domains');
}

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <form method="post" id="checkform">
                        <div class="card card-custom">
                        <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Domain suchen</span>
                            </h3>
                        </div>
                            <div class="card-body">
                                <input class="form-control" name="domain" rows="1" placeholder="Black-Host">
                                <br>
                                <button onclick="checkNow();" type="submit" id="checkDomain" name="checkDomain" class="btn btn-outline-primary btn-block">
									<b><i class="fas fa-search"></i> Domainverfügbarkeit prüfen</b>
								</button>
                            </div>
                        </div>
                    </form><br>
                </div>

                <script>
                    function checkNow() {
                        document.getElementById("checkform").submit();
                        const button = document.getElementById('checkDomain');
                        button.disabled = true;
                        button.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i> Domain wird geprüft ...';
                    }
                    </script>


                <div class="col-md-12"> <br> </div>


            </div>

            <div class="row">


                <div class="col-md-3">
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
                </div>

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
  
                        <form method="post">
                         <div class="form-group row">
                         
                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="<?= $domain; ?>.de" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $deprice ?>.00€" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $deprice ?>.00€" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            <?php $endung = "de" ?>
                                            <?php include 'checker.php'; ?>

                                            <?php if($checkDomain['available'] == true) {
                                                $check = "frei"; 
                                            }
                                            ?>

                                            <?php if($checkDomain['available'] == false) {
                                            $check = "vergeben"; 
                                            }
                                            ?>

                                           <?php if($domain == NULL) {
                                            $check = "unknow"; 
                                            }
                                            ?>                                                                                       
                                                

                                                <?php include '_domainbutton.php'; ?>
                                            </div>
                                            
                                            
                         </div>
                        </form>


                        <form method="post">
                         <div class="form-group row">
                         
                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="<?= $domain; ?>.eu" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $euprice ?>.00€" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $euprice ?>.00€" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            <?php $endung = "eu" ?>
                                            <?php include 'checker.php'; ?>

                                            <?php if($checkDomain['available'] == true) {
                                                $check = "frei"; 
                                            }
                                            ?>

                                            <?php if($checkDomain['available'] == false) {
                                            $check = "vergeben"; 
                                            }
                                            ?>

                                           <?php if($domain == NULL) {
                                            $check = "unknow"; 
                                            }
                                            ?>                                                                                       
                                                
                                                <input type="text" name="endung" class="form-control" value="<?= $endung ?>" hidden>
                                                <input type="text" name="domain" class="form-control" value="<?= $domain ?>" hidden>

                                                <?php include '_domainbutton.php'; ?>
                                            </div>
                                            
                                            
                         </div>
                        </form>

                        <form method="post">
                         <div class="form-group row">
                         
                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="<?= $domain; ?>.net" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $netprice ?>.00€" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $netprice ?>.00€" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            <?php $endung = "net" ?>
                                            <?php include 'checker.php'; ?>

                                            <?php if($checkDomain['available'] == true) {
                                                $check = "frei"; 
                                            }
                                            ?>

                                            <?php if($checkDomain['available'] == false) {
                                            $check = "vergeben"; 
                                            }
                                            ?>

                                           <?php if($domain == NULL) {
                                            $check = "unknow"; 
                                            }
                                            ?>                                                                                       
                                                
                                                <input type="text" name="endung" class="form-control" value="<?= $endung ?>" hidden>
                                                <input type="text" name="domain" class="form-control" value="<?= $domain ?>" hidden>

                                                <?php include '_domainbutton.php'; ?>
                                            </div>
                                            
                                            
                         </div>
                        </form>

                        <form method="post">
                         <div class="form-group row">
                         
                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="<?= $domain; ?>.com" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $comprice ?>.00€" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $comprice ?>.00€" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            <?php $endung = "com" ?>
                                            <?php include 'checker.php'; ?>

                                            <?php if($checkDomain['available'] == true) {
                                                $check = "frei"; 
                                            }
                                            ?>

                                            <?php if($checkDomain['available'] == false) {
                                            $check = "vergeben"; 
                                            }
                                            ?>

                                           <?php if($domain == NULL) {
                                            $check = "unknow"; 
                                            }
                                            ?>                                                                                       
                                                
                                                <input type="text" name="endung" class="form-control" value="<?= $endung ?>" hidden>
                                                <input type="text" name="domain" class="form-control" value="<?= $domain ?>" hidden>

                                                <?php include '_domainbutton.php'; ?>
                                            </div>
                                            
                                            
                         </div>
                        </form>

                        <form method="post">
                         <div class="form-group row">
                         
                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="<?= $domain; ?>.be" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $beprice ?>.00€" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $beprice ?>.00€" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            <?php $endung = "be" ?>
                                            <?php include 'checker.php'; ?>

                                            <?php if($checkDomain['available'] == true) {
                                                $check = "frei"; 
                                            }
                                            ?>

                                            <?php if($checkDomain['available'] == false) {
                                            $check = "vergeben"; 
                                            }
                                            ?>

                                           <?php if($domain == NULL) {
                                            $check = "unknow"; 
                                            }
                                            ?>                                                                                       
                                                
                                                <input type="text" name="endung" class="form-control" value="<?= $endung ?>" hidden>
                                                <input type="text" name="domain" class="form-control" value="<?= $domain ?>" hidden>

                                                <?php include '_domainbutton.php'; ?>
                                            </div>
                                            
                                            
                         </div>
                        </form>

                        <form method="post">
                         <div class="form-group row">
                         
                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="<?= $domain; ?>.link" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $linkprice ?>.00€" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $linkprice ?>.00€" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            <?php $endung = "link" ?>
                                            <?php include 'checker.php'; ?>

                                            <?php if($checkDomain['available'] == true) {
                                                $check = "frei"; 
                                            }
                                            ?>

                                            <?php if($checkDomain['available'] == false) {
                                            $check = "vergeben"; 
                                            }
                                            ?>

                                           <?php if($domain == NULL) {
                                            $check = "unknow"; 
                                            }
                                            ?>                                                                                       
                                                
                                                <input type="text" name="endung" class="form-control" value="<?= $endung ?>" hidden>
                                                <input type="text" name="domain" class="form-control" value="<?= $domain ?>" hidden>

                                                <?php include '_domainbutton.php'; ?>
                                            </div>
                                            
                                            
                         </div>
                        </form>

                        <form method="post">
                         <div class="form-group row">
                         
                                            <div class="col-sm-1">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" name="" class="form-control" value="<?= $domain; ?>.dev" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $devprice ?>.00€" disabled>
                                            </div>

                                            <div class="col-sm-3">
                                            <input type="text" name="" class="form-control" value="<?= $devprice ?>.00€" disabled>
                                            </div>


                                            <div class="col-sm-2">
                                            <?php $endung = "dev" ?>
                                            <?php include 'checker.php'; ?>

                                            <?php if($checkDomain['available'] == true) {
                                                $check = "frei"; 
                                            }
                                            ?>

                                            <?php if($checkDomain['available'] == false) {
                                            $check = "vergeben"; 
                                            }
                                            ?>

                                           <?php if($domain == NULL) {
                                            $check = "unknow"; 
                                            }
                                            ?>                                                                                       
                                                
                                                <input type="text" name="endung" class="form-control" value="<?= $endung ?>" hidden>
                                                <input type="text" name="domain" class="form-control" value="<?= $domain ?>" hidden>

                                                <?php include '_domainbutton.php'; ?>
                                            </div>
                                            
                                            
                         </div>
                        </form>


                    
                        </div>
                    </div>
                    </form>
                </div>



            </div>


        </div>
    </div>
</div>