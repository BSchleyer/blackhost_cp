<?php
$currPage = 'front_KVM Pakete (Angebote) Bestellen';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/kvm/order_packs_amd.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 style="font-size: 70px;">Unsere <b style="color: #6254FE;">KVM</b> Pakete (ANGEBOTE)</h1>
        </div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <?php
                $SQL = $db->prepare("SELECT * FROM `kvm_packs` WHERE `kat` = '-1'");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($pack = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

				<?php include '_kvmpackAMD.php'; ?>

<?php } } ?>



            </div>
        </div>
    </div>				
	<center><small></small></center>
</div>

