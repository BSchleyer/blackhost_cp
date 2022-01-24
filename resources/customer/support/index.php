<?php
$currPage = 'front_Support';
include BASE_PATH.'app/controller/PageController.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">
        <div class="container">
			<br>
			


            <div class="row">

			<div class="alert alert-primary col-md-12" align="center" role="alert">
				Aufgrund mangelnder Besetzung, werden wichtige Abteilungen mit Vorrang bearbeitet.
			</div>

            <!--<div class="alert alert-primary col-md-12" align="center" role="alert">
				<i class="fa fa-exclamation-circle text-warning"></i> Von dem <b>23.12.2021</b> bis zum <b>01.01.2022</b> ist mit verlängertem und eingeschränktem
                Support zu rechnen.
			</div>-->


                <div class="col-md-12">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3 text-center">
								</div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-ticket-alt fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Allgemeine Anfragen 
										<!--<i class="fa fa-check text-success" data-toggle="tooltip" data-original-title="Geöffnet"></i>-->
									</h4>
									
                                    <span class="badge badge-primary">Ticket</span>
                                    <span class="badge badge-success">1-10 Min. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="tickets"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> Zum Ticketsupport</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fab fa-discord fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Allgemeine Anfragen 
									</h4>
									
                                    <span class="badge badge-primary">Discord</span>
                                    <span class="badge badge-success">1-10 Min. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="https://dsc.gg/black-host" target="_blank" class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> Zum Discord</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
								</div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-handshake fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Partnersupport 
										<?php include '_wartezeit.php'; ?>
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-danger">1-3 D. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:partner@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-ban fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Abuse Meldungen 
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-warning">1-24 H. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:abuse@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-shield-alt fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Sicherheit 
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-warning">1-24 H. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:savety@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-book fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Rechtsfragen 
										<?php include '_wartezeit.php'; ?>
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-danger">1-3 D. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:rechtsabteilung@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-wallet fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Buchhaltung 
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-warning">1-24 H. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:buchhaltung@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-lightbulb fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Wünsche/Feedback 
										<?php include '_wartezeit.php'; ?>
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-danger">1-7 D. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:care@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-user-tie fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Managementkontakt
										<?php include '_wartezeit.php'; ?>
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-danger">1-3 D. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:info@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>
								


                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-network-wired fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Netzwerkmeldungen
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-warning">1-24 H. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:netzwerk@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
								</div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-cube fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Bestellungen
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-warning">1-24 H. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:order@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
                                    <br>
                                    <br>
                                    <br>
                                    <i class="fa fa-store-alt fa-5x" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                                    <br>
                                    <br>
									<h4>Verkauf
										<?php include '_wartezeit.php'; ?>
									</h4>
									
                                    <span class="badge badge-primary">E-Mail</span>
                                    <span class="badge badge-danger">1-3 D. Wartezeit</span>
									
                                    <br>
                                    <br>
                                    <a href="mailto:verkauf@black-host.eu"class="btn btn-outline-primary btn-block">
										<b><i class="fas fa-sign-in-alt"></i> E-Mail verfassen</b>
									</a>
                                </div>

                                <div class="col-md-3 text-center">
								</div>

                            </div>
                        </div>
                    </div>
				</div>


                <div class="col-md-12"> <br> </div>


            </div>

        </div>
    </div>
</div>