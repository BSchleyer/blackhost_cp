<?php
$price = 5;
$mainrabatt_script = 0.50;
$codeprice = 0;

$output = number_format($price,2) * $mainrabatt_script - $codeprice;

?>

<?= $output; ?>