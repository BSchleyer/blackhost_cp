<?php
$currPage = 'front_Marktplatz';
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
								<img src="https://data.black-host.eu/share/dedicated_de.png" width="100">

                                <br><br>
                                Server (Dediziert)
                                <br>
                                <hr>
                            </h3>
                            <span style="font-size: 110%;">
                                Unsere Dedizierten Server Angebote in dem Standort Deutschland.

                                <br>
                                <br>

                                <a href="<?= $helper->url(); ?>order/marktplatz/dedicated" class="btn btn-block btn-outline-primary mb-4">
                                    <i class="fas fa-share-square"></i> <b>Zu den Angeboten</b>
                                </a>

                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>