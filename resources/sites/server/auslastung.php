<?php
$currPage = 'front_Server Auslastung';
include BASE_PATH.'app/controller/PageController.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body" style="text-align: center;">
                            <h3 class="mb-0">

                                vweb01.black-host.eu
                                <br>
                                <hr>
                            </h3>


                            <span style="font-size: 100%;">
<iframe src="https://vweb01.black-host.eu/modules/grafana/service/d-solo/monitoring__hdd/monitoring-datentrager?kiosk=tv&theme=dark&orgId=1&refresh=2m&from=1637780447555&to=1637866847555&panelId=1" width="450" height="200" frameborder="0"></iframe>
								
								<br>
								Hier zu sehen ist die Speicherauslastung dieses Servers

                            </span>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>