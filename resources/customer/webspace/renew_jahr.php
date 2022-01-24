<?php
$currPage = 'back_Webspace verlängern';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/webspace/renew_jahr.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-9">
                    <div class="card shadow mb-5">
                        <div class="card-body">

                            <form method="post">
                                <label for="duration">Laufzeit</label>
                                <select id="duration" name="duration" class="form-control">
                                    <option value="365" data-factor="1">365 Tage</option>
                                </select>

                                <div class="mt-10"></div>

                                <input name="voucher" hidden value="<?= $_POST['voucher']; ?>">
                                
                                <button type="submit" class="btn btn-outline-primary font-weight-bolder" name="renew"><i class="fas fa-history"></i> Kostenpflichtig verlängern</button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-5">
                        <div class="card-header text-center">
                            <h3 style="margin-bottom: 0px;">Kostenübersicht</h3>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Paket:
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
                                        <?= $packInfos['name']; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Laufzeit
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
                                        <span id="runtime_int">365</span> Tage
                                    </a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Gesamtbetrag:
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
                                        <span id="need_pay" data-amount=""></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $("select, textarea").change(function() { update(); } ).trigger("change");

    function update(){
        let sum = "<?= $serverInfos['price']; ?>";
        $('#runtime_int').html($("#duration").find("option:selected").val());
        let price = Number(sum * $("#duration").find("option:selected").data("factor")).toFixed(2);
        $("*[data-amount]").html(price + " €");
    }

    $(document).ready(function(){
        update();
    });
</script>