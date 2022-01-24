<?php
$currPage = 'back_Zahlungsverlauf';
include BASE_PATH.'app/controller/PageController.php';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-custom card-stretch gutter-b shadow mb-5">
                        <div class="card-body d-flex flex-column">
                            <table id="dataTableLoad" class="table dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Beschreibung</th>
                                    <th>Betrag</th>
                                    <th>Datum</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $SQL = $db->prepare("SELECT * FROM `user_transactions` WHERE `user_id` = :user_id");
                                $SQL->execute(array(":user_id" => $userid));
                                if ($SQL->rowCount() != 0) {
                                    while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $row['desc']; ?></td>
                                            <td><?= $row['amount']; ?>€</td>
                                            <td><?= $helper->formatDate($row['created_at']); ?></td>
                                            <td> <a class="btn btn-outline-primary btn-sm font-weight-bolder" href="<?= env('URL'); ?>accounting/invoice/<?= $row['id']; ?>" target="_blank">Zur Rechnung</a> </td>
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