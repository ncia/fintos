<?php
include_once('./common.php');
$sql = "select es_code, ei_no, ei_title, ei_state from {$g5['eyoom_slider_item']} where ei_title like '%SALE ITEMS%'";
$result = sql_query($sql);

echo "--- Searching for 'SALE ITEMS' ---\n";
while($row = sql_fetch_array($result)) {
    $state = ($row['ei_state'] == '1') ? "SHOW" : "HIDE";
    echo "Slider Code (es_code): {$row['es_code']} | ID: {$row['ei_no']} | Title: {$row['ei_title']} | Status: $state\n";
}
echo "----------------------------------\n";
?>
