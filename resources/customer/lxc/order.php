<?php
$currPage = 'front_LXC Bestellen';
include BASE_PATH.'app/controller/PageController.php';
    include BASE_PATH.'app/manager/customer/lxc/order.php';

if(isset($_POST['useCode'])){
	$codeerror = false;

    // gucken ob code noch nutzbar ist
    $SQL4 = $db->prepare("SELECT * from `kvm_codes` WHERE `code` = :code");
    $code = $_POST['code'];
    $SQL4->execute(array(":code" => $code));
	while ($rowhow = $SQL4 -> fetch(PDO::FETCH_ASSOC)){

	if($rowhow['useable'] == "0"){
		
			$codeerror = true;
		    echo sendError('Der Code wurde bereits zu oft verwendet.');

	}
		
	}
    // gucken ob code noch nutzbar ist [ENDE]

    $SQL = $db->prepare("SELECT * from `kvm_codes` WHERE `code` = :code");
    $code = $_POST['code'];
    $SQL->execute(array(":code" => $code));
	while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

	if($codeerror == false){
	$codeprice = $row['amount'];
	}

		
		// error check
	if($codeerror == false){

		// Code gefunden

	if($row['code'] == $code){

    
		$SQL3 = $db->prepare("UPDATE `kvm_codes` SET `useable` = :newcode WHERE `id` = :codeid");
        $codeid = $row['id'];
		$newcode = $row['useable'] -1;
		$SQL3->execute(array(":codeid" => $codeid, ":newcode" => $newcode));

		echo sendSuccess('Der Code wird auf der nächsten Bestellung angewendet.');

	}
	


	} // error check
	
} // select * from code

	if($SQL->rowCount() == 0){

		    echo sendError('Der Code wurde nicht gefunden');

	}

} // gutschein POST ende

?>

							<?php
					$order = true;
                                    $SQL1 = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id AND `disabled` = '0'");
                                    $SQL1->execute(array(":option_id" => '1'));

                                    $SQL2 = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id AND `disabled` = '0'");
                                    $SQL2->execute(array(":option_id" => '2'));

                                    $SQL3 = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id AND `disabled` = '0'");
                                    $SQL3->execute(array(":option_id" => '3'));

                                    $SQL4 = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id AND `disabled` = '0'");
                                    $SQL4->execute(array(":option_id" => '4'));
	
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

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


        <div class="text-center" style="margin-top: 1px; margin-bottom: 30px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: <?= env('MAIN_COLOR'); ?>">INTEL LXC</b> Server</h1>
        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-9">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-header"><h1>Niederlande, LXC Server</h1>
						

			        <div class="alert alert-primary col-md-12" role="alert">
				    Zurzeit ist, aufgrund der erhöhten Nachfrage, keine Lieferzeit innerhalb der gewohnten Zeit möglich. Wir
					bitten um euer Verständnis.
			        </div>
					

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
							  </span> bis zu <b>16</b> Intel Xeon vKerne (Max. 3,40 Ghz)
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-memory" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> bis zu <b>64</b> GB DDR4 ECC RAM
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-hdd" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> bis zu <b>200</b> GB SSD
							<br>
							
							<br>
							<h5>Host-Informationen</h5>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-desktop" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> Basierend auf LXC Virtualizor
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-building" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> Standort: Niederlande
							<br>

							<span class="svg-icon svg-icon-primary svg-icon-1x">
							<i class="fa fa-tachometer-alt" style="color: <?= env('MAIN_COLOR'); ?>"></i>
							  </span> Unendlich Traffic basierend auf 10.000 MBIT/s(/Shared)
							<i class=" fa fa-question-circle" style="color: <?= env('MAIN_COLOR'); ?>" data-toggle="tooltip" title="" 
							   data-original-title="Wir garantieren keine vollen 10 G Anbindung, da diese mit anderen
													Kunden geteilt wird."></i>
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
                                    $SQL->execute(array(":option_id" => '2'));
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
                                    $SQL->execute(array(":option_id" => '1'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

                                <br>
                                <i class="fas fa-hdd" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="disk">Festplatte (Aktuell keine NVMe)</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="disk" name="disk">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '3'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

                                <br>
                                <i class="fas fa-network-wired" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="addresses">IP-Adressen</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="addresses" name="addresses">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '4'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>
								<input hidden name="codeprice" id="codeprice" value="<?= $codeprice; ?>">

                                <br>
                                <i class="fab fa-linux" style="color: <?= env('MAIN_COLOR'); ?>"></i> <b><label style="font-weight: bold;" for="serverOS">Betriebssystem</label></b>
                                <select class="form-control" id="serverOS" name="serverOS">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `vm_server_os` WHERE `type` = 'LXC'");
                                    $SQL->execute();
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                    <?php } } ?>
                                </select>

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
                                    <option data-price="0.00" value="0.00">SkyLink / Colo (+ 0.00€)</option>
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
                            +parseFloat($("#disk").find("option:selected").data("price"))
                            +parseFloat($("#addresses").find("option:selected").data("price"));
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
</div>