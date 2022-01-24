<?php
$currPage = 'back_SinusBot verlängern';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/sinusbot/renew.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">

                            <form method="post">
                                <label for="duration">Laufzeit</label>
                                <select id="duration" name="duration" class="form-control">
                                    <option value="30" data-factor="1">30 Tage</option>
                                    <option value="60" data-factor="2">60 Tage</option>
                                    <option value="90" data-factor="3">90 Tage</option>
                                    <option value="180" data-factor="6">180 Tage</option>
                                </select>

                                <div class="mt-10"></div>

                                <button type="submit" class="btn btn-outline-primary" name="renew"><b><i class="fas fa-history"></i> Kostenpflichtig verlängern</b></button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                    <div class="card-header text-center">
                            <h3 style="margin-bottom: 0px;">Kostenübersicht</h3>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <b class="mb-0">
                                        Laufzeit
                                    </b>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted">
                                        <span id="runtime_int">30</span> Tage
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
        let price = Number(sum * $("#duration").find("option:selected").data("factor"))
            .toLocaleString("de-DE", {minimumFractionDigits: 2, maximumFractionDigits: 2});
        $("*[data-amount]").html(price + " €");
    }

    $(document).ready(function(){
        update();
    });
</script>