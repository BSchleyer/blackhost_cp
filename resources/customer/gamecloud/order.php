<?php
$currPage = 'front_Gamecloud bestellen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/gamecloud/order.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: #6254FE;">GAMECLOUD</b> Pakete</h1>
        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
        <div class="alert alert-primary col-md-12" role="alert" align="center">         
        Aktuell verfügt die Gamecloud über folgende Produkte: <b>Minecraft Gameserver, SinusBot Instanzen und Teamspeak Server</b>.
        </div>
            <div class="row">

                <?php
                $SQL = $db->prepare("SELECT * FROM `gamecloud_packs`");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($pack = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

<div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;"><?= $pack['gc_pack_name'] ?></h1>

                            <?php if($pack['special'] == 1){ ?>
                            <div class="alert alert-primary col-md-12" role="alert" align="center">         
                                Dieses Paket ist nur für begrenzte Zeit verfügbar
                            </div>

                            <?php } else { ?>
                                
                            <?php } ?>

                            <!-- -->

		  	                 <?php if($pack['gc_pack_price_old'] == 0){ ?>
                            <b><span style="font-size: 28px;"><?= $pack['gc_pack_price']; ?>€</span> / 30 Tage</b>

                            <?php } elseif($pack['gc_pack_price_old'] !== 0) { ?>
                            <b><span style="font-size: 28px; color:red;"><?= $pack['gc_pack_price']; ?>€</span>/ 30 Tage</b>
								<br>
								<h5>Statt <?= $pack['gc_pack_price_old']; ?>€</h5>

                            <?php } else { ?>
                                
                            <?php } ?>

                        </div>
                        <div class="card-body" align="center">
                            <form method="post">

								<input hidden name="packname" value="<?= $pack['gc_pack_name'] ?>">


                                <?php
                                $cpu = $pack['gc_pack_cpu'] / 100;
                                ?>
                                
                                <?php
                                $ram = $pack['gc_pack_ram'] / 1000;
                                ?>
                                                                <?php
                                $disk = $pack['gc_pack_ssd'] / 1000;
                                ?>


								<h4>
									<i class="fas fa-microchip" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $cpu ?> vKerne (3.5 GHz+)<br>
									
									<br>

									<i class="fas fa-memory" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $ram ?> GB DDR4 RAM<br>
									
									<br>

									<i class="fas fa-hdd" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $disk ?> GB SSD NVME<br>

                                    <br>
									
									<i class="fas fa-database" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $pack['gc_datenbanken'] ?> Datenbank(en)<br>

                                    <br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Traffic<br>

                                    <br>
									
									<i class="fas fa-server" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									maximal <?= $cpu ?> Server<br>
									
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
	<center><small></small></center>
</div>

