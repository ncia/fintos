<?php
include_once('./_common.php');
$row = sql_fetch("select de_bodmi_target_date from {$g5['g5_shop_default_table']}");
echo "DATE_VAL:[" . $row['de_bodmi_target_date'] . "]";
?>
