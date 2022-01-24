    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-9">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-header"><h1>Deutschland, Gameserver</h1>
					

			        <?php if($order == false){ ?>
			        <div class="alert alert-primary col-md-12" role="alert">
				        Sehr geehrter Kunde, leider ist die Bestellung über den Konfigurator nicht möglich, da die verfügbaren 
						Hostsysteme nicht über genug Leistung verfügung. Unser Team ist bereits informiert und wir arbeiten an einer Lösung.
			        </div>
                    <?php } ?>

						<hr>

							<h5>Max. Konfiguration</h5>
							
							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-microchip" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> bis zu <b>32</b> Intel Xeon vKerne (Max. 3,50 Ghz)
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-memory" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> bis zu <b>64</b> GB DDR4 ECC RAM
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-hdd" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> bis zu <b>100</b> GB HDD Speicher
							<br>

							<br>
							<h5>Host-Informationen</h5>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-desktop" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> Basierend auf Pterodactyl
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-building" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> Standort: Deutschland <span class="badge badge-success">NEU</span>
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-tachometer-alt" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> Unendlich Traffic basierend auf 1.000 MBIT/s
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-shield-alt" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> Black-Host DDoS-Schutz + DDoS-Filter 
							<i class=" fa fa-question-circle" style="color: <?= env('MAIN_COLOR'); ?>" data-toggle="tooltip" title="" 
							   data-original-title="Wir bieten einen eigenen DDoS-Schutz inkl. Filter mit bis zu
													800 GBIT/s Schutz."></i>
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-stopwatch" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> Einrichtung in unter 10 Sekunden
							<br>

						
						</div>
                        <div class="card-body">
                            <form method="post" id="orderForm">

                                <i class="fas fa-microchip" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="cores">Kerne</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="cores" name="cores">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '20'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

                                <br>
                                <i class="fas fa-memory" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="memory">Arbeitsspeicher</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="memory" name="memory">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '21'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

                                <br>
                                <i class="fas fa-hdd" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="disk">Festplatte</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="disk" name="disk">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '22'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

                                <br>
                                <i class="fas fa-file" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="backups">Externe Backups</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="disk" name="backups">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '23'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

								<input hidden name="codeprice" id="codeprice" value="<?= $codeprice; ?>">

                                <br>
                                <i class="fas fa-shield-alt" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;">DDoS Protection</label></b>
                                <select class="form-control" name="ddos-protection">
                                    <option data-price="0.00" value="0.00">Permanent (+ 0.00€)</option>
                                </select>

                                <br>
                                <i class="fas fa-building" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;">Standort wählen</label></b>
                                <select class="form-control" name="ddos-protection">
                                    <option data-price="0.00" value="0.00">Deutschland / Colo (+ 0.00€)</option>
                                </select>

                                <br>
                                <div class="form-group" hidden>
                                    <i class="fas fa-history" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
									<b><label style="font-weight: bold;" for="interval">Laufzeit</label></b>
                                    <select class="form-control" id="duration" name="duration">
                                        <option value="30" data-factor="1">30 Tage</option>
                                        <option value="60" data-factor="2">60 Tage</option>
                                        <option value="90" data-factor="3">90 Tage</option>
                                        <option value="180" data-factor="6">180 Tage</option>
                                    </select>
                                </div>

                                <input hidden value="" name="order">
                                <input hidden value="2" name="server_id">

                                <label for="agb" class="checkbox noselect">
                                    <input type="checkbox" name="agb" id="agb">
                                    <span></span>
                                    Ich habe die <a href="<?= $helper->url(); ?>agb">AGB</a> und <a href="<?= $helper->url(); ?>datenschutz">Datenschutzerklärung</a> gelesen und akzeptiere diese.
                                </label>
                                <br>
                                <br>
                                <label for="wiederruf" class="checkbox noselect">
                                    <input type="checkbox" name="wiederruf" id="wiederruf">
                                    <span></span>
                                    Ich wünsche die vollständige Ausführung der Dienstleistung vor Fristablauf des Widerufsrechts gemäß Fernabsatzgesetz. Die automatische Einrichtung und Erbringung der Dienstleistung führt zum Erlöschen des Widerrufsrechts.
                                </label>


                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-header text-center">
                            <h3 style="margin-bottom: 0px;">Kostenübersicht</h3>
                        </div>
                        <div class="card-body">
							
                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Laufzeit
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
                                        <span id="duration_val"></span> Tage
                                    </a>
                                </div>
                            </div>

							<?php if($codeprice == 0){ ?>

                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Monatlicher Betrag:
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
										<span data-amount="">0.00</span>
                                    </a>
                                </div>
                            </div>

                           <?php } ?>
						
							
							<?php if($codeprice > 0){ ?>

                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Rabattcode Ersparnis:
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
                                        <span style="color:red;">-<?= $codeprice ?></span>
                                    </a>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Monatlicher Betrag:
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
										<s><span data-amount="">0.00</span></s> <span data-amount_code="">0.00</span>
                                    </a>
                                </div>
                            </div>

										
                           <?php } ?>
							
                            <br>
                            <hr>

				
							<div class="row align-items-center">
								<div class="col">
									<div class="text-center">	
										<h4 style="margin-bottom: 0px;">Gutschein Einlösen</h4>
									</div>
									<br>
									<form method="post">
										<input class="form-control" name="code" rows="1">										
										<br>
										<button type="submit" name="useCode" class="btn btn-outline-primary btn-block">
											<b><i class="fas fa-terminal"></i> Gutschein einlösen</b>
										</button>
									</form>
									<br>
								</div>
							</div>
							
							<hr>
						    <br>

                            <br>
                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>



			        <?php if($order == true){ ?>
                            <a onclick="orderNow();" id="orderBtn" class="btn btn-block btn-outline-primary mb-4 pulse-red">
                                <i class="fas fa-shopping-cart"></i> <b>Kostenpflichtig bestellen</b>
                            </a>
                    <?php } ?>

			        <?php if($order == false){ ?>
                            <button disabled id="orderBtn" class="btn btn-block btn-outline-primary mb-4 pulse-red">
                                <i class="fas fa-times"></i> <b>Zurzeit Ausverkauft</b>
                            </button>
                    <?php } ?>

							<center>
							<small>Automatisierte Bereitstellung binnen 10 Sekunden</small>
							</center>
                            <?php } else { ?>
                                <a href="<?= env('URL'); ?>" class="btn btn-block btn-outline-primary mb-4 pulse-red">
                                    <b>Account erstellen</b>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <script>

                    function orderNow() {
                        document.getElementById("orderForm").submit();
                        const button = document.getElementById('orderBtn');
                        button.disabled = true;
                        button.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i> Installation erfolgt ...';
                    }

                    $("select, textarea").change(function() { update(); } ).trigger("change");

                    function update()
                    {
                        sum = parseFloat($("#cores").find("option:selected").data("price"))
                            +parseFloat($("#memory").find("option:selected").data("price"))
                            +parseFloat($("#disk").find("option:selected").data("price"));
                        var price = Number(sum * $("#duration").find("option:selected").data("factor")).toFixed(2);
						var codeprice = <?php echo json_encode($codeprice); ?>;
                        $("*[data-amount]").html(price + "€");
                        $("*[data-amount_code]").html(price - codeprice + "€");

                        var duration = $("#duration").find("option:selected").val();
                        $('#duration_val').html(duration);
                    }

                    $(document).ready(function(){
                        update();
                    });
                </script>

            </div>
        </div>
    </div>