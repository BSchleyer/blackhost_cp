<?php
$currPage = 'front_Webspace DE Angebote Bestellen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/webspace/order.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: #6254FE;">Plesk</b> Webserver Angebote</h1>
        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                                <?php
                                $i = 0;
//                                    $names = ['disc', 'domains', 'subdomains', 'databases', 'ftp_accounts', 'emails'];

                                $disc = [];
                                $domains = [];
                                $subdomains = [];
                                $databases = [];
                                $ftp_accounts = [];
                                $emails = [];

                                $SQL = $db->prepare("SELECT * FROM `webspace_packs` WHERE `kat` = '3'");
                                $SQL->execute();
                                if ($SQL->rowCount() != 0) {
                                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

                                    array_push($disc, $row['disc']);
                                    array_push($domains, $row['domains']);
                                    array_push($subdomains, $row['subdomains']);
                                    array_push($databases, $row['databases']);
                                    array_push($ftp_accounts, $row['ftp_accounts']);
                                    array_push($emails, $row['emails']);

                                ?>

				<!-- Modal Start -->
                                <div class="modal fade" id="webspaceModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="webspaceModal<?= $row['id']; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="webspaceModal<?= $row['id']; ?>Label">Webspace mieten</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">


                                                <ul class="nav nav-pills" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="custom-tab<?= $row['id']; ?>" data-toggle="tab" href="#custom<?= $row['id']; ?>" role="tab"  style="color:white;" aria-controls="custom<?= $row['id']; ?>" aria-selected="true">Eigene Domain</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="subdomain-tab<?= $row['id']; ?>" data-toggle="tab" href="#subdomain<?= $row['id']; ?>" role="tab" style="color:white;" aria-controls="subdomain<?= $row['id']; ?>" aria-selected="false">Subdomain von Uns</a>
                                                    </li>
                                                </ul>

                                                <hr>


                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="custom<?= $row['id']; ?>" role="tabpanel" aria-labelledby="custom-tab<?= $row['id']; ?>">

                                                        <form method="post">

                                                            <label>Domain</label>
                                                            <input class="form-control" name="domainName" placeholder="deine-domain.de" required>

                                                            <br>
                                                            <label for="agb<?= $row['id']; ?>_1" class="checkbox noselect">
                                                                <input type="checkbox" name="agb" id="agb<?= $row['id']; ?>_1">
                                                                <span></span>
                                                                Ich habe die <a href="<?= $helper->url(); ?>agb">AGB</a> und <a href="<?= $helper->url(); ?>datenschutz">Datenschutzerklärung</a> gelesen und akzeptiere diese.
                                                            </label>
                                                            <label for="wiederruf<?= $row['id']; ?>_1" class="checkbox noselect">
                                                                <input type="checkbox" name="wiederruf" id="wiederruf<?= $row['id']; ?>_1">
                                                                <span></span>
                                                                Ich wünsche die vollständige Ausführung der Dienstleistung vor Fristablauf des Widerufsrechts gemäß Fernabsatzgesetz. Die automatische Einrichtung und Erbringung der Dienstleistung führt zum Erlöschen des Widerrufsrechts.
                                                            </label>

                                                            <input hidden value="<?= $row['plesk_id']; ?>" name="planName">

                                                            <br>
                                                            <hr>

                                                            <button type="submit" name="order" class="btn btn-outline-success text-uppercase font-weight-bolder px-15 py-3">
                                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                                            </button>
                                                            <button type="button" class="btn btn-outline-primary text-uppercase font-weight-bolder" data-dismiss="modal">
                                                                <i class="fas fa-ban"></i> Abbrechen
                                                            </button>
                                                        </form>

                                                    </div>
                                                    <div class="tab-pane fade" id="subdomain<?= $row['id']; ?>" role="tabpanel" aria-labelledby="subdomain-tab<?= $row['id']; ?>">

                                                        <form method="post">

                                                            <label>Domain</label>
                                                            <input class="form-control" style="background-color: #292929;" readonly name="domainName" value="web<?= rand(0,9).rand(0,9).rand(0,9).'-'.$userid; ?>.<?= env('CUSTOM_WEBSPACE_SUBDOMAIN'); ?>" required>

                                                            <br>
                                                            <label for="agb<?= $row['id']; ?>_2" class="checkbox noselect">
                                                                <input type="checkbox" name="agb" id="agb<?= $row['id']; ?>_2">
                                                                <span></span>
                                                                Ich habe die <a href="<?= $helper->url(); ?>agb">AGB</a> und <a href="<?= $helper->url(); ?>datenschutz">Datenschutzerklärung</a> gelesen und akzeptiere diese.
                                                            </label>
                                                            <label for="wiederruf<?= $row['id']; ?>_2" class="checkbox noselect">
                                                                <input type="checkbox" name="wiederruf" id="wiederruf<?= $row['id']; ?>_2">
                                                                <span></span>
                                                                Ich wünsche die vollständige Ausführung der Dienstleistung vor Fristablauf des Widerufsrechts gemäß Fernabsatzgesetz. Die automatische Einrichtung und Erbringung der Dienstleistung führt zum Erlöschen des Widerrufsrechts.
                                                            </label>

                                                            <input hidden value="<?= $row['plesk_id']; ?>" name="planName">

                                                            <br>
                                                            <hr>

                                                            <button type="submit" name="order" class="btn btn-outline-success text-uppercase font-weight-bolder px-15 py-3">
                                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
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
                                    function orderNow<?= $row['id']; ?>() {
                                        document.getElementById("orderForm<?= $row['id']; ?>").submit();
                                        const button = document.getElementById('orderBtn<?= $row["id"]; ?>');
                                        button.disabled = true;
                                        button.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i> wird ausgeführt...';
                                    }
                                </script>
				
				<!-- Modal Ende -->


                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;"><?= $row['name']; ?></h1>


		  	                 <?php if($row['price_old'] == 0){ ?>
                            <b><span style="font-size: 28px;"><?= $row['price']; ?>€</span> / 30 Tage</b>

                            <?php } elseif($row['price_old'] !== 0) { ?>
                            <b><span style="font-size: 28px; color:red;"><?= $row['price']; ?>€</span>/ 30 Tage</b>
								<br>
								<h5>Statt <?= $row['price_old']; ?>€</h5>

                            <?php } else { ?>
                                
                            <?php } ?>
							
                        </div>
                        <div class="card-body" align="center">
                            <form method="post">

								<h4>
									<i class="fas fa-hdd" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $row['disc']; ?>GB Speicher<br>
									
									<br>
									
									<i class="fas fa-globe" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $row['domains']; ?> Domains*<br>	
									
									<br>
									
									<i class="fas fa-globe" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $row['subdomains']; ?> Subdomains*<br>	
									
									<br>
									
									<i class="fas fa-database" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $row['databases']; ?> Datenbanken<br>	
									
									<br>
									
									<i class="fas fa-user" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $row['ftp_accounts']; ?> FTP-Konten<br>		
		
									<br>
									
									<i class="fas fa-envelope-open-text" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $row['emails']; ?> E-Mail Konten<br>			

									<br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Fair-Use Traffic<br>	
									
									<br>
									
									<br>
	
									<i class="fas fa-building" style="color:<?= env('MAIN_COLOR'); ?>"></i>								
									Deutschland<br>

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									1.000 MBIT/s Anbindung<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                            <a href="#" data-toggle="modal" data-target="#webspaceModal<?= $row['id']; ?>" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Paket konfigurieren
                                            </a>
                                            <?php } else { ?>
                                            <a href="<?= env('URL'); ?>register" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Account erstellen
                                            </a>
                                            <?php } ?>
                                        </div>

                            </form>
                        </div>
                    </div>
                </div>
			
                <?php } } ?>

            </div>
        </div>
    </div>				
	<center><small>* Dies ist nur die Anzahl an in Plesk hinterlegbaren Domains.</small></center>
</div>

