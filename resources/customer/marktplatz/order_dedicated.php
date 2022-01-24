<?php
$currPage = 'front_Dedicated Server bestellen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/marktplatz/order.php';

$setup = "20";
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: #6254FE;">Dedizierten</b> Server</h1>

        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">


			<div class="alert alert-primary col-md-12" align="center" role="alert">
				Bis zum 10.02.2022 berechnen wir <b>keine Einrichtungsgebühr</b>, auf die Bestellung von dedizierten Servern.
			</div>


            <div class="row">

											

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;">D-IX-32 #1</h1>
                            <b><span style="font-size: 28px;">40.00€</span> / 30 Tage <br>31 Tage Kündigungsfrist</b>
                        </div>
                        <div class="card-body" align="center">
                            <form method="post">
								
								<input hidden name="plan_id" value="D-IX-32 #1">
								<input hidden name="planPrice" value="40">
								<!--<input hidden name="planPriceSetup" value="<?= $setup; ?>">-->

								<h4>

									<i class="fas fa-microchip" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									1x Intel Xeon E3-1246 v3<br>
									
									<br>

									<i class="fas fa-memory" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									32 GB DDR3 RAM<br>
									
									<br>

									<select class="form-control" id="disk" name="disk">
										
										<option data-price="0.00" value="4 TB HDD" align="center">

											4 TB HDD (+ 0.00€) 							
										</option>                                    					                                      

									</select>
									
									<br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Traffic<br>	
									
									<br>
									
									<br>
	
									<i class="fas fa-sign-language" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									24/7 On-Hand Service<br>

									<br>
	
									<i class="fas fa-building" style="color:<?= env('MAIN_COLOR'); ?>"></i>								
									Deutschland (DC-1)<br>

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									1x 1.000 MBIT/s Anbindung<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

								<h6 style="color:orange;">Weniger als 10 Verfügbar</h6>

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
								<small><s>* inkl. <?= $setup; ?>.00€ Einrichtungsgebühr</s></small>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;">D-IC-64 #1</h1>
                            <b><span style="font-size: 28px;">45.00€</span> / 30 Tage <br>31 Tage Kündigungsfrist</b>
                        </div>
                        <div class="card-body" align="center">
                            <form method="post">
								
								<input hidden name="plan_id" value="D-IC-64 #1">
								<input hidden name="planPrice" value="45">
								<!--<input hidden name="planPriceSetup" value="<?= $setup; ?>">-->

								<h4>

									<i class="fas fa-microchip" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									1x Intel Core i7-3930<br>
									
									<br>

									<i class="fas fa-memory" style="color:<?= env('MAIN_COLOR'); ?>"></i>
								    64 GB DDR3 RAM<br>
									
									<br>

									<select class="form-control" id="disk" name="disk">
										
										<option data-price="0.00" value="4 TB HDD" align="center">

											4 TB HDD (+ 0.00€) 							
										</option>        

										<option data-price="0.00" value="1 TB SSD SATA" align="center">

											1 TB SSD SATA (+ 0.00€) 							
										</option>                              					                                      

									</select>

									
									<br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Traffic<br>	
									
									<br>
									
									<br>
	
									<i class="fas fa-sign-language" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									24/7 On-Hand Service<br>

									<br>
	
									<i class="fas fa-building" style="color:<?= env('MAIN_COLOR'); ?>"></i>								
									Deutschland (DC-1)<br>

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									1x 1.000 MBIT/s Anbindung<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

								<h6 style="color:orange;">Weniger als 10 Verfügbar</h6>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>
                                            <?php } else { ?>
                                            <a href="<?= env('URL'); ?>register" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Account erstellen
                                            </a>
                                            <?php } ?>
                                        </div>
								<small><s>* inkl. <?= $setup; ?>.00€ Einrichtungsgebühr</s></small>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;">D-IX-128 #1</h1>
							<div class="alert alert-primary col-md-12" align="center" role="alert">
								Wird mit <b>3 Ipv4 Adressen</b> geliefert.
							</div>
                            <b><span style="font-size: 28px;">150.00€</span> / 30 Tage <br>31 Tage Kündigungsfrist</b>
                        </div>
                        <div class="card-body" align="center">
                            <form method="post">
								
								<input hidden name="plan_id" value="D-IX-128 #1">
								<input hidden name="planPrice" value="150">
								<!--<input hidden name="planPriceSetup" value="<?= $setup; ?>">-->

								<h4>

									<i class="fas fa-microchip" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									1x Intel Xeon W 2145<br>
									
									<br>

									<i class="fas fa-memory" style="color:<?= env('MAIN_COLOR'); ?>"></i>
								    128 GB DDR4 ECC RAM<br>
									
									<br>

									<select class="form-control" id="disk" name="disk">
										
										<option data-price="0.00" value="4 TB HDD" align="center">

											4 TB HDD (+ 0.00€) 							
										</option>        

										<option data-price="0.00" value="1.8 TB SSD SATA" align="center">

											1.8 TB SSD SATA (+ 0.00€) 							
										</option>                              					                                      

									</select>

									
									<br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Traffic<br>	
									
									<br>
									
									<br>
	
									<i class="fas fa-sign-language" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									24/7 On-Hand Service<br>

									<br>
	
									<i class="fas fa-building" style="color:<?= env('MAIN_COLOR'); ?>"></i>								
									Deutschland (DC-1)<br>

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									1x 1.000 MBIT/s Anbindung<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

								<h6 style="color:green;">Mehr als 10 Verfügbar</h6>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>
                                            <?php } else { ?>
                                            <a href="<?= env('URL'); ?>register" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Account erstellen
                                            </a>
                                            <?php } ?>
                                        </div>
								<small><s>* inkl. <?= $setup; ?>.00€ Einrichtungsgebühr</s></small>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;">D-IX-256 #1</h1>
							<div class="alert alert-primary col-md-12" align="center" role="alert">
								Wird mit <b>3 Ipv4 Adressen</b> geliefert.
							</div>
                            <b><span style="font-size: 28px;">250.00€</span> / 30 Tage <br>31 Tage Kündigungsfrist</b>
                        </div>
                        <div class="card-body" align="center">
                            <form method="post">
								
								<input hidden name="plan_id" value="D-IX-256 #1">
								<input hidden name="planPrice" value="250">
								<!--<input hidden name="planPriceSetup" value="<?= $setup; ?>">-->

								<h4>

									<i class="fas fa-microchip" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									1x Intel Xeon W 2145<br>
									
									<br>

									<i class="fas fa-memory" style="color:<?= env('MAIN_COLOR'); ?>"></i>
								    256 GB DDR4 ECC RAM<br>
									
									<br>

									<select class="form-control" id="disk" name="disk">
										
										<option data-price="0.00" value="6 TB HDD" align="center">

											6 TB HDD (+ 0.00€) 							
										</option>        

										<option data-price="0.00" value="1.8 TB SSD SATA" align="center">

											1.8 TB SSD SATA (+ 0.00€) 							
										</option>                              					                                      

									</select>

									
									<br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Unendlich Traffic<br>	
									
									<br>
									
									<br>
	
									<i class="fas fa-sign-language" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									24/7 On-Hand Service<br>

									<br>
	
									<i class="fas fa-building" style="color:<?= env('MAIN_COLOR'); ?>"></i>								
									Deutschland (DC-1)<br>

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									1x 1.000 MBIT/s Anbindung<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

								<h6 style="color:green;">Mehr als 10 Verfügbar</h6>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>
                                            <?php } else { ?>
                                            <a href="<?= env('URL'); ?>register" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Account erstellen
                                            </a>
                                            <?php } ?>
                                        </div>
								<small><s>* inkl. <?= $setup; ?>.00€ Einrichtungsgebühr</s></small>

                            </form>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>				
	<center><small>
		- Die Einrichtungsgebühr wird nach dem Kauf von dem Guthaben abgezogen, sollte das Konto nicht gedeckt sein, wird der Kauf storniert.
		<br>
		-Die Bereitstellung erfolgt binnen 48h.
		</small></center>
</div>

