<?php
$currPage = 'team_Zahlungsverwaltung_admin';
include BASE_PATH.'app/controller/PageController.php';

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
                                    <th scope="col">
                                        #
                                    </th>
                                    <th scope="col">
                                        Benutzername
                                    </th>
                                    <th scope="col">
                                        Beschreibug
                                    </th>
                                    <th scope="col">
                                        Betrag
                                    </th>
                                    <th scope="col">
                                        Datum
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php
                                $SQL = $db -> prepare("SELECT * FROM `user_transactions`");
                                $SQL->execute();
                                if ($SQL->rowCount() != 0) {
                                    while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){
                                        $spin = str_replace('=','',base64_encode($row['s_pin']));
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $row['id']; ?></th>
                                            <td><?= $user->getDataById($row['user_id'],'username'); ?></td>
                                            <td><?= $row['desc']; ?></td>
                                            <td><?= $row['amount']; ?>€</td>
                                            <td><?= $helper->formatDate($row['created_at']); ?></td>
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
