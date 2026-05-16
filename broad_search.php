<?php
include_once('./common.php');
$sql = "select es_code, ei_no, ei_title, ei_subtitle, ei_state from {$g5['eyoom_slider_item']} where ei_title like '%SALE%' or ei_subtitle like '%SALE%'";
$result = sql_query($sql);

echo "--- Broad Search for 'SALE' ---\n";
while($row = sql_fetch_array($result)) {
    $state = ($row['ei_state'] == '1') ? "SHOW" : "HIDE";
    echo "es_code: {$row['es_code']} | ID: {$row['ei_no']} | Title: {$row['ei_title']} | Sub: {$row['ei_subtitle']} | Status: $state\n";
}
echo "-------------------------------\n";
?>
