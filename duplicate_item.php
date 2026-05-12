<?php
include_once('./common.php');

$it_id_old = '1776008318';
$it_id_new = '1778489229';

$sql = "SELECT * FROM g5_shop_item WHERE it_id = '$it_id_old'";
$row = sql_fetch($sql);

if ($row) {
    unset($row['it_id']);
    $row['it_id'] = $it_id_new;
    $row['it_name'] = '삼성 행복종신보험 (복사본)';
    
    $set = "";
    $comma = "";
    foreach ($row as $key => $val) {
        if ($key == 'it_time' || $key == 'it_update_time') continue;
        $set .= "{$comma} `{$key}` = '" . addslashes($val) . "'";
        $comma = ", ";
    }
    
    $set .= ", it_time = NOW(), it_update_time = NOW()";
    
    $sql_insert = "REPLACE INTO g5_shop_item SET $set";
    sql_query($sql_insert);
    echo "Product duplicated successfully: $it_id_new";
} else {
    echo "Original product not found.";
}
?>
