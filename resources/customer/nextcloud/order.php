<?php
$currPage = 'front_Nextcloud wählen';
include BASE_PATH.'app/controller/PageController.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-body" style="text-align: center;">
                            <h3 class="mb-0">
								<img src="https://data.black-host.eu/share/cloudserver_de_konfig.png" width="100">

                                <br><br>
                                Pakete (DE)
                                <br>
                                <hr>
                            </h3>
                            <span style="font-size: 110%;">
                                Wähle dein Cloud-Paket, lokalisiert in Deutschland, aus.

                                <br>
                                <br>

                                <a href="<?= $helper->url(); ?>order/nextcloud/pakete" class="btn btn-block btn-outline-primary mb-4">
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
								<img src="https://data.black-host.eu/share/cloudserver_de_normal.png" width="108">

                                <br><br>
                                Konfigurator (DE)
                                <br>
                                <hr>
                            </h3>
                            <span style="font-size: 110%;">
                                Stelle deine eigene Cloud, in Deutschland, zusammen.

                                <br>
                                <br>

                                <a href="<?= $helper->url(); ?>order/nextcloud/konf" class="btn btn-block btn-outline-primary mb-4">
                                    <i class="fas fa-share-square"></i> <b>Zu dem Konfigurator</b>
                                </a>

                            </span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>