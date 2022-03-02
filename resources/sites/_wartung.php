<?php
$currPage = 'front_Wartung';
include BASE_PATH.'app/controller/PageController.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


    <div class="d-flex flex-column-fluid">



		<div class="container">
            <div class="row">       

				<div class="col-md-12">                  
					<div class="alert alert-dark text-center" role="alert">      
						
						<h1 class="alert-heading">
							<br>
							Wartungsarbeiten 👷
						</h1>
						
						<h4>
							Diese Seite ist aktuell im Wartungsmodus. Informiere dich im Dashboard oder per Discord warum diese Seite
							aktuell nicht nutzbar ist. Wir bitten um etwas Geduld und euer Verständnis. Wir werden euch über unsere
							Social-Media Kanäle auf dem laufenden halten.
						</h4>
						
						<br>
						<p>   
							<a href="<?= $helper->url() ?>order/webspace" class="btn btn-outline-primary text-uppercase font-weight-bolder pulse-red">Jetzt bestellen</a>   
						</p>
					</div>
				</div>              
			</div>
        </div>


    </div>
</div>