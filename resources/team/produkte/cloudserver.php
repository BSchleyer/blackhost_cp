<?php
$currPage = 'team_Produktverwaltung_admin';
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
                                    <th>#</th>
                                    <th>Inhaber</th>
                                    <th>Kosten</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $SQL = $db->prepare("SELECT * FROM `cloudserver`");
                                $SQL->execute();
                                if ($SQL->rowCount() != 0) {
                                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <td>NC #<?= $row['id']; ?></td>
                                        <td>
											<?= $user->getDataById($row['user_id'],'username'); ?>
											(#<?= $user->getDataById($row['user_id'],'id'); ?>)
										</td>
                                        <td><?= $row['price']; ?>€</td>
                                        <td><?= $row['state']; ?></td>
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