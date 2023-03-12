<?php
$currPage = 'back_Webspace';
include BASE_PATH . 'app/controller/PageController.php';

$items = 0;

if (isset($_POST['saveCustomName'])) {
    $error = null;

    if (empty($_POST['webspace_id'])) {
        $error = 'Webspace wurde nicht gefunden';
    }

    if ($userid != $plesk->getWebspace($_POST['webspace_id'], 'user_id')) {
        $error = 'Du hast keine Rechte auf diesen Webspace';
    }

    if (empty($error)) {
        if (empty($_POST['custom_name'])) {
            $custom_name = null;
            $msg = 'Name wurde entfernt';
        } else {
            $custom_name = $_POST['custom_name'];
            $msg = 'Name wurde gespeichert';
        }

        $SQL = $db->prepare("UPDATE `webspace` SET `custom_name` = :custom_name WHERE `id` = :id");
        $SQL->execute(array(":custom_name" => $custom_name, ":id" => $_POST['webspace_id']));

        echo sendSuccess($msg);
    } else {
        echo sendError($error);
    }
}

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <?php
                $SQL = $db->prepare("SELECT * FROM `queue` WHERE `user_id` = :user_id");
                $SQL->execute(array(":user_id" => $userid));
                if ($SQL->rowCount() != 0) {
                    while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) {
                        $payload = json_decode($row['payload']);
                        if ($payload->action == 'PLESK_ORDER' or 'KEYHELP_ORDER') { ?>

                            <?php include BASE_PATH . 'resources/additional/pages/produkt_installing.php' ?>

                            <?php $items++;
                        }
                    }
                } ?>

                <?php
                $SQL = $db->prepare("SELECT * FROM `webspace` WHERE `user_id` = :user_id AND `deleted_at` IS NULL ORDER BY `id` DESC");
                $SQL->execute(array(":user_id" => $userid));
                if ($SQL->rowCount() != 0) {
                    while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) {

                        if ($row['state'] == 'active') {
                            $state = '<span class="badge badge-success">Aktiv</span>';
                        } else {
                            $state = '<span class="badge badge-warning">Gesperrt</span>';
                        }

                        if (!is_null($row['locked'])) {
                            $state = '<span class="badge badge-warning">Gesperrt</span>';
                        }

                        ?>

                        <div class="modal fade" id="webspaceModal<?= $row['id']; ?>" tabindex="-1" role="dialog"
                             aria-labelledby="webspaceModal<?= $row['id']; ?>Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="webspaceModal<?= $row['id']; ?>Label">Webspace
                                                umbenennen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <label>Produkt Name</label>
                                            <input class="form-control" name="custom_name"
                                                   value="<?= $row['custom_name']; ?>">
                                            <input hidden name="webspace_id" value="<?= $row['id']; ?>">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                    class="btn btn-outline-primary text-uppercase font-weight-bolder"
                                                    data-dismiss="modal"><i class="fas fa-ban"></i> Abbrechen
                                            </button>
                                            <button type="submit" name="saveCustomName"
                                                    class="btn btn-outline-success text-uppercase font-weight-bolder"><i
                                                        class="fas fa-save"></i> Speichern
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-3">
                            <div class="card text-center shadow mb-5">
                                <div class="card-header">
                                    <div class="row align-items-center text-center">
                                        <div class="col">
                                            <h3 class="mb-0">
                                            <span class="svg-icon svg-icon-primary svg-icon-8x">
												<i class="fa fa-globe" style="color:#6254FE"></i>
												</span>
                                                <br><br>
                                                <?php if (is_null($row['custom_name'])) { ?>
                                                    <b>Webspace</b> #<?= $row['id']; ?> <span data-toggle="tooltip"
                                                                                              title="Eigenen Produkt-Namen setzen"><i
                                                                style="cursor:pointer;" data-toggle="modal"
                                                                data-target="#webspaceModal<?= $row['id']; ?>"
                                                                class="far fa-edit"></i></span>
                                                <?php } else { ?>
                                                    <?= $helper->xssFix($row['custom_name']); ?> <span
                                                            data-toggle="tooltip"
                                                            title="Eigenen Produkt-Namen setzen"><i
                                                                style="cursor:pointer;" data-toggle="modal"
                                                                data-target="#webspaceModal<?= $row['id']; ?>"
                                                                class="far fa-edit"></i></span>
                                                <?php } ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="mb-lg-4">
                                                <b>Status</b><br>
                                                <?= $state; ?>
                                            </h4>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="mb-lg-4">
                                                <b>Domain</b><br>
                                                <span class="badge badge-success"><?= $row['domainName']; ?></span>
                                            </h4>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="mb-0">
                                                <b>Ablaufdatum</b><br>
                                                <span id="countdown<?= $row['id']; ?>">Lädt...</span>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?= env('URL'); ?>manage/webspace/<?= $row['id']; ?>"
                                               class="btn btn-block btn-outline-warning">
                                                <b><i class="fa fa-desktop"></i> Verwalten</b>
                                            </a>
                                        </div>

                                        <br><br><br>


                                        <?php
                                        $SQL5 = $db->prepare("SELECT * FROM `webspace_packs` WHERE `name` = :name");
                                        $name = $row['plan_id'];
                                        $SQL5->execute(array(":name" => $name));
                                        if ($SQL5->rowCount() != 0) {
                                            while ($webcheck = $SQL5->fetch(PDO::FETCH_ASSOC)) { ?>

                                                <?php if ($webcheck['kat'] == 1) { ?>


                                                    <div class="col-md-6">
                                                        <a href="<?= $helper->url() ?>renew/webspace/<?= $row['id']; ?>"
                                                           class="btn btn-block btn-outline-success">
                                                            <b><i class="fa fa-calendar-week"></i> Verlängern</b>
                                                        </a>
                                                    </div>


                                                <?php } ?>


                                                <?php if ($webcheck['kat'] == 2) { ?>


                                                    <div class="col-md-6">
                                                        <a href="<?= $helper->url() ?>renew/jahr/webspace/<?= $row['id']; ?>"
                                                           class="btn btn-block btn-outline-success">
                                                            <b><i class="fa fa-calendar-week"></i> Verlängern</b>
                                                        </a>
                                                    </div>


                                                <?php } ?>

                                            <?php }
                                        } ?>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            var countDownDate<?= $row['id']; ?> = new Date("<?= $row['expire_at']; ?>").getTime();
                            var x<?= $row['id']; ?> = setInterval(function () {

                                var now<?= $row['id']; ?> = new Date().getTime();
                                var distance<?= $row['id']; ?> = countDownDate<?= $row['id']; ?> - now<?= $row['id']; ?>;

                                var days = Math.floor(distance<?= $row['id']; ?> / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((distance<?= $row['id']; ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((distance<?= $row['id']; ?> % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance<?= $row['id']; ?> % (1000 * 60)) / 1000);

                                if (days == 1) {
                                    var days_text = ' Tag'
                                } else {
                                    var days_text = ' Tage';
                                }
                                if (hours == 1) {
                                    var hours_text = ' Stunde'
                                } else {
                                    var hours_text = ' Stunden';
                                }
                                if (minutes == 1) {
                                    var minutes_text = ' Minute'
                                } else {
                                    var minutes_text = ' Minuten';
                                }
                                if (seconds == 1) {
                                    var seconds_text = ' Sekunde'
                                } else {
                                    var seconds_text = ' Sekunden';
                                }

                                if (days == 0 && !(hours == 0 && minutes == 0 && seconds == 0)) {
                                    $('#countdown<?= $row["id"]; ?>').html(hours + hours_text + ', ' + minutes + minutes_text + ' und ' + seconds + seconds_text);
                                    if (days == 0 && hours == 0 && !(minutes == 0 && seconds == 0)) {
                                        $('#countdown<?= $row["id"]; ?>').html(minutes + minutes_text + ' und ' + seconds + seconds_text);
                                        if (days == 0 && hours == 0 && minutes == 0 && !(seconds == 0)) {
                                            $('#countdown<?= $row["id"]; ?>').html(seconds + seconds_text);
                                        }
                                    }
                                } else {
                                    $('#countdown<?= $row["id"]; ?>').html(days + days_text + ', ' + hours + hours_text + ', ' + minutes + minutes_text + ' und ' + seconds + seconds_text);
                                }

                                if (distance<?= $row['id']; ?> <= 0) {
                                    clearInterval(x<?= $row['id']; ?>);
                                }
                            }, 1000);
                        </script>
                        <?php $items++;
                    }
                }
                if ($items == 0) { ?>

                    <?php include BASE_PATH . 'resources/sites/_errors/produkt_notfound.php' ?>


                <?php } ?>
            </div>
        </div>
    </div>
</div>