<?php
$currPage = 'front_Nextcloud Bestellen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/nextcloud/order.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: #6254FE;">Nextcloud</b> Server</h1>
        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <?php
                $SQL = $db->prepare("SELECT * FROM `cloudserver_packs`");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h1 style="font-size: 30px;">NEXTCLOUD-0<?= $row['id'] ?></h1>

		  	                 <?php if($row['nc_pack_oldprice'] == 0){ ?>
                            <b><span style="font-size: 28px;"><?= $row['nc_pack_price']; ?>€</span> / 30 Tage</b>

                            <?php } elseif($row['nc_pack_oldprice'] !== 0) { ?>
                            <b><span style="font-size: 28px; color:red;"><?= $row['nc_pack_price']; ?>€</span>/ 30 Tage</b>
								<br>
								<h5>Statt <?= $row['nc_pack_oldprice']; ?>€</h5>

                            <?php } else { ?>
                                
                            <?php } ?>

                        </div>
                        <div class="card-body" align="center">
                            <form method="post">

								<input hidden name="packid" value="<?= $row['id'] ?>">


								<h4>
									<i class="fas fa-hdd" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									<?= $row['nc_pack_speicher'] ?> Speicher<br>
									
									<br>

									<i class="fas fa-times" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Keine Einschränkungen<br>
									
									<br>
									
									<i class="fas fa-wifi" style="color:<?= env('MAIN_COLOR'); ?>"></i>
									Fair-Use Traffic<br>	
									
									<br>
									
									<br>
	
									<i class="fas fa-building" style="color:<?= env('MAIN_COLOR'); ?>"></i>								
									Deutschland<br>

									<br>
	
									<i class="fas fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>"></i>							
									1.000 MBIT/s Anbindung<br>
	
								</h4>

                                <br>
                                <hr>
                                <br>

                                        <div class="mt-7" align="center">
                                            <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                            <button type="submit" name="order" data-toggle="modal"  class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-shopping-cart"></i> Kostenpflichtig bestellen*
                                            </button>
                                            <?php } else { ?>
                                            <a href="<?= env('URL'); ?>register" class="btn btn-outline-primary text-uppercase font-weight-bolder px-15 py-3">
                                                <i class="fas fa-share-square"></i> Account erstellen
                                            </a>
                                            <?php } ?>
                                        </div>

                            </form>
                        </div>
                    </div>
                </div>


<?php } } ?>



            </div>
        </div>
    </div>				
	<center><small></small></center>
</div>

