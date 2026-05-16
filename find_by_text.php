<?php
include_once('./common.php');
$text = '특별한제품을 할인 상품으로 만나보세요.';
$sql = "select es_code, ei_no, ei_title, ei_text, ei_state from {$g5['eyoom_slider_item']} where ei_text like '%$text%'";
$result = sql_query($sql);

echo "--- Searching for Description Text ---\n";
while($row = sql_fetch_array($result)) {
    $state = ($row['ei_state'] == '1') ? "SHOW" : "HIDE";
    echo "es_code: {$row['es_code']} | ID: {$row['ei_no']} | Title: {$row['ei_title']} | Status: $state\n";
}
echo "--------------------------------------\n";
?>
