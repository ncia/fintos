<?php
include_once('./common.php');
$es_code = '1650710257';
$sql = "select ei_no, ei_title, ei_state from {$g5['eyoom_slider_item']} where es_code = '$es_code'";
$result = sql_query($sql);

echo "--- Items for Top Banner Slider $es_code ---\n";
while($row = sql_fetch_array($result)) {
    $state = ($row['ei_state'] == '1') ? "SHOW" : "HIDE";
    echo "ID: {$row['ei_no']} | Title: {$row['ei_title']} | Status: $state\n";
}
echo "------------------------------------------\n";
?>
