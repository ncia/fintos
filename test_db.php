<?php
include_once('./common.php');
$res = sql_query("SELECT it_id, it_name FROM g5_shop_item WHERE it_id = '1776008318'");
$row = sql_fetch_array($res);
print_r($row);
?>
