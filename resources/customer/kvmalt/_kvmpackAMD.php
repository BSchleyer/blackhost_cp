                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;"><?= $pack['kvm_pack_name'] ?></h1>

		  	                 <?php if($pack['kvm_pack_price_old'] == 0){ ?>
                            <b><span style="font-size: 28px;"><?= $pack['kvm_pack_price']; ?>€</span> / 30 Tage</b>

                            <?php } elseif($pack['kvm_pack_price_old'] !== 0) { ?>
                            <b><span style="font-size: 28px; color:red;"><?= $pack['kvm_pack_price']; ?>€</span>/ 30 Tage</b>
								<br>
								<h5>Statt <?= $pack['kvm_pack_price_old']; ?>€</h5>

                            <?php } else { ?>
                                
                            <?php } ?>

                        </div>
                        <div class="card-body" align="center">
                            <form method="post">

								<input hidden name="packname" value="<?= $pack['kvm_pack_name'] ?>">


								<h4>
									<i class="fas fa-microchip" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $pack['kvm_pack_cpu'] ?> AMD RYZEN (4.5 GHz+)<br>
									
									<br>

									<i class="fas fa-memory" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $pack['kvm_pack_ram'] ?> MB DDR4 ECC RAM<br>
									
									<br>

									<i class="fas fa-hdd" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $pack['kvm_pack_ssd'] ?> GB SSD NVME<br>
									
									<br>

									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $pack['kvm_pack_ips'] ?>x IPv4 enthalten<br>
									
									<br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Traffic<br>	
									
									<br>
									
									<br>
	
									<i class="fas fa-building" style="color:<?= env('MAIN_COLOR'); ?>"></i>								
									Niederlande (SkyLink)<br>

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									5.000 MBIT/s Anbindung<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
											
											<?php if ($pack['disabled'] == 0){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen
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