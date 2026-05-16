<?php
include_once('./common.php');
$sql = "select es_code, ei_title, ei_state from {$g5['eyoom_slider_item']} where ei_title like '%SALE ITEMS%'";
$result = sql_query($sql);
while($row = sql_fetch_array($result)) {
    echo "Code: {$row['es_code']} | Title: {$row['ei_title']} | State: {$row['ei_state']}\n";
}
?>
