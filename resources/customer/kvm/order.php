<?php
$currPage = 'front_KVM Bestellen';
include BASE_PATH.'app/controller/PageController.php';
    include BASE_PATH.'app/manager/customer/kvm/order.php';

    // rabatt [START]
    $SQL50 = $db->prepare("SELECT * from `produkt_rabatt` WHERE `produkt` = 'kvm'");
    $SQL50->execute();
	while ($rowrabatt = $SQL50 -> fetch(PDO::FETCH_ASSOC)){


$date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$dateTimeNow = $date->format('Y-m-d H:i:s');

	if($rowrabatt['rabatt'] !== "0"){
		
			$mainrabatt = $rowrabatt['rabatt'];
		    $mainrabatt_script = "0.".$rowrabatt['rabatt'];
		    $mainrabatt_ende = $rowrabatt['end_at'];
		
		if($dateTimeNow > $mainrabatt_ende){
		$mainrabatt = 0;	
		}
        


	}
		
	}
    // rabat [ENDE]

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

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


        <div class="text-center" style="margin-top: 1px; margin-bottom: 30px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: <?= env('MAIN_COLOR'); ?>">KVM</b> Server</h1>
        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-9">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-header"><h1><img src="https://cdn.discordapp.com/emojis/876466880464949279.webp?size=96&quality=lossless" width="30"> Niederlande, KVM Server</h1>
						

			        <!--<div class="alert alert-primary col-md-12" role="alert">
				    Achtung: Bitte beachte, ob dein PC bereits problemlos mit IPv6 Netzwerken agieren kann. <u><a href="https://www.wieistmeineip.de/ipv6-test/" target="_blank" style="color:white">Zum Ipv6 Test</a></u>
			        </div>-->

                    <?php if($mainrabatt > 0){ ?>

<div class="alert alert-success col-md-12" role="alert">
    Bestelle innerhalb von <b><span id="countdown"></span></b> und spare <b><?= $mainrabatt; ?>%</b> auf deine Bestellung,
    sowie die Verlängerung
</div>

                    
       <?php } ?>


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
							  </span> bis zu <b>32</b> Intel Xeon vKerne (+3.3 Ghz)
							<br>

							<?php include '_kvminfo.php'; ?>

						
						</div>
                        <div class="card-body">
                            <form method="post" id="orderForm">

                                <i class="fas fa-microchip" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="cores">Kerne</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="cores" name="cores">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '56'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

                                <br>
                                <i class="fas fa-memory" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="memory">Arbeitsspeicher</label></b>
								<span class="badge badge-primary">Derzeitig nur ddr3</span>
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
								<b><label style="font-weight: bold;" for="disk">Festplatte</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="disk" name="disk">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '52'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

                                <br>
                                <i class="fas fa-network-wired" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="ipv4">IPv4 Adressen</label></b>
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <select class="form-control" id="ipv4" name="ipv4">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '55'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>

                                <!--<br>
                                <i class="fas fa-network-wired" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="ipv6">IPv6 Adressen</label></b>-->
								<!--<span class="badge badge-warning">Teils nicht verfügbar</span>-->
                                <!--<select class="form-control" id="ipv6" name="ipv6">
                                    <?php
                                    $SQL = $db->prepare("SELECT * FROM `product_option_entries` WHERE `option_id` = :option_id");
                                    $SQL->execute(array(":option_id" => '51'));
                                    if ($SQL->rowCount() != 0) { while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php include 'option.php'; ?>
                                    <?php } } ?>
                                </select>-->
								
								<input hidden name="codeprice" id="codeprice" value="<?= $codeprice; ?>">

                                <br>
                                <i class="fas fa-copy" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="installos">Image wählen</label></b>
                                <select class="form-control" id="installos" name="installos">
                                     <option data-price="0.00" value="878">Debian 10 (+ 0.00€)</option>
                                     <option data-price="0.00" value="979">Debian 11 (+ 0.00€)</option>

                                     <option data-price="0.00" value="860">Ubuntu 18.10 (+ 0.00€)</option>
                                     <option data-price="0.00" value="889">Ubuntu 19.04 (+ 0.00€)</option>
                                     <option data-price="0.00" value="909">Ubuntu 20.04 (+ 0.00€)</option>

                                     <option data-price="0.00" value="955">Centos 7.8 (+ 0.00€)</option>
                                     <option data-price="0.00" value="895">Centos 8 (+ 0.00€)</option>

                                     <option data-price="0.00" value="929">Suse 15.1 (+ 0.00€)</option>

                                     <option data-price="0.00" value="950">Webuzo Ubuntu 18.04 (+ 0.00€)</option>

                                     <option data-price="0.00" value="972">Almalinux 8.4 (+ 0.00€)</option>

                                     <option data-price="0.00" value="995">Fedora 34 (+ 0.00€)</option>

                                     <option data-price="0.00" value="1000">Rocky 8.4 (+ 0.00€)</option>

                                     <option data-price="0.00" value="800">Scientific 7.4 (+ 0.00€)</option>
                                </select>

                                <br>
                                <i class="fas fa-globe" style="color: <?= env('MAIN_COLOR'); ?>"></i> 
								<b><label style="font-weight: bold;" for="installos">Anbindung wählen</label></b>
                                <select class="form-control" id="anbindung" name="anbindung">
                                     <option data-price="0.00" value="1280000">10 GBITs (shared) (+ 0.00€)</option>
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
                                    <option data-price="0.00" value="0.00">Niederlande (+ 0.00€)</option>
                                </select>

								<input hidden name="mainrabatt_script" id="mainrabatt_script" value="<?= $mainrabatt_script; ?>">

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
                                <input hidden value="1" name="server_id">

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

							<?php if($mainrabatt > 0){ ?>

                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Aktuelle Ersparnis:
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
                                        <span style="color:red;"><?= $mainrabatt ?>%</span>
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
										<s><span data-amount="">0.00</span></s> <span data-amount_rabatt="">0.00</span>
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
							
							<?php
	                         //$order = false;
	                         ?>



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
                            +parseFloat($("#ipv4").find("option:selected").data("price"));
                        var price = Number(sum * $("#duration").find("option:selected").data("factor")).toFixed(2);
						var codeprice = <?php echo json_encode($codeprice); ?>;
						var mainrabatt = <?php echo json_encode($mainrabatt_script); ?>;
						var right = price * mainrabatt;
						var rightnow = price - right;
						var formatet = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(rightnow);
                        $("*[data-amount]").html(price + "€");
                        $("*[data-amount_code]").html(price - codeprice + "€");
                        $("*[data-amount_rabatt]").html(formatet);

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

<script>
    var countDownDate = new Date("<?= $mainrabatt_ende; ?>").getTime();
    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(days == 1){ var days_text = ' Tag' } else { var days_text = ' Tage'; }
        if(hours == 1){ var hours_text = ' Stunde' } else { var hours_text = ' Stunden'; }
        if(minutes == 1){ var minutes_text = ' Minute' } else { var minutes_text = ' Minuten'; }
        if(seconds == 1){ var seconds_text = ' Sekunde' } else { var seconds_text = ' Sekunden'; }

        if(days == 0 && !(hours == 0 && minutes == 0 && seconds == 0)){
            $('#countdown<?= $row["id"]; ?>').html(hours+hours_text+', '+  minutes+minutes_text+' und ' +  seconds+seconds_text);
            if(days == 0 && hours == 0 && !(minutes == 0 && seconds == 0)){
                $('#countdown<?= $row["id"]; ?>').html(minutes+minutes_text+' und '+  seconds+seconds_text);
                if(days == 0 && hours == 0 && minutes == 0 && !(seconds == 0)){
                    $('#countdown<?= $row["id"]; ?>').html(seconds+seconds_text);
                }
            }
        } else {
            $('#countdown').html(days+days_text+', '+  hours+hours_text+', '+  minutes+minutes_text+' und '+  seconds+seconds_text);
        }

        if (distance <= 0) {
            clearInterval(x);
        }
    }, 1000);
</script>