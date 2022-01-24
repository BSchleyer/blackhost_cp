<?php
$currPage = 'team_Zahlungsverwaltung_admin';
include BASE_PATH.'app/controller/PageController.php';

if(isset($_POST['acceptPayment'])){

    $SQL = $db->prepare("SELECT * FROM `transactions` WHERE `id` = :id");
    $SQL->execute(array(":id" => $_POST['payment_id']));
    $response = $SQL->fetch(PDO::FETCH_ASSOC);

    $user->addTransaction($response['user_id'], $response['amount'],'Guthabenaufladung mit Paysafecard');
    $user->addMoney($response['amount'], $response['user_id']);

    $SQL = $db->prepare("UPDATE `transactions` SET `state` = 'success' WHERE `id` = :id");
    $SQL->execute(array(':id' => $_POST['payment_id']));

    echo sendSuccess('Zahlung akzeptiert');
}

if(isset($_POST['declinePayment'])){

    $SQL = $db->prepare("UPDATE `transactions` SET `state` = 'abort' WHERE `id` = :id");
    $SQL->execute(array(':id' => $_POST['payment_id']));

    echo sendSuccess('Zahlung abgelehnt');
}

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body d-flex flex-column">
                            <table class="table" id="dataTableLoad">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Benutzername</th>
                                    <th>Betrag</th>
                                    <th>PSC-Code</th>
                                    <th>Datum</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $SQL = $db->prepare("SELECT * FROM `transactions` WHERE `gateway` = 'paysafecard' AND `state` = 'pending'");
                                $SQL->execute();
                                if ($SQL->rowCount() != 0) {
                                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $user->getDataById($row['user_id'],'username'); ?></td>
                                        <td><?= $row['amount']; ?>€</td>
                                        <td><?= $helper->xssFix($row['tid']); ?></td>
                                        <td><?= $helper->formatDate($row['created_at']); ?></td>
                                        <td>
                                            <form method="post">
                                                <input hidden name="payment_id" value="<?= $row['id']; ?>">
                                                <button type="submit" class="btn btn-outline-success btn-sm" name="acceptPayment"><b>Akzeptieren</b></button>
                                                <button type="submit" class="btn btn-outline-primary btn-sm" name="declinePayment"><b>Ablehnen</b></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
