<?php
$currPage = 'front_KVM Pakete bestellen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/kvm/order_pakete.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

							<?php
					$order = true;
                                    $SQL1 = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id AND `disabled` = '0'");
                                    $SQL1->execute(array(":option_id" => '56'));

                                    $SQL2 = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id AND `disabled` = '0'");
                                    $SQL2->execute(array(":option_id" => '1'));

                                    $SQL3 = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id AND `disabled` = '0'");
                                    $SQL3->execute(array(":option_id" => '52'));

                                    $SQL4 = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id AND `disabled` = '0'");
                                    $SQL4->execute(array(":option_id" => '55'));
	
	                         ?>

			        <?php if($SQL1->rowCount() == 0){ ?>
					<?php
					$order = false;
					?>
                    <?php } ?>

			        <?php if($SQL2->rowCount() == 0){ ?>
					<?php
					$order = false;
					?>
                    <?php } ?>

			        <?php if($SQL3->rowCount() == 0){ ?>
					<?php
					$order = false;
					?>
                    <?php } ?>

			        <?php if($SQL4->rowCount() == 0){ ?>
					<?php
					$order = false;
					?>
                    <?php } ?>

        <div class="text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: #6254FE;">KVM</b> Pakete</h1>
        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
				        <?php if($order == false){ ?>
			        <div class="alert alert-primary col-md-12" role="alert" align="center">
				        Sehr geehrter Kunde, leider ist die Bestellung, dieses Produktes, nicht möglich, da die verfügbaren 
						Hostsysteme nicht über genug Leistung verfügung. Unser Team ist bereits informiert und wir arbeiten an einer Lösung.
			        </div>
                    <?php } ?>

            <div class="row">

                <?php
                $SQL = $db->prepare("SELECT * FROM `kvm_packs`");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($pack = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

<div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;"><?= $pack['pack_name'] ?></h1>

							<?php if($order == false){ ?>
			       		    <div class="alert alert-primary col-md-12" role="alert">
				       		  Dieses Paket ist ausverkauft.
			       		    </div>
                    		<?php } ?>
							
                            <?php if($pack['special'] == 1){ ?>
                            <div class="alert alert-primary col-md-12" role="alert" align="center">         
                                Dieses Paket ist nur für begrenzte Zeit verfügbar
                            </div>

                            <?php } else { ?>
                                
                            <?php } ?>

                            <!-- -->

		  	                 <?php if($pack['pack_price_old'] == 0){ ?>
                            <b><span style="font-size: 28px;"><?= $pack['pack_price']; ?>€</span> / 30 Tage</b>

                            <?php } elseif($pack['gc_pack_price_old'] !== 0) { ?>
                            <b><span style="font-size: 28px; color:red;"><?= $pack['pack_price']; ?>€</span>/ 30 Tage</b>
								<br>
								<h5>Statt <?= $pack['pack_price_old']; ?>€</h5>

                            <?php } else { ?>
                                
                            <?php } ?>

                        </div>
                        <div class="card-body" align="center">
                            <form method="post">

								<input hidden name="packname" value="<?= $pack['pack_name'] ?>">


                                <?php
                                $cpu = $pack['pack_cpu'];
                                ?>
                                
                                <?php
                                $ram = $pack['pack_ram'] / 1000;
                                ?>
                                                                <?php
                                $disk = $pack['pack_ssd'];
                                ?>


								<h4>
									<i class="fas fa-microchip" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $cpu ?> vKerne (3.3 GHz+)<br>
									
									<br>

									<i class="fas fa-memory" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $ram ?> GB DDR3 RAM<br>
									
									<br>

									<i class="fas fa-hdd" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $disk ?> GB SSD NVME<br>

                                    <br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Traffic<br>
									
									<br>
<select class="form-control" id="installos" name="installos">
                                     <option data-price="0.00" value="878" align="center">Debian 10 (+ 0.00€)</option>
                                     <option data-price="0.00" value="979" align="center">Debian 11 (+ 0.00€)</option>

                                     <option data-price="0.00" value="860" align="center">Ubuntu 18.10 (+ 0.00€)</option>
                                     <option data-price="0.00" value="889" align="center">Ubuntu 19.04 (+ 0.00€)</option>
                                     <option data-price="0.00" value="909" align="center">Ubuntu 20.04 (+ 0.00€)</option>

                                     <option data-price="0.00" value="955" align="center">Centos 7.8 (+ 0.00€)</option>
                                     <option data-price="0.00" value="895" align="center">Centos 8 (+ 0.00€)</option>

                                     <option data-price="0.00" value="929" align="center">Suse 15.1 (+ 0.00€)</option>

                                     <option data-price="0.00" value="950" align="center">Webuzo Ubuntu 18.04 (+ 0.00€)</option>

                                     <option data-price="0.00" value="972" align="center">Almalinux 8.4 (+ 0.00€)</option>

                                     <option data-price="0.00" value="995" align="center">Fedora 34 (+ 0.00€)</option>

                                     <option data-price="0.00" value="1000" align="center">Rocky 8.4 (+ 0.00€)</option>

                                     <option data-price="0.00" value="800" align="center">Scientific 7.4 (+ 0.00€)</option>
                                </select>
									<br>
									
									<br>
	
									<i class="fas fa-building" style="color:<?= env('MAIN_COLOR'); ?>"></i>								
									Niederlande <img src="https://cdn.discordapp.com/emojis/876466880464949279.webp?size=96&quality=lossless" width="20"><br>

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									10.000 MBIT/s Shared<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
											
											<?php if ($pack['disabled'] == 0){ ?>

							<?php if($order == true){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>
                    		<?php } ?>

							<?php if($order == false){ ?>
                                            <button disabled data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-times"></i> Aktuell nicht verfügbar
                                            </button>
                    		<?php } ?>

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

