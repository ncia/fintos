<?php
include_once('./common.php');
$sql = "select ei_no, es_code, ei_theme from {$g5['eyoom_slider_item']} where es_code = '1659255375' ";
$res = sql_query($sql);
while($row = sql_fetch_array($res)) {
    print_r($row);
}
?>
