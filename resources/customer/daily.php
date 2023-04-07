<?php
$currPage = 'back_Tägliche Belohnung';
include BASE_PATH . 'app/controller/PageController.php';

$daily = "0.05";

$SQL = $db->prepare("SELECT * FROM `daily_rew` WHERE `userid` = :user_id AND `state` = 'NO'");
$SQL->execute(array(":user_id" => $userid));

if (isset($_POST['claimDaily'])) {
    $dailyerror = false;

    if ($SQL->rowCount() !== 0) {
        $dailyerror = true;
    }

    if ($dailyerror == false) {

        $price = $daily;
        $proname = "Tägliche Belohnung";

        $SQL2 = $db->prepare("INSERT INTO `daily_rew` SET `userid` = :user_id, `state` = 'NO'");
        $SQL2->execute(array(":user_id" => $userid));

        $user->addMoney($price, $userid);
        $user->addTransaction($userid, '+' . $price, $proname . ' eingelöst');

        echo sendSuccess('Die Belohnung wurde eingelöst');
        header("Refresh:2");

    }

    if ($dailyerror == true) {
        echo sendError('Die Belohnung wurde bereits eingelöst');
    }


}
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary" role="alert">
                        Vorsicht: Diese Funktion befindet sich aktuell in der Beta, Fehler sind daher nicht
                        ausgeschlossen und sollten gemeldet werden.
                    </div>

                    <?php if ($SQL->rowCount() !== 0) { ?>

                        <div class="alert alert-warning" role="alert">
                            Du hast deine Belohnung für heute bereits gesammelt.
                        </div>

                    <?php } ?>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Guthaben</p>
                                    <h4 class="mb-0"><?= $amount; ?>€</h4>
                                    <small>Dein gesamtes Guthaben</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-wallet" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Belohnung</p>
                                    <h4 class="mb-0"><?= $daily; ?>€</h4>
                                    <small>Tägliche Belohnung</small>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle align-self-center">
                                    <span class="avatar-title">
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
											<i class="fa fa-gift" style="color:#6254FE;"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <form method="post">
                        <div class="card card-custom">
                            <div class="card-header border-0 pt-5" style="margin-bottom: -30px;">
                                <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">
									Belohnung in der Höhe von <?= $daily; ?>€ abholen.
								</span>
                                </h3>
                            </div>
                            <div class="card-body">

                                <?php if ($SQL->rowCount() !== 0) { ?>

                                    <button class="btn btn-outline-primary btn-block disabled" disabled="disabled">
                                        <b><i class="fas fa-times"></i> Belohnung bereits gesammelt</b>
                                    </button>

                                <?php } ?>

                                <?php if ($SQL->rowCount() == 0) { ?>

                                    <button type="submit" name="claimDaily"
                                            class="btn btn-outline-primary btn-block">
                                        <b><i class="fas fa-gift"></i> Belohnung abholen</b>
                                    </button>

                                <?php } ?>

                            </div>
                        </div>
                    </form>
                    <br>
                </div>

                <div class="col-md-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">
                            <table id="dataTableLoad" class="table dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Belohnung</th>
                                    <th>Status</th>
                                    <th>Datum</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $SQL = $db->prepare("SELECT * FROM `daily_rew` WHERE `userid` = :user_id");
                                $SQL->execute(array(":user_id" => $userid));
                                if ($SQL->rowCount() != 0) {
                                    while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $daily; ?>€</td>
                                            <td>

                                                <?php if ($row['state'] == "YES") { ?>

                                                    <?php $state = "Abgelaufen / Erfolgreich"; ?>

                                                <?php } elseif ($row['state'] == "NO") { ?>

                                                    <?php $state = "Aktiv / Erfolgreich"; ?>

                                                <?php } else { ?>

                                                <?php } ?>

                                                <?= $state; ?>
                                            </td>
                                            <td><?= $helper->formatDate($row['claimed_at']); ?></td>
                                            <td><a class="btn btn-outline-primary btn-sm font-weight-bolder"
                                                   href="tickets" target="_blank">Fehler melden</a>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>