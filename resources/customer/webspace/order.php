<?php
$currPage = 'front_Webserver wählen';
include BASE_PATH.'app/controller/PageController.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row justify-content-center">

                <!--<div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body" style="text-align: center;">
                            <h3 class="mb-0">

								<img src="https://icon-library.com/images/settings-icon-android/settings-icon-android-5.jpg" width="100">


                                <br><br>
                                Konfigurieren

                                <br>
                                <hr>
                            </h3>
                            <span style="font-size: 110%;">
                                Stelle dir dein Wunschpaket zusammen, ohne Forschriften.

                                <br>
                                <br>

                                <a href="<?= $helper->url(); ?>order/webspace/custom" class="btn btn-block btn-outline-primary mb-4 disabled">
                                    <i class="fas fa-share-square"></i> <b>Zu dem Konfigurator</b>
                                </a>

                            </span>
                        </div>
                    </div>
                </div>-->

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body" style="text-align: center;">
                            <h3 class="mb-0">
								<img src="https://data.black-host.eu/share/webserver_de_normal.png" width="100">

                                <br><br>
                                Pakete (DE)
                                <br>
                                <hr>
                            </h3>
                            <span style="font-size: 110%;">
                                Wähle ein Webserver-Paket in Deutschland aus.

                                <br>
                                <br>

                                <a href="<?= $helper->url(); ?>order/webspace/de" class="btn btn-block btn-outline-primary mb-4">
                                    <i class="fas fa-share-square"></i> <b>Zu den Paketen</b>
                                </a>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body" style="text-align: center;">
                            <h3 class="mb-0">
								<img src="https://data.black-host.eu/share/webserver_de_normal.png" width="100">

                                <br><br>
                                 JahresPakete (DE)
                                <br>
                                <hr>
                            </h3>
                            <span style="font-size: 110%;">
                                Wähle ein Webserver-Paket in Deutschland aus.

                                <br>
                                <br>

                                <a href="<?= $helper->url(); ?>order/webspace/de/jahr" class="btn btn-block btn-outline-primary mb-4">
                                    <i class="fas fa-share-square"></i> <b>Zu den Paketen</b>
                                </a>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body" style="text-align: center;">
                            <h3 class="mb-0">
								<img src="https://data.black-host.eu/share/webserver_de_reseller.png" width="100">

                                <br><br>
                                Reseller (DE)
                                <br>
                                <hr>
                            </h3>
                            <span style="font-size: 110%;">
                                Wähle dein Reseller Webserver-Paket in Deutschland aus.

                                <br>
                                <br>

                                <a href="<?= $helper->url(); ?>order/webspace/reseller/de" class="btn btn-block btn-outline-primary mb-4">
                                    <i class="fas fa-share-square"></i> <b>Zu den Paketen</b>
                                </a>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body" style="text-align: center;">
                            <h3 class="mb-0">
								<img src="https://data.black-host.eu/share/webserver_de_normal.png" width="100">

                                <br><br>
                                Angebote (DE)
                                <br>
                                <hr>
                            </h3>
                            <span style="font-size: 110%;">
                                Hier sind limitierte Webserver Angebote zu sehen (limitert)

                                <br>
                                <br>

                                <a href="<?= $helper->url(); ?>order/webspace/de/angebote" class="btn btn-block btn-outline-primary mb-4">
                                    <i class="fas fa-share-square"></i> <b>Zu den Paketen</b>
                                </a>

                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>