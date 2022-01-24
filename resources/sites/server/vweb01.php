<?php
$currPage = 'front_vweb01';
include BASE_PATH.'app/controller/PageController.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                            
	<h3 class="mb-0" align="center">             				
		vweb01.black-host.eu
		<br><br><br>
	</h3>

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row justify-content-center">


                <div class="col-md-6">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body" style="text-align: center;">

<iframe src="https://vweb01.black-host.eu/modules/grafana/service/d-solo/monitoring__hdd/monitoring-datentrager?kiosk=tv&theme=dark&orgId=1&refresh=2m&from=1637787465015&to=1637873865015&panelId=1" width="550" height="250" frameborder="0"></iframe>
								
								<br>
								Hier wird die Festplatten (01) des Servers angezeigt



                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card" style="border-radius: 15px 10px;">
                        <div class="card-body" style="text-align: center;">

<iframe src="https://vweb01.black-host.eu/modules/grafana/service/d-solo/monitoring__ram/monitoring-speicher?orgId=1&refresh=2m&from=1637786998797&to=1637873398797&panelId=1" width="550" height="250" frameborder="0"></iframe>
								
								<br>
								Hier wird der Ram des Servers angezeigt



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>