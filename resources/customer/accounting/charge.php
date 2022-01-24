<?php
$currPage = 'back_Guthaben aufladen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/payment/init.php';
include BASE_PATH.'app/manager/customer/payment/check_payments.php';

$psc_fees = $helper->getSetting('psc_fees');

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <div class="card shadow mb-5">
                        <div class="card-body">

                            <form method="post">
                                <label for="amount">Betrag <small id="payment_fees"></small></label>


		  	                 <?php if($psc_fees == 0){ ?>

                            <?php } elseif($psc_fees > 0) { ?>

								<div class="alert alert-success" role="alert">
									Aktuell ist ein Aufladebonus von +<?= $psc_fees; ?>% aktiv.
								</div>


                            <?php } else { ?>
                                
                            <?php } ?>

                                <input id="amount" class="form-control" value="1.00" name="amount" onkeyup="update();">

                                <br>

                                <label for="payment_method">Zahlungsmethode</label>
                                <select class="form-control" id="payment_method" name="payment_method" onchange="update();">
                                    <option data-method="paypal" value="paypal">
										PayPal 

												  	                 
										<?php if($psc_fees == 0){ ?>

										(0% Gebühren)
                            
										<?php } elseif($psc_fees > 0) { ?>
										
										(+<?= $psc_fees; ?> Aufladebonus)

										<?php } else { ?>
                                
                            
										<?php } ?>
									</option>
									
                                   <!-- <option data-method="paysafecard" value="paysafecard">paysafecard <?php $psc_fees = $helper->getSetting('psc_fees'); if($psc_fees != 0){ echo '('.$psc_fees.'% Zahlungsgebühren)'; } ?></option>-->
                                </select>

                                <div id="psc_code"></div>

                                <br>
                                <button type="submit" name="startPayment" class="btn btn-outline-primary font-weight-bolder"><i class="fas fa-wallet"></i> Guthaben aufladen</button><br><br>
                                <center>
											<hr>
                                    <font size="2">
                                        <p>
											<b><u>Hinweise:</u></b> 
											<br>
											<br>
											- Zahlungen via PaySafeCard und Kreditkarte müssen aufgrund von Änderungen
											aktuell noch per Support durchgeführt werden.
											<br><br>
											- Das Guthaben lässt sich nicht wieder zurück auf das Konto buchen, eine Erstattung
											eines Kaufbetrages ist somit nur in Form von Guthaben möglich.
                                        </p>
                                    </font>
                                </center>
                            </form>

                            <script>
                                function update() {
                                    var payment_method = $('#payment_method').val();
                                    var amount = $('#amount').val();
                                    if(payment_method == 'paypal'){
                                        var new_amount = (amount / 100 * (100 + <?= $psc_fees; ?>)).toFixed(2);
                                        $('#payment_fees').html('(Du erhältst '+new_amount+'€)');
                                        $('#payment_fees1').html(''+new_amount+'');
                                    } else {
                                        $('#payment_fees').html('(Du erhältst '+amount+'€)');
                                        $('#payment_fees1').html(''+amount+'');
                                    }
                                }
                                update();
                            </script>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow mb-5">
                        <div class="card-body">

                            <table id="dataTableLoad" class="table dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Beschreibung</th>
                                    <th>Betrag</th>
                                    <th>Datum</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $SQL = $db->prepare("SELECT * FROM `transactions` WHERE `user_id` = :user_id AND `state` = :state");
                                $SQL->execute(array(":user_id" => $userid, ":state" => 'success'));
                                if ($SQL->rowCount() != 0) {
                                    while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $row['desc']; ?></td>
                                            <td><?= $row['amount']; ?>€</td>
                                            <td><?= $helper->formatDate($row['created_at']); ?></td>
                                        </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>