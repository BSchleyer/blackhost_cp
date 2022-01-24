<?php
$state = "YES";
?>

                <?php
                $SQL = $db->prepare("UPDATE `daily_rew` SET `state` = :state");
                $SQL->execute(array(":state" => $state));
                if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php } } ?>
