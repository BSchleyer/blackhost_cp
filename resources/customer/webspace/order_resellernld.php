<?php
$currPage = 'front_Webspace RESELLER Bestellen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/webspace/order_rs.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: #6254FE;">Plesk</b> Reseller-Webserver</h1>
        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

			<?php
                $SQL = $db->prepare("SELECT * FROM `webserver_rs_packs`");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($pack = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

<div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;"><?= $pack['pack_name'] ?></h1>

                            <?php if($pack['special'] == 1){ ?>
                            <div class="alert alert-primary col-md-12" role="alert" align="center">         
                                Dieses Paket ist nur für begrenzte Zeit verfügbar
                            </div>

                            <?php } else { ?>
                                
                            <?php } ?>

                            <!-- -->

		  	                 <?php if($pack['price_old'] == 0){ ?>
                            <b><span style="font-size: 28px;"><?= $pack['price']; ?>€</span> / 30 Tage</b>

                            <?php } elseif($pack['price_old'] !== 0) { ?>
                            <b><span style="font-size: 28px; color:red;"><?= $pack['price']; ?>€</span>/ 30 Tage</b>
								<br>
								<h5>Statt <?= $pack['price_old']; ?>€</h5>

                            <?php } else { ?>
                                
                            <?php } ?>

                        </div>
                        <div class="card-body" align="center">
                            <form method="post">

								<input hidden name="plan_id" value="<?= $pack['gc_pack_name'] ?>">
								<input hidden name="planPrice" value="<?= $pack['price']; ?>">


								<h4>
								<i class="fas fa-hdd" style="color:<?= env('MAIN_COLOR'); ?>"></i>
								<?= $pack['kunden']; ?>GB Speicher<br>
									
									<br>

									<i class="fas fa-user" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $pack['kunden']; ?> erstellbare Kunden<br>
									
									<br>
									
									<i class="fas fa-globe" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Domains*<br>	
									
									<br>
									
									<i class="fas fa-globe" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Subdomains*<br>	
									
									<br>
									
									<i class="fas fa-database" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Datenbanken<br>	
									
									<br>
									
									<i class="fas fa-user" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich FTP-Konten<br>		
		
									<br>
									
									<i class="fas fa-envelope-open-text" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich E-Mail Konten<br>			

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
											
											<?php if ($pack['disabled'] == 0){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>
											<?php } ?>

											<?php if ($pack['disabled'] == 1){ ?>
                                            <button disabled data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-times"></i> Aktuell nicht verfügbar
                                            </button>
											<?php } ?>
											
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
	<center><small>* Dies ist nur die Anzahl an in Plesk hinterlegbaren Domains.
		<br>[!] Die Angebote richten sich ausschließlich an Gewerbetreibende und Gratis-Hoster. Nach der Bestellung werden wir uns mit
		dir in Kontakt setzen, um die Richtigkeit zu prüfen.</small></center>
</div>

