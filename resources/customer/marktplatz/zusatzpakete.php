<?php
$currPage = 'front_Dedicated Server bestellen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/marktplatz/zusatz.php';

$setup = "10";
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: #6254FE;">Zusatzpakete</b></h1>

        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">

<div class="alert alert-primary col-md-12" align="center" role="alert">
	Die Zusatzpakete sind nur für den Server <b><?= $serverInfos['mp_name']; ?> (SERV-<?= $serverInfos['id']; ?>)</b> nutzbar
</div>

            <div class="row">

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;">1 IPv4 Adresse</h1>
                            <b><span style="font-size: 28px;">25.00€</span> / Einmalig <br>Läuft mit dem Server aus</b>
                        </div>
                        <div class="card-body" align="center">
                            <form method="post">
								
								<input hidden name="plan_id" value="+ 1 IPv4 (MP-<?= $serverInfos['id']; ?>)">
								<input hidden name="planPrice" value="25">
								<!--<input hidden name="planPriceSetup" value="<?= $setup; ?>">-->

								<h4>

									<i class="fas fa-check" style="color:green"></i>
									RDNS änderbar<br>
									

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									Ermöglicht eine weitere IP-Adresse<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

								<h6 style="color:green;">Für diesen Server verfügbar</h6>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>


											<!--<button class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3 disabled">
                                                <i class="fas fa-shopping-cart"></i> Aktuell ausverkauft
                                            </button>-->
											
                                            <?php } else { ?>
                                            <a href="<?= env('URL'); ?>register" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Account erstellen
                                            </a>
                                            <?php } ?>
                                        </div>
								<small>* inkl. 0.00€ Einrichtungsgebühr</small>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;">2 IPv4 Adresse</h1>
                            <b><span style="font-size: 28px;">45.00€</span> / Einmalig <br>Läuft mit dem Server aus</b>
                        </div>
                        <div class="card-body" align="center">
                            <form method="post">
								
								<input hidden name="plan_id" value="+ 1 IPv4 (MP-<?= $serverInfos['id']; ?>)">
								<input hidden name="planPrice" value="25">
								<!--<input hidden name="planPriceSetup" value="<?= $setup; ?>">-->

								<h4>

									<i class="fas fa-check" style="color:green"></i>
									RDNS änderbar<br>
									

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									Ermöglicht zwei weitere IP-Adressen<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

								<h6 style="color:green;">Für diesen Server verfügbar</h6>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>


											<!--<button class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3 disabled">
                                                <i class="fas fa-shopping-cart"></i> Aktuell ausverkauft
                                            </button>-->
											
                                            <?php } else { ?>
                                            <a href="<?= env('URL'); ?>register" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Account erstellen
                                            </a>
                                            <?php } ?>
                                        </div>
								<small>* inkl. 0.00€ Einrichtungsgebühr</small>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;">4 IPv4 Adresse</h1>
                            <b><span style="font-size: 28px;">90.00€</span> / Einmalig <br>Läuft mit dem Server aus</b>
                        </div>
                        <div class="card-body" align="center">
                            <form method="post">
								
								<input hidden name="plan_id" value="+ 1 IPv4 (MP-<?= $serverInfos['id']; ?>)">
								<input hidden name="planPrice" value="25">
								<!--<input hidden name="planPriceSetup" value="<?= $setup; ?>">-->

								<h4>

									<i class="fas fa-check" style="color:green"></i>
									RDNS änderbar<br>
									

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									Ermöglicht viert weitere IP-Adressen<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

								<h6 style="color:green;">Für diesen Server verfügbar</h6>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>


											<!--<button class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3 disabled">
                                                <i class="fas fa-shopping-cart"></i> Aktuell ausverkauft
                                            </button>-->
											
                                            <?php } else { ?>
                                            <a href="<?= env('URL'); ?>register" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Account erstellen
                                            </a>
                                            <?php } ?>
                                        </div>
								<small>* inkl. 0.00€ Einrichtungsgebühr</small>

                            </form>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>				
	<center><small>
		-Die Bereitstellung, von Zusatzpaketen, erfolgt binnen 48 Stunden.
		</small></center>
</div>

