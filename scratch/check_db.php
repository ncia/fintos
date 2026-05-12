<?php
include_once('./common.php');
$row = sql_fetch("SELECT * FROM g5_shop_default");
echo 'PC_TITLE: ' . $row['de_bodmi_title'] . PHP_EOL;
echo 'PC_DATE: ' . $row['de_bodmi_target_date'] . PHP_EOL;
echo 'ALL_TITLE: ' . $row['de_all_bodmi_title'] . PHP_EOL;
echo 'ALL_DATE: ' . $row['de_all_bodmi_target_date'] . PHP_EOL;
?>
